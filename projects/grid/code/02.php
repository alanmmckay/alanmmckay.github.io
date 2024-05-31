<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
hex_handler = function(){
	grid_handler();
	hexV.hexCount++;

	hexV.y = hexV.y + hexV.r;//priming the initial vertex.
	this.center = {x: hexV.x + hexV.s, y: hexV.y};
	this.sideVertices = [];

	//Taking a walk around the hexegon, generating each side vertex, then storing them in the sideVertices array:
	this.sideVertices.v1 = {x: hexV.x, y: hexV.y};
	hexV.x = hexV.x + hexV.h;
	hexV.y = hexV.y - hexV.r;
	this.sideVertices.v2 = {x: hexV.x, y: hexV.y};
	hexV.x = hexV.x + hexV.s;
	this.sideVertices.v3 = {x: hexV.x, y: hexV.y};
	hexV.x = hexV.x + hexV.h;
	hexV.y = hexV.y + hexV.r;
	this.sideVertices.v4 = {x: hexV.x, y: hexV.y};
	hexV.x = hexV.x - hexV.h;
	hexV.y = hexV.y + hexV.r;
	this.sideVertices.v5 = {x: hexV.x, y: hexV.y};
	hexV.x = hexV.x - hexV.s;
	this.sideVertices.v6 = {x: hexV.x, y: hexV.y};
	hexV.x = hexV.x - hexV.h;
	hexV.y = hexV.y - hexV.r;
	this.v7 = {x: hexV.x, y: hexV.y};//this is redundant, can trace back to v1
	hexV.y = hexV.y - hexV.r;

	return{
		center: this.center,
		sideVertices: this.sideVertices
	}
}
<?php
    require($root_directory."code_footer.html");
?>
