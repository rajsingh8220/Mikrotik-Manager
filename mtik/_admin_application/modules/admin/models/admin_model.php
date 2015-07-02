<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
function __construct()
	{
		parent::__construct();
	}
	
//public function get_all_admin_users(){
//    $this->db->select("*");
//    $this->db->from('ag_login');
//    return $result = $this->db->get();
//}
public function get_all_admin_users($filters = array(), $counting  = FALSE){
		if (isset($filters['user_id'])) {
			$this->db->where('user_id',$filters['user_id']);
		}
		if (isset($filters['status'])) {
			$this->db->where('status',$filters['status']);
		}
		if (isset($filters['blocked'])) {
			$this->db->where('blocked',$filters['blocked']);
			
		}
		if((isset($filters['start'])) and (isset($filters['limit']))){
            $this->db->limit($filters['limit'],$filters['start']);
        }
        if((isset($filters['sort_by'])) and (isset($filters['sort_order']))){
            $this->db->order_by($filters['sort_by'],$filters['sort_order']);
        }
	
		$this->db->select("*");
		$this->db->from('ag_login');
		$this->db->order_by('user_id');
		/*$this->db->join('ckt_news_type','ckt_news_schedule.news_type_news_id = ckt_news_type.news_id','left');
		$this->db->join('ckt_team_list','ckt_news_schedule.team1_news_id = ckt_team_list.news_id','inner');*/
		$result = $this->db->get();
        
         if ($counting === TRUE) {
			$rows = $result->num_rows();
			$result->free_result();
           
			return $rows;
		}
        if ($result->num_rows() == 0) {
			return FALSE;
		}
        
		$admins = array();
       foreach ($result->result_array() as $row) {
			
            $admins[] = array(
                'user_id' => $row['user_id'],
                'username' => $row['username'],
                'recovery_email' => $row['recovery_email'],
                'read_write_blocked' => $row['read_write_blocked'],
                'allow_queue_add' => $row['allow_queue_add'],
                'blocked' => $row['blocked'],
                'allow_queue_edit' => $row['allow_queue_edit']
                
				
            );
        }

        return $admins;
	}

    
    public function get_admin_user($user_id){
		$return = $this->get_all_admin_users(array('user_id' => $user_id));

        if (empty($return)) {
            return FALSE;
        } else {
            return $return[0];
        }
	}
    public function delete_admin($uid=NULL){
        $user_detail = $this->get_all_admin_users(array('user_id' => $uid));
		if($this->db->delete('ag_login', array('user_id' => $uid))){
		  
		  $this->load->model('log/log_model');
          date_default_timezone_set('GMT');
           $hour =date('h')+5; 
           $minut = date('i')+45;
           if($minut==60){
              $hour=$hour+1;
             $minut =0;
           }
           else if($minut>60){
              $hour=$hour+1;
              $minut =$minut-60;
           }
           if($hour==24){
            $hour = 0;
           }
           else if($hour>=24){
            $hour = $hour-24;
           }
           $second = date('s');
           $time = $hour.":".$minut.":".$second;
           $date = date('y-m-d')." ".$time;
        $log['added_by'] ='n/a';
       $log['added_on'] = 'n/a';
       $log['action'] = 'delete';
       $log['table_name'] = 'User Deleted';
       $log['fieldname'] = 'username';
       $log['field_old_value'] = 'Username: '.$user_detail[0]['username'];
       $log['field_new_value'] = 'User is deleted';
       $log['edited_by'] =  $this->session->userdata('login_name');
       $log['edited_on'] = $date;
       $log['category_name'] = 'n/a';
       $log['device_name'] = 'n/a';
       $last_log = $this->log_model->add_log_record($log);
       return $user_detail;
		}
        
        
	}
    
    //Insert new vacancy
	public function new_admin($insert_fields= array()){
	$this->db->insert('ag_login', $insert_fields);
        $last_uid = $this->db->insert_id() ;
        return $last_uid;      

	}
    //Update Match
	public function update_admin($update_fields = array(),$uid=NULL){
		$this->db->update('ag_login', $update_fields, array('user_id' => $uid));
        return TRUE;
	}

}