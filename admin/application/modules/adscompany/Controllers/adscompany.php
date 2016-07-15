<?php

class Adscompany extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('adscompany_model');
		$this->load->library('form_validation');
        $this->load->module("member");
        if(!$this->member->_is_logged_in()){
			redirect('member/signin');
		}else if($this->session->userdata('role')!='admin'){
            show_404();
        }
        
	}
	
	function index(){
        if($_POST){
            $city_id             = $this->input->post('city');
            $list                = $this->adscompany_model->read_by_city($city_id);
            $data['cityid']      = $city_id;
            $data['cityname']    = $this->adscompany_model->city_by_id($city_id)->Name;
        }else{
            $list                = $this->adscompany_model->read();
            $data['cityid']      = null;
            $data['cityname']    = "All City";
        }
        $data['units']           = $list;
        $data['cities']          = $this->adscompany_model->city();
		$data['main_content']    = 'adscompanies';
		$this->load->view('page', $data);
	}
	
	function create(){
		if($_POST){
			$config = array(
				array(
					'field' => 'name',
					'label' => 'Company Name',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'city',
					'label' => 'City',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'phone',
					'label' => 'Phone',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required',
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() === false){
				$data['error']          = validation_errors();
				$data['cities']         = $this->adscompany_model->city();
			}else{
				$data['Name']		= $this->input->post('name',true);
				$data['Address']	= $this->input->post('address',true); 
				$data['PhoneNumber']= $this->input->post('phone',true);
				$data['CityID']		= $this->input->post('city',true);
                $data['JoinDate']   = date('Y-m-d H:i:s');
				$data['Username']	= $this->input->post('username',true); 
				$data['Password']	= md5($this->input->post('password',true)); 
                
				$create = $this->adscompany_model->create($data);
                if($create){
                    $data['message']    = "Item Successfully Created";
                    $data['cities']          = $this->adscompany_model->city();
                }else{
                    $data['error']           = "Error creating item, try again!";
                    $data['cities']          = $this->adscompany_model->city();
                }
            }
		}
        $data['cities']             = $this->adscompany_model->city();
		$data['main_content']     = 'adscompaniesform';
		$this->load->view('page', $data);
	}
    
    function edit(){
        if($_POST){
            $data['Name']		= $this->input->post('name');
            $data['CityID']		= $this->input->post('city');
            $data['Address']	= $this->input->post('address'); 
            $data['PhoneNumber']= $this->input->post('phone');
            
            $update = $this->adscompany_model->update($this->input->post('id'), $data);
			
			if($update){
				$data['message']    = "Updated succesfully";
			}else{
                $data['error']      = "Error updating data";
            }
            $detail                 = $this->adscompany_model->read_by_id($this->input->post('id'));
            $data['cities']         = $this->adscompany_model->city();
            $data['units']          = $detail;
            $data['main_content']   = 'adscompaniesdetail';
            $this->load->view('page', $data);
            
        }else{
            redirect('adscompany');
        }
    }
    
    function detail($id){
        
        $detail                 = $this->adscompany_model->read_by_id($id);
        $data['cities']         = $this->adscompany_model->city();
        $data['units']          = $detail;
        $data['main_content']   = 'adscompaniesdetail';
        $this->load->view('page',$data);
    }
	
}

?>