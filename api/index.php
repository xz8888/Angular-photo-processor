<?php

require 'vendor/autoload.php';
require 'config/template.php';
require 'config/config.php';

header('Access-Control-Allow-Origin: '.$config['front_end_domain']);  //I have also tried the * wildcard and get the same response
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


session_start();

$options = array(
	'temp_dir' => dirname(__FILE__).'/images/temp',
	'image_dir' => dirname(__FILE__).'/images/upload/'.date('Ymd'),
	'crop_dir' => dirname(__FILE__).'/images/crop/'.date('Ymd'), 
	'process_dir' => dirname(__FILE__).'/images/process/'.date('Ymd'), 
	'upload_url' => $config['domain'].'/images/upload/'.date('Ymd'),
	'crop_url' => $config['domain'].'/images/crop/'.date('Ymd'),
	'process_url' => $config['domain'].'/images/process/'.date('Ymd'),
	'local_upload_path' => 'api/images/upload/'.date('Ymd'),
	'local_crop_path' => 'api/images/crop/'.date('Ymd'),
	'local_process_path' => 'api/images/crop/'.date('Ymd'),
	'font_location' =>  dirname(__FILE__).'/fonts'
);

$db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].';charset=utf8', $config['username'], $config['password']);
$imageHandler = new BabyMoment\Photo\ImageHandler($options, $db);

if(!empty($_REQUEST['action'])){
	switch($_REQUEST['action']){
		case 'upload':

            //Supporting old IE browser upload such as IE9
            if (!isset($_REQUEST['flowTotalChunks'])){
                $result = $imageHandler->old_browser_save();
            }
            else{
               $result = $imageHandler->save();
            }
	
			echo json_encode($result);
			
		break;

		case 'crop':
			//pass in data
			if ($_REQUEST['image_id'] && is_numeric($_REQUEST['image_id'])){
				$sw = isset($_POST['sw']) ? $_POST['sw'] : 0;
				$sh = isset($_POST['sh']) ? $_POST['sh'] : 0;
				$dx = isset($_POST['dx']) ? $_POST['dx'] : 0;
				$dy = isset($_POST['dy']) ? $_POST['dy'] : 0;
				$dw = isset($_POST['dw']) ? $_POST['dw'] : 0;
				$dh = isset($_POST['dh']) ? $_POST['dh'] : 0;

				$image = new BabyMoment\Photo\Image($db, $_REQUEST['image_id']);
				$imageHandler->setImage($image);
			    $result = $imageHandler->crop($sw, $sh, $dx, $dy, $dw, $dh);
				
				echo json_encode($result);
			}
			else 
				echo json_encode(array('success' => 0, 'message' => 'Image crop uncessfully'));

		 
		break;

        case 'templates': 
        	$templateManager = new BabyMoment\Template\TemplateManager($templates);
        	$templates = $templateManager->getTemplates();
        	echo json_encode($templates);

        break;

        case 'template':
        	if(isset($_REQUEST['template_id']) && is_numeric($_REQUEST['template_id'])){
        		$templateManager = new BabyMoment\Template\TemplateManager($templates);
        	    $template = $templateManager->getTemplate($_REQUEST['template_id']);

        	    echo json_encode(array('success' => 1, 'template' => $template));
        	}
   		    else{
   		    	echo json_encode(array('success' => 0, 'message' => 'coudn\'t locate template id'));
   		    }

        break; 

        case 'get_image': 

            //Todo check id exist
            if($_REQUEST['id'] && is_numeric($_REQUEST['id'])){
            	$image = new BabyMoment\Photo\Image($db);
        	    $result = $image->getImage($_REQUEST['id']);
        	    echo json_encode($result);
            }
            else{
            	echo json_encode(array('success' => 0, 'message' => 'couldn\'t locate image id'));
            }
       
   	    break;

   	    case 'process':
			if($_REQUEST['image_id'] && is_numeric($_REQUEST['image_id'])){
    			$template = json_decode($_POST['template'], true);
    			$image = new BabyMoment\Photo\Image($db, $_REQUEST['image_id']);
    			$result = $image->getImage($_REQUEST['image_id']);
    			$imageHandler->setImage($image);
    			$result = $imageHandler->process($template);
                echo json_encode($result);
    		}
    		else{
    			echo json_encode(array('success' => 0, 'message' => 'couldn\t locate the image'));
    		}
   	    break;

	}
}

exit();

