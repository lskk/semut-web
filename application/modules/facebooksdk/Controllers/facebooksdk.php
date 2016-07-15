<?php
class Facebooksdk extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Facebook_model');
	}
	
	function index()
	{
		$fb_data = $this->session->userdata('fb_data');

		$data = array(
					'fb_data' => $fb_data,
					);
		
		$this->load->view('welcome', $data);
	}
	
	function topsecret()
	{
		$fb_data = $this->session->userdata('fb_data');
		
		if((!$fb_data['uid']) or (!$fb_data['me']))
		{
			redirect('welcome');
		}
		else
		{
			$data = array(
						'fb_data' => $fb_data,
						);
			
			$this->load->view('topsecret', $data);
		}
	}
}
?>