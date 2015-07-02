<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bandwidth_model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
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
      function add($data){
        $result = $this->db->insert('bandwidth',$data);
        return $result;
      }
 
}