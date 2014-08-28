<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_controller extends CI_Controller {

	public function index()
	{
		$this->load->helper(array('url','html','form'));
		$this->load->library(array('form_validation','session'));
                $data=array();
		$data['my_projects_ui']=$this->load->view('my_projects','',true);
		$this->load->view('home',$data);
	}
	
	public function view_registration_form()
	{
		$this->load->helper(array('url','html','form','captcha'));
		$data=array();
		$data['register']=$this->load->view('registration_form','',true);
		$this->load->view('home',$data);
	}	
}