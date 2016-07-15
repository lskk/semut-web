<?php

class Cctv extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('cctv_model');
		$this->load->library('form_validation');
        $this->load->module("member");
        if(!$this->member->_is_logged_in()){
			redirect('member/signin');
		}else if($this->session->userdata('role')!='admin'){
            show_404();
        }
        
	}
	
	function index(){
        $cctv                    = $this->cctv_model->read();
        $data['lists']           = $cctv;
		$data['main_content']    = 'cctv';
		$this->load->view('page', $data);
	}
	
	function create(){
		if($_POST){
			$config = array(
				array(
					'field' => 'name',
					'label' => 'Camera Name',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'city',
					'label' => 'City',
					'rules' => 'trim|required',
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() === false){
				$data['error']        = validation_errors();
				$data['cities']          = $this->cctv_model->city();
			}else{
				$data['Name']		= $this->input->post('name',true);
				$data['CityID']		= $this->input->post('city',true);
				$data['Latitude']	= $this->input->post('lat',true); 
				$data['Longitude']	= $this->input->post('lon',true); 
                
				$create = $this->cctv_model->create($data);
                if($create){
                    $data['message']    = "Item Successfully Created";
                    $data['cities']          = $this->cctv_model->city();
                }else{
                    $data['error']      = "Error creating item, try again!";
                    $data['cities']          = $this->cctv_model->city();
                }
            }
		}
        $data['cities']          = $this->cctv_model->city();
		$data['main_content'] = 'cctvform';
		$this->load->view('page', $data);
	}
    
    function edit(){
        if($_POST){
            $data['Name']		= $this->input->post('name');
            $data['CityID']		= $this->input->post('city');
            $data['Latitude']	= $this->input->post('lat'); 
            $data['Longitude']	= $this->input->post('lon'); 
            
            $update = $this->cctv_model->update($this->input->post('id'), $data);
			
			if($update){
				$data['message']    = "Updated success";
			}else{
                $data['error']      = "Error updating data";
            }
            $detail                 = $this->cctv_model->read_by_id($this->input->post('id'));
            $data['cities']         = $this->cctv_model->city();
            $data['units']          = $detail;
            $data['main_content']   = 'cctvdetail';
            $this->load->view('page', $data);
            
        }else{
            redirect('cctv');
        }
    }
    
    function detail($id){
        
        $detail                 = $this->cctv_model->read_by_id($id);
        $data['cities']         = $this->cctv_model->city();
        $data['units']          = $detail;
        $data['main_content']   = 'cctvdetail';
        $this->load->view('page',$data);
    }
	
}

?>