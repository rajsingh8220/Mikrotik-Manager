<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
	}
    public function add_log_record($data){
        $this->db->insert('tbl_editlog',$data);
    }
    public function get_log(){
        $this->db->select('*');
        $this->db->from('tbl_editlog');
        $this->db->order_by('log_id','desc');
        $result  = $this->db->get();
        $logs=array();
        foreach ($result->result_array() as $row) {
			
            $logs[] = array(
                'log_id' => $row['log_id'],
                'fieldname' => $row['fieldname'],
                'field_old_value' => $row['field_old_value'],
                'field_new_value' => $row['field_new_value'],
                'edited_by' => $row['edited_by'],
                'edited_on' => $row['edited_on'],
                'added_by' => $row['added_by'],
                'added_on' => $row['added_on'],
                'device_name' => $row['device_name'],
                'affected_queue'=>$row['affected_queue'],
                //'category' => $row['category'],
                'category_name' => $row['category_name'],
                'table_name' => $row['table_name']
				
            );
        }

        return $logs;
    }
    public function search_log($search=array()){
            $this->db->select('*');
			$this->db->from('tbl_editlog');
			$this->db->order_by('log_id', 'desc');
			
			
			if($search['category_name']!=''){
			   $this->db->like('category_name',$search['category_name']);
			}
			if($search['username']!=''){
			   $this->db->like('edited_by',$search['username']);
               $this->db->or_like('added_by',$search['username']);
			}
			if($search['from_date']!='' and $search['to_date']!=''){
			   $this->db->where( 'edited_on >= ',$search['from_date']);
			    $this->db->where('edited_on <= ',$search['to_date']);
			}
			if($search['edited_date']!=''){
			 //$date_e = $search['edited_date'];
             //$ss = $date_e
			   $this->db->where('edited_on',$search['edited_date']);
               $this->db->or_where('added_on',$search['edited_date']);
			}
			/**
 * if($search['username']!=''){
 * 			   $this->db->where('edited_by',$search['username']);
 * 			}
 * 			if($search['username']!=''){
 * 			   $this->db->where('added_by',$search['username']);
 * 			}
 */
		
		$result  = $this->db->get();
		
		$logs=array();
        foreach ($result->result_array() as $row) {
			
            $logs[] = array(
                'log_id' => $row['log_id'],
                'fieldname' => $row['fieldname'],
                'field_old_value' => $row['field_old_value'],
                'field_new_value' => $row['field_new_value'],
                'edited_by' => $row['edited_by'],
                'edited_on' => $row['edited_on'],
                'added_by' => $row['added_by'],
                'added_on' => $row['added_on'],
                'device_name' => $row['device_name'],
                'affected_queue'=>$row['affected_queue'],
                //'category' => $row['category'],
                'category_name' => $row['category_name'],
                'table_name' => $row['table_name']
				
            );
        }

        return $logs;
		
		
    }
    
    
    public function get_log_by_action($action){
        $this->db->select('*');
        $this->db->from('tbl_editlog');
        $this->db->where('action',$action);
        $this->db->order_by('log_id','desc');
        $result  = $this->db->get();
        $logs=array();
        foreach ($result->result_array() as $row) {
			
            $logs[] = array(
                'log_id' => $row['log_id'],
                'fieldname' => $row['fieldname'],
                'field_old_value' => $row['field_old_value'],
                'field_new_value' => $row['field_new_value'],
                'edited_by' => $row['edited_by'],
                'edited_on' => $row['edited_on'],
                'added_by' => $row['added_by'],
                'added_on' => $row['added_on'],
                'action' => $row['action'],
                'device_name' => $row['device_name'],
                'affected_queue'=>$row['affected_queue'],
                //'category' => $row['category'],
                'category_name' => $row['category_name'],
                'table_name' => $row['table_name']
				
            );
        }

        return $logs;
    }
    function get_log_by_log_id($log_id){
        $this->db->select('*');
        $this->db->from('tbl_editlog');
        $this->db->where('log_id',$log_id);
        $result = $this->db->get();
        $logs=array();
        foreach ($result->result_array() as $row) {
			
            $logs[] = array(
                'log_id' => $row['log_id'],
                'fieldname' => $row['fieldname'],
                'field_old_value' => $row['field_old_value'],
                'field_new_value' => $row['field_new_value'],
                'edited_by' => $row['edited_by'],
                'edited_on' => $row['edited_on'],
                'added_by' => $row['added_by'],
                'added_on' => $row['added_on'],
                'action' => $row['action'],
                'device_name' => $row['device_name'],
                'affected_queue'=>$row['affected_queue'],
                //'category' => $row['category'],
                'category_name' => $row['category_name'],
                'table_name' => $row['table_name']
				
            );
        }

        return $logs[0];
    }
    function get_all_schedule_log(){
        $this->db->select('*');
        $this->db->from('schedule_log');
        $result = $this->db->get();
        $schedule_logs=array();
        foreach ($result->result_array() as $row) {
			
            $schedule_logs[] = array(
                'id' => $row['id'],
                'start_time' => $row['start_time'],
                'end_time' => $row['end_time'],
                'previous_bandwidth' => $row['previous_bandwidth'],
                'new_bandwidth' => $row['new_bandwidth'],
                'queue_name' => $row['queue_name'],
                'cat_id' => $row['cat_id'],
                'status' => $row['status'],
                'scheduled_by' => $row['scheduled_by'],
                'schedule_id'=>$row['schedule_id']
				
            );
        }

        return $schedule_logs;
    }
    
 
}