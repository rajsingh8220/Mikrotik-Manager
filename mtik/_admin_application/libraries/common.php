<?php

/*Class Common
 * verify the user, set the sessions and logout the user
 * 
 */
class Common {
   var $CI;
   const MATCH_STATUS_START='2';
   const MATCH_STATUS_UPCOMING='1';
   const MATCH_STATUS_FINISHED='3';
   function __construct(){
       
       $this->CI =& get_instance();
     
   }
   
   public static function return_field_value($data= array(),$table=NULL){
      $CI =& get_instance(); 
	  $CI->db->select($data['select_fieldname']);
	  $CI->db->where($data['where_fieldname'],$data['where_value']);
	  $result = $CI->db->get($table);
	  foreach($result->result_array() as $rows){
	  	$data = $rows[$data['select_fieldname']];
	  }
	   return $data;
   }
   
   public function anchor_tag($minutes,$schedule_time,$match_started=FALSE,$match_id){
	   
	if($match_started==TRUE )
		{
		  $script = '<a href="'.base_url().'scoreboard/toss/'.$match_id.'">'.$schedule_time.'</a>';
		return $script;
		}
	
		
	if($minutes<=1800){
		//$script = '';
		$script = '<a href="'.base_url().'scoreboard/toss/'.$match_id.'">'.$schedule_time.'</a>';
		return $script;
	}else{
		 return $schedule_time;
    }
   }
   
   public static function  full_url()
	{
	   $ci=& get_instance();
	   $return = $ci->config->site_url().$ci->uri->uri_string();
	   if(count($_GET) > 0)
	   {
		  $get =  array();
		  foreach($_GET as $key => $val)
		  {
			 $get[] = $key.'='.$val;
		  }
		  $return .= '?'.implode('&',$get);
	   }
	   return $return;
	}  
	
	
	public static function form_dropdown_from_db($name = '', $sql, $selected = array(), $extra = '')
    {
        $CI =& get_instance();
        if ( ! is_array($selected))
        {
            $selected = array($selected);
        }

        // If no selected state was submitted we will attempt to set it automatically
        if (count($selected) === 0)
        {
            // If the form name appears in the $_POST array we have a winner!
            if (isset($_POST[$name]))
            {
                $selected = array($_POST[$name]);
            }
        }

        if ($extra != '') $extra = ' '.$extra;

        $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

        $form = '<select name="'.$name.'"'.$extra.$multiple.">\n";
        $query=$CI->db->query($sql);
        if ($query->num_rows() > 0)
        {
           foreach ($query->result_array() as $row)
           {
                  $values = array_values($row);
                  if (count($values)===2){
                    $key = (string) $values[0];
                    $val = (string) $values[1];
                    //$this->option($values[0], $values[1]);
                  }

                $sel = (in_array($key, $selected))?' selected="selected"':'';

                $form .= '<option value="'.$key.'"'.$sel.'>'.$val."</option>\n";
           }
        }
        $form .= '</select>';
        return $form;
    } 
    
    function generate_slug(){
		$slug = strtolower($_GET['title']);
		$slug = preg_replace("/[^a-zA-Z0-9 ]/", "", $slug);
	    $slug = str_replace(" ", "-", $slug);
			
		$data = array('slug_id'=>$slug);
		$record = $this->news_model->get_newss($data);
		if(count($record)<=0){
		   echo  $slug;
		}else{
			  echo $slug.'-'.uniqid('cricket_',true);;
		}
		   
   
	}
	
	function generate_excerpt(){
		$description = $_GET['description'];
		if(strlen($description)>200){
			echo substr($description,0,200);
		}else{
		    echo $description;
		}
		
	}
    
}
?>
