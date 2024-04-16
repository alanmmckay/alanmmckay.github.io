/* ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----  */

function toggleCollapsible(body_id, header_id, expand_str, collapse_str, collapsed_attribute){
    header = document.getElementById(header_id);
    if(header.getAttribute(collapsed_attribute) == 'false'){
        new_status_bool = true;
        header.setAttribute(collapsed_attribute,true);
    }else{
        new_status_bool = false;
        header.setAttribute(collapsed_attribute,false);
    }
    old_header_str = header.innerHTML;
    if(new_status_bool == true){
        document.getElementById(body_id).style.display = "block";
        new_header_str = collapse_str + old_header_str.slice(expand_str.length,old_header_str.length);
    }else{
        document.getElementById(body_id).style.display = "none";
        new_header_str = expand_str + old_header_str.slice(collapse_str.length,old_header_str.length);
    }
    document.getElementById(header_id).innerHTML = new_header_str;
}

/* ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----  */

// This solves the problem of proportional scaling with respect to
//  height and an image's width being scaled on window resize;
//  Something that native css can't handle as far as I know.
function setDynamicFigureStyle(event_type, screen_state,element,old_ele_height,class_id){

    screen_height = window.outerHeight;
    shrinking = screen_state['shrinking'];
    growing = screen_state['growing'];
    flex_switch = screen_state['flex_switch'];
    old_screen_height = screen_state['old_screen_height'];
    old_orientation = screen_state['old_orientation'];

    // Conditional considers prior values of shrinking and growing:
    if(!(shrinking == true && growing == true)){
        // Determine if screen is currently shrinking or growing:
        if(old_screen_height < screen_height){
            shrinking = false;
            growing = true;
        }else if(old_screen_height > screen_height){
            shrinking = true;
            growing = false;
        }else{
            shrinking = false;
            growing = false;
            // Factors the change in the x-axis causing the fig to be bigger:
            if(element_height > screen_height){
                shrinking = true;
            }
            // Contingent Redundancy:
            old_ele_height = element.getBoundingClientRect().height;
        }
    }else{
        shrinking = true;
        growing = false;
    }
    // Get the height of the figure as a whole (not the window):
    element_height = element.getBoundingClientRect().height;
    if(shrinking == true){
        if(element_height >= screen_height){
            if(flex_switch == false){
                old_ele_height = element.getBoundingClientRect().height;
                flex_switch = true;
            }
            element.classList.add(class_id);
            element.style.display = 'flex';
        }
    }
    if(growing == true){
        if(old_ele_height < screen_height){
            element.classList.remove(class_id);
            element.style.display = 'inherit';
            flex_switch = false;
        }
    }
    old_screen_height = screen_height;
    return [{"old_screen_height": old_screen_height,
            "shrinking": shrinking,
            "growing": growing,
            "old_orientation": old_orientation,
            "flex_switch": flex_switch
    },old_ele_height];
}

/* ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----  */

// A function which changes the font size of a code block being displayed.
//  This requires elements with the following schema to be in place:
/*
 * <figure class='code-figure'>
 *      <iframe frameborder="0" style='width:100%;max-height:<INT>px;overflow:auto' max-height='<INT>' src='<URI>'>
 *      </iframe>
 * </figure>
 */
// setCodeSizeSliders() will attach a div containing a button and an input
//  slider to each element with code-figure set as a class.
// revealCodeSizeSlider() activates the relevant control once a button is
//  pressed or once an input option is selected.
// changeCodeSize() will then set the size of the font in each iframe whilst
//  changing the max-height property to ensure that the iframes cannot be
//  resized to too great of a length.

// Changes made using this resize method is global for all code blocks being
//  displayed on a page.

function changeCodeSize(element){
    var value = element.value;
    var iframes = document.getElementsByTagName('iframe');
    for(let i=0; i<iframes.length; i++){
        var iframe = iframes[i];
        var iframe_content = iframe.contentWindow.document;
        var pre = iframe_content.getElementsByTagName('pre')[0];
        var code = iframe_content.getElementsByTagName('code')[0];
        code.style['font-size'] = value+'px';
        // For hidden elements:
        if(pre.getBoundingClientRect().height == '' || pre.getBoundingClientRect().height == '0'){
            var new_height = Number(iframe.style['max-height'].substring(0,iframe.style['max-height'].length-2));
            var max = Number(iframe.getAttribute('max-height'));
            var ratio = max * ((17-1)-value);
            ratio = ratio / 17;
            iframe.style['max-height'] = max - ratio + 'px';
        }else{
            var new_height = pre.getBoundingClientRect().height;
            iframe.style['max-height'] = new_height+((17+1-value+85)*.40)+'px';
        }
        //
        if(pre.style['padding-top'] == '' || pre.style['padding-top'] == '0%'){
            var padding = 0;
        }else{
            var padding = Number(pre.style['padding-top'].substring(0,pre.style['padding-top'].length-1));
        };
        pre.style['padding-top'] = (17 + 1 - value)*.40 + '%';
    }
    slider_containers = document.getElementsByClassName('code-font');
    for(let i=0; i<slider_containers.length; i++){
        container = slider_containers[i];
        slider = container.getElementsByTagName('input')[0];
        slider.value = value;
    }
}

function revealCodeSizeSlider(bool){
    var buttons = document.getElementsByTagName('button');
    for(let i=0; i<buttons.length; i++){
        var button = buttons[i];
        if(bool == true){
            button.style['display'] = 'none';
        }else{
            button.style['display'] = 'inherit';
        }
    }
    slider_containers = document.getElementsByClassName('code-font');
    for(let i=0; i<slider_containers.length; i++){
        container = slider_containers[i];
        slider = container.getElementsByTagName('input')[0];
        if(bool == true){
            slider.style['display'] = 'inherit';
        }else{
            slider.style['display'] = 'none';
        }
    }
}

function setCodeSizeSliders(){
    var iframe_containers = document.getElementsByClassName('code-figure');
    for(let i=0; i<iframe_containers.length; i++){
        var container = iframe_containers[i];
        var div = document.createElement('div');
        div.classList.add('code-font');

        var button = document.createElement('button');
        button.addEventListener("click",function(){revealCodeSizeSlider(true);});
        button.innerHTML = "Code Size";

        var input = document.createElement('input');
        input.type = 'range';
        input.min = '12';
        input.max = '17';
        input.value = '17';
        input.addEventListener('input',function(){changeCodeSize(this);});
        input.addEventListener('mouseup',function(){revealCodeSizeSlider(false);});
        input.addEventListener('touchend',function(){revealCodeSizeSlider(false);});

        div.appendChild(button);
        div.appendChild(input);
        container.insertBefore(div,container.firstChild);
    }
}


/* ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----  */
