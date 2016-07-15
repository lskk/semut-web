<?php

class Front extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('front_model');
		$this->load->library('form_validation');
		if ($this->session->userdata('logged_in')) {
			redirect('member');
		}
	}
	
	function index(){
		$semuter 		= $this->front_model->count_semuter();
		$onlinesemuter 	= $this->front_model->count_online_semuter();
		$tag 			= $this->front_model->count_tag();
		$checkin		= $this->front_model->count_checkin();
		$reputdata 		= array();
		$poinrank 		= $this->front_model->get_poinrank();
		$reputrank 		= $this->front_model->get_reputrank();

		if ($reputrank) {
			foreach ($reputrank as $item) {
				$reputation 		= (int)$item->Reputation;
				$bar = '0:100,0:100,0:100,0:100,0:100,0:100,0:100,0:100';
				if ($reputation != 0) {
					if ($reputation < 100) {
						$rbar = 100 - $reputation;
						$bar = $reputation.':'.$rbar.',0:100,0:100,0:100,0:100,0:100,0:100,0:100';
					} else if ($reputation < 200) {
						$rbar = 200 - $reputation;
						$rep = 100 - $rbar;
						$bar = '100:0,'.$rep.':'.$rbar.',0:100,0:100,0:100,0:100,0:100,0:100';
					} else if ($reputation < 300) {
						$rbar = 300 - $reputation;
						$rep = 100 - $rbar;
						$bar = '100:0,100:0,'.$rep.':'.$rbar.',0:100,0:100,0:100,0:100,0:100';
					} else if ($reputation < 400) {
						$rbar = 400 - $reputation;
						$rep = 100 - $rbar;
						$bar = '100:0,100:0,100:0,'.$rep.':'.$rbar.',0:100,0:100,0:100,0:100';
					} else if ($reputation < 500) {
						$rbar = 500 - $reputation;
						$rep = 100 - $rbar;
						$bar = '100:0,100:0,100:0,100:0,'.$rep.':'.$rbar.',0:100,0:100,0:100';
					} else if ($reputation < 600) {
						$rbar = 600 - $reputation;
						$rep = 100 - $rbar;
						$bar = '100:0,100:0,100:0,100:0,100:0,'.$rep.':'.$rbar.',0:100,0:100';
					} else if ($reputation < 700) {
						$rbar = 700 - $reputation;
						$rep = 100 - $rbar;
						$bar = '100:0,100:0,100:0,100:0,100:0,100:0,'.$rep.':'.$rbar.',0:100';
					} else if ($reputation < 800) {
						$rbar = 800 - $reputation;
						$rep = 100 - $rbar;
						$bar = '100:0,100:0,100:0,100:0,100:0,100:0,100:0,'.$rep.':'.$rbar;
					} else if ($reputation >= 800) {
						$bar = '100:0,100:0,100:0,100:0,100:0,100:0,100:0,100:0';
					}
				}
				$dat['ID'] 			= $item->ID;
				$dat['Name'] 		= $item->Name;
				$dat['Joindate'] 	= $item->Joindate;
				$dat['AvatarID'] 	= $item->AvatarID;
				$dat['Bar'] 		= $bar;

				array_push($reputdata, $dat);
			}
		}else{
			$reputdata = false;
		} 
		

		$data['semuter'] 		= $semuter;
		$data['onlinesemuter'] 	= $onlinesemuter;
		$data['tags'] 			= $tag;
		$data['checkins'] 		= $checkin;
		$data['p_rank'] 		= $poinrank;
		$data['r_rank'] 		= $reputdata;
        $data['main_content'] 	= 'frontView';
	    $this->load->view('page', $data);
	}

	function tweet_feed(){
		$ntmc 		= array('twitter_screen_name'   => 'NTMCLantasPolri');
		$ntmctweet 	= $this->tweetfeed->get_tweet_list($ntmc);
		echo $ntmctweet;
	}

	function tweets(){
		$settings = array(
	        'oauth_access_token' => "21490569-SyEnR2kdVhoi9PyTkkzwl6NP8LCtQRr0EFM6SWqku",
	        'oauth_access_token_secret' => "jwVaghEcFO2mflgRviHL5unEmYHulvp1ZhH6i45DBhrQU",
	        'consumer_key' => "SlHcRAt2YHrQZxVpYUEp5EnwO",
	        'consumer_secret' => "T1zBBk4ztWWhTCYKjZZEffnlne0Sa7CiA9indo5r8jXqnEogSw"
	    );
		$twitter = $this->load->library('twitterapi',$settings);
		$url = 'https://api.twitter.com/1.1/search/tweets.json';
	    $getfield = '?q=%23freebandnames&since_id=24012619984051000&max_id=250126199840518145&result_type=mixed&count=4';
	    $requestMethod = 'GET';
	    $result =  $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest();
        print_r($result);

        if ($result) {
        	echo "berhasil <br>";
        	echo $result;

        } else {
        	echo "GAGAL";
        }
        

	}

    	
}

?>