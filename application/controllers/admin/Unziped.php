<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Copyright (c) 2006-2017 Adipati Arya <jawircodes@gmail.com>,
 * 2006-2017 http://webssh.xyz
 * fb account: : https://www.facebook.com/adipati.aarya
 
 * Permission to use, copy, modify, and distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFT
*/

class Unziped extends Admin_Controller {
	
	
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('unzip');
		$this->load->model('templates_model');
		
		
		function rrmdir($src) {
			$dir = opendir($src);
			
			while(false !== ( $file = readdir($dir)) ) {
				if (( $file != '.' ) && ( $file != '..' )) {
					$full = $src . '/' . $file;
					if ( is_dir($full) ) {
						rrmdir($full);
					}
					else {
						unlink($full);
					}
				}
			}
			closedir($dir);
			rmdir($src);
		}
	}
	public function index() {
	   
	    $this->data['message'] = '';
	    $this->template->admin_render('admin/web/upload', $this->data);
	
	}
	public function upload() {
		
		$file_name ='';
		
		if (! is_writable('./assets')) {
				
				show_error('chmod 777 assets');
		}
		
		if (! is_writable(APPPATH.'/views/public') ) {
				
			show_error('chmod 777 application/views/public');
				
		}
		
		
		$config['upload_path'] = APPPATH.'/views/public/';
		$config['allowed_types'] = 'zip';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		
		
		if (! $this->upload->do_upload('zip_file')) {
		    
			$this->data['message'] = $this->upload->display_errors();
			$this->template->admin_render('admin/web/upload', $this->data);
			//redirect(site_url('admin/unziped', 'refresh'));
		}
		else {
			
			$data = (object) $this->upload->data();
			$file_name .= str_replace('.zip','',$data->file_name);
			
			
			$view_folder = APPPATH.'/views/public/'.$file_name;
			
			$css_folder = './assets/'.$file_name;
			
			
			if (is_dir($view_folder)) {
				
				rrmdir($view_folder);
				
				
				//echo "dir removed";	
			}
			if (is_dir($css_folder)) {
				
				rrmdir($css_folder);
				
				//echo "css removed";	
			}
			
			if ( mkdir($view_folder, 0777)) {
				
				$this->unzip->extract($data->full_path, $view_folder);
				
			}
			
			
			rename($view_folder.'/assets', $css_folder);
			unlink($data->full_path);
			
			//try {
			   // $this->load->model('templates_model');
			    //$this->templates_model->buat(array('name'=>$file_name));
			//} catch(Exception $e) {}
			
		
		}
		if ($file_name !== '') {
		    
		    redirect(site_url('admin/unziped/insert/'.$file_name), 'refresh');
	
		    
		}
	 
	}
	public function insert($name = false) {
	    
	    
	   if (!empty($name)) {
	       
	       $this->templates_model->create(array('name'=>$name));
	      
	   }
	    $this->session->set_flashdata('theme', '<div class="alert alert-succes">Themplate Upload successfull</div>');
		
		redirect('admin/webssh.html', 'refresh');
	    
	    
	}
	public function delete($id=FALSE) {
		
		$this->load->model('templates_model');
		$name = $this->templates_model->read($id)->row();
		if (!isset($name->id)) { show_404(); }
		
		
		$view_folder = APPPATH.'/views/public/'.$name->name;
		$css_folder = './assets/'.$name->name;
		
		if (is_dir($view_folder)) {
				
				rrmdir($view_folder);
				
		
		}
		if (is_dir($css_folder)) {
				
				rrmdir($css_folder);
				
				
		}
		$this->templates_model->delete($id);
		$this->session->set_flashdata('theme', '<div class="alert alert-succes">Themplate deleted successfull</div>');
		
		redirect('admin/webssh.html', 'refresh');
	}
}
