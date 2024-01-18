var isMobile = window.matchMedia || window.msMatchMedia;
/* Exercise: Need to abstract the styles being changed */
function primeBorders(transition){
    if (isMobile("(pointer:coarse)").matches){
    writings = document.getElementsByClassName("writing");
        for (i = 0; i < writings.length; i++){
            writing = writings[i];
            if (transition == true){
                writing.style['transition'] = 'border-left 2s';
            }else{
                writing.style['transition'] = 'border-left 0s';
            }
            bound = writing.getBoundingClientRect();
            writing.style['border-left'] = 'solid 2px';
        }
    }
}

function scrollEffect() {
    if (isMobile("(pointer:coarse)").matches){
        height = screen.height;
        threshold = 35;
        writings = document.getElementsByClassName("writing");
        for (i = 0; i < writings.length; i++){
            writing = writings[i];
            bound = writing.getBoundingClientRect();
            if (bound.y < height - threshold){
                writing.style['transition'] = 'border-left .5s';
                writing.style['border-left'] = 'solid white 10px';
            }
            if ((bound.y < 0) || (bound.y > height - threshold)){
                writing.style['transition'] = 'border-left 1s';
                writing.style['border-left'] = 'solid #778088 2px';
            }
        }
    }
}

window.onscroll = function(ev){
    scrollEffect();
}

window.onscrollend = function(ev){
    primeBorders(true);
}

window.addEventListener('load', function () {
    setTimeout(function(){
        primeBorders(false);
    },100);
});
