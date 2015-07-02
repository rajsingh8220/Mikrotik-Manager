<?php

/*Class Login 
 * verify the user, set the sessions and logout the user
 * 
 */
class Login_lib {
   var $CI;
   public static $username;
   public static $password;
   public static $table_login;
   const SUCCESSFULL_LOGIN = 'category/' ;
   const UNSUCCESSFULL_LOGIN = 'login/' ;
   function __construct(){
       $this->CI =& get_instance();
     
   }
   
   public static function verify_user($data= array(),$table=NULL){
      
       if(isset($data['username'])&&($data['password'])){
          self::$table_login = $table;
          self::$username = $data['username'];
          self::$password = $data['password'];
          $is_valid = self::valid_user();
          if($is_valid==TRUE){
               return TRUE;
          }else{
               return FALSE;
           }
        }else{
           return FALSE;
       }
   }
   
   public function get_user_details(){
   
   }
   public function get_user_by_id(){
       
   }
   
   public function is_logged_in(){
       $CI =& get_instance();
      
       if(($CI->session->userdata('login_name')=='') && ($CI->session->userdata('login_email')=='') && ($CI->session->userdata('login_id')=='')){
         return FALSE;  
       }else{
           return TRUE;
       }
   }
   
   private static function valid_user(){
    $return = array();   
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from(self::$table_login);
    $CI->db->where('username',self::$username);
    
    $CI->db->where('password',self::$password);
    $query =$CI->db->get();  
//    die($CI->db->last_query());
    if($CI->db->count_all_results()>0){
        foreach($query->result() as $row){
            if($row->blocked!=1){
                self::set_sessions('login_name',$row->username);
                self::set_sessions('login_email',$row->recovery_email);
                self::set_sessions('login_id',$row->user_id);
                self::set_sessions('read_write_blocked',$row->read_write_blocked);
                self::set_sessions('allow_queue_add',$row->allow_queue_add);
                self::set_sessions('allow_queue_edit',$row->allow_queue_edit);
               // self::set_sessions('login_type',$row->type);
                self::set_sessions('login_type',$row->group_id);
                //self::set_sessions('login_group_id',$row->gid);
                return TRUE;
            }else{
               $return = array('blocked'=>TRUE);
               return $return;
            }
        }
    }
    return FALSE;
   }
   
   public static  function set_sessions($session_name , $session_value){
       $CI =& get_instance();
       $CI->session->set_userdata($session_name, $session_value);
      
   }
   public static  function destroy_sessions($session_name ){
       $CI =& get_instance();
       $CI->session->unset_userdata($session_name);
   }
   
   public static function prepare_password($password){
       $CI =& get_instance();
       return sha1($password.$CI->config->item('encryption_key'));
   }
  
   public static function  forgot_password(){
       $CI =& get_instance();
   }
   
   public static function send_password(){
      return true;
   }
  
   
}


class module_lib extends Login_lib{
    public $CI;
    function __construct() {
        parent::__construct();
        $this->CI =& get_instance();
    }
    
    function get_all_modules(){
        if($this->CI->session->userdata('login_id')){
            $user_id = $this->CI->session->userdata('login_id');
        }
        if($this->CI->session->userdata('login_id')){
            $group_id = $this->CI->session->userdata('login_group_id');
        }
        if($this->CI->session->userdata('login_id')){
            $user_email = $this->CI->session->userdata('login_email');
        }
        
        $sql = $this->CI->db->query('select * from tbl_module where pid="0"');
        if($sql->num_rows()>0){
            $i= 0;
            foreach($sql as $field->$value){
                $data[$field] = $value;
                if($field=='mid'){
                     if($this->has_child($sql['mid'])){
                       $data['child'] = $this->get_child($sql['mid']);
                      
                     }
                }
                $record[$i] = $data;
                
                $i++;
            }
        }
        
        //get first level menu 
        //check has child 
        //if has child get childs ---repeeat 
        //check third level menu
        
    }
    
    function has_child(){
        return true;
    }
    
    function get_modules($pid=0){
        return true;
    }
}
?>
