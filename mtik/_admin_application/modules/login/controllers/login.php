<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
    var $table_name = 'ag_login';
    var $data = array();
	public function __construct() {
        parent::__construct();
        $this->load->library('login_lib');
        //$this->load->library('module_lib');
        //$this->load->library('login_lib');
        //$data = module_lib::get_all_modules();

    }
    
	public function index()
	{
		$this->load->view('login');
	}
    
    public function login_user(){
        if($this->input->post('submit')){
           
            $record['username'] = $this->input->post('username');
            $record['password'] = login_lib::prepare_password($this->input->post('password'));
          
            $isvalid = login_lib::verify_user($record,$this->table_name);
            if($isvalid == TRUE){
				$username = $this->session->userdata('login_name');
				$staff_id = $this->session->userdata('login_id'); 
				$login = date("Y-m-d");
				/*$sql = mysql_query("select * from tbl_attendace where staff_id='$staff_id' and login_time like'$login%' ");
				$count = mysql_num_rows($sql);
				if($count<=0){*/
			 	 // mysql_query("insert into tbl_attendance( staff_id, username) values('$staff_id','$username')");	
				//}
			   redirect(login_lib::SUCCESSFULL_LOGIN);
            }else{
                redirect(Login_lib::UNSUCCESSFULL_LOGIN);
            }
        }
        $this->load->view('login');
    }
    
    function logout(){
        $logout = date('Y-m-d h:i:s');
        $login = date("Y-m-d");
        $staff_id = $this->session->userdata('login_id'); 
        mysql_query("update tbl_attendance set logout_time='$logout' where staff_id ='$staff_id' and login_time like'$login%' ");
        login_lib::destroy_sessions('login_name');
        login_lib::destroy_sessions('login_email');
        login_lib::destroy_sessions('login_id');
        login_lib::destroy_sessions('login_type');
        redirect(Login_lib::UNSUCCESSFULL_LOGIN);
    }
    
  
    
}

/* End of file Login.php */
/* Location: ./application/controllers/login.php */