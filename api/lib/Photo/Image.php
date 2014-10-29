<?php

namespace BabyMoment\Photo;

class Image {

	protected $imageId;
	protected $width;
	protected $height;
	protected $thumb;
	protected $db;
	protected $image;

	public function __construct ($db, $image_id = null){
		$this->db = $db;

		if(is_numeric($image_id)){
			$this->image = $this->getImage($image_id);
		}
	}
	/** Temporary function for getting the image **/
    public function getImage($image_id = null){

    	if(!$this->image && $image_id){
    		$query = $this->db->prepare('SELECT image_name, url, local_path FROM images WHERE id = :id LIMIT 1');
    		$query->execute(array(':id' => $image_id));
    		$row = $query->fetch();

    		return $row;
    	}
    	else 
    		return $this->image;
    	
    }
}