<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userop extends CI_Controller {

    public $viewFolder = "";
    
    public function __construct()
    {
        parent::__construct();
        
        $dil = $this->session->userdata("lang");
        if(empty($dil))
        {
            //default language
            $dil = "english";
            $this->session->set_userdata("lang", $dil);
        }
        $this->lang->load($dil, $dil);
        
    }
    
	public function makeLogin()
	{        
        $dbi = dbi();
        
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        
        $dbi->where("username", $username);
        $dbi->where("password", $password);
        $userInfo = $dbi->getOne("users");
        
        if(!empty($userInfo))
        {
            $this->session->set_userdata("user", $userInfo);
            die(json_encode(array("message" => array("success" => true))));    
        }
        else
        {
            die(json_encode(array('message' => array('error' => _USER_NOT_FOUND))));
        }
        
	}
    
    public function logout()
    {
        $this->session->unset_userdata("user");
        redirect(base_url("login"));
        
    }
    
}
