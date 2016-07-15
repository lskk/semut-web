<?php

class General extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('general_model');
        $this->load->helper('download');

	}

	function import_node(){
        $file = file_get_contents('http://127.0.0.1/osmdata/export_bandung_node.json');
        $data = json_decode($file);
        foreach ($data as $item) {
            if($item->type == 'node'){
                $cek = $this->general_model->cek_node($item->id);
                if (!$cek) {
                    $insertdata = array(
                        'ID'        => $item->id,
                        'Latitude'  => $item->lat,
                        'Longitude' => $item->lon
                        );
                    $this->general_model->insert_node($insertdata);
                }
            }
        }
    }

	function import_way(){
        $file 	= file_get_contents('http://127.0.0.1/osmdata/export_bandung_way.json');
        $data 	= json_decode($file);
        $highway = null;
        $lanes 	= null;
        $name 	= null;
        $oneway = null;
        $avgspeed = null;
        $bicycle = null;
        $foot 	= null;
        $count = 0;
        foreach ($data as $item) {
            if($item->type == 'way'){
                $cek = $this->general_model->cek_way($item->id);
                if (!$cek) {
                    if (isset($item->tags->highway)) {
                        $highway = $item->tags->highway;
                    }
                    if (isset($item->tags->lanes)) {
                        $lanes = $item->tags->lanes;
                    }
                    if (isset($item->tags->name)) {
                        $name = $item->tags->name;
                    }
                    if (isset($item->tags->oneway)) {
                        $oneway = $item->tags->oneway;
                    }
                    if (isset($item->tags->avgspeed)) {
                        $avgspeed = $item->tags->avgspeed;
                    }
                    if (isset($item->tags->bicycle)) {
                        $bicycle = $item->tags->bicycle;
                    }
                    if (isset($item->tags->foot)) {
                        $foot = $item->tags->foot;
                    }
                    $insertdata = array(
                        'ID'        => $item->id,
                        'Highway'   => $highway,
                        'Lanes'     => $lanes,
                        'Name'      => $name,
                        'Oneway'    => $oneway,
                        'Avgspeed'  => $avgspeed,
                        'Bicycle'   => $bicycle,
                        'Foot'      => $foot
                        );
                    $max = sizeof($item->nodes);
                    for ($i=0; $i < $max; $i++) { 
                        $cek_waynode = $this->general_model->cek_way_node($item->id, $item->nodes[$i]);
                        if (!$cek_waynode) {
                            $insertnode = array(
                                'WayID'     =>$item->id,
                                'NodeID'    =>$item->nodes[$i],
                                'Squence'   =>$i
                                );
                            $this->general_model->insert_way_node($insertnode);
                        }
                    }
                    $this->general_model->insert_way($insertdata);
                    $count++;
                }
            }
        }
        echo $count.' way data inserted!';
    }

    function check_way_node(){
        $file   = file_get_contents('http://127.0.0.1/osmdata/export_bandung_way.json');
        $data   = json_decode($file);
        $count  = 0;
        foreach ($data as $item) {
            if($item->type == 'way'){
                $max = sizeof($item->nodes);
                for ($i=0; $i < $max; $i++) { 
                    $cek_waynode = $this->general_model->cek_way_node($item->id, $item->nodes[$i]);
                        if (!$cek_waynode) {
                            $insertnode = array(
                                'WayID'     =>$item->id,
                                'NodeID'    =>$item->nodes[$i],
                                'Squence'   =>$i
                                );
                            $this->general_model->insert_way_node($insertnode);
                            $count++;
                        }
                }      
            }   
        }
        echo $count.' way_node data inserted';
    }
	
	function index(){
		
	}

	function download(){
		$data['main_content'] 	= 'downloadView';
        $data['profile'] = $this->general_model->get_profile($this->session->userdata('user_id'));
		$this->load->view('page',$data);
	}

    function guestbook(){
        $data['main_content']   = 'guestbookView';
        $data['profile'] = $this->general_model->get_profile($this->session->userdata('user_id'));
        $this->load->view('page',$data);
    }

	 /*Angkot Tracer*/
    function angkottracer(){
        $data['main_content']   = 'angkottracerView';
        $data['profile'] = $this->general_model->get_profile($this->session->userdata('user_id'));
        $this->load->view('page',$data);
    }
	
    function download_semuttaxi(){
        $data = file_get_contents(base_url()."public/data/semuttaxi/SemutTaxi.apk"); 
        $name = 'Semut Taxi.apk';
        force_download($name, $data);
    }

    function download_semut(){
        $data = file_get_contents(base_url()."public/data/semut/Semut.apk"); 
        $name = 'Semut.apk';
        force_download($name, $data);
    }

    function download_semutparking(){
        $data = file_get_contents(base_url()."public/data/semutparking/Semut-Parking.apk"); 
        $name = 'Semut-Parking.apk';
        force_download($name, $data);
    }

    function download_semutparkingios(){
        $data = file_get_contents(base_url()."public/data/semutparking/BITS-Parking.app.zip"); 
        $name = 'Semut-Parking.app';
        force_download($name, $data);
    }

	function tweets(){
		$data['main_content'] 	= 'tweetsView';
		$this->load->view('page',$data);
	}
	
	function get_statistik(){
        $data = $this->maps_model->get_statistik();
		
		echo json_encode($data);
    }
    	
}

?>
