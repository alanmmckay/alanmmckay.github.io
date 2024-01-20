//Abstract this function to include range parameters
function reframeImage(elementID,inPosition,outPosition, threshold){
    element = document.getElementById(elementID);
    bounding = element.getBoundingClientRect();
    if ( (threshold - bounding.top > 0) && (bounding.top > 0) )
    {
        element.style['object-position'] = inPosition;
    } else{
        element.style['object-position'] = outPosition;
    }
}
