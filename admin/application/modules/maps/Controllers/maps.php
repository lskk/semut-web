<?php

class Maps extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('maps_model');
		$this->load->library('form_validation');
        $this->load->module("member");
        if(!$this->member->_is_logged_in()){
			redirect('member/signin');
		}
        
	}
	
	function index(){
        if($_POST){
            if($this->input->post('type')=='semut'){
                $data_map   = $this->maps_model->get_user_semut();
                $data['datatype']   = 'Semuters';
                $data['main_content'] 	= 'mapview';
            }else if($this->input->post('type')=='ambulance'){
                $data_map   = $this->maps_model->get_ambulance();
                $data['datatype']   = 'Ambulance';
                $data['main_content'] 	= 'mapambulance';
            }else if($this->input->post('type')=='taxi'){
                $data_map   = $this->maps_model->get_taxi();
                $data['datatype']   = 'Taxi';
                $data['main_content'] 	= 'maptaxi';
            }
        }else{
            $data_map   = $this->maps_model->get_user_semut();
            $data['datatype']   = 'Semuters'; 
            $data['main_content'] 	= 'mapview';
        }
        
        $data['datamap']    = $data_map;
        $this->load->view('page', $data);
	}

	
	
}

?>