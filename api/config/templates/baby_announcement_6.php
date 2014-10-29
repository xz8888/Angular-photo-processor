<?php 

$templates[5]['id'] =6;
$templates[5]['width'] = 400;
$templates[5]['height'] = 300;
$templates[5]['thumbnail_width'] = 100;
$templates[5]['thumbnail_height'] = 150;
$templates[5]['thumbnail'] = 'http://placehold.it/100x150';
$templates[5]['template_image'] = 'http://placehold.it/400x500';
$templates[5]['template_name'] = 'Baby Annoucement 4';
$templates[5]["thumb_box"] =  array(
			"width" => 200, 
			"height" => 200
);
$templates[5]["number_of_blocks"] = 3;

/** Block definition **/
$templates[5]['blocks'] = array(
	array(
		"positionX" => 10, 
	    "positionY" => 10, 
	    "width" => 150, 
	    "height" => 50,
		"elements" => array(
			 array(
			 	"positionX" => 10, 
	    		"positionY" => 10,
				"field_type" => "text", 
				"font" => "Times New Roman", 
				"font_file" => "opensans/OpenSans-Regular.ttf", 
				"font_size" => 14,
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
	    		"positionY" => 25,
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
	    "positionY" => 100, 
	    "width" => 150, 
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
	    		"positionY" => 25,
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
