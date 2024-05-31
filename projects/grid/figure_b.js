function create_fig_b(canvas_id){
	var hexV4 = [];
	hexV4.canvas = document.getElementById(canvas_id);
	hexV4.context = hexV4.canvas.getContext('2d');
	hexV4.s = 60;//This is the circumradius and the length of each hexegonal side
	hexV4.h = (Math.sin((30*(Math.PI/180))) * hexV4.s);
	hexV4.r = (Math.cos((30*(Math.PI/180))) * hexV4.s);//this is the inradius
	hexV4.a = 2*hexV4.r;
	hexV4.x = 25;
	hexV4.y = 25;


			hexV4.y = hexV4.y + hexV4.r;
	hexV4.context.beginPath(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x + hexV4.h;
		hexV4.y = hexV4.y - hexV4.r;
	hexV4.context.moveTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x + hexV4.s;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x + hexV4.h;
		hexV4.y = hexV4.y + hexV4.r;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x - hexV4.h;
		hexV4.y = hexV4.y + hexV4.r;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x - hexV4.s;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x - hexV4.h;
		hexV4.y = hexV4.y - hexV4.r;
			hexV4.resume = {x:hexV4.x, y:hexV4.y};
	hexV4.context.lineTo(hexV4.x, hexV4.y);
			//hexV2.y = hexV2.y - hexV2.r;

	hexV4.context.closePath();
	hexV4.context.lineWidth = 1;
	hexV4.context.strokeStyle = 'grey';
	hexV4.context.fillStyle = '#ebebe0';
	hexV4.context.fill();
	hexV4.context.stroke();

	hexV4.x = hexV4.x + hexV4.h + hexV4.s;
	hexV4.y = hexV4.y + hexV4.r;

			//hexV4.y = hexV4.y + hexV4.r;
	hexV4.context.beginPath(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x + hexV4.h;
		hexV4.y = hexV4.y - hexV4.r;
	hexV4.context.moveTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x + hexV4.s;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x + hexV4.h;
		hexV4.y = hexV4.y + hexV4.r;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x - hexV4.h;
		hexV4.y = hexV4.y + hexV4.r;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x - hexV4.s;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x - hexV4.h;
		hexV4.y = hexV4.y - hexV4.r;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
			//hexV2.y = hexV2.y - hexV2.r;

	hexV4.context.closePath();
	hexV4.context.lineWidth = 1;
	hexV4.context.strokeStyle = 'grey';
	hexV4.context.fillStyle = '#ebebe0';
	hexV4.context.fill();
	hexV4.context.stroke();

	hexV4.x = hexV4.x + hexV4.h + hexV4.s;
	hexV4.y = hexV4.y - hexV4.r;

			//hexV4.y = hexV4.y + hexV4.r;
	hexV4.context.beginPath(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x + hexV4.h;
		hexV4.y = hexV4.y - hexV4.r;
	hexV4.context.moveTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x + hexV4.s;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x + hexV4.h;
		hexV4.y = hexV4.y + hexV4.r;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x - hexV4.h;
		hexV4.y = hexV4.y + hexV4.r;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x - hexV4.s;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.x = hexV4.x - hexV4.h;
		hexV4.y = hexV4.y - hexV4.r;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
			hexV4.y = hexV4.y - hexV4.r;

	hexV4.context.closePath();
	hexV4.context.lineWidth = 1;
	hexV4.context.strokeStyle = 'grey';
	hexV4.context.fillStyle = '#ebebe0';
	hexV4.context.fill();
	hexV4.context.stroke();



	hexV4.context.fillStyle = 'black';
	hexV4.context.font = "18px Arial";

		hexV4.x = hexV4.resume.x;// + 2*hexV4.s;
		hexV4.y = hexV4.resume.y;
	hexV4.context.beginPath(hexV4.x, hexV4.y);
	hexV4.context.moveTo(hexV4.x, hexV4.y);
		hexV4.x = (hexV4.x + 0.5*hexV4.h + 0.5*hexV4.s);
	hexV4.context.fillText("h + s", hexV4.x-15, hexV4.y-5);
		hexV4.x = (hexV4.x + 0.5*hexV4.h + 0.5*hexV4.s);
	hexV4.context.lineTo(hexV4.x, hexV4.y);
		hexV4.y = hexV4.y + 0.5*hexV4.r;
	hexV4.context.fillText("r", hexV4.x+5, hexV4.y);
		hexV4.y = hexV4.y + 0.5*hexV4.r;
	hexV4.context.lineTo(hexV4.x, hexV4.y);
	hexV4.context.lineWidth = 1;
	hexV4.context.strokeStyle = 'black';
	hexV4.context.stroke();
}
