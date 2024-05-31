<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
hex = function(name, type){
	this.vertices = hex_handler();
        this.vertices.center.name = name;
        if(type === null){
            this.vertices.center.type = type;
        }else{
            this.vertices.center.type = 'standard';
        }
        hexV.grid.push(this.vertices.sideVertices);
        hexV.origin.push(this.vertices.center);
}
<?php
    require($root_directory."code_footer.html");
?>
