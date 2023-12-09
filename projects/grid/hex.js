var hexV = [];//this array holds all the variables and values associated with this script.

//*** Putting everything in the above hex array allows helps prevent any other script variables from having conflict with this script. This also makes it easy to include multiples of this file within a web page to house multiple hexagonal grids. All that's required is to use a search and replace function in a text editor to replace the string "hexV." with whatever arbitrary name you want to use for the object ***//

hexV.canvas = document.getElementById("myCanvas");
hexV.context = hexV.canvas.getContext('2d');

hexV.s = 25;//This is the circumradius and the length of each hexegonal side
hexV.h = (Math.sin((30*(Math.PI/180))) * hexV.s);
hexV.r = (Math.cos((30*(Math.PI/180))) * hexV.s);//this is the inradius
hexV.a = 2*hexV.r;
    
hexV.hexCount = 0;
hexV.newHex = true;
hexV.subHex = 1;
hexV.endHex = 0;
hexV.rows = 0;
hexV.cols = 3;
hexV.currentRow = 1;
hexV.adjacencyInit = false;
    
//** These variables are used in the grid_handler function. The help determine where each vertex should be positioned **//
hexV.actualx = 25;
hexV.actualy = 25;
hexV.x = hexV.actualx;
hexV.y = hexV.actualy;
hexV.counter = 1;
hexV.rowswitch = false;
hexV.rowinit = false;
hexV.init = false;

hexV.adjLines = false;
hexV.hexLines = false;
hexV.drawOrigins = false;

hexV.mousePos;
hexV.grid = [];//This global array will be populated by objects representing the coordinates of each hexegon
hexV.origin = [];




//*** grid_handler is used to handle the offest of every other hexagon. This also handles shifting the required hexegon to the next row. ***//
grid_handler = function(){
	if(hexV.counter <= hexV.cols){//it's not time to start a new row of hexegons
		if(hexV.rowinit === true){
			if(hexV.rowswitch === true){//a hexegon with an even designation in regards to how many hexegons have been generated in it's row
				hexV.x = hexV.x + hexV.h + hexV.s;
				hexV.y = hexV.y + hexV.r;
			}else{//a hexegon with an odd designation in regards to how many hexegons have been generated in it's row
				hexV.x = hexV.x + hexV.h + hexV.s;
				hexV.y = hexV.y - hexV.r;
			}
		}else{
			hexV.rowinit = true;
			if(hexV.init === true){//the first hexegon generated in each row after the first.
				hexV.x = hexV.x + hexV.h + hexV.s;
				hexV.y = hexV.y + hexV.r;
			}else{//the very first hexegon to be generated.
				hexV.init = true;
			}
		}
	}else{
		hexV.rowinit = false;
		hexV.counter = 1;
		hexV.x = hexV.actualx;
		if(hexV.cols % 2 === 0){
			hexV.y = hexV.y + hexV.r;
		}else{
			hexV.y = hexV.y + hexV.a;
		}
		hexV.rowswitch = false;
	}
	hexV.counter++;
	hexV.rowswitch = !hexV.rowswitch;
}

//*** hex_handler uses the grid_handler function to calculate the set of vertices associated with each hexegon. It then returns these values back to the hexegon object ***//
hex_handler = function(){
	grid_handler();
        hexV.hexCount++;
	hexV.y = hexV.y + hexV.r;//priming the initial vertex.
	this.center = {x: hexV.x + hexV.s, y: hexV.y};
        this.sideVertices = [];
        //Taking a walk around the hexegon, generating each side vertex, then storing them in the sideVertices array
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

//*** This is the hexagon data collection hub. Data is gathered from the above functions to be stored in array to be used by the functions used bellow ***//
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


function calculateAdjacentOrigins(){
    hexV.rows = Math.ceil(hexV.hexCount / hexV.cols);
    hexV.endHex = hexV.cols;
    //*** This function calculates and stores any center coordinates of any imaginary AND null hexegons that will be used in the grid's selection logic. Imaginary hexegons can be defined as adjacent hexegons to hexegons that exist on the border of the grid. Null hexegons are hexegons with the type of null; hexegons that a user may choose not to display. ***//
    
    //The coordinates are generated and stored in the origin array.
    //As of now, this function is only run once: When the first javascript event occurs. This is determined outside of the function so any implementation can redraw these values at their own discretion.
    
//*** The following if/else if statements factor three contingencies:
    

    
//*** ONLY ONE HEXEGON EXISTS ***//
    if(hexV.hexCount === 1){
        if(hexV.origin[0].type !== null){
            this.center = hexV.origin[0];
            hexV.origin.push({x: center.x, y: center.y - hexV.a});//hex top
            hexV.origin.push({x: center.x, y: center.y + hexV.a});//hex bottom
            hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top right
            hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top left
            hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right
            hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom left
        }
        
        
//*** ONLY ONE ROW OF HEXEGONS EXIST --- ***//
    }else if (hexV.rows === 1){
        for(i = 0; i < hexV.hexCount; i++){
            if(hexV.origin[i].type !== null){
                this.center = hexV.origin[i];
                hexV.origin.push({x: center.x, y: center.y - hexV.a});//hex top
                hexV.origin.push({x: center.x, y: center.y + hexV.a});//hex bottom
                if(hexV.origin[i+1].type === null && hexV.origin[i] !== hexV.hexCount-1){
                    if(i % 2 === 0){
                        hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top right
                    }
                    if(i % 2 !== 0){
                        hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right
                    }
                }
                if(i > 0 && i < hexV.hexCount){//making sure origin reference exists
                    if(hexV.origin[i-1].type === null){
                        if(hexV.origin[i-2].type === null){
                            if(i % 2 === 0){
                                hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top left 
                            }
                            if(i % 2 !== 0){
                                hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom left
                            }
                        }
                    }   
                }
            
                
                if(i === 0){
                    hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top left
                    hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom left
                }
                if(i === hexV.hexCount - 1){
                    hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top right
                    hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right
                }
            }
        }
        
        
//*** MULTIPLE ROWS OF HEXEGONS EXISTS ***//
    }else{
        for(i = 0; i < hexV.hexCount; i++){
            if(hexV.origin[i].type !== null){
                this.center = hexV.origin[i];
                
                //*** FIRST ROW CONDITION ***//
                if(hexV.currentRow === 1){
                    hexV.origin.push({x: center.x, y: center.y - hexV.a});//generate the top origin - applies to every hexagon in this row
                    if(hexV.origin[i+1].type === null && i !== hexV.endHex-1){
                        if(i % 2 === 0){
                            hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top right
                        }
                    }
                    if(i > 0 && i < hexV.hexCount){
                        if(hexV.origin[i-1].type === null){
                            if(hexV.origin[i-2].type === null){
                                if(i % 2 === 0){
                                    hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top left 
                                }
                            }
                        }
                    }
                
                    if(i === 0){
                        hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top left
                        if(hexV.origin[i+hexV.cols].type === null){
                            hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom left
                        }
                    }
                    if(i === hexV.cols-1){
                        hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top right 
                        if(hexV.origin[i+hexV.cols].type === null){
                          hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right  
                        }
                    }
                   
                    if(typeof hexV.origin[i+hexV.cols].type === "undefined" && i !== 0){
                        hexV.origin.push({x: center.x, y: center.y + hexV.a});//hex bottom
                        if(i === hexV.cols-1){
                            hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right
                        }
                        if(typeof hexV.origin[i-1+hexV.cols].type === "undefined"){
                            hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom left
                        }
                    }
                    
                    if( hexV.rows === 2){
                        if(typeof hexV.origin[i+hexV.cols].type === "undefined" && hexV.origin[i+1].type === null){
                            hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right
                        }
                    }
                
                //*** MIDDLE ROW CONDITION ***//
                }else if((hexV.currentRow > 1 && hexV.currentRow < hexV.rows) || (hexV.rows === 2 && hexV.currentRow === 1)){
                    if(hexV.newHex === true){
                        hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top left
                        if(hexV.origin[i+hexV.cols].type === null){
                            hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom left
                        }
                    }
                    
                    if(i === hexV.endHex-1){
                        hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top right 
                        if(hexV.origin[i+hexV.cols].type === null){
                           hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right  
                        }
                    }
                    
                    if(hexV.currentRow === hexV.rows - 1){
                        if(hexV.newHex !== true){
                            if(typeof hexV.origin[i+hexV.cols].type === "undefined"){
                                hexV.origin.push({x: center.x, y: center.y + hexV.a});//hex bottom
                                if(i === hexV.endHex-1){
                                    hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right
                                }
                            }
                            if(typeof hexV.origin[i-1+hexV.cols].type === "undefined" && hexV.origin[i-1].type === null){
                                if(hexV.subHex % 2 === 0){
                                    hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom left
                                }
                            }
                            if(typeof hexV.origin[i+1+hexV.cols].type === "undefined" && hexV.subHex % 2 === 0 && hexV.origin[i+1].type === null){
                               hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right  
                            }
                        }
                    }
                    
                //*** LAST ROW CONDITION ***/
                }else if(hexV.currentRow === hexV.rows){
                    hexV.origin.push({x: center.x, y: center.y + hexV.a});//hex bottom
                    if(hexV.newHex === true){
                        hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top left
                        hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom left
                    }
                    
                    if(i === hexV.hexCount - 1){
                        hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right
                        if(i === hexV.endHex-1 || hexV.origin[i+1-hexV.cols].type === null){
                            hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y - hexV.r});//hex top right
                        }                
                    }
                    
                    if(hexV.origin[i-1].type === null){
                        if(hexV.subHex % 2 === 0){
                            hexV.origin.push({x: center.x - 0.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom left
                        }
                    }
                    
                    if(hexV.origin[i+1].type === null){
                        if(hexV.subHex % 2 === 0){
                            hexV.origin.push({x: center.x + 2.5*hexV.s - hexV.s, y: center.y + hexV.r});//hex bottom right  
                        }
                    }

                
                   // 1-1blank-2-5blank-3-3blank-2
                   //6cols - 7 - 2blank - 4 
                }//end if
            }//end if
            
            if(hexV.newHex === true){
                hexV.newHex = false;
            }
            
            hexV.subHex++;
            
            if(i === hexV.endHex-1){
                hexV.newHex = true;
                hexV.subHex = 1;
                hexV.endHex = hexV.endHex + hexV.cols;
                hexV.currentRow++;
            }
        }
    }
    hexV.adjacencyInit = true;//this has now been initialized.
}


function getselectedHex(){
    if(hexV.adjacencyInit === false){
        calculateAdjacentOrigins();
    }
    
//*** This function starts by calculating the points of origin for adjacent hexagons that have yet to be factored. It then runs through the origin array and applies the distance formula between each set of coordinates and the current mouse position. The shortest length is considered the 'selection', as noted in the logic below ***//

    for(n = 0; n < hexV.origin.length; n++){
        this.original = hexV.origin[n];
        if(n === 0){//Initiate the calculations...
            this.minDistance = /*Math.floor*/(Math.sqrt( (original.x - hexV.mousePos.x)*(original.x - hexV.mousePos.x) + (original.y - hexV.mousePos.y)*(original.y - hexV.mousePos.y) ) );
            this.selected = hexV.origin[n];
        }else{//grab the next distance calculation...
            this.centerDistance = /*Math.floor*/(Math.sqrt( (original.x - hexV.mousePos.x)*(original.x - hexV.mousePos.x) + (original.y - hexV.mousePos.y)*(original.y - hexV.mousePos.y) ) );
            if(this.centerDistance < this.minDistance){//Compare the two calculations...
                this.minDistance = this.centerDistance;//if comparison is true, establish a new minimum distance...
                this.selected = hexV.origin[n];//...and prime the selected parameter.
            }
        }
    }
    //adjacencyInit = true;
    //console.log(this.selected.name);
    //console.log(this.selected.x+","+this.selected.y);
    return{
        selected: this.selected
    }
}


//drawHexes is the function that uses canvas-based methods to draw the hexagon
function drawHexes(evtinit){
    
    //*** This function grabs all the data that has been stored in both the grid and origin arrays and draws the hexagon on the canvas element. ***//
    //The evtinit parameter is used to decide whether or not certain elements should be drawn. This is relevant when a user may choose to move their cursor off the canvas element.
    
        if(evtinit === 1){
            this.selectedHex = getselectedHex();
        }
	for (i = 0; i < hexV.grid.length; i++){//loop through each set of side vertices stored in the grid array
            if(hexV.origin[i].type !== null){//check to see if the corresponding hexagon type hasn't been declared a null by the user
                this.vertices = hexV.grid[i];
            
                
               hexV.context.beginPath(vertices.v1.x, vertices.v1.y);
               hexV.context.moveTo(vertices.v2.x, vertices.v2.y);
               hexV.context.lineTo(vertices.v3.x, vertices.v3.y);
               hexV.context.lineTo(vertices.v4.x, vertices.v4.y);
               hexV.context.lineTo(vertices.v5.x, vertices.v5.y);
               hexV.context.lineTo(vertices.v6.x, vertices.v6.y);
               hexV.context.lineTo(vertices.v1.x, vertices.v1.y);
               hexV.context.closePath();
               hexV.context.lineWidth = 1;
                if(evtinit === 1){
                    //need to factor overlapping lines
                    //console.log(this.selectedHex.selected.x);
                    if(hexV.origin[i] === this.selectedHex.selected){
                        hexV.grid['hover'] = this.vertices;
                    }else{
                       hexV.context.strokeStyle = 'grey';
                    }
                }else{
                   hexV.context.strokeStyle = 'grey';
                }
               hexV.context.fillStyle='#ebebe0';
               hexV.context.fill();
               hexV.context.stroke();
               
               
                /*if(evtinit === 1){
                    hexV.context.fillStyle = "black";
                    hexV.context.font = "18px arial";
                    hexV.context.fillText(i, hexV.origin[i].x, hexV.origin[i].y);
                }*/
            }
	}
	if(hexV.grid['selected'] != null){
            this.vertices = hexV.grid['selected'];
           hexV.context.beginPath(vertices.v1.x, vertices.v1.y);
           hexV.context.moveTo(vertices.v2.x, vertices.v2.y);
           hexV.context.lineTo(vertices.v3.x, vertices.v3.y);
           hexV.context.lineTo(vertices.v4.x, vertices.v4.y);
           hexV.context.lineTo(vertices.v5.x, vertices.v5.y);
           hexV.context.lineTo(vertices.v6.x, vertices.v6.y);
           hexV.context.lineTo(vertices.v1.x, vertices.v1.y);
           hexV.context.closePath();
           hexV.context.lineWidth = 1;
           hexV.context.fillStyle='#d7d7c1';
           hexV.context.fill();
           hexV.context.stroke();
	}
	if(hexV.grid['hover'] != null){
            this.vertices = hexV.grid['hover'];
           hexV.context.beginPath(vertices.v1.x, vertices.v1.y);
           hexV.context.moveTo(vertices.v2.x, vertices.v2.y);
           hexV.context.lineTo(vertices.v3.x, vertices.v3.y);
           hexV.context.lineTo(vertices.v4.x, vertices.v4.y);
           hexV.context.lineTo(vertices.v5.x, vertices.v5.y);
           hexV.context.lineTo(vertices.v6.x, vertices.v6.y);
           hexV.context.lineTo(vertices.v1.x, vertices.v1.y);
           hexV.context.closePath();
           hexV.context.lineWidth = 1;	
           hexV.context.strokeStyle='black';
           hexV.context.stroke();
	}
        if(hexV.drawOrigins === true){
            for(n = 0; n < hexV.origin.length;n++){
                hexV.context.beginPath();
                hexV.context.arc(hexV.origin[n].x, hexV.origin[n].y, 1, 0, 2*Math.PI, false);
                hexV.context.fillStyle = 'black';
                hexV.context.fill();
                hexV.context.strokeStyle = 'black';
                hexV.context.stroke();
            }
        }
	if(evtinit === 1){
            for(j = 0; j < hexV.origin.length; j++){
                if(hexV.hexLines === true && j < hexV.hexCount){
                    hexV.context.beginPath();
                    hexV.context.moveTo(hexV.origin[j].x, hexV.origin[j].y);
                    hexV.context.lineTo(hexV.mousePos.x, hexV.mousePos.y);
                    hexV.context.closePath();
                    hexV.context.lineWidth = 1;
                    hexV.context.strokeStyle = 'black';
                    hexV.context.stroke();
                }
                if(hexV.adjLines === true && j >= hexV.hexCount){
                    hexV.context.beginPath();
                    hexV.context.moveTo(hexV.origin[j].x, hexV.origin[j].y);
                    hexV.context.lineTo(hexV.mousePos.x, hexV.mousePos.y);
                    hexV.context.closePath();
                    hexV.context.lineWidth = 1;
                    hexV.context.strokeStyle = 'black';
                    hexV.context.stroke();
                }
            }
        }
	hexV.grid['hover'] = null;
        
}



function getMousePos(canvas, evt) {
    hexV.rect = hexV.canvas.getBoundingClientRect();
    return {
            x: Math.floor((evt.clientX-hexV.rect.left)/(hexV.rect.right-hexV.rect.left)*hexV.canvas.width),
            y: Math.floor((evt.clientY-hexV.rect.top)/(hexV.rect.bottom-hexV.rect.top)*hexV.canvas.height)
    };
}

hexV.canvas.addEventListener('mousemove', function(evt){
    hexV.mousePos = getMousePos(hexV.canvas,evt);
    hexV.x = 0;
    hexV.y = 0;
    hexV.counter = 1;
    hexV.rowswitch = false;
    hexV.rowinit = false;
    hexV.init = false;
   hexV.context.clearRect(0, 0, hexV.canvas.width, hexV.canvas.height);
    drawHexes(1);
}, false);

hexV.canvas.addEventListener('mouseout', function(evt){
    hexV.mousePos = getMousePos(hexV.canvas,evt);
    hexV.x = 0;
    hexV.y = 0;
    hexV.counter = 1;
    hexV.rowswitch = false;
    hexV.rowinit = false;
    hexV.init = false;
   hexV.context.clearRect(0, 0, hexV.canvas.width, hexV.canvas.height);
    drawHexes(0);
}, false);

hexV.canvas.addEventListener('mousedown', function(evt){
    for (i = 0; i < hexV.grid.length; i++){
        this.vertices = hexV.grid[i];//resume
        this.selectedHex = getselectedHex();
        if(hexV.origin[i] === this.selectedHex.selected && hexV.origin[i].type !== null){
            if(hexV.grid['selected'] === this.vertices){
                //document.getElementById("output").innerHTML = '<br>';
                hexV.grid['selected'] = null;
            }else{
                //document.getElementById("output").innerHTML = hexV.origin[i].name;
                hexV.grid['selected'] = this.vertices;
            }
            drawHexes(1);
        }
    }
}, false);


//** Page specific functions **//
sliderfunction = function(){
    hexContainer = [];
    hexV.s = parseInt(document.getElementById("sizeslider").value);
    hexV.h = (Math.sin((30*(Math.PI/180))) * hexV.s);
    hexV.r = (Math.cos((30*(Math.PI/180))) * hexV.s);
    hexV.a = 2*hexV.r;
    hexV.hexCount2 = hexV.hexCount;
    
    hexV.origin2 = [];
    
    hexV.hexCount = 0;
    hexV.newHex = true;
    hexV.currentRow = 1;
    hexV.adjacencyInit = false;
    
    hexV.x = hexV.actualx;
    hexV.y = hexV.actualy;
    hexV.counter = 1;
    hexV.rowswitch = false;
    hexV.rowinit = false;
    hexV.init = false;
    
    for(c = 0; c < hexV.hexCount2; c++){
        hexV.origin2[c] = hexV.origin[c];
    }
    
    hexV.mousePos;
    hexV.grid = [];
    hexV.origin = [];
    
    for(c = 0; c < hexV.hexCount2; c++)
    {
        if(hexV.origin2[c].type !== null){
            hexContainer[c] = new hex("tile"+c);
        }else{
            hexContainer[c] = new hex("tile"+c, null);
        }
        //console.log(hexV.hexCount);
    }
    hexV.origin2 = [];
    calculateAdjacentOrigins();
    hexV.context.clearRect(0, 0, hexV.canvas.width, hexV.canvas.height);
    drawHexes(0);
}

traceAdj = function(){
    if(hexV.adjLines === false){
        hexV.adjLines = true;
        document.getElementById("traceAdjOrig").value = "Disable Adjacency Trace";
    }else{
        hexV.adjLines = false;
        document.getElementById("traceAdjOrig").value = "Trace Adjacency Lines";
    }
}

traceOrig1 = function(){
    if(hexV.hexLines === false){
        hexV.hexLines = true;
        document.getElementById("traceOrig").value = 'Disable Origin Trace';
    }else{
        hexV.hexLines = false;
        document.getElementById("traceOrig").value = 'Trace Origin Lines';
    }
}

addHex1 = function(type){
hexV.origin2 = [];

for(c = 0; c < hexV.hexCount;c++){
    hexV.origin2[c] = hexV.origin[c];
}

hexContainer = [];
hexV.hexCount2 = hexV.hexCount;
hexV.hexCount = 0;
hexV.newHex = true;
hexV.currentRow = 1;
hexV.adjacencyInit = false;

hexV.x = hexV.actualx;
hexV.y = hexV.actualy;
hexV.counter = 1;
hexV.rowswitch = false;
hexV.rowinit = false;
hexV.init = false;

hexV.mousePos;
hexV.grid = [];
hexV.origin = [];

for(c = 0; c < hexV.hexCount2;c++){
    if(hexV.origin2[c].type === null){
        hexContainer[c] = new hex(c, null);
    }else{
        hexContainer[c] = new hex("tile"+c);
    }
}

if(type === null){
    hexContainer[hexV.hexCount+1] = new hex("tile"+(hexV.hexCount+1), null);
}else{
    hexContainer[hexV.hexCount+1] = new hex("tile"+(hexV.hexCount+1));
}

hexV.origin2 = [];

calculateAdjacentOrigins();
hexV.context.clearRect(0, 0, hexV.canvas.width, hexV.canvas.height);
drawHexes(0);
}

removeHex1 = function(){
    if(hexV.hexCount > 1){
    hexV.origin2 = [];

    for(c = 0; c < hexV.hexCount;c++){
        hexV.origin2[c] = hexV.origin[c];
    }

    hexContainer = [];
    hexV.hexCount2 = hexV.hexCount-1;
    hexV.hexCount = 0;
    hexV.newHex = true;
    hexV.currentRow = 1;
    hexV.adjacencyInit = false;
    
    hexV.x = hexV.actualx;
    hexV.y = hexV.actualy;
    hexV.counter = 1;
    hexV.rowswitch = false;
    hexV.rowinit = false;
    hexV.init = false;
    
    hexV.mousePos;
    hexV.grid = [];
    hexV.origin = [];
    
    for(c = 0; c < hexV.hexCount2;c++){
        if(hexV.origin2[c].type === null){
            hexContainer[c] = new hex(c, null);
        }else{
            hexContainer[c] = new hex("tile"+c);
        }
    }
    hexV.origin2 = [];
    calculateAdjacentOrigins();
    hexV.context.clearRect(0, 0, hexV.canvas.width, hexV.canvas.height);
    drawHexes(0);
    }
}

drawOrigin = function(){
    if(hexV.drawOrigins === false){
        hexV.drawOrigins = true;
        document.getElementById("originDisplay").value = 'Hide Points of Origin';
    }else{
        hexV.drawOrigins = false;
        document.getElementById("originDisplay").value = 'Show Points of Origin';
    }  
    hexV.context.clearRect(0, 0, hexV.canvas.width, hexV.canvas.height);
    drawHexes(0);
}

addColumn1 = function(){
    hexV.hexCount2 = hexV.hexCount;
    hexV.origin2 = [];
    
    hexV.hexCount = 0;
    hexV.newHex = true;
    hexV.cols = hexV.cols + 1;
    hexV.currentRow = 1;
    hexV.adjacencyInit = false;
    
    hexV.x = hexV.actualx;
    hexV.y = hexV.actualy;
    hexV.counter = 1;
    hexV.rowswitch = false;
    hexV.rowinit = false;
    hexV.init = false;
    
    for(c = 0; c < hexV.hexCount2; c++){
        hexV.origin2[c] = hexV.origin[c];
    }
    
    hexV.mousePos;
    hexV.grid = [];
    hexV.origin = [];
    
    for(c = 0; c < hexV.hexCount2; c++)
    {
        if(hexV.origin2[c].type !== null){
            hexContainer[c] = new hex("tile"+c);
        }else{
            hexContainer[c] = new hex("tile"+c, null);
        }
        //console.log(hexV.hexCount);
    }
    hexV.origin2 = [];
    calculateAdjacentOrigins();
    hexV.context.clearRect(0, 0, hexV.canvas.width, hexV.canvas.height);
    drawHexes(0);
}

removeColumn1 = function(){
    if(hexV.cols > 1){
    hexV.hexCount2 = hexV.hexCount;
    hexV.origin2 = [];
    
    hexV.hexCount = 0;
    hexV.newHex = true;
    hexV.cols = hexV.cols - 1;
    hexV.currentRow = 1;
    hexV.adjacencyInit = false;
    
    hexV.x = hexV.actualx;
    hexV.y = hexV.actualy;
    hexV.counter = 1;
    hexV.rowswitch = false;
    hexV.rowinit = false;
    hexV.init = false;
    
    for(c = 0; c < hexV.hexCount2; c++){
        hexV.origin2[c] = hexV.origin[c];
    }
    
    hexV.mousePos;
    hexV.grid = [];
    hexV.origin = [];
    
    for(c = 0; c < hexV.hexCount2; c++)
    {
        if(hexV.origin2[c].type !== null){
            hexContainer[c] = new hex("tile"+c);
        }else{
            hexContainer[c] = new hex("tile"+c, null);
        }
        //console.log(hexV.hexCount);
    }
    hexV.origin2 = [];
    calculateAdjacentOrigins();
    hexV.context.clearRect(0, 0, hexV.canvas.width, hexV.canvas.height);
    drawHexes(0);
    }
} 
