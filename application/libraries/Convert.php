<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Convert{

    public function __get($var)
	{
		return get_instance()->$var;
	}
	public function img($img) {
		
		$config = array (
			'image_library' => 'gd2',
			'source_image' => $img,
			'create_tumb' => TRUE,
			'maintain_ratio' => TRUE,
			'width' => 256,
			'height' => 256,
		);
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
	}

}
