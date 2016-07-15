<?php

class Summary extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('summary_model');
        $this->load->module("member");
        if(!$this->member->_is_logged_in()){
			redirect('member/signin');
		}else if($this->session->userdata('role')!='admin'){
            show_404();
        }
	}
	
	function index(){
		$month 	= date("m");
		$year 	= date("Y");
		if ($_POST) {
			$month	= $this->input->post('month');
			$year 	= $this->input->post('year');
		}
		$activities 	= array();
        $user  			= $this->summary_model->read_user();

        foreach ($user as $key) {
        	//$activity 			= array();
     		$login_log 			= $this->summary_model->count_session($key->ID, $month,$year);

     		$activity['UserID'] = $key->ID;
     		$activity['Name'] 	= $key->Name;
     		$activity['Email'] 	= $key->Email;
     		$activity['Phone'] 	= $key->PhoneNumber;
     		if ($login_log) {
     			$activity['log'] 	= $login_log->log_count;
     		} else {
     			$activity['log'] 	= '0';
     		}
     		
     		array_push($activities, $activity);
     	} 
     	if ($month == 1) {
     		$data['bulan'] 			= 'January';
     	} else if ($month == 2) {
     		$data['bulan'] 			= 'February';
     	} else if ($month == 3) {
     		$data['bulan'] 			= 'March';
     	} else if ($month == 4) {
     		$data['bulan'] 			= 'April';
     	} else if ($month == 5) {
     		$data['bulan'] 			= 'May';
     	} else if ($month == 6) {
     		$data['bulan'] 			= 'June';
     	} else if ($month == 7) {
     		$data['bulan'] 			= 'July';
     	} else if ($month == 8) {
     		$data['bulan'] 			= 'August';
     	} else if ($month == 9) {
     		$data['bulan'] 			= 'September';
     	} else if ($month == 10) {
     		$data['bulan'] 			= 'October';
     	} else if ($month == 11) {
     		$data['bulan'] 			= 'November';
     	} else if ($month == 12) {
     		$data['bulan'] 			= 'December';
     	}
     	
     	$data['years'] 			= date("Y");
        $data['years1'] 		= 2014;
     	$data['tahun']			= $year;
		$data['users'] 			= $activities;
		$data['main_content'] 	= 'user';
		$this->load->view('page', $data);
	}

		
}

?>