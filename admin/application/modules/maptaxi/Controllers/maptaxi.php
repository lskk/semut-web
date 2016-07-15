<?php

class Maptaxi extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('maptaxi_model');
		$this->load->library('form_validation');
        $this->load->module("member");
        if(!$this->member->_is_logged_in()){
			redirect('member/signin');
		}else if($this->session->userdata('role')!='taxi'){
            show_404();
        }
        $this->idadmin = $this->session->userdata('admin_id');
        
	}
	
	function index(){
        $data_map               = $this->maptaxi_model->get_unit($this->idadmin); 
        $data['datamap']        = $data_map;
        $data['main_content'] 	= 'maptaxiview';    
        
        $this->load->view('page', $data);
	}

	
	
}

?>