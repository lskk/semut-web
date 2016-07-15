<?php

class Member extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('member_model');
		
		$this->load->library('form_validation');
	}
	
	function index(){
        if(!$this->_is_logged_in()){
			redirect('member/signin');
		}else{
			if ($this->session->userdata('role')=='admin') {
				$data['monthly_users']	= $this->member_model->get_user_per_month();
				$data['all_user'] 		= $this->member_model->count_all_user();
	            $data['main_content'] 	= 'admindashboard';
	            $this->load->view('page', $data);
			} else if($this->session->userdata('role')=='taxi') {
				$data['main_content'] 	= 'taxidashboard';
	            $this->load->view('page', $data);
			} else if($this->session->userdata('role')=='ads') {
				$data['main_content'] 	= 'adsdashboard';
	            $this->load->view('page', $data);
			} else if($this->session->userdata('role')=='ambulance') {
				$data['main_content'] 	= 'ambulancedashboard';
	            $this->load->view('page', $data);
			}				
        }
	}
    
    function signin(){
		//Redirect
		if($this->_is_logged_in()){
			redirect('');
		}
		
		if($_POST){
			//Data
			$username 	= $this->input->post('username', true);
			$password 	= $this->input->post('password', true);
			$pass 		= md5($password);
			//cek user on admin
			$useradmin 	= $this->member_model->validadmin($username, $pass);
			//cek user on taxi company
			$usertaxi	= $this->member_model->validtaxi($username, $pass);
			//cek user on ads company
			$userads	= $this->member_model->validads($username, $pass);
			//cek user on ambulance
			$userambulance	= $this->member_model->validambulance($username, $pass);
			
			//Validation
			if($useradmin){
                $data['admin_id']    = $useradmin->ID;
				$data['admin'] 		= $username;
				$data['role']		= 'admin';
                $data['loggenin'] 	= true;
                $this->session->set_userdata($data);
                redirect('');				
			}else if($usertaxi){
                $data['admin_id']    = $usertaxi->ID;
				$data['admin'] 		= $username;
				$data['role']		= 'taxi';
                $data['loggenin'] 	= true;
                $this->session->set_userdata($data);
                redirect('');				
			}else if($userads){
                $data['admin_id']    = $userads->ID;
				$data['admin'] 		= $username;
				$data['role']		= 'ads';
                $data['loggenin'] 	= true;
                $this->session->set_userdata($data);
                redirect('');				
			}else if($userambulance){
                $data['admin_id']    = $userads->ID;
				$data['admin'] 		= $username;
				$data['role']		= 'ambulance';
                $data['loggenin'] 	= true;
                $this->session->set_userdata($data);
                redirect('');				
			}else{
				$data['error'] = "Incorret username or password!";
				$data['main_content'] = 'signin';
				$this->load->view('form', $data);
			}

			return;
		}
		$data['main_content'] = 'signin';
		$this->load->view('form', $data);
	}
    
    function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

	
//Hidden Methods not allowed by url request

	function _member_area(){
		if(!$this->_is_logged_in()){
			redirect('signin');
		}
	}
	
	function _is_logged_in(){
		if($this->session->userdata('loggenin')){
			return true;
		}else{
			return false;
		}
	}

		
}

?>