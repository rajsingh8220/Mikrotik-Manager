<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {
	public $data = array();
	function __construct(){
		parent::__construct();
                $this->load->library('login_lib');
                $login = new login_lib();
                if($login->is_logged_in()==FALSE){
                redirect('login');
                }
		$this->load->model('home_model');
        $this->load->model('category/category_model');
        $this->load->model('log/log_model');
	//	$this->data['submenu'] = 'category/submenu_actions';
                $this->load->library('pagination');
                $this->data['categories'] = $this->category_model->get_categories();
		//$this->setup();
	}

	public function devices()
	{  
	       $this->data['records'] = $this->home_model->get_devices();
        $this->data['title'] = 'Devices';
         $this->data['template'] = 'home/devices';
         $this->load->view('common/main',$this->data);
	}
    public function add_device($cat_id){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            $this->data['cat_id'] = $cat_id;
            $this->data['category_detail'] = $this->category_model->get_category($cat_id);
            $cat = $this->category_model->get_category($cat_id);
            $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$cat['title'].' -> <span style="color:darkgreen;">Edit Mikrotik Device</span></span>';
            $this->data['submenu'] = 'category/submenu_actions';
            $this->data['template'] = 'home/add_device';
             $this->load->view('common/main',$this->data);
        }
        else{
            
            $this->data['title'] = 'Not Allowed';
            $this->data['submenu'] = 'admin/not_allowed_submenu';
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function validate_category($val){
        if($val=='0'){
            $this->form_validation->set_message('category_id','The password didnot match.'); 
            $this->form_validation->error('category_id','Member is not valid!');
            return false;
            
        }
        else{
            return true;
        }
    }
    public function add_device_info(){
        $cat_detail = $this->category_model->get_category($_POST['category_id']);
        $this->form_validation->set_error_delimiters('<span class="error">', '</span><br/>');
        $this->form_validation->set_rules('ip_address', 'IP Address', 'required|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
        //$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
        $this->form_validation->set_rules('category_id', 'Category', "callback_validate_category");    
        if ($this->form_validation->run() == TRUE ){
               $somedata['ip_addr'] = $_POST['ip_address'];
                $somedata['username'] = $_POST['username'];
                $somedata['password'] = $_POST['password'];
                 $somedata['category_id'] = $_POST['category_id'];
                $d_id = $this->home_model->add_device($somedata);
                if($d_id){
                    //..........................................................
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
                       $added_by = $this->session->userdata('login_name');
                       
                       
                       $log['added_by'] = $this->session->userdata('login_name');
                       $log['added_on'] = $date;
                       $log['table_name'] = 'New Device Added';
                       $log['fieldname'] = 'ip_addr';
                       $log['field_old_value'] = 'n/a';
                       $log['field_new_value'] = $somedata['ip_addr'];
                       $log['edited_by'] = 'n/a';
                       $log['action'] = 'add';
                       $log['edited_on'] = 'n/a';
                       $log['category_name'] = $cat_detail['category_name'];
                       $last_log = $this->log_model->add_log_record($log);
                       // ........................................................
                    redirect('category/actions/'.$somedata['category_id']);
                } 
        }
        $this->data['cat_id'] = $cat_detail['id'];
        $this->data['category_detail'] = $this->category_model->get_category($_POST['category_id']);
        $this->data['title'] = 'Add Device';
        $this->data['submenu'] = 'category/submenu_actions';
        $this->data['template'] = 'home/add_device';
        $this->load->view('common/main',$this->data);
        
    }
    
    function edit_device($id){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            $this->data['record'] = $this->home_model->get_device_by_id($id);
            $this->data['title'] = 'Edit Device Info';
            $this->data['template'] = 'home/edit_device';
             $this->load->view('common/main',$this->data);
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function edit_device_detail($id){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            $this->data['record'] = $this->home_model->get_device_by_id($id);
            $d = $this->home_model->get_device_by_id($id);
            $cat = $this->category_model->get_category($d['category_id']);
            $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$cat['title'].' -> <span style="color:darkgreen;">Edit Mikrotik Device</span></span>';
            $this->data['cat_id'] = $cat['id'];
            $this->data['submenu'] = 'category/submenu_actions';
            $this->data['template'] = 'home/edit_device_detail';
             $this->load->view('common/main',$this->data);
        }
        else{
            $this->data['title'] = 'Not Allowed';
            $this->data['submenu'] = 'admin/not_allowed_submenu';
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);    
        }
        
    }
    function edit_device_info(){
        $id = $_POST['device_id'];
        $somedata['ip_addr'] = $_POST['ip_address'];
        $somedata['username'] = $_POST['username'];
        $somedata['password'] = $_POST['password'];
         $somedata['category_id'] = $_POST['category_id'];
         if($this->db->update('devices_list',$somedata,array('id'=>$id))){
            redirect('category/actions/'.$somedata['category_id']);
         }
    }
    function edit_device_info_detail(){
        $id = $_POST['device_id'];
        $somedata['ip_addr'] = $_POST['ip_address'];
        $somedata['username'] = $_POST['username'];
        $somedata['password'] = $_POST['password'];
         $somedata['category_id'] = $_POST['category_id'];
         $d = $this->home_model->get_device_by_id($id);
         $cat_deatil = $this->category_model->get_category($somedata['category_id']);
         $device_info = $this->home_model->get_device_by_id($id);
         $log['device_name'] = $device_info['ip_addr'];
         if($this->db->update('devices_list',$somedata,array('id'=>$id))){
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
            $log['table_name'] = 'Device is Edited';
            
            if($_POST['ip_address']!=$d['ip_addr']){
            $log['fieldname'] = 'ip_addr';
            $log['field_old_value'] = $d['ip_addr'];
            $log['field_new_value'] = $somedata['ip_addr'];
            $log['added_by'] = 'n/a';
            $log['added_on'] = 'n/a';
            $log['action'] = 'edit';
            $log['edited_by'] = $this->session->userdata('login_name');
            $log['edited_on'] = $date;
            $log['category_name'] = $cat_deatil['title'];
            $last_log = $this->log_model->add_log_record($log);
            }
            if($_POST['username']!=$d['username']){
            $log['fieldname'] = 'username';
            $log['field_old_value'] = $d['username'];
            $log['field_new_value'] = $somedata['username'];
            $log['added_by'] = 'n/a';
            $log['added_on'] = 'n/a';
            $log['action'] = 'edit';
            $log['edited_by'] = $this->session->userdata('login_name');
            $log['edited_on'] = $date;
            $log['category_name'] = $cat_deatil['title'];
            $last_log = $this->log_model->add_log_record($log);
            } 
            if($_POST['password']!=$d['password']){
            $log['fieldname'] = 'password';
            $log['field_old_value'] = $d['password'];
            $log['field_new_value'] = $somedata['password'];
            $log['added_by'] = 'n/a';
            $log['added_on'] = 'n/a';
            $log['action'] = 'edit';
            $log['edited_by'] = $this->session->userdata('login_name');
            $log['edited_on'] = $date;
            $log['category_name'] = $cat_deatil['title'];
            $last_log = $this->log_model->add_log_record($log);
            }  
            redirect('category/actions/'.$somedata['category_id']);
         }
    }
    
    function device_shuffle($id, $status, $cat_id){
        $read_write = $this->session->userdata('read_write_block_status');
        if($read_write=='0'){
            if($status=='0'){
                $status = '1';
            }else{
                $status = '0';
            }
            mysql_query("update devices_list set block_status='$status' where id='$id'");
            redirect('category/actions/'.$cat_id);
        }
        else{
            $this->data['title'] = "Update Device";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function delete_device_confirmation($device_id,$cat_id){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            $this->data['device_id'] = $device_id;
            $this->data['device_detail'] = $this->home_model->get_device_by_id($device_id);
            $this->data['cat_detail'] = $this->category_model->get_category($cat_id);
            $this->data['cat_id'] = $cat_id;
             $this->data['title'] = "Delete Device";
             $this->data['submenu'] = 'category/submenu_actions';
            $this->data['template'] = 'home/delete_device_confirmation';
            $this->load->view('common/main',$this->data);  
        }
        else{
            $this->data['title'] = "Update Device";
            $this->data['cat_id'] = $cat_id;
            $this->data['submenu'] = 'category/submenu_actions';
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data); 
        }

        
    }
    function delete_device_detail($device_id,$cat_id){
        $cat_detail = $this->category_model->get_category($cat_id);
        $device = $this->home_model->get_device_by_id($device_id);
        if($this->db->delete('devices_list',array('id'=>$device_id))){
            
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
           $log['added_by'] ='n/a';
           $log['added_on'] = 'n/a';
           $log['action'] = 'delete';
           $log['table_name'] = 'Device is Deleted';
           $log['fieldname'] = '';
           $log['field_old_value'] = '';
           $log['field_new_value'] = 'Device is deleted';
           $log['edited_by'] =  $this->session->userdata('login_name');
           $log['edited_on'] = $date;
           $log['category_name'] = $cat_detail['title'];
           $log['device_name'] = $device['ip_addr'];
           $last_log = $this->log_model->add_log_record($log); 
           redirect('category/actions/'.$cat_id);
        }
        
        
    }
    
   /**
 *  function connect_device(){
 *         $this->data['records'] = $this->home_model->get_devices();
 *         $this->data['title'] = 'Devices List To Connect';
 *          $this->data['template'] = 'home/list_devices_to_connect';
 *          $this->load->view('common/main',$this->data);
 *     }
 */
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */