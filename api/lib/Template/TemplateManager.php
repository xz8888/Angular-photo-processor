<?php

namespace Babymoment\Template;

class TemplateManager{

	protected $templates;

	function __construct($templates){
		$this->templates = $templates;

	}	

	public function getTemplates(){
      return $this->templates;
	}

	public function getTemplate($id){
		foreach($this->templates as $template){
			if($template['id'] == $id)
				return $template;
		}

		return array('success' => 0, 'message' => 'can\'t find template');
	}
}