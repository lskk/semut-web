<?php

class Adssubscrib extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('adssubscrib_model');
		$this->load->library('form_validation');
        $this->load->module("member");
        if(!$this->member->_is_logged_in()){
			redirect('member/signin');
		}else if($this->session->userdata('role')!='ads'){
            show_404();
        }
        $this->idadmin = $this->session->userdata('admin_id');
        
	}
	
	function index(){
        $list                    = $this->adssubscrib_model->read($this->idadmin);
        $data['units']           = $list;
        $subscrib                = $this->adssubscrib_model->subscrib($this->idadmin);
        $data['request']         = $subscrib;
        $data['ads']             = $this->adssubscrib_model->count_ads($this->idadmin);
		$data['main_content']    = 'adssubscrib';
		$this->load->view('page', $data);
	}
	
	function create($type){

        $data['AdsCompany']     = $this->idadmin; 
        $data['Type']           = $type; 
        $data['DateRequest']    = date('Y-m-d H:i:s');

        $create = $this->adssubscrib_model->create($data);
        if($create){
            $data['message']    = "Your subsccription request has been sent";
        }else{
            $data['error']      = "Error!";
        }

        $list                    = $this->adssubscrib_model->read($this->idadmin);
        $data['units']           = $list;
        $subscrib                = $this->adssubscrib_model->subscrib($this->idadmin);
        $data['request']         = $subscrib;
        $data['ads']             = $this->adssubscrib_model->count_ads($this->idadmin);
		$data['main_content']    = 'adssubscrib';
		$this->load->view('page', $data);
	}
    
}

?>