<?php

class Ads extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('ads_model');
		$this->load->library('form_validation');
        $this->load->module("member");
        if(!$this->member->_is_logged_in()){
			redirect('member/signin');
		}else if($this->session->userdata('role')!='ads'){
            show_404();
        }
        $this->idadmin = $this->session->userdata('admin_id');
	}
	
	function index(){
        if($_POST){
            $cat_id             = $this->input->post('category');
            $list               = $this->ads_model->read_by_category($cat_id,$this->idadmin);
            $data['catid']      = $cat_id;
            $data['catname']    = $this->ads_model->cat_by_id($cat_id)->CatTitle;
        }else{
            $list               = $this->ads_model->read($this->idadmin);
            $data['catid']      = null;
            $data['catname']    = "All Category";
        }
        $data['ads']            = $this->ads_model->count_ads($this->idadmin);
        $data['company']        = $this->ads_model->company($this->idadmin);
        $data['units']          = $list;
        $data['cats']           = $this->ads_model->cat();
		$data['main_content']   = 'ads';
		$this->load->view('page', $data);
	}
	
	function create(){
        $ads            = $this->ads_model->count_ads($this->idadmin);
        $company        = $this->ads_model->company($this->idadmin);
        $datenow        = strtotime(date("Y-m-d"));
        $expdate        = strtotime($company->SubscriptionExp);
        
        if($ads->NumberOfAds<$company->AdsNumb || $expdate>$datenow){
            if($_POST){
                $config = array(
                    array(
                        'field' => 'title',
                        'label' => 'Ads Title',
                        'rules' => 'trim|required',
                    ),
                    array(
                        'field' => 'category',
                        'label' => 'Category',
                        'rules' => 'trim|required',
                    ),
                    array(
                        'field' => 'description',
                        'label' => 'Description',
                        'rules' => 'trim|required',
                    )
                );

                $this->form_validation->set_rules($config);

                if($this->form_validation->run() === false){
                    $data['error']          = validation_errors();
                }else{
                    $company                = $this->ads_model->company($this->idadmin);
                    $insert['Title']		= $this->input->post('title',true);
                    $insert['Description']  = $this->input->post('description',true);
                    $insert['Category']	    = $this->input->post('category',true); 
                    $insert['CompanyID']    = $this->idadmin;
                    $insert['Latitude']	    = $this->input->post('latitude',true); 
                    $insert['Longitude']	= $this->input->post('longitude',true); 
                    $insert['ExpiredDate']  = $company->SubscriptionExp;
                    $insert['StartDate']    = date('Y-m-d H:i:s');

                    $create = $this->ads_model->create($insert);
                    if($create){
                        $data['message']    = "Item Successfully Created";
                    }else{
                        $data['error']      = "Error creating item, try again!";
                    }
                }
            }
            $data['cats']          = $this->ads_model->cat();
            $data['main_content'] = 'adsform';
            $this->load->view('page', $data);
        }else{
            redirect('ads');
        }
	}
    
    function edit(){
        if($_POST){
            $insert['Title']		= $this->input->post('title');
            $insert['Description']  = $this->input->post('description');
            $insert['Category']	    = $this->input->post('category');
            $insert['Latitude']	    = $this->input->post('latitude'); 
            $insert['Longitude']	= $this->input->post('longitude'); 
            
            $update = $this->ads_model->update($this->input->post('id'), $insert);
			
			if($update){
				$data['message']    = "Updated succesfully";
			}else{
                $data['error']      = "Error updating data";
            }
            $detail                 = $this->ads_model->read_by_id($this->input->post('id'));
            $data['cats']           = $this->ads_model->cat();
            $data['units']          = $detail;
            $data['main_content']   = 'adsdetail';
            $this->load->view('page',$data);
            
        }else{
            redirect('ads');
        }
    }
    
    function status($id,$status){
        $insert['Status']		= $status;
        $update = $this->ads_model->update($id, $insert);

        redirect('ads');

    }
    
    function detail($id){
        
        $detail                 = $this->ads_model->read_by_id($id);
        $data['cats']           = $this->ads_model->cat();
        $data['units']          = $detail;
        $data['main_content']   = 'adsdetail';
        $this->load->view('page',$data);
    }
	
}

?>