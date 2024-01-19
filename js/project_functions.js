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
