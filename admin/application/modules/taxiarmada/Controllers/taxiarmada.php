<?php

class Taxiarmada extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('taxiarmada_model');
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
        $list                   = $this->taxiarmada_model->read($this->idadmin);
        $data['units']           = $list;
		$data['main_content']    = 'taxiarmada';
		$this->load->view('page', $data);
	}
	
	function create(){
		if($_POST){
			$config = array(
				array(
					'field' => 'number',
					'label' => 'Taxi Number',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'nopol',
					'label' => 'No. Polisi',
					'rules' => 'trim|required',
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() === false){
				$data['error']          = validation_errors();
			}else{
				$data['Nopol']		= $this->input->post('nopol',true);
				$data['Number']     = $this->input->post('number',true); 
				$data['TaxiCompany']= $this->idadmin; 
                
				$create = $this->taxiarmada_model->create($data);
                if($create){
                    $data['message']    = "Item Successfully Created";
                }else{
                    $data['error']      = "Error creating item, try again!";
                }
            }
		}
        $list                    = $this->taxiarmada_model->read($this->idadmin);
        $data['units']           = $list;
		$data['main_content']    = 'taxiarmada';
		$this->load->view('page', $data);
	}
    
    function edit(){
        if($_POST){
            $data['Nopol']		= $this->input->post('nopol');
            $data['Number']		= $this->input->post('number');
            
            $update = $this->taxiarmada_model->update($this->input->post('id'), $data);
			
			if($update){
				$data['message']    = "Updated succesfully";
			}else{
                $data['error']      = "Error updating data";
            }
            $detail                 = $this->taxiarmada_model->read_by_id($id,$this->idadmin);
            $driver                 = $this->taxiarmada_model->get_driver($detail->ID);
            $data['units']          = $detail;
            $data['drivers']        = $driver;
            $data['main_content']   = 'taxiarmadadetail';
            $this->load->view('page',$data);
            
        }else{
            redirect('taxiarmada');
        }
    }
    
    function detail($id){
        
        $detail                 = $this->taxiarmada_model->read_by_id($id);
        $driver                 = $this->taxiarmada_model->get_driver($detail->ID);
        $data['units']          = $detail;
        $data['drivers']        = $driver;
        $data['main_content']   = 'taxiarmadadetail';
        $this->load->view('page',$data);
    }
	
}

?>