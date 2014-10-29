<?php 

$environment = "dev";

if($environment == "dev"){
	$config = array(
		'domain' => "http://test.dev/babyapp/api",
		'front_end_domain' => 'http://test.dev:9000',
		'host' => 'localhost',
		'dbname' => 'db_canon_baby',
		'username' => 'root', 
		'password' => 'root'

	);
}
else if($environment == "testing"){
	$config = array(
		'domain' => "http://test.dev/api",
		'front_end_domain' => 'http://test.dev:9000',
		'host' => 'localhost',
		'dbname' => 'db_canon_baby',
		'username' => 'root', 
		'password' => 'root'

	);
}
else
{ 
   $config = array(
		'domain' => "http://test.dev/api",
		'front_end_domain' => 'http://test.dev:9000',
		'host' => 'localhost',
		'dbname' => 'db_canon_baby',
		'username' => 'root', 
		'password' => 'root'

	);
}