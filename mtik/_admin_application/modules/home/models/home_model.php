<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
	}
    function add_device($data){
        $last_id = $this->db->insert('devices_list',$data);
        return $last_id;
    }
    function get_devices(){
        $this->db->select('*');
        $this->db->from('devices_list');
        $result = $this->db->get();
        
        $devices = array();
        foreach ($result->result_array() as $row) {
			
            $devices[] = array(
                'id' => $row['id'],
                'ip_addr' => $row['ip_addr'],
                'username' => $row['username'],
                'password' => $row['password'],
                'category_id' => $row['category_id']
				
            );
        }

        return $devices;
    }
    function get_device_by_id($id){
        $this->db->select('*');
        $this->db->from('devices_list');
        $this->db->where('id',$id);
        $result = $this->db->get();
        
        $device = array();
        foreach ($result->result_array() as $row) {
			
            $device[] = array(
                'id' => $row['id'],
                'ip_addr' => $row['ip_addr'],
                'username' => $row['username'],
                'password' => $row['password'],
                'category_id' => $row['category_id']
				
            );
        }

        return $device[0];
    }
	

}

/* End of file Match Model */
/* Location: ./application/models/news_model.php */