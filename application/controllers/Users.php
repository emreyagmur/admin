<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public $viewFolder = "";
    //public $user;
    
    public function __construct()
    {
        parent::__construct();
        
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
        
        $dil = $this->session->userdata("lang");
        if(empty($dil))
        {
            //default language
            $dil = "english";
            $this->session->set_userdata("lang", $dil);
        }
        $this->lang->load($dil, $dil);
        
        
        $this->viewFolder = "Users";
        
    }
    
	public function index()
	{        
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->dbi = dbi();
        
		$this->load->view("{$viewData->viewFolder}/index", $viewData);
	}
    
}
