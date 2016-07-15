<?php

class Maps extends MY_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('maps_model');
		$this->load->library('form_validation');
	}
	
	function index(){
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H',time());

        if ($time >= 6 && $time < 18) {
            $data['time'] = 1;
        }else {
            $data['time'] = 2;
        }

        if ($this->session->userdata('logged_in')) {
            $data['isloggedin'] = 1;
        } else {
            $data['isloggedin'] = 0;
        }
        

        $data['now'] = $time;
        $data['main_content']   = 'mapview';
        $data['profile']  = $this->maps_model->get_profile($this->session->userdata('user_id'));
        $this->load->view('page',$data);
	}

    function get_semuters(){
        $data = $this->maps_model->get_semuters();
        echo json_encode($data);
    }

    function get_reports(){
        $data = $this->maps_model->get_report();
        echo json_encode($data);
    }

    function get_places(){
        $data = $this->maps_model->get_place($_GET['type']);
        echo json_encode($data);
    }

    function get_cctv(){
        $data       = $this->maps_model->get_cctv();  
        $cctvs      = array();
        foreach ($data as $row) {
            $cctv['ID']         = $row->ID;
            $cctv['Name']       = $row->Name;
            $cctv['Video']      = "http://bsts-svc.lskk.ee.itb.ac.id/247/content/getcontent.php?type=video&vid=".$row->ItemID;
            $cctv['Screenshot'] = "http://bsts-svc.lskk.ee.itb.ac.id/247/content/getcontent.php?type=image&vid=".$row->ItemID;
            $cctv['Latitude']   = $row->Latitude;
            $cctv['Longitude']  = $row->Longitude;
            $cctv['City']       = $row->City;
            $cctv['Province']   = $row->Province;
            $cctv['Country']    = $row->Country;
        array_push($cctvs, $cctv);
        }
        echo json_encode($cctvs);
    }

    function get_member_reports(){
        $id   = $this->session->userdata('user_id');
        $data = $this->maps_model->get_member_report($id);
        echo json_encode($data);
    }

    function get_member_friends(){
        $id         = $this->session->userdata('user_id');
        $friend1    = $this->maps_model->get_friend1($id);
        $friend2    = $this->maps_model->get_friend2($id);
        $friends    = array();
        if ($friend1) {
            foreach ($friend1 as $key) {
                    $idfriend     = $key->ID_RESPONSE;
                    if ($key->ID_RESPONSE==$id) {
                        $idfriend = $key->ID_REQUEST;
                    }
                    $profile      = $this->maps_model->get_friend_location($idfriend);
                    array_push($friends, $profile);
            }
        }
        if ($friend2) {
            foreach ($friend2 as $key) {
                    $idfriend     = $key->ID_REQUEST;
                    if ($key->ID_REQUEST==$id) {
                        $idfriend = $key->ID_RESPONSE;
                    }
                    $profile      = $this->maps_model->get_friend_location($idfriend);
                    array_push($friends, $profile);
            }
        }
        echo json_encode($friends);
    }

    function get_ads(){
        $data = $this->maps_model->get_ads();
        echo json_encode($data);
    }

    function get_incidents(){
        $data = $this->maps_model->get_incident();
        echo json_encode($data);
    }
	function get_angkot(){
        $data = $this->maps_model->get_angkot();
        echo json_encode($data);
    }

    function get_stops() {
    //load model
    // $this->load->model('stops_model');
    //add the header
    header('Content-Type: application/json');
    //encode json
    echo json_encode( $this->maps_model->get_stops() );
  }

  function get_stops_time($stop_id) {
    // $stop_id = 'ST_BD';
    //load model
    // $this->load->model('stops_time_model');
    //add the header
    header('Content-Type: application/json');
    //encode json
    echo json_encode( $this->maps_model->get_stops_time($stop_id) );
  }

  function get_train($trip_id) {
    $data = json_decode(file_get_contents(base_url() . 'asset/commuter/js/posisikereta_sim.json'));

    // var_dump($data[0]->trip_id);

    //add the header
    header('Content-Type: application/json');

    for($i = 0; $i < sizeof($data); $i++){
      if($data[$i]->trip_id == $trip_id){
        echo json_encode($data[$i]);
      }
    }
  }

  function get_delays() {
    $data = json_decode(file_get_contents(base_url() . 'asset/commuter/js/posisikereta_sim.json'));
    // $this->load->model('stops_model');
    $stops = $this->maps_model->get_stops_coord();
    // $this->load->model('stops_time_model');

    $prev_station        = 0;
    $next_station        = 0;
    $prev_next_distance  = 0;
    $train_next_distance = 0;

    $arrayJson = array();

    // var_dump($stops);


    for($i = 0; $i < sizeof($data); $i++){
      //get prev & next station
      if($data[$i]->dir_id == 0){
        // echo "==TUJUAN PADALARANG==";

        $found = false;

        $station = sizeof($stops) - 1;
        for($station; $station >= 0; $station--){
          // echo "stat " . $stops[$station]->stop_id . "//";
          if(($data[$i]->long > $stops[$station]->stop_lon)&&($found == false)){
            $found = true;
            $prev_station = $station + 1;//$stops[$station + 1]->stop_id;
            $next_station = $station;//$stops[$station]->stop_id;

            // echo "prev: " . $prev_station;
          }
        }
      }else if($data[$i]->dir_id == 1){
        // echo "==TUJUAN CICALENGKA==";

        $found = false;

        for($station = 1; $station < sizeof($stops); $station++){
          if(($data[$i]->long < $stops[$station]->stop_lon)&&($found == false)){
            $found = true;
            $prev_station = $station - 1;//$stops[$station - 1]->stop_id;
            $next_station = $station;//$stops[$station]->stop_id;

            // echo "prev: " . $prev_station;
          }
        }
      }


      //calculate prev to next station distance
      $prev_next_distance = $this->haversineGreatCircleDistance(
        $stops[$prev_station]->stop_lat, $stops[$prev_station]->stop_lon,
        $stops[$next_station]->stop_lat, $stops[$next_station]->stop_lon);
      // echo "prev_next_distance: " . $prev_next_distance;

      //calculate train to next station distance
      $train_next_distance = $this->haversineGreatCircleDistance(
        $data[$i]->lat, $data[$i]->long,
        $stops[$next_station]->stop_lat, $stops[$next_station]->stop_lon);
      // echo "train_next_distance: " . $train_next_distance;

      //calculate prev to next station time
      $prev_time = $this->maps_model->get_train_departure_time(
        $stops[$prev_station]->stop_id,
        $data[$i]->trip_id);

      $next_time = $this->maps_model->get_train_arrival_time(
        $stops[$next_station]->stop_id,
        $data[$i]->trip_id);

      $prev_next_time = strtotime($next_time[0]->arrival_time) - strtotime($prev_time[0]->departure_time);
      // var_dump($this->stops_time_model->getDepartureTime(
      //     $stops[$next_station]->stop_id,
          // $data[$i]->trip_id));

      // echo " " . $next_time[0]->arrival_time . "-" . $prev_time[0]->departure_time . "time: " . " = " . $prev_next_time;
      // echo "time: " . $this->stops_time_model->getArrivalTime('ST_BD','KA410')->departure_time;//$stops[$next_station]->stop_id, $data[$i]->trip_id

      //calculate average scheduled speed
      //calculate ETA
      $train_next_time = $train_next_distance * $prev_next_time / $prev_next_distance;
      // echo " || train_next_time " . floor($train_next_time / 60);
      $tracking_time = date('H:i:s', strtotime($data[$i]->datetime));
      // echo "tracking_time " . $tracking_time;
      $eta = date('H:i:s', strtotime($tracking_time) + $train_next_time);
      // echo " // eta : " . $eta; //date('H:i:s', $eta);
      // echo " // sch : " . date('H:i:s', strtotime($next_time[0]->arrival_time));
      $delay = strtotime($eta) - strtotime($next_time[0]->arrival_time);
      // echo " id : " . $data[$i]->trip_id . " delay:: " . $delay;

      $arrayJson[] = array('trip_id' => $data[$i]->trip_id, 'delay' => $delay);
    }

    echo json_encode($arrayJson);
    // var_dump($data);
  }



  function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
    // echo "test";
    // $latitudeFrom = -6.949106;
    // $longitudeFrom = 107.712525;
    // $latitudeTo = -6.870046;
    // $longitudeTo = 107.517610;
    // $earthRadius = 6371000;


    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

    // echo "string" . ($angle * $earthRadius);
    return $angle * $earthRadius;
  }
	
}

?>