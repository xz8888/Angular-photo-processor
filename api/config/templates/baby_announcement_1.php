<?php 

$templates[0]['id'] = 1;
$templates[0]['width'] = 300;
$templates[0]['height'] = 400;
$templates[0]['thumbnail_width'] = 100;
$templates[0]['thumbnail_height'] = 150;
$templates[0]['thumbnail'] = 'http://placehold.it/100x150';
$templates[0]['template_image'] = 'http://placehold.it/400x500';
$templates[0]['template_name'] = 'Baby Annoucement 1';
$templates[0]["thumb_box"] =  array(
			"width" => 200, 
			"height" => 200
);
$templates[0]["number_of_blocks"] = 3;

/** Block definition **/
$templates[0]['blocks'] = array(

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
				"font_size" => 16,
				"font_file" => "opensans/OpenSans-Regular.ttf",
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
	    		"positionY" => 60, 
				"field_type" => "date", 
				"font" => "Times New Roman", 
				"font_size" => 12,
				"font_file" => "opensans/OpenSans-Regular.ttf",
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
   	    "positionY" => 120,
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
				'color' => '#fff', 
			),
		   
			array(
				"positionX" => 10, 
	    		"positionY" => 50, 
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
  )
);
