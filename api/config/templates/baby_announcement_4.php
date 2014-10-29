<?php 

$templates[3]['id'] = 4;
$templates[3]['width'] = 400;
$templates[3]['height'] = 300;
$templates[3]['thumbnail_width'] = 100;
$templates[3]['thumbnail_height'] = 150;
$templates[3]['thumbnail'] = 'http://placehold.it/100x150';
$templates[3]['template_image'] = 'http://placehold.it/400x500';
$templates[3]['template_name'] = 'Baby Annoucement 4';
$templates[3]["thumb_box"] =  array(
			"width" => 200, 
			"height" => 200
);
$templates[3]["number_of_blocks"] = 3;

/** Block definition **/
$templates[3]['blocks'] = array(
	array(
		"positionX" => 10, 
	    "positionY" => 10, 
	    "width" => 200, 
	    "height" => 50,
		"elements" => array(
			 array(
			 	"positionX" => 10, 
	    		"positionY" => 10,
				"field_type" => "text", 
				"font" => "Times New Roman", 
				"font_file" => "opensans/OpenSans-Regular.ttf", 
				"font_size" => 12,
				"font_url" => "",
				"label" => "Subject Line", 
				"temp" => "default text", 
				"default_value" => "default text", 
				"placeholder" => "", 
				"value" => "default text",
				'color' => '#fff'
			),
		   
			array(
				"positionX" => 10, 
	    		"positionY" => 40,
				"field_type" => "date", 
				"font" => "Times New Roman", 
				"font_file" => "opensans/OpenSans-Regular.ttf", 
				"font_size" => 12,
				"font_url" => "",
				"label" => "birthday", 
				"temp" => "default text", 
				"default_value" => "default text", 
				"placeholder" => "", 
				"value" => "default text",
				'color' => '#fff'
			)
	  )
  ), 
   
   array(
   	   	"positionX" => 10, 
	    "positionY" => 50, 
	    "width" => 200, 
	    "height" => 50,
		"elements" => array(
			 array(
			 	"positionX" => 10, 
	    		"positionY" => 10,
				"field_type" => "text", 
				"font" => "Times New Roman", 
				"font_file" => "opensans/OpenSans-Regular.ttf", 
				"font_size" => 12,
				"font_url" => "",
				"label" => "Subject Line 2", 
				"temp" => "default text", 
				"default_value" => "default text", 
				"placeholder" => "", 
				"value" => "default text",
				'color' => '#fff'
			),
		   
			array(
				"positionX" => 10, 
	    		"positionY" => 40,
				"field_type" => "date", 
				"font" => "Times New Roman", 
				"font_file" => "opensans/OpenSans-Regular.ttf", 
				"font_size" => 12,
				"font_url" => "",
				"label" => "Date Type 2", 
				"temp" => "default text", 
				"default_value" => "default text", 
				"placeholder" => "", 
				"value" => "default text",
				'color' => '#fff'
			)
	  )
  )
);
