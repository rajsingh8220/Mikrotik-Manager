<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
	}
    function add_category($data){
        $last_id = $this->db->insert('category',$data);
        return $last_id;
    }
    function get_categories(){
        $this->db->select('*');
        $this->db->from('category');
        $result = $this->db->get();
        $categories = array();
        foreach ($result->result_array() as $row) {
			
            $categories[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'category_name' => $row['category_name'],
                'description' => $row['description']
				
            );
        }

        return $categories;
    }
    function get_category($cat_id){
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id',$cat_id);
        $result = $this->db->get();
        $category = array();
        foreach ($result->result_array() as $row) {
			
            $category[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'category_name' => $row['category_name'],
                'description' => $row['description']
				
            );
        }

        return $category[0];
    }
    function get_count_no_of_devices_by_category($category_id){
        $sql = "SELECT COUNT(id) as count FROM devices_list WHERE category_id='$category_id'";
        $result = $this->db->query($sql);
        $device_count = array();
        foreach ($result->result_array() as $row) {
			
            $device_count[] = array(
                'count' => $row['count']
				
            );
        }

        return $device_count;
    }
    function get_devices_by_category_id($cat_id){
        $this->db->select('*');
        $this->db->from('devices_list');
        $this->db->where('category_id',$cat_id);
        $result = $this->db->get();
        $devices = array();
        foreach ($result->result_array() as $row) {
			
            $devices[] = array(
                'id' => $row['id'],
                'ip_addr' => $row['ip_addr'],
                'username' => $row['username'],
                'password' => $row['password'],
                'block_status' => $row['block_status'],
                'category_id' => $row['category_id']
				
            );
        }

        return $devices;
    }
    
    function get_queues($cat_id){
       $this->db->select('*');
        $this->db->from('queues');
        $this->db->where('cat_id',$cat_id);
        $result = $this->db->get();
        $queues = array();
        foreach ($result->result_array() as $row) {
			
            $queues[] = array(
                'q_id' => $row['q_id'],
                'name' => $row['name'],
                'target_address' => $row['target_address'],
                'rx_max_limit' => $row['rx_max_limit'],
                'tx_max_limit' => $row['tx_max_limit'],
                'cat_id' => $row['cat_id'],
                'parent_queue_id' => $row['parent_queue_id'],
                'multiple_ips' => $row['multiple_ips']
				
            );
        }

        return $queues; 
    }
    function add_queue($data){
        $last_id = $this->db->insert('queues',$data);
        return $last_id;
    }

  function get_queue_by_qid($q_id){
          if($q_id=='0'||$q_id==''){
              $queues = '';
              return $queues;
         }
          else{
              $this->db->select('*');
              $this->db->from('queues');
              $this->db->where('q_id',$q_id);
              $result = $this->db->get();
              $queues = array();
              foreach ($result->result_array() as $row) {
      			
                  $queues[] = array(
                      'q_id' => $row['q_id'],
                      'name' => $row['name'],
                      'target_address' => $row['target_address'],
                      'rx_max_limit' => $row['rx_max_limit'],
                      'tx_max_limit' => $row['tx_max_limit'],
                      'cat_id' => $row['cat_id'],
                      'parent_queue_id' => $row['parent_queue_id'],
                      'multiple_ips' => $row['multiple_ips']
      				
                  );
              }
              //if($queues ==''){
                //$queues = '';
              //}
      
              return $queues;
          }
          
          
      }
      function get_queue_by_qname($qname){
          if($qname==null||$qname==''){
              $queues = '';
              return $queues;
         }
          else{
              $this->db->select('*');
              $this->db->from('queues');
              $this->db->where('name',$qname);
              $result = $this->db->get();
              $queues = array();
              foreach ($result->result_array() as $row) {
      			
                  $queues[] = array(
                      'q_id' => $row['q_id'],
                      'name' => $row['name'],
                      'target_address' => $row['target_address'],
                      'rx_max_limit' => $row['rx_max_limit'],
                      'tx_max_limit' => $row['tx_max_limit'],
                      'cat_id' => $row['cat_id'],
                      'parent_queue_id' => $row['parent_queue_id'],
                      'multiple_ips' => $row['multiple_ips']
      				
                  );
              }
      
              return $queues[0];
          }
          
          
      }
      function delete_queue_by_queue_name($queue_name){
        $deleted_id = $this->db->delete('queues',array('name'=>$queue_name));
        return $deleted_id;
      }
      function get_limits(){
        $this->db->select('*');
        $this->db->from('bandwidth');
        $result = $this->db->get();
        $limits = array();
              foreach ($result->result_array() as $row) {
      			
                  $limits[] = array(
                      'id' => $row['id'],
                      'limits' => $row['limits'],
                       'title' => $row['title']
      				
                  );
              }
      
              return $limits;
      }
      function edit_queue($q_name, $data){
        $q = $this->db->update('queues',$data,array('name'=>$q_name));
        return $q;
      }
      function edit_queue_by_id($queue_id, $data){
        $last_update = $this->db->update('queues',$data,array('q_id'=>$queue_id));
        return $last_update;
      }
      function get_queue_by_parent_id($id){
            $this->db->select('*');
            $this->db->from('queues');
            $this->db->where('parent_queue_id',$id);
            $result = $this->db->get();
            $queues = array();
              foreach ($result->result_array() as $row) {
      			
                  $queues[] = array(
                      'q_id' => $row['q_id'],
                      'name' => $row['name'],
                      'target_address' => $row['target_address'],
                      'rx_max_limit' => $row['rx_max_limit'],
                      'tx_max_limit' => $row['tx_max_limit'],
                      'cat_id' => $row['cat_id'],
                      'parent_queue_id' => $row['parent_queue_id'],
                      'multiple_ips' => $row['multiple_ips']
      				
                  );
              }
      
              return $queues;
      }
      function add_schedule($data){
        $inserted = $this->db->insert('schedules',$data);
        return $this->db->insert_id();
      }
      
      function adjust($parent,$device_ip,$device_username, $device_password){
        //echo "<br>".$parent;
        $final_upload = 0;
        $final_download = 0;
        $findme_up_k   = 'k';
        $this_parent = $this->category_model->get_queue_by_qname($parent);
        $queues_under_this_queue = $this->category_model->get_queue_by_parent_id($this_parent['q_id']);
        //print_r($queues_under_this_queue);
        if($queues_under_this_queue==null){
            echo '<br>the parent does not hav childs so put 64k bandwidth';
            echo "<br>final Adjustment for".$parent;
            echo "<br>".$final_upload."/".$final_download;
            $data['rx_max_limit'] = '64k';
            $data['tx_max_limit'] = '64k';
            if ($this->api_model->connect($device_ip, $device_username, $device_password)) {
                $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                      "numbers"     => $parent,
                      "max-limit"=>"64k/64k",
                 )); 
            }
            if($ARRAY!=null){
             echo "error on adjustment";   
            }
            else{
               $id_l = $this->category_model->edit_queue_by_id($this_parent['q_id'],$data);
               if($id_l){
                echo "adjustmnet success";
               } 
            }
        }
        else{
            foreach($queues_under_this_queue as $q){
                //echo "<br>".$q['rx_max_limit'];
                
                //$findme_up_m  = 'M';
                $pos_up_k = strpos($q['rx_max_limit'], $findme_up_k);
                if ($pos_up_k !== false) {
                    $int_upload = filter_var($q['rx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                    $final_upload = $final_upload+$int_upload;
                } 
                else{
                    $int_upload = filter_var($q['rx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                    $int_upload = $int_upload*1024;
                    $final_upload = $final_upload+$int_upload;
                }
                
                
               
                $pos_down_k = strpos($q['tx_max_limit'], $findme_up_k);
                if ($pos_down_k !== false) {
                    $int_download = filter_var($q['tx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                    $final_download = $final_download+$int_download;
                } 
                else{
                    $int_download = filter_var($q['tx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                    $int_download = $int_download*1024;
                    $final_download = $final_download+$int_download;
                }
                
                
            }//end of foreach
            //echo "<br>final Adjustment for".$parent;
            //echo "<br>".$final_upload."/".$final_download;
            $data['rx_max_limit'] = $final_upload.'k';
            $data['tx_max_limit'] = $final_download.'k';
            if ($this->api_model->connect($device_ip, $device_username, $device_password)) {
                $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                      "numbers"     => $parent,
                      "max-limit"=>$final_upload."k/".$final_download.'k',
                 )); 
            }
            if($ARRAY!=null){
             //echo "error on adjustment";   
            }
            else{
               $id_l = $this->category_model->edit_queue_by_id($this_parent['q_id'],$data);
               if($id_l){
                //echo "adjustmnet success";
               } 
            }
            
        }// end of else
    }
    function add_schedule_log($data){
        $id = $this->db->insert('schedule_log',$data);
        return $id;
    }
    function edit_schedule_log($id,$data){
        $this->db->update('schedule_log',$data,array('schedule_id'=>$id));
        return true;
    }
    function get_schedule_by_queue_name($queue_name){
        $this->db->select('*');
        $this->db->from('schedules');
        $this->db->where('queue_name',$queue_name);
        $result = $this->db->get();
        $schedules = array();
        foreach($result->result_array() as $row){
            $schedules[] = array(
                'id' => $row['id'],
                'start_time' =>$row['start_time'],
                'end_time' =>$row['end_time'],
                'previous_upload_limit' =>$row['previous_upload_limit'],
                'previous_download_limit' =>$row['previous_download_limit'],
                'scheduled_upload_limit' =>$row['scheduled_upload_limit'],
                'scheduled_download_limit' =>$row['scheduled_download_limit'],
                'comment' =>$row['comment'],
                'scheduled_by' =>$row['scheduled_by'],
                'queue_name' =>$row['queue_name'],
                'queue_id' =>$row['queue_id'],
                'cat_id' =>$row['cat_id']
            );
        }
        return $schedules;
    }
      
      
 
}