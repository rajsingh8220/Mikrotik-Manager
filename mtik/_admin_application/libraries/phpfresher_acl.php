<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Access Control List Library for module management , User Management and Privlilage Management
 * 
 */

class Phpfresher_acl{
    var $perms = array();		//Array : Stores the permissions for the user
	var $user_id;			//Integer : Stores the ID of the current user
	var $user_roles = array();	//Array : Stores the roles of the current user
    var $modules = array();	//Array : Stores the roles of the current user
	var $ci;

    function __construct($config=array()) {
		$this->ci = &get_instance();
        self::conifgure();
	}
    
    public static  configure(){
       $sql = "CREATE TABLE IF NOT EXISTS `tbl_module` (
                `mid` int(10) NOT NULL auto_increment,
                `m_name` varchar(50) NOT NULL,
                `m_controller` varchar(50) NOT NULL,
                `m_method` varchar(50) NOT NULL,
                `m_status` int(2) NOT NULL,
                `m_order` int(10) NOT NULL,
                `m_pid` int(10) NOT NULL,
                    PRIMARY KEY  (`mid`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1'" ;
       $sql = "CREATE TABLE IF NOT EXISTS `tbl_permission` (
                `pr_id` int(10) NOT NULL auto_increment,
                `gid` int(10) NOT NULL,
                `uid` int(10) NOT NULL,
                `perview` int(2) NOT NULL,
                `peredit` int(2) NOT NULL,
                `peradd` int(2) NOT NULL,
                `perdel` int(2) NOT NULL,
                `mid` int(10) NOT NULL,
                `perstatus` int(2) NOT NULL,
                 PRIMARY KEY  (`pr_id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=170 ;
                ";

    }
    
    function login_check($username,$password){
        return true;
    }
    
    function get_user_permission($user_id,$username){
        
    }
    
    function get_user_modules($user_id,$username){
        
    }
    
    function logout(){
        
    }
    
    function has_privilage(){
        
    }
    
    function login_attempt($username,$password,$ip){
        
    }
    
    function has_role(){
        
    }
    
    function has_permission(){
        
    }
    
    
}
?>
