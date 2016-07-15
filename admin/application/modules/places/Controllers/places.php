<?php

class Places extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('places_model');
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
            $type_id             = $this->input->post('type');
            $list                = $this->places_model->read_by_type($type_id);
            $data['typeid']      = $type_id;
            $data['typename']    = $this->places_model->type_by_id($type_id)->Name;
        }else{
            $list                = $this->places_model->read();
            $data['typeid']      = null;
            $data['typename']    = "All Type";
        }
        $data['units']           = $list;
        $data['types']          = $this->places_model->type();
		$data['main_content']    = 'places';
		$this->load->view('page', $data);
	}
	
	function create(){
		if($_POST){
			$config = array(
				array(
					'field' => 'Name',
					'label' => 'Place Name',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'type',
					'label' => 'Type',
					'rules' => 'trim|required',
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() === false){
				$data['error']        = validation_errors();
				$data['types']          = $this->places_model->type();
			}else{
				$data['Name']		= $this->input->post('name',true);
				$data['TypeID']		= $this->input->post('type',true);
				$data['Address']	= $this->input->post('address',true); 
				$data['Description']= $this->input->post('description',true);
				$data['Latitude']	= $this->input->post('latitude',true); 
				$data['Longitude']	= $this->input->post('longitude',true); 
				$data['CreateBy']   = 0;
                
				$create = $this->places_model->create($data);
                if($create){
                    $data['message']    = "Item Successfully Created";
                    $data['types']          = $this->places_model->type();
                }else{
                    $data['error']      = "Error creating item, try again!";
                    $data['types']          = $this->places_model->type();
                }
            }
		}
        $data['types']          = $this->places_model->type();
		$data['main_content'] = 'placesform';
		$this->load->view('page', $data);
	}
    
    function edit(){
        if($_POST){
            $data['Name']		= $this->input->post('name');
            $data['TypeID']		= $this->input->post('type');
            $data['Address']	= $this->input->post('address'); 
            $data['Description']= $this->input->post('description');
            $data['Latitude']	= $this->input->post('latitude'); 
            $data['Longitude']	= $this->input->post('longitude'); 
            
            $update = $this->places_model->update($this->input->post('id'), $data);
			
			if($update){
				$data['message']    = "Updated succesfully";
			}else{
                $data['error']      = "Error updating data";
            }
            $detail                 = $this->places_model->read_by_id($this->input->post('id'));
            $data['types']          = $this->places_model->type();
            $data['units']          = $detail;
            $data['main_content']   = 'placesdetail';
            $this->load->view('page', $data);
            
        }else{
            redirect('places');
        }
    }
    
    function detail($id){
        
        $detail                 = $this->places_model->read_by_id($id);
        $data['types']          = $this->places_model->type();
        $data['units']          = $detail;
        $data['main_content']   = 'placesdetail';
        $this->load->view('page',$data);
    }
	
}

?>