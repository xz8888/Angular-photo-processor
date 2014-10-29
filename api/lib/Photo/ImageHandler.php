<?php

namespace BabyMoment\Photo;

use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Gd\Font;
use Imagine\Image\Color;
/**
 *  Main Image Handler class
 */
class ImageHandler{

    protected $image_config;
    protected $image_directory;
    protected $crop_directory;
    protected $process_directory;
    protected $upload_url;
    protected $crop_url;
    protected $process_url;
    protected $imagine;
    protected $image = null;
    protected $domain; 
    protected $db; 
    protected $local_upload_url;
    protected $local_crop_url;
    protected $local_process_url;
    protected $font_location;
    protected $accept_file_types = "/\.(gif|jpe?g|png)$/i";

    protected $error_messages = array(
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk',
        8 => 'A PHP extension stopped the file upload',
        'post_max_size' => 'The uploaded file exceeds the post_max_size directive in php.ini',
        'max_file_size' => 'File is too big',
        'min_file_size' => 'File is too small',
        'accept_file_types' => 'Filetype not allowed',
        'max_number_of_files' => 'Maximum number of files exceeded',
        'max_width' => 'Image exceeds maximum width',
        'min_width' => 'Image requires a minimum width',
        'max_height' => 'Image exceeds maximum height',
        'min_height' => 'Image requires a minimum height',
        'abort' => 'File upload aborted',
        'image_resize' => 'Failed to resize image'
    );

    public function validate($file_name){
    	if (!preg_match($this->accept_file_types, $file_name)) {
            return false;
        }

        return true;
    }
    /*
     * Check on the data
     */
	public function __construct($options,  $db){
       $this->image_config = new \Flow\Config(
       	array(
       		'tempDir' => $options['temp_dir']
       	));

       if (!file_exists($options['temp_dir']))
          mkdir($options['temp_dir']);
       if (!file_exists($options['image_dir']))
          mkdir($options['image_dir']);
       if (!file_exists($options['crop_dir']))
          mkdir($options['crop_dir']);
       if (!file_exists($options['process_dir']))
          mkdir($options['process_dir']);

       $this->image_directory = $options['image_dir'];
       $this->crop_directory = $options['crop_dir'];
       $this->process_directory = $options['process_dir'];

       $this->upload_url = $options['upload_url'];
       $this->crop_url = $options['crop_url'];
       $this->process_url = $options['process_url'];
       $this->local_upload_path = $options['local_upload_path'];
       $this->local_crop_path = $options['local_crop_path'];
       $this->local_process_path = $options['local_process_path'];

       //set the fonts
       $this->font_location = $options['font_location'];
       $this->imagine = new \Imagine\Gd\Imagine();

       $this->db = $db;
	}
   
	public function crop($sw, $sh, $dx, $dy, $dw, $dh){

		$imageProcessor = $this->imagine->open($this->image['local_path']);

		$image_name = $this->get_unique_filename($this->image['image_name'], "crop");

		//crop the image
		if($imageProcessor->crop(new Point(abs($dx), abs($dy)), new Box(200, 200))->save($this->crop_directory.'/'.$image_name)){
			//save the file to database
			$image_url = $this->crop_url.'/'.$image_name;
			$local_path = $this->crop_directory.'/'.$image_name;

			//insert the image
			$result = $this->insertImage($image_name, $image_url, $local_path);

		    // File upload was completed
		    if($result)
		    	return array('success' => 1, 'msg' => 'file cropped successfully', 'image_id' => $this->db->lastInsertId());
		    else
		    	return array('success' => 0, 'msg' => 'file wasn\'t cropped');
		}
		else{
			return array('success' => 0, 'msg' => 'file wasn\'t cropped');
		}
	}

	public function old_browser_save(){
        $request = new \Flow\FustyRequest();
        $file = new \Flow\File($this->image_config, $request);

        if($_SERVER['REQUEST_METHOD'] === 'GET'){
			if ($file->checkChunk())
				header('HTTP/1.1 200 Ok');
			else{
				header('HTTP/1.1 400 not Found');
				return ;
			}
		} else {
		  	if ($file->validateChunk()) {
		      $file->saveChunk();
		  	} else {
		      // error, invalid chunk upload request, retry
		      header("HTTP/1.1 400 Bad Request");	
		      return ;
		  	}
	    }

        $filename = $this->get_unique_filename($request->getFileName());

        $image_path = $this->image_directory.'/'.$filename;
        
		if ($this->validate($filename) && $file->validateFile() && $file->save($image_path)) {
			//save the file to database
			$image_url = $this->upload_url.'/'.$filename;
			$local_path = $this->image_directory.'/'.$filename;

		    $result = $this->insertImage($filename, $image_url, $local_path);
		    
		    // File upload was completed
		    if($result)
		    	return array('success' => 1, 'msg' => 'file uploaded successfully', 'image_id' => $this->db->lastInsertId());
		    else
		    	return array('success' => 0, 'msg' => 'file wasn\'t uploaded');
		} else {
		    // This is not a final chunk, continue to upload
		    return array('success' => 0, 'msg' => 'file wasn\'t uploaded');
		    
		}
	}

	/** resize the file if is too big **/
	public function resize(){

	}
 
    //save uploaded image
	public function save(){
		
		$request = new \Flow\Request();
		$file = new \Flow\File($this->image_config);

		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			if ($file->checkChunk())
				header('HTTP/1.1 200 Ok');
			else{
				header('HTTP/1.1 400 not Found');
				return ;
			}
		} else {
		  	if ($file->validateChunk()) {
		      $file->saveChunk();
		  	} else {
		      // error, invalid chunk upload request, retry
		      header("HTTP/1.1 400 Bad Request");	
		      return ;
		  	}
	    }

        $filename = $this->get_unique_filename($request->getFileName());

        $image_path = $this->image_directory.'/'.$filename;
        
		if ($this->validate($filename) && $file->validateFile() && $file->save($image_path)) {
			//save the file to database
			$image_url = $this->upload_url.'/'.$filename;
			$local_path = $this->image_directory.'/'.$filename;

		    $result = $this->insertImage($filename, $image_url, $local_path);
		    
		    // File upload was completed
		    if($result)
		    	return array('success' => 1, 'msg' => 'file uploaded successfully', 'image_id' => $this->db->lastInsertId());
		    else
		    	return array('success' => 0, 'msg' => 'file wasn\'t uploaded');
		} else {
		    // This is not a final chunk, continue to upload
		    
		}
	}

	 protected function get_unique_filename($name, $type="upload") {
        while(is_file($this->get_upload_path($name, $type))) {
            $name = $this->upcount_name($name);
        }
        return $name;
	 }	

    protected function upcount_name_callback($matches) {
        $index = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        $ext = isset($matches[2]) ? $matches[2] : '';
        return ' ('.$index.')'.$ext;
    }

    protected function upcount_name($name) {
        return preg_replace_callback(
            '/(?:(?: \(([\d]+)\))?(\.[^.]+))?$/',
            array($this, 'upcount_name_callback'),
            $name,
            1
        );
    }

    protected function get_upload_path($file_name = null, $type="upload") {
        $file_name = $file_name ? $file_name : '';
        
        switch($type){
        	case "upload":
        	    return $this->image_directory.'/'.$file_name;
        	case "crop":
        		return $this->crop_directory.'/'.$file_name;
        	case "process":
        		return $this->process_directory.'/'.$file_name;
        }    
    }

	/**
	 * Process the image, applying text/filter effects
	 */
	public function process($template){
		//process the images
		//getting the images
		$imageProcessor = $this->imagine->open($this->image['local_path']);

		$blocks = $template['blocks'];

		foreach($blocks as $block){
			$block_x = $block['positionX'];
			$block_y = $block['positionY'];
			foreach($block['elements'] as $element){
				$element_x = $block_x + $element['positionX'];
				$element_y = $block_y + $element['positionY'];
                
				$color = new Color($element['color']);
				$theFont = new Font($this->font_location.'/'.$element['font_file'], $element['font_size'], $color);

				$imageProcessor->draw()
							   ->text($element['value'], $theFont, new Point($element_x, $element_y));

			}
		}

        $filename = $this->get_unique_filename($this->image['image_name'], "process");
		if($imageProcessor->save($this->process_directory.'/'.$filename)){
			//save the processed image
			//save the file to database
			$image_url = $this->process_url.'/'.$filename;
			$local_path = $this->process_directory.'/'.$filename;

			$result = $this->insertImage($filename, $image_url, $local_path);
		    // File upload was completed
		    if($result)
		    	return array('success' => 1, 'msg' => 'file processed successfully', 'image_id' => $this->db->lastInsertId());
		    else
		    	return array('success' => 0, 'msg' => 'file wasn\'t processed');
		}	
		else{
			return array('success' => 0, 'msg' => 'Image can\'t be saved');
		}
	}

    /** insert image into database **/
	public function insertImage($image_name, $image_url, $local_path){
		//insert the image
		$sql = "INSERT INTO images (image_name,  url, type, local_path) VALUES (:image_name, :url, :type, :local_path)";

		$q = $this->db->prepare($sql);
		$result = $q->execute(array(':image_name' => $image_name, ':url' => $image_url, ":type" => 'upload', ":local_path" => $local_path));

		return $result;
	}

	public function setImage(Image $image){
		$this->image = $image->getImage();
	}
}