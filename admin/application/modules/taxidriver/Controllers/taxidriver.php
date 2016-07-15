<?php

class Taxidriver extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('taxidriver_model');
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
        $list                    = $this->taxidriver_model->read($this->idadmin);
        $data['taxies']          = $this->taxidriver_model->taxi_by_company($this->idadmin);
        $data['units']           = $list;
		$data['main_content']    = 'taxidriver';
		$this->load->view('page', $data);
	}
	
	function create(){
		if($_POST){
			$config = array(
				array(
					'field' => 'nip',
					'label' => 'NIP',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'phone',
					'label' => 'Phone',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'taxi',
					'label' => 'Taxi',
					'rules' => 'trim|required',
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() === false){
				$data['error']          = validation_errors();
			}else{
				$data['NIP']		= $this->input->post('nip',true);
                $data['TaxiID']     = $this->input->post('taxi',true);
				$data['TaxiCompany']= $this->idadmin; 
				$data['Name']       = $this->input->post('name',true);
                $data['PhoneNumber']= $this->input->post('phone',true);
                $data['Address']    = $this->input->post('address');
                
				$create = $this->taxidriver_model->create($data);
                if($create){
                    $data['message']    = "Item Successfully Created";
                }else{
                    $data['error']      = "Error creating item, try again!";
                }
            }
		}
        $list                    = $this->taxidriver_model->read($this->idadmin);
        $data['taxies']          = $this->taxidriver_model->taxi_by_company($this->idadmin);
        $data['units']           = $list;
		$data['main_content']    = 'taxidriver';
		$this->load->view('page', $data);
	}
    
    function edit(){
        if($_POST){
            $data['TaxiID']     = $this->input->post('taxi');
            $data['Name']       = $this->input->post('name');
            $data['PhoneNumber']= $this->input->post('phone');
            $data['Address']    = $this->input->post('address');
            
            $update = $this->taxidriver_model->update($this->input->post('id'), $data);
			
			if($update){
				$data['message']    = "Updated succesfully";
			}else{
                $data['error']      = "Error updating data";
            }
            $detail                 = $this->taxidriver_model->read_by_id($this->input->post('id'));
            $data['units']          = $detail;
            $data['taxies']         = $this->taxidriver_model->taxi_by_company($this->idadmin);
            $data['main_content']   = 'taxidriverdetail';
            $this->load->view('page',$data);
            
        }else{
            redirect('taxidriver');
        }
    }
    
    function detail($id){
        
        $detail                 = $this->taxidriver_model->read_by_id($id);
        $data['units']          = $detail;
        $data['taxies']         = $this->taxidriver_model->taxi_by_company($this->idadmin);
        $data['main_content']   = 'taxidriverdetail';
        $this->load->view('page',$data);
    }
	
}

?>