<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	public $data = array();
	function __construct(){
		parent::__construct();
                $this->load->library('login_lib');
                $login = new login_lib();
                if($login->is_logged_in()==FALSE){
                redirect('login');
                }
		$this->load->model('admin_model');
        $this->load->model('log/log_model');
		$this->data['submenu'] = 'admin/submenu_admin';
                $this->load->library('pagination');
    }

    //public function index()
//	{
//        $this->data['admin_users'] = $this->admin_model->get_all_admin_users();
//		$this->data['template'] = 'admin/admin';
//		$this->load->view('common/main',$this->data);
//	}
    public function index($sort_by = 'username', $sort_order = 'asc', $offset = 0)
	{
         $this->data['fields'] = array(
			'user_id' => '#',
			'username' => 'username',
            'blocked' => 'Web Login',
            'read_write' => ' Allow all Updates Except Queue',
            'allow_queue_add' => ' Allow Queue Operations',
            'allow_queue_edit' => ' Allow Bandwidth Update'
            
           
		);
                $data = array();
                $config = array();
	        $config["base_url"] = base_url() . "admin/index/{$sort_by}/{$sort_order}";
	        $config["total_rows"] = $this->admin_model->get_all_admin_users($data,TRUE);
	        $config["per_page"] = 10;
	        $config["uri_segment"] = 5;	 
                $config['full_tag_open'] = '<p id="pagination">';
		$config['full_tag_close'] = '</p>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
	        $this->pagination->initialize($config);	 
                
	        $data['start'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;;
                $data['limit'] =  $config["per_page"];
                $data['sort_by'] = $sort_by;
                $data['sort_order'] = $sort_order;
                $this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
        
                $this->data["links"] = $this->pagination->create_links();
                $this->data['title'] = "All Users";
                $this->data['template'] = 'admin/admin';
		$this->data['records']= $this->admin_model->get_all_admin_users($data,FALSE);
		$this->load->view('common/main',$this->data);
	}
	public function add_admin()
	{
	   $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
	       $this->data['title'] = "Add User";
    		$this->data['template'] = 'admin/add_admin';
    		$this->load->view('common/main',$this->data);
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
	}
    
    public function add(){
        if($this->input->post('submit')){
                $this->form_validation->set_error_delimiters('<span class="error">', '</span><br/>');
                $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[ag_login.username]');
                $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
                //$this->form_validation->set_rules('recovery_email', 'Recovery Email','trim|required|xss_clean|valid_email|is_unique[ag_login.recovery_email]');
                $this->form_validation->set_rules('re_password', 'Re Password','required');
			
             if ($this->form_validation->run() == TRUE ){
        			$some_data['username'] = $this->input->post('username');
        			$some_data['password'] = login_lib::prepare_password($this->input->post('password'));
        			$some_data['recovery_email'] = 'sss';
        			$insert_id = $this->admin_model->new_admin($some_data);
        			if(isset($insert_id)){
        			                 date_default_timezone_set('GMT');
                                        $hour =date('h')+5; 
                                        $minut = date('i')+45;
                                        if($minut==60){
                                        $hour=$hour+1;
                                        $minut =0;
                                        }
                                        else if($minut>60){
                                        $hour=$hour+1;
                                        $minut =$minut-60;
                                        }
                                        if($hour==24){
                                        $hour = 0;
                                        }
                                        else if($hour>=24){
                                        $hour = $hour-24;
                                        }
                                        $second = date('s');
                                        $time = $hour.":".$minut.":".$second;
                                        $date = date('y-m-d')." ".$time;
                                     $log['fieldname'] = 'username';
                                     $log['table_name'] = 'New User Added';
                                    $log['field_old_value'] = 'n/a';
                                    $log['field_new_value'] = 'Username:'.$some_data['username'].' <br>Password:'.$this->input->post('password');
                                    $log['added_by'] = $this->session->userdata('login_name');
                                    $log['added_on'] = $date;
                                    $log['action'] = 'add';
                                    $log['device_name'] = 'n/a';
                                    $log['edited_by'] = 'n/a';
                                    $log['edited_on'] = 'n/a';
                                    $log['category_name'] = 'n/a';
                                    $last_log = $this->log_model->add_log_record($log);
                                   $this->session->set_flashdata('message', 'Data successfully Added !');
        			   redirect('admin/');
        			}
                }         
            }   
            $this->data['title'] = "Add User";    
		$this->data['template'] = 'admin/add_admin';
        $this->data['username'] = $this->input->post('username');
        $this->data['password'] = $this->input->post('password');
		$this->data['recovery_email'] = $this->input->post('recovery_email');
		$this->load->view('common/main',$this->data);
    }
    public function edit($user_id){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
        if($this->input->post('edit_submit')){
                $this->form_validation->set_error_delimiters('<span class="error">', '</span><br/>');
                $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
                $this->form_validation->set_rules('new_password', 'password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('recovery_email', 'Recovery Email','trim|required|xss_clean|valid_email');
                $this->form_validation->set_rules('re_password', 'Re Password','required');
			
             if ($this->form_validation->run() == TRUE ){
        			$some_data['username'] = $this->input->post('username');
        			$some_data['password'] = login_lib::prepare_password($this->input->post('new_password'));
        			$some_data['recovery_email'] = $this->input->post('recovery_email');
        			$insert_id = $this->admin_model->update_admin($some_data,$user_id);
        			if(isset($insert_id)){
                                   $this->session->set_flashdata('message', 'Data successfully Added !');
        			   redirect('admin/');
        			}
                }         
            } 
            $this->data['title'] = "Edit User";
        $this->data['record'] = $this->admin_model->get_admin_user($user_id);      
		$this->data['template'] = 'admin/edit_admin';
        $this->data['password'] = $this->input->post('new_password');
		$this->load->view('common/main',$this->data);
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    
    function delete($admins, $return_url){
            foreach ($admins as $admin) {
                    $this->admin_model->delete_admin($admin);
                    //print_r('h'.$a[0]['username']);
            }
            redirect($return_url);
            return TRUE;
	}
    
    function get_delete_data(){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
        	  $records = ($this->input->post('ids'));
        	  //$this->delete($records,'vacancy/');
              if($records){
        	  $this->delete($records,'admin/');
              }
        	  else{
                    redirect('admin/');
                }
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
	  
	}
    
    
    public function edit_admin($user_id)
	{
	   $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
	       $this->data['title'] = "Edit User";
    	  $this->data['record'] = $this->admin_model->get_admin_user($user_id);
    		$this->data['template'] = 'admin/edit_admin';
    		$this->load->view('common/main',$this->data); 
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function shuffle($id, $status){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            if($status=='0'){
                $status = '1';
            }else{
                $status = '0';
            }
            mysql_query("update ag_login set blocked='$status' where user_id='$id'");
            redirect('admin/');
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function shuffle_read_write($id, $status){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            if($status=='0'){
                $status = '1';
            }else{
                $status = '0';
            }
            mysql_query("update ag_login set read_write_blocked='$status' where user_id='$id'");
            redirect('admin/');
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function shuffle_queue($id, $status){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            if($status=='0'){
                $status = '1';
            }else{
                $status = '0';
            }
            mysql_query("update ag_login set allow_queue_add='$status' where user_id='$id'");
            redirect('admin/');
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function not_allowed(){
        $this->data['title'] = "Not Allowed";
        $this->data['submenu'] = 'admin/not_allowed_submenu';
		$this->data['template'] = 'admin/not_allowed';
		$this->load->view('common/main',$this->data); 
    }
    
    function shuffle_queue_edit($id, $status){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            if($status=='0'){
                $status = '1';
            }else{
                $status = '0';
            }
            mysql_query("update ag_login set allow_queue_edit='$status' where user_id='$id'");
            redirect('admin/');
        }
        else{
            $this->data['title'] = "Edit Queue";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    
	
}
