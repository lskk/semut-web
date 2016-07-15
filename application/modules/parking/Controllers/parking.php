<?php

class Parking extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('parkings_model');
	}
	
	function index(){
        $this->load->view('lskk_parking_view');
	}

    function dashboard(){
        $this->load->view('lskk_parking_dashboard');
    }

    function get_lot_data(){
        $data = $this->parkings_model->get_lot_data();
        echo json_encode($data);
    }
}

?>