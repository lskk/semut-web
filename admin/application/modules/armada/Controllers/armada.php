<?php

class Armada extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('armada_model');
		$this->load->library('form_validation');
        $this->load->module("member");
        if(!$this->member->_is_logged_in()){
			redirect('member/signin');
		}else if($this->session->userdata('roles')!='taxi'){
            show_404();
        }	
	}
	
	function index(){
		$data["units"] = $this->armada_model->read();
		$data['main_content'] = 'users';
		$this->load->view('page', $data);
	}
	
	function input(){
		if($_POST){
		
			$config = array(
				array(
					'field' => 'fullname',
					'label' => 'Full name',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'username',
					'label' => 'User name',
					'rules' => 'trim|is_unique[users.user_nicename]',
				),
				array(
					'field' => 'email',
					'label' => 'E-mail',
					'rules' => 'trim|required|valid_email|is_unique[users.user_email]',
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required',
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() === false){
				$data['error'] = validation_errors();
				$data['main_content'] = 'signup';
				$this->load->view('page', $data);
			}else{
				$data['user_login']		= $this->input->post('fullname',true);
				$data['user_pass']		= md5($this->input->post('password',true));
				$data['user_nicename']	= $this->input->post('username',true); 
				$data['user_email']		= $this->input->post('email',true);
				$data['activation_key']	= md5(rand(0,1000).'uniquefrasehere');
				
				$create = $this->armada_model->create($data);
            }
			
			return;
		}
		$data['main_content'] = 'signup';
		$this->load->view('page', $data);
	}
	
}

?>