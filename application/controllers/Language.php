<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    public $viewFolder = "";
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
	public function newLang($id)
	{
        $this->session->set_userdata("lang", $id);
        redirect(base_url());
	}
    
}
