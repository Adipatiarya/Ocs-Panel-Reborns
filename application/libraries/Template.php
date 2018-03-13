<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {

    protected $CI;
    
    public $theme;

    public function __construct()
    {	
		$this->CI =& get_instance();
    }

    public function admin_render($content, $data = NULL)
    {
        if ( ! $content)
        {
            return NULL;
        }
        else
        {
            $this->template['header']  = $this->CI->load->view('admin/_templates/header', $data, TRUE);
            $this->template['content'] = $this->CI->load->view($content, $data, TRUE);
            $this->template['footer']  = $this->CI->load->view('admin/_templates/footer', $data, TRUE);

            return $this->CI->load->view('admin/_templates/template', $this->template);
        }
	}


    public function auth_render($content, $data = NULL)
    {
        if ( ! $content)
        {
            return NULL;
        }
        else
        {
            $this->template['header']  = $this->CI->load->view('auth/_templates/header', $data, TRUE);
            $this->template['content'] = $this->CI->load->view($content, $data, TRUE);
            $this->template['footer']  = $this->CI->load->view('auth/_templates/footer', $data, TRUE);

            return $this->CI->load->view('auth/_templates/template', $this->template);
        }
	}
	public function public_render($content, $data = NULL)
    {
		
		
		
        if ( ! $content)
        {
            return NULL;
        }
        else
        {
			
            $this->template['header']  = $this->CI->load->view('public/'.$this->theme.'/_templates/header', $data, TRUE);
            $this->template['content'] = $this->CI->load->view($content, $data, TRUE);
            $this->template['footer']  = $this->CI->load->view('public/'.$this->theme.'/_templates/footer', $data, TRUE);

            return $this->CI->load->view('public/'.$this->theme.'/_templates/template', $this->template);
            
        }
	}
	public function success_render($content, $data = NULL)
    {
		
		
		
        if ( ! $content)
        {
            return NULL;
        }
        else
        {
			

            $this->template['content'] = $this->CI->load->view($content, $data, TRUE);
            

            return $this->CI->load->view('public/'.$this->theme.'/_templates/template', $this->template, TRUE);
            
        }
	}
	public function member_render($content, $data = NULL)
    {
        if ( ! $content)
        {
            return NULL;
        }
        else
        {
            $this->template['header']  = $this->CI->load->view('member/_templates/header', $data, TRUE);
            $this->template['content'] = $this->CI->load->view($content, $data, TRUE);
            $this->template['footer']  = $this->CI->load->view('member/_templates/footer', $data, TRUE);

            return $this->CI->load->view('member/_templates/template', $this->template);
        }
	}

}
