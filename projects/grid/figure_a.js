function create_fig_a(canvas_id){
	var hexVa = [];
	hexVa.canvas = document.getElementById(canvas_id);
	hexVa.context = hexVa.canvas.getContext('2d');
	hexVa.s = 60;//This is the circumradius and the length of each hexegonal side
	hexVa.h = (Math.sin((30*(Math.PI/180))) * hexVa.s);
	hexVa.r = (Math.cos((30*(Math.PI/180))) * hexVa.s);//this is the inradius
	hexVa.a = 2*hexVa.r;
	hexVa.x = 25;
	hexVa.y = 5;


			hexVa.y = hexVa.y + hexVa.r;
	hexVa.context.beginPath(hexVa.x, hexVa.y);
		hexVa.x = hexVa.x + hexVa.h;
		hexVa.y = hexVa.y - hexVa.r;
	hexVa.context.moveTo(hexVa.x, hexVa.y);
		hexVa.x = hexVa.x + hexVa.s;
	hexVa.context.lineTo(hexVa.x, hexVa.y);
		hexVa.x = hexVa.x + hexVa.h;
		hexVa.y = hexVa.y + hexVa.r;
	hexVa.context.lineTo(hexVa.x, hexVa.y);
		hexVa.x = hexVa.x - hexVa.h;
		hexVa.y = hexVa.y + hexVa.r;
	hexVa.context.lineTo(hexVa.x, hexVa.y);
		hexVa.x = hexVa.x - hexVa.s;
	hexVa.context.lineTo(hexVa.x, hexVa.y);
		hexVa.x = hexVa.x - hexVa.h;
		hexVa.y = hexVa.y - hexVa.r;
	hexVa.context.lineTo(hexVa.x, hexVa.y);
			//hexV2.y = hexV2.y - hexV2.r;

	hexVa.context.closePath();
	hexVa.context.lineWidth = 1;
	hexVa.context.strokeStyle = 'grey';
	hexVa.context.fillStyle = '#ebebe0';
	hexVa.context.fill();
	hexVa.context.stroke();
	hexVa.context.fillStyle = 'black';
	hexVa.context.strokeStyle = 'black';
	hexVa.context.font = "18px Arial";

	hexVa.context.beginPath(hexVa.x, hexVa.y);
	hexVa.context.moveTo(hexVa.x, hexVa.y);
		hexVa.y = hexVa.y + 0.5*hexVa.r;
	hexVa.context.fillText("r", 15, hexVa.y+10);
		hexVa.y = hexVa.y + 0.5*hexVa.r;
	hexVa.context.lineTo(hexVa.x, hexVa.y);
		hexVa.x = hexVa.x + 0.5*hexVa.h;
	hexVa.context.fillText("h", hexVa.x-5, hexVa.y+20);
		hexVa.x = hexVa.x + 0.5*hexVa.h;
	hexVa.context.lineTo(hexVa.x, hexVa.y);
		hexVa.x = hexVa.x + 0.5*hexVa.s;
	hexVa.context.fillStyle = 'grey';
	hexVa.context.fillText("s", hexVa.x-5, hexVa.y+15);
	hexVa.context.closePath();
	hexVa.context.lineWidth = 1;
	hexVa.context.stroke();
}
