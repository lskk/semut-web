
<?php

class Member_model extends CI_Model{
	
	var $table = "tb_user_admin";
	
	function __construct(){
		parent::__construct();
	}
	
	function validsemut($username, $password){
		$query = $this->db->query("SELECT * FROM tb_user WHERE Email = '$username' AND Password = '$password'");
		if($query->num_rows === 1){
			return $query->row();
		}else{
			return false;
		}
	}

	function cek_user($mail, $number){
		$query = $this->db->query("SELECT * FROM tb_user WHERE Email = '$mail' AND VerifiedNUmber = '$number'");
		if($query->num_rows === 1){
			return $query->row();
		}else{
			return false;
		}
	}

	function get_by_email($email){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('Email', $email);
		$query = $this->db->get(); 
						
		if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	function update_user($data,$id){
		$this->db->where('ID',$id);
		return $this->db->update('tb_user',$data);
	}

	public function is_exist($email) {
    	$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('Email', $email);
		$query = $this->db->get(); 
						
		if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
    }

    public function insert($user){
		$data_user 	= array(		
	        'Name' 			=>  $user['Name'],
	        'Email'     	=>  $user['Email'],
	        'CountryCode'   =>  62,
	        'Gender'     	=>  $user['Gender'],
	        'Password'     	=>  md5($user['Password']),
	        'Poin'     		=>  1000,
	        'AvatarID'     	=>  $user['Gender'],
	        'Joindate' 		=>  date('Y-m-d H:i:s')
        );

    	$result 	= $this->db->insert('tb_user', $data_user); 

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function get_profile($id){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('ID', $id);
		$query = $this->db->get(); 
						
		if($query->num_rows > 0){
			$row 					= $query->row();
			$profile['ID']			= $row->ID;
			$profile['Name']		= $row->Name;
			$profile['Email'] 		= $row->Email;
			$profile['CountryCode']	= $row->CountryCode;
			$profile['PhoneNumber']	= $row->PhoneNumber;
			$profile['Gender']		= $row->Gender;
			$profile['Birthday'] 	= $row->Birthday;
			$profile['Joindate'] 	= $row->Joindate;
			$profile['Poin']		= $row->Poin;
			$profile['PoinLevel']	= $row->PoinLevel;
			$profile['Reputation'] 	= $row->Reputation;
			$profile['AvatarID']	= $row->AvatarID;
			$profile['Verified']	= $row->Verified;
			$profile['deposit']	    = $row->deposit;
			$profile['Barcode']	    = $row->Barcode;
			return $profile;
		}else{
			return false;
		}
	}

	function count_friend1($id){
        $this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','2');
        $this->db->where('ID_REQUEST',$id);
        $query  = $this->db->get();

        return $query->num_rows;
    }


	function count_friend2($id){
       	$this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','2');
        $this->db->where('ID_RESPONSE',$id);
        $query  = $this->db->get();

        return $query->num_rows;
    }

    function count_friend_req($id){
        $this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','1');
        $this->db->where('ID_RESPONSE',$id);
        $query  = $this->db->get();

        return $query->num_rows;
    }

    function count_report($id){
		$query = $this->db->query("SELECT * FROM tb_post WHERE Status = 1 AND UserID = $id ");
		return $query->num_rows;
	}

	function count_checkin($id){
		$query = $this->db->query("SELECT * FROM tb_checkin WHERE Status = 1 AND UserID = $id ");
		return $query->num_rows;
	}

	function get_poin($id){
		$query = $this->db->query("SELECT Poin FROM tb_user WHERE ID = $id ");
		return $query->row();
	}

	function get_friend_list1($id){
		$this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','2');
        $this->db->where('ID_RESPONSE',$id);
        $query  = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return false;
        }
	}

	function get_friend_list2($id){
		$this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','2');
        $this->db->where('ID_REQUEST',$id);
        $query  = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return false;
        }
	}

	function get_friend_req_list($id){
		$this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','1');
        $this->db->where('ID_RESPONSE',$id);
        $query  = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return false;
        }
	}

	function get_post_list($id){
		$this->db->select('
				tb_post.*,
				tb_post_subtype.Name AS Type,
				tb_post_subtype.ParentID,
				tb_post_type.Name AS ParentType
			');
		$this->db->from('tb_post');
		$this->db->where('tb_post.UserID', $id);
		$this->db->join('tb_post_subtype','tb_post.SubType = tb_post_subtype.ID','left');
		$this->db->join('tb_post_type','tb_post_subtype.ParentID = tb_post_type.ID','left');
		$this->db->order_by('tb_post.Times','DESC');
		$query = $this->db->get(); 
						
		if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function get_checkin_list($id){
		$this->db->select('
				tb_checkin.*,
				tb_place.Name As PlaceName
			');
		$this->db->from('tb_checkin');
		$this->db->where('tb_checkin.UserID', $id);
		$this->db->join('tb_place','tb_checkin.PlaceID = tb_place.ID','left');
		$this->db->order_by('tb_checkin.Timespan','DESC');
		$query = $this->db->get(); 
						
		if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}
		
}

?>