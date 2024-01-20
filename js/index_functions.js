function primeClassTransitions(class_name, css_property, initial_value, transition_time, transition_switch){
    elements = document.getElementsByClassName(class_name);
    for (i = 0; i < elements.length; i++){
        element = elements[i];
        if (transition_switch == true){
            element.style['transition'] = css_property + ' ' + transition_time;
        }else{
            element.style['transition'] = css_property + ' 0s';
        }
        element.style[css_property] = initial_value;
    }
}


function applyClassTransitionEffects(class_name, css_property, thresh_in_value, thresh_in_time, thresh_out_value, thresh_out_time, screen_threshold) {
    height = screen.height;
    elements = document.getElementsByClassName(class_name);
    for (i = 0; i < elements.length; i++){
        element = elements[i];
        bound = element.getBoundingClientRect();
        if (bound.y < height - screen_threshold){
            element.style['transition'] = css_property + ' ' + thresh_in_time;
            element.style[css_property] = thresh_in_value;
        }
        if ((bound.y < 0) || (bound.y > height - screen_threshold)){
            element.style['transition'] = css_property + ' ' + thresh_out_time;
            element.style[css_property] = thresh_out_value;
        }
    }
}
