<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
	}
    function get_schedules(){
        $this->db->select('*');
        $this->db->from('schedules');
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
      function delete_schedule($id){
        $this->db->delete('schedules',array('id'=>$id));
        return true;
      }
 }