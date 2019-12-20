<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		  
		parent::__construct();
			
	}
	
	public function index()
	{
		$data['stud_details'] 	= $this->Task_model->custom_query("SELECT * FROM `student_details`");
		
		$this->load->view('welcome_message',$data);
		
	}
	
}
