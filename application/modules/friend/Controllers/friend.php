<?php

class Friend extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('friend_model');
		$this->load->library('form_validation');
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		} 
		$this->id 	= $this->session->userdata('user_id');
	}
	
	function index(){
        redirect('/friend/listing');
	}

	function listing(){
		$friend1 	= $this->friend_model->get_friend1($this->id);
		$friend2 	= $this->friend_model->get_friend2($this->id);
        $friends 	= array();
        if ($friend1) {
	        foreach ($friend1 as $key) {
	                $idfriend     = $key->ID_RESPONSE;
	                if ($key->ID_RESPONSE==$this->id) {
	                    $idfriend = $key->ID_REQUEST;
	                }
	                $profile      = $this->friend_model->get_friend_profile($idfriend);
	                array_push($friends, $profile);
	        }
        }
        if ($friend2) {
	        foreach ($friend2 as $key) {
	                $idfriend     = $key->ID_RESPONSE;
	                if ($key->ID_RESPONSE==$this->id) {
	                    $idfriend = $key->ID_REQUEST;
	                }
	                $profile      = $this->friend_model->get_friend_profile($idfriend);
	                array_push($friends, $profile);
	        }
	    }
        $data['friends'] 		= $friends;
        $data['main_content'] 	= 'friend_list';
        $this->load->view('page', $data);
	}

	function request(){
		$friend 	= $this->friend_model->get_friend_request($this->id);
        $friends 	= array();
        if ($friend) {
	        foreach ($friend as $key) {
	                $idfriend     = $key->ID_RESPONSE;
	                if ($key->ID_RESPONSE==$this->id) {
	                    $idfriend = $key->ID_REQUEST;
	                }
	                $profile      = $this->friend_model->get_friend_profile($idfriend);
	                array_push($friends, $profile);
	        }
	    }
        $data['friends'] 		= $friends;
        $data['main_content'] 	= 'request_list';
        $this->load->view('page', $data);
	}

	function pending(){
		$friend 	= $this->friend_model->get_friend_pending($this->id);
        $friends 	= array();
        if ($friend) {
	        foreach ($friend as $key) {
	                $idfriend     = $key->ID_RESPONSE;
	                if ($key->ID_RESPONSE==$this->id) {
	                    $idfriend = $key->ID_REQUEST;
	                }
	                $profile      = $this->friend_model->get_friend_profile($idfriend);
	                array_push($friends, $profile);
	        }
	    }
        $data['friends'] 		= $friends;
        $data['main_content'] 	= 'pending_list';
        $this->load->view('page', $data);
	}

	function accept_request($idfriend){

        $acceptdata = array('ResponseTime' => date('Y-m-d H:i:s'), 'State' => 2);
        $accetReq   = $this->friend_model->update_relation($acceptdata, $this->id, $idfriend);
        
        redirect('/friend/request');

	}
	
		
}

?>