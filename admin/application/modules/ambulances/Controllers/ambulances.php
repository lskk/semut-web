<?php

class Ambulances extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('ambulances_model');
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
            $list                = $this->ambulances_model->read_by_city($city_id);
            $data['cityid']      = $city_id;
            $data['cityname']    = $this->ambulances_model->city_by_id($city_id)->Name;
        }else{
            $list                = $this->ambulances_model->read();
            $data['cityid']      = null;
            $data['cityname']    = "All City";
        }
        $data['units']           = $list;
        $data['cities']          = $this->ambulances_model->city();
		$data['main_content']    = 'ambulances';
		$this->load->view('page', $data);
	}
	
	function create(){
		if($_POST){
			$config = array(
				array(
					'field' => 'rsname',
					'label' => 'Hospital Name',
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
					'field' => 'nopol',
					'label' => 'No. Polisi',
					'rules' => 'trim|required',
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() === false){
				$data['error']        = validation_errors();
				$data['cities']          = $this->ambulances_model->city();
			}else{
				$data['RSName']		= $this->input->post('rsname',true);
				$data['CityID']		= $this->input->post('city',true);
				$data['Address']	= $this->input->post('address',true); 
				$data['PhoneNumber']= $this->input->post('phone',true);
				$data['Latitude']	= $this->input->post('latitude',true); 
				$data['Longitude']	= $this->input->post('longitude',true); 
				$data['NoPol']      = $this->input->post('nopol',true);
                
				$create = $this->ambulances_model->create($data);
                if($create){
                    $data['message']    = "Item Successfully Created";
                    $data['cities']          = $this->ambulances_model->city();
                }else{
                    $data['error']      = "Error creating item, try again!";
                    $data['cities']          = $this->ambulances_model->city();
                }
            }
		}
        $data['cities']          = $this->ambulances_model->city();
		$data['main_content'] = 'ambulancesform';
		$this->load->view('page', $data);
	}
    
    function edit(){
        if($_POST){
            $data['RSName']		= $this->input->post('rsname');
            $data['CityID']		= $this->input->post('city');
            $data['Address']	= $this->input->post('address'); 
            $data['PhoneNumber']= $this->input->post('phone');
            $data['Latitude']	= $this->input->post('latitude'); 
            $data['Longitude']	= $this->input->post('longitude'); 
            $data['NoPol']      = $this->input->post('nopol');
            
            $update = $this->ambulances_model->update($this->input->post('id'), $data);
			
			if($update){
				$data['message']    = "Updated succesfully";
			}else{
                $data['error']      = "Error updating data";
            }
            $detail                 = $this->ambulances_model->read_by_id($this->input->post('id'));
            $data['cities']         = $this->ambulances_model->city();
            $data['units']          = $detail;
            $data['main_content']   = 'ambulancesdetail';
            $this->load->view('page', $data);
            
        }else{
            redirect('ambulances');
        }
    }
    
    function detail($id){
        
        $detail                 = $this->ambulances_model->read_by_id($id);
        $data['cities']          = $this->ambulances_model->city();
        $data['units']          = $detail;
        $data['main_content']   = 'ambulancesdetail';
        $this->load->view('page',$data);
    }
	
}

?>