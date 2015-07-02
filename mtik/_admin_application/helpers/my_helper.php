<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!(function_exists('adie'))){
    function adie($var){
        echo '<pre>';
          print_r($var);
        echo '</pre>';
    }
}
if(!(function_exists('flash_message'))){
    function flash_message()
    {
        // get flash message from CI instance
        $ci =& get_instance();
        $flashmsg = $ci->session->flashdata('message');

        $html = '';
        if (is_array($flashmsg))
        {
            $html = '<div id="flashmessage" class="'.$flashmsg[type].'">
                <img style="float: right; cursor: pointer" id="closemessage" src="'.base_url().'images/cross.png" />
                <strong>'.$flashmsg['title'].'</strong>
                <p>'.$flashmsg['content'].'</p>
                </div>';
        }
        return $html;
    }
}


if(!(function_exists('get_fieldname_from_fieldvalue'))){
      function get_fieldname_from_fieldvalue($filter=array()){
          $staff_id = $filter['staff_id'];
          $sql = mysql_query("select department_id from ag_staff_official_status where staff_id='$staff_id'");
          $output = mysql_fetch_array($sql);
          $dpt_id = $output['department_id'];
          $select_field_name = $filter['select_field_name'];
          $table_name = $filter['table_name'];
          $where_field_name = $filter['where_field_name'];
          $where_field_value = $dpt_id;
          $sql = mysql_query("select $select_field_name from $table_name where $where_field_name='$where_field_value'");
          $result = mysql_fetch_array($sql);
          return $result[$select_field_name];
          
      }
}

    if(!(function_exists('get_values_of_fieldname'))){
        function get_values_of_fieldname($select , $where , $value ,$tablename){
            $CI = & get_instance();
            $CI->db->select($select);
            $CI->db->where($where,$value);
            $data = $CI->db->get($tablename);
            if(!$data){
                return FALSE;
            }
            $row = $data->row();
            return $row->$select;
        }
        
    }       
 
    if(!(function_exists('get_file_name'))){
        function get_file_name($staff_id){
            $CI = & get_instance();
            $CI->db->select('document_name');
            $CI->db->where('user_id',$staff_id);
            $data = $CI->db->get('ag_documents');
            if(!$data){
                return FALSE;
            }
            foreach($data->result_array() as $row){
                unlink(FCPATH.'/upload/'.$row['document_name']);
            }
        }
        
    }       
    
    
?>
