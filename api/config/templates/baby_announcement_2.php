<?php 

$templates[1]['id'] = 2;
$templates[1]['width'] = 400;
$templates[1]['height'] = 500;
$templates[1]['thumbnail_width'] = 100;
$templates[1]['thumbnail_height'] = 150;
$templates[1]['thumbnail'] = 'http://placehold.it/100x150';
$templates[1]['template_image'] = 'http://placehold.it/400x500';
$templates[1]['template_name'] = 'Baby Annoucement 2';
$templates[1]["thumb_box"] =  array(
			"width" => 200, 
			"height" => 200
);
$templates[1]["number_of_blocks"] = 3;

/** Block definition **/
$templates[1]['blocks'] = array(
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
				"font_size" => 16,
				"font_url" => "",
				"label" => "Subject Line", 
				"temp" => "default text", 
				"default_value" => "default text", 
				"placeholder" => "", 
				"value" => "test",
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
				"value" => "",
				'color' => '#fff'
			)
	  )
  ), 
   
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
				"value" => "",
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
				"value" => "",
				'color' => '#fff'
			)
	  )
  )
);
