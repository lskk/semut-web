<?php

class Member extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('front/front_model');
		$this->load->library('form_validation');
			
		$this->id_user 	= $this->session->userdata('user_id');
	}
	
	function index(){
        if(!$this->_is_logged_in()){
        	$data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('member/signinfb'), 
                'scope' => array("email") // permissions here
            ));
			$data['main_content'] = 'signin';
			$this->load->view('form', $data);
		}else{
			$friend1 		= $this->member_model->count_friend1($this->id_user);
			$friend2 		= $this->member_model->count_friend2($this->id_user);
			$friend 		= $friend1 + $friend2;
			$friend_req 	= $this->member_model->count_friend_req($this->id_user);
			$report 		= $this->member_model->count_report($this->id_user);
			$poin			= $this->member_model->get_poin($this->id_user);
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
			$data['p_rank'] 		= $poinrank;
			$data['r_rank'] 		= $reputdata;
			//count data
			$data['friends'] 		= $friend;
			$data['friend_reqs'] 	= $friend_req;
			$data['reports'] 		= $report;
			$data['poins'] 			= $poin;
			$data['profile'] = $this->member_model->get_profile($this->session->userdata('user_id'));


	        $data['main_content'] 	= 'dashboard';
	        $this->load->view('page', $data);				
        }
	}

	function signinfb(){
		$user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            $this->facebook->destroySession();
        }

        if ($user) {

            $data['user_id']    = '100';
			$data['user'] 		= 'FB_Name';
			$data['roles']		= 'fb';
            $data['logged_in'] 	= true;
            $this->session->set_userdata($data);
            redirect('');

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('member/signinfb'), 
                'scope' => array("email") // permissions here
            ));
            $data['main_content'] = 'signin';
			$this->load->view('form', $data);
        }

	}

	function signup(){
		if ($_POST) {
			$params['Name'] 		= $this->input->post('username', true);//$this->post('username');
			$params['Email'] 		= $this->input->post('email', true);//$this->post('email');
			$params['Password'] 	= $this->input->post('password', true);//$this->post('password');
			$params['Gender'] 		= $this->input->post('gender', true);//$this->post('gender');
			if (!$this->member_model->is_exist($params['Email'])) {
	    		$action	= $this->member_model->insert($params);
	    		if (!$action) {
                    $data['error'] = 'Registration Error, please try again';
					$data['login_url'] = $this->facebook->getLoginUrl(array(
			            'redirect_uri' => site_url('member/signinfb'), 
			            'scope' => array("email") // permissions here
			        ));
					$data['main_content'] = 'signup';
					$this->load->view('form', $data);
			    } else {
			    	$profile 			= $this->member_model->get_profile($params['Email']);
			    	$data['user_id']    = $profile['ID'];
					$data['user'] 		= $profile['Name'];
					$data['roles']		= 'reg';
	                $data['logged_in'] 	= true;
	                $this->session->set_userdata($data);
	                redirect('');
			    } 
			}else{
				$data['error'] = 'Email is already used';
				$data['login_url'] = $this->facebook->getLoginUrl(array(
		            'redirect_uri' => site_url('member/signinfb'), 
		            'scope' => array("email") // permissions here
		        ));
				$data['main_content'] = 'signin';
				$this->load->view('form', $data);
			}
			return;
		}
		$data['main_content'] 	= 'signup';
		$this->load->view('form', $data);	
	}

	function resetpassword(){
		if ($_POST) {
			$user_email = $this->post('email');
			$user 		= $this->member_model->get_by_email($user_email);
			$random 	= rand(6,12345);
	    	$newpass 	= $user->Name.$random;
	    	$updatepass	= array('Password'=>md5($newpass));
	    	$doupdate 	= $this->member_model->update_user($updatepass,$user->ID);

	    	if ($doupdate) {
	    	    $config['protocol'] 	= "smtp";
				$config['smtp_host'] 	= "ssl://smtp.gmail.com";
				$config['smtp_port'] 	= "465";
				$config['smtp_user'] 	= "bstslskk@gmail.com"; 
				$config['smtp_pass'] 	= "semut123";
				$config['charset'] 		= "iso-8859-1";
				$config['mailtype'] 	= "text";
				$config['newline'] 		= "\r\n";
		 
		        $this->email->initialize($config);

		    	$this->email->from('bstslskk@gmail.com', 'Admin Semut');
				$this->email->to($user_email); 

				$this->email->subject('Reset New Password');
				$this->email->message('Hai Semuter, your new password is'.$newpass);	
				$sending = $this->email->send();
				if ($sending) {
		            $data['successreset'] 		= 'Reset password success, please check your email for new password!';
				} else {                    
		            $data['errorreset'] 		= 'Reset password error, please try again!';
				}
	    	} else {
	    		$data['errorreset'] 		= 'Reset password error, please try again!';
	    	}
		}
		$data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('member/signinfb'), 
            'scope' => array("email") // permissions here
        ));
		$data['main_content'] 	= 'signin';
		$this->load->view('form', $data); 	
    }

    function forget(){
    	if($this->_is_logged_in()){
			redirect('');
		}
		$data['main_content'] 	= 'forget';
		$this->load->view('form', $data);
    }
    
    function signin(){
		//Redirect
		if($this->_is_logged_in()){
			redirect('');
		}
		
		if($_POST){
			//Data
			$username 	= $this->input->post('email', true);
			$password 	= $this->input->post('password', true);
			$pass 		= md5($password);
			//cek user on user semut
			$usersemut	= $this->member_model->validsemut($username, $pass);
			//Validation
			if($usersemut){
                $data['user_id']    = $usersemut->ID;
				$data['user'] 		= $usersemut->Name;
				$data['roles']		= 'reg';
				$data['verified']	= $usersemut->verified;
                $data['logged_in'] 	= true;
                $this->session->set_userdata($data);
                redirect('');				
			}else{
				$data['error'] = "Incorret Email or Password!";
				$data['login_url'] = $this->facebook->getLoginUrl(array(
		            'redirect_uri' => site_url('member/signinfb'), 
		            'scope' => array("email") // permissions here
		        ));
				$data['main_content'] = 'signin';
				$this->load->view('form', $data);
			}

			return;
		}
		$data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('member/signinfb'), 
            'scope' => array("email") // permissions here
        ));
		$data['main_content'] 	= 'signin';
		$this->load->view('form', $data);
	}
    
    function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

	function profile(){
		if (!$this->session->userdata('logged_in')) {
			redirect('');
		} 
		$friend1 		= $this->member_model->count_friend1($this->id_user);
		$friend2 		= $this->member_model->count_friend2($this->id_user);
		$friend 		= $friend1 + $friend2;
		$friend_req 	= $this->member_model->count_friend_req($this->id_user);
		$report 		= $this->member_model->count_report($this->id_user);
		$checkin 		= $this->member_model->count_checkin($this->id_user);

		$friends1 		= $this->member_model->get_friend_list1($this->id_user);
		$friends2 		= $this->member_model->get_friend_list2($this->id_user);
		$friends_list 	= array();
		if ($friends1) {
            foreach ($friends1 as $key) {
                $idfriend     = $key->ID_REQUEST;
                if ($key->ID_REQUEST==$this->id_user) {
                    $idfriend = $key->ID_RESPONSE;
                } 
                $profile      = $this->member_model->get_profile($idfriend);
                array_push($friends_list, $profile);
            }
        }
        if ($friends2) {
            foreach ($friends2 as $key) {
                $idfriend     = $key->ID_RESPONSE;
                if ($key->ID_RESPONSE==$this->id_user) {
                    $idfriend = $key->ID_REQUEST;
                }
                $profile      = $this->member_model->get_profile($idfriend);
                array_push($friends_list, $profile);
            }
        }
		$friend_reqs 	= $this->member_model->get_friend_req_list($this->id_user);
		$friends_reqs 	= array();
		if ($friend_reqs) {
            foreach ($friend_reqs as $key) {
                $idfriend     = $key->ID_REQUEST;
                if ($key->ID_REQUEST==$this->id_user) {
                    $idfriend = $key->ID_RESPONSE;
                } 
                $profile      = $this->member_model->get_profile($idfriend);
                array_push($friends_reqs, $profile);
            }
        }
		$posts 			= $this->member_model->get_post_list($this->id_user);
		$checkins 		= $this->member_model->get_checkin_list($this->id_user);
		$myprofile 		= $this->member_model->get_profile($this->id_user);
		$reputation 	= (int)$myprofile['Reputation'];
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
//data 
		$data['friend_list'] 	= $friends_list;
		$data['friend_req_list']= $friends_reqs;
		$data['post_list'] 		= $posts;
		$data['checkin_list'] 	= $checkins;
		
		$data['friends'] 		= $friend;
		$data['friend_reqs'] 	= $friend_req;
		$data['reports'] 		= $report;
		$data['checkins'] 		= $checkin;
		$data['Bar'] 		= $bar;

		$data['profile'] 		= $myprofile;
		$data['main_content'] 	= 'profile_view';
		$this->load->view('page', $data);
	}
    
    function verification(){
		if($_POST){
			//Data
			$mail 	= $this->input->post('email', true);
			$number = $this->input->post('number', true);

			$user	= $this->member_model->cek_user($mail, $number);
			
			//Validation
			if($user){
				$updateuser	= array('Verified'=> 1);
	    		$doupdate 	= $this->member_model->update_user($updateuser, $user->ID);
				$data['info'] = "Congratulation!!! Verification Success!";
			}else{
				$data['error'] = "Email and Number not match!";
			}
		}
		$data['main_content'] 	= 'verification';
		$this->load->view('form', $data);
	}

	function verifiying(){
		$user 		= $this->member_model->get_profile($this->id_user);    	
        $random     = rand(6,123456789);
        $updatedata = array('VerifiedNumber'=>$random);
        $this->users_model->update_user($updatedata,$user->ID);

        $config['protocol']     = "smtp";
        $config['smtp_host']    = "ssl://smtp.gmail.com";
        $config['smtp_port']    = "465";
        $config['smtp_user']    = "bstslskk@gmail.com"; 
        $config['smtp_pass']    = "semut123";
        $config['charset']      = "iso-8859-1";
        $config['mailtype']     = "html";
        $config['newline']      = "\r\n";
 
        $this->load->library('email', $config);

        $this->email->from('bstslskk@gmail.com', 'Admin Semut App');
        $this->email->to($user['Email']); 

        $this->email->subject('User Verification Number');
        $this->email->message('<p>Hai '.$user['Name'].', your verification number is &nbsp;&nbsp;<strong>'.$random.'</strong></p>
                                <p>Enter your verification at this <a href="http://bsts.lskk.itb.ac.id/semut/member/verification">Verification Link</a></p>
                                '); 
        $sending = $this->email->send();
        if ($sending) {
        	$data['info'] 		= 'Email verification has been send';
        } else {
        	$data['warning'] 	= 'Oops! An error occurred';
        }
        $friend1 		= $this->member_model->count_friend1($this->id_user);
		$friend2 		= $this->member_model->count_friend2($this->id_user);
		$friend 		= $friend1 + $friend2;
		$friend_req 	= $this->member_model->count_friend_req($this->id_user);
		$report 		= $this->member_model->count_report($this->id_user);
		$checkin 		= $this->member_model->count_checkin($this->id_user);

		$data['friends'] 		= $friend;
		$data['friend_reqs'] 	= $friend_req;
		$data['reports'] 		= $report;
		$data['checkins'] 		= $checkin;

		$data['profile'] 		= $this->member_model->get_profile($this->id_user);
		$data['main_content'] 	= 'profile_view';
		$this->load->view('page', $data);                
    }
	
//Hidden Methods not allowed by url request

	function _member_area(){
		if(!$this->_is_logged_in()){
			redirect('signin');
		}
	}
	
	function _is_logged_in(){
		if($this->session->userdata('logged_in')){
			return true;
		}else{
			return false;
		}
	}
	public function update(){
               
                $data = array(
                'Barcode'=>$this->input->post('contact'));
                $this->db->where('ID', $this->input->post('hidden'));
                $this->db->update('tb_user', $data);
                $data['success'] = '<div class="alert alert-success">One record inserted Successfully</div>';
                redirect('member/profile');
        }
		
}

?>