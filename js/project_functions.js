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
