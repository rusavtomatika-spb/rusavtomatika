lightGallery(document.getElementById('lightgallery'), {
	
});
$(document).ready(function() { 
	var canvas_options = {
		textColour : '#484848', 
		outlineThickness : 1, 
		outlineColour : '#00ad61',
		outlineRadius: 4,
		maxSpeed : 0.02, 
		depth : 0.7, 
		pulsateTo : 0.6,
		initial : [0.1,-0.1],
		decel : 0.98,
		reverse : true,
		/*hideTags : false,*/
		shadow : '#ccc',
		shadowBlur : 2,
		weight : false,
		fadeIn : 1000,
		clickToFront : 600,
		textHeight: 20,
		zoomMin: 0.5,
		imageAlign: 'left',
		padding: 4,
		radiusX: 2.2
	};
	$('#catalog_canvas').tagcanvas(canvas_options);
	$('#sphere_canvas').tagcanvas(canvas_options);
});
/*
TagCanvas.depth = 0.92;
pulsateTo : 0.6,
initial : [0.1,-0.1],
decel : 0.98,
reverse : true,
hideTags : false,
shadow : '#ccc',
shadowBlur : 3,
weight : false,
fadeIn : 1000,
clickToFront : 600
 TagCanvas.imageScale = null;
 outlineColour : '#ссс'
 */