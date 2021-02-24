<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
        $this->load->library('myauth');
        $this->_wrapper = $this->config->item('public_view');
	}
    
    public function index()
    {
        $this->form();
    }
    
    public function form()
    {
        $this->myauth->login($this->_wrapper);
    }
    
    public function logout()
    {
        $this->myauth->logout();
    }
}

?>