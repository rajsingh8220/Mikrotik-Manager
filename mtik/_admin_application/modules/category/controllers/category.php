<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller {
	public $data = array();
	function __construct(){
		parent::__construct();
                $this->load->library('login_lib');
                $login = new login_lib();
                if($login->is_logged_in()==FALSE){
                redirect('login');
                }
		$this->load->model('category_model');
        $this->load->model('log/log_model');
		$this->data['submenu'] = 'category/submenu_category';
        $this->load->library('pagination');
        $this->load->model('api/api_model');
        
		//$this->setup();
	}
    
    function index(){
        $this->data['records'] = $this->category_model->get_categories();
        $this->data['title'] = "Categories";
        $this->data['template'] = 'category/categories';
        $this->load->view('common/main',$this->data);
    }
    
    function add_category(){
        $read_write = $this->session->userdata('read_write_blocked');
   	    if($read_write=='0'){
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'category/add_category_form';
            $this->load->view('common/main',$this->data);
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function new_category(){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            $this->form_validation->set_error_delimiters('<span class="error">', '</span><br/>');
            $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
            
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|xss_clean');
        
            if ($this->form_validation->run() == TRUE ){
                $data['title'] = $_POST['title'];
                $data['category_name'] = $_POST['category_name'];
                $data['description'] = $_POST['description'];
                
                
                   
                $last_id = $this->category_model->add_category($data);
                if($last_id){
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
                       
                       
                       $log['added_by'] = $added_by;
                       $log['added_on'] = $date;
                       $log['table_name'] = 'New Category Added';
                       $log['fieldname'] = 'category_name';
                       $log['field_old_value'] = 'n/a';
                       $log['field_new_value'] = $data['category_name'];
                       $log['edited_by'] = 'n/a';
                       $log['action'] = 'add';
                       $log['edited_on'] = 'n/a';
                       $log['category_name'] = 'n/a';
                       $last_log = $this->log_model->add_log_record($log);
                       // ........................................................
                    redirect('category/');  
                }
                
            }
        
        
        $this->data['title'] = "Add Categories";
        $this->data['template'] = 'category/add_category_form';
        $this->load->view('common/main',$this->data);
        }
        else{
            $this->data['title'] = "Add Categories";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function edit_category($cat_id){
        $read_write = $this->session->userdata('read_write_blocked');
        if($read_write=='0'){
            $this->data['records'] = $this->category_model->get_category($cat_id);
            $this->data['title'] = "Edit Category";
            $this->data['template'] = 'category/edit_category_form';
            $this->load->view('common/main',$this->data);
        }
        else{
            $this->data['title'] = "Not Allowed";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    function edit_category_submit(){
        $cat_id = $_POST['category_id'];
        $category_detail = $this->category_model->get_category($cat_id);
        
        $data['category_name'] = $_POST['category_name'];
        $data['title'] = $_POST['title'];
        $data['description'] = $_POST['description'];
        
                     
        if($this->db->update('category',$data,array('id'=>$cat_id))){
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
            $log['table_name'] = 'Category Edited';
            
            if($_POST['title']!=$category_detail['title']){
            $log['fieldname'] = 'title';
            $log['field_old_value'] = $category_detail['title'];
            $log['field_new_value'] = $data['title'];
            $log['added_by'] = 'n/a';
            $log['device_name'] = 'n/a';
            $log['added_on'] = 'n/a';
            $log['action'] = 'edit';
            $log['edited_by'] = $this->session->userdata('login_name');
            $log['edited_on'] = $date;
            $log['category_name'] = $category_detail['title'];
            $last_log = $this->log_model->add_log_record($log);
            } 
            if($_POST['description']!=$category_detail['description']){
            $log['fieldname'] = 'description';
            $log['field_old_value'] = $category_detail['description'];
            $log['field_new_value'] = $data['description'];
            $log['added_by'] = 'n/a';
            $log['added_on'] = 'n/a';
            $log['action'] = 'edit';
            $log['device_name'] = 'n/a';
            $log['edited_by'] = $this->session->userdata('login_name');
            $log['edited_on'] = $date;
            $log['category_name'] = $category_detail['title'];
            $last_log = $this->log_model->add_log_record($log);
            }  
            
            
            redirect('category/');
        }
    }
    
    
    
    
    
    function actions($category_id){
    
           $this->data['cat_id'] = $category_id;
           $this->data['category'] = $this->category_model->get_category($category_id);
           $this->data['total_devices'] = $this->category_model->get_count_no_of_devices_by_category($category_id);
           $this->data['devices'] = $this->category_model->get_devices_by_category_id($category_id);
           $this->data['submenu'] = 'category/submenu_actions';
           $category_title = $this->category_model->get_category($category_id);
           $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$category_title['title'].' -> <span style="color:darkgreen;">MikroTik Device List</span></span>';
           $this->data['template'] = 'category/actions';
           $this->load->view('common/main',$this->data);
        
    }
    function add_queue($category_id){
       $this->data['cat_id'] = $category_id;
        $this->data['submenu'] = 'category/submenu_actions';
       $category_title = $this->category_model->get_category($category_id);
       
       $this->data['limits'] = $this->category_model->get_limits();
       $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$category_title['title'].' -> <span style="color:darkgreen;">Add Queue</span></span>';
       $this->data['template'] = 'category/queue_add_form';
       $this->load->view('common/main',$this->data); 
    }
    
    
    public function ajax_field(){
       
        if($_POST['count']==''){
            
        }
        else{
            $this->data['count']  = $_POST['count'];
            $this->load->view('category/ajax_input_address_field',$this->data);  
        }
          
    }
    
    
    public function queue_by_cat_id($category_id){
        $this->data['cat_id'] = $category_id;
        $category_title = $this->category_model->get_category($category_id);
        $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$category_title['title'].' -> <span style="color:darkgreen;">Queues</span></span>';
       $this->data['queues'] = $this->category_model->get_queues($category_id);
       $this->data['submenu'] = 'category/submenu_actions';
       $this->data['template'] = 'category/queues';
       $this->load->view('common/main',$this->data);
    }
    public function delete_queue($queue_name,$cat_id){
        $que_detail = $this->category_model->get_queue_by_qname($queue_name);
        $get_all_queue = $this->category_model->get_queues($cat_id);
        $flag = 0;
        foreach($get_all_queue as $all){
            if($all['parent_queue_id']==$que_detail['q_id']){
                $flag = 1;
            }
        }
        if($flag==0){
           $this->data['cat_id'] = $cat_id;
            $category_title = $this->category_model->get_category($cat_id);
            $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$category_title['title'].' -> <span style="color:darkgreen;">Remove Queue -><span style="color:#DD4814;">'.$queue_name.'</span></span></span>';
           //$this->data['queues'] = $this->category_model->get_queues($category_id);
           $this->data['queue_name'] = $queue_name;
           $this->data['category_title'] = $category_title['title'];
           $this->data['submenu'] = 'category/submenu_actions';
           $this->data['template'] = 'category/delete_queue_confirmation';
           $this->load->view('common/main',$this->data); 
        }
        else{
            $this->data['cat_id'] = $cat_id;
           $this->data['title'] = 'Have Child';
           $this->data['submenu'] = 'category/submenu_actions';
           $this->data['template'] = 'category/queue_have_child';
           $this->load->view('common/main',$this->data);  
        }
        
    }
    
    public function delete_queue_yes($cat_id, $queue_name){
        $adjusted_max_upload = '0';
        $adjusted_max_download = '0';
        $current_queue_detail = $this->category_model->get_queue_by_qname($queue_name);
        $current_parent_detail = $this->category_model->get_queue_by_qid($current_queue_detail['parent_queue_id']);
        
        $queue_operation = $this->session->userdata('allow_queue_add');
        if($queue_operation=='0'){
        $cat_detail = $this->category_model->get_category($cat_id);
        $devices = $this->category_model->get_devices_by_category_id($cat_id);
           foreach($devices as $dev){
            //echo $dev['ip_addr'];
                if($dev['block_status']=='0'){
                if ($this->api_model->connect($dev['ip_addr'], $dev['username'], $dev['password'])) {
                    
                     //$ARRAY = $this->api_model->comm("/queue/simple/remove/2");
                     $ARRAY = $this->api_model->comm('/queue/simple/remove', array('numbers' => $queue_name));
                     //print_r($ARRAY);
                      if($ARRAY!=null){
                            //$this->data['record'] = $ARRAY;
                           $error[] = array(
                            'error_code' => '1',
                            'msg' => '<span class="error">Error:</span>',
                            'msg_detail' => '<span class="error">Error in Supplied Parameters!</span>',
                            'result'=>$ARRAY	
                        );
                            //$this->session->set_flashdata( 'msg','Error in array supplied'); 
                      }
                      if($ARRAY==null){
                         //$this->data['record'] = $ARRAY;
                         $error[] = array(
                            'error_code' => '0',
                            'msg' => '<span>Success:</span>',
                            'msg_detail' => '<span >The Queue <strong>"'.$queue_name.'"</strong> Deleted Successfully from:<strong>'.$dev['ip_addr'].'</strong></span>',
                            'result'=>$ARRAY	
                        );
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        //................................................................................................
                         $id_l = $this->category_model->delete_queue_by_queue_name($queue_name);
                         //$id_l = '1';
                         if($id_l){
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
                                $log['added_by'] ='n/a';
                               $log['added_on'] = 'n/a';
                               $log['action'] = 'delete';
                               $log['table_name'] = 'Queue is Deleted';
                               $log['fieldname'] = 'queue_name';
                               $log['field_old_value'] = $queue_name;
                               $log['field_new_value'] = 'Queue is deleted';
                               $log['edited_by'] =  $this->session->userdata('login_name');
                               $log['edited_on'] = $date;
                               $log['category_name'] = $cat_detail['title'];
                               $log['device_name'] = $dev['ip_addr'];
                               $last_log = $this->log_model->add_log_record($log);
                               
                               //....
                               //bandwidth adjustments......................................................................
                                    
                                    //print_r($current_queue_detail);
                                    if($current_queue_detail['parent_queue_id']=='0'||$current_queue_detail['parent_queue_id']==''){
                                        
                                    }
                                    else{
                                        
                                            if($current_parent_detail[0]['parent_queue_id']=='0'||$current_parent_detail[0]['parent_queue_id']==''){
                                                $all_child = $this->category_model->get_queue_by_parent_id($current_parent_detail[0]['q_id']);
                                                //print_r($all_child);
                                                if($all_child!=null){
                                                foreach($all_child as $child){
                                                    $findme_up_k   = 'k';
                                                    //$findme_up_m  = 'M';
                                                    $pos_up_k = strpos($child['rx_max_limit'], $findme_up_k);
                                                    if ($pos_up_k !== false) {
                                                        $int_upload = filter_var($child['rx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                                    } 
                                                    else{
                                                        $int_upload = filter_var($child['rx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                                        $int_upload = $int_upload*1024;
                                                    }
                                                    
                                                    
                                                   
                                                    $pos_down_k = strpos($child['tx_max_limit'], $findme_up_k);
                                                    if ($pos_down_k !== false) {
                                                        $int_download = filter_var($child['tx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                                    } 
                                                    else{
                                                        $int_download = filter_var($child['tx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                                        $int_download = $int_download*1024;
                                                    }
                                                    
                                                    
                                                    $adjusted_max_upload = $adjusted_max_upload+$int_upload;
                                                    $adjusted_max_download = $adjusted_max_download+$int_download;
                                                }
                                                     $adjustments['rx_max_limit'] = $adjusted_max_upload.'k';
                                                     $adjustments['tx_max_limit'] = $adjusted_max_download.'k';
                                                    $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                                                      "numbers"     => $current_parent_detail[0]['name'],
                                                      //"target-addresses"     => $ips,
                                                      "max-limit"=>$adjusted_max_upload."k/".$adjusted_max_download."k",
                                                          //"parent"=>$parent_name,
                                                     )); 
                                                    if($ARRAY!=null){
                                                
                                                    }
                                                    else{
                                             
                                                        $id_edit = $this->category_model->edit_queue($current_parent_detail[0]['name'],$adjustments);
                                                    }
                                                }
                                                else{
                                                    $adjusted_max_upload = 1;
                                                    $adjusted_max_download = 1;
                                                    $adjustments['rx_max_limit'] = $adjusted_max_upload.'k';
                                                     $adjustments['tx_max_limit'] = $adjusted_max_download.'k';
                                                    $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                                                      "numbers"     => $current_parent_detail[0]['name'],
                                                      //"target-addresses"     => $ips,
                                                      "max-limit"=>$adjusted_max_upload."k/".$adjusted_max_download."k",
                                                          //"parent"=>$parent_name,
                                                     )); 
                                                    if($ARRAY!=null){
                                                
                                                    }
                                                    else{
                                             
                                                        $id_edit = $this->category_model->edit_queue($current_parent_detail[0]['name'],$adjustments);
                                                    }
                                                }
                                                
                                         }  
                                    }
                                    
                         }
                      }
                    
                  }
                  else{
                      $error[] = array(
                            'error_code' => '1',
                            'msg' => '<span class="error">Error:</span>',
                            'msg_detail' => '<span class="error">Error in Connection! Unable to connect: <strong>'.$dev['ip_addr'].'</strong></span>',	
                            'result'=>'Connection Fail!'
                        );
                      
                      //$this->session->set_flashdata( 'msg','Error!!');
                  }
                  }// end of first if
            }
            
            //redirect('operation/');
            $this->data['error'] = $error;
            //$this->data['total_ips'] = $total_ips;
            //$this->data['upload_limit'] = $somedata['rx_max_limit'];
            //$this->data['download_limit'] = $somedata['tx_max_limit'];
            $this->data['queue_name'] = $queue_name;
            //$this->data['ips'] = $ips;
            //$this->data['cat_id'] = $somedata['cat_id'];
            //$this->data['parent'] = $somedata['parent_queue_id'];
            //$this->data['all_ips'] = $exp;
            $this->data['cat_id'] = $cat_id;
             $this->data['submenu'] = 'category/submenu_actions';
            $this->data['title'] = "Deleted Success";
            $this->data['template'] = 'operation/queue_deleted_successfully';
            $this->load->view('common/main',$this->data); 
            //$this->load->view('operation/queue_added_successfully',$this->data);
        }
        else{
            $this->data['title'] = "Not Allowed";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data); 
        }
     
    }
    
    
    
    public function delete_queue_no($cat_id){
        redirect('category/queue_by_cat_id/'.$cat_id);
        
    }
    public function tree_view($category_id){
        $this->data['cat_id'] = $category_id;
        $category_title = $this->category_model->get_category($category_id);
        $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$category_title['title'].' -> <span style="color:darkgreen;">Tree View</span></span>';
       $this->data['queues'] = $this->category_model->get_queues($category_id);
       $this->data['submenu'] = 'category/submenu_actions';
       $this->data['template'] = 'category/tree_view';
       $this->load->view('common/main',$this->data);
    }
    public function edit_queue($q_name, $cat_id){
        $queue_edit = $this->session->userdata('allow_queue_edit');
        if($queue_edit=='0'){
            $this->data['cat_id'] = $cat_id;
            $this->data['submenu'] = 'category/submenu_actions';
            $category_title = $this->category_model->get_category($cat_id);
            $this->data['queue_detail'] = $this->category_model->get_queue_by_qname($q_name);
            $this->data['queues'] = $this->category_model->get_queues($cat_id);
            
            $this->data['limits'] = $this->category_model->get_limits();
            //print_r($this->data['limits']);
            $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$category_title['title'].' -> <span style="color:darkgreen;">Edit Queue</span></span>';
            $this->data['template'] = 'category/queue_edit_form';
            $this->load->view('common/main',$this->data); 
        }
        else{
            $this->data['title'] = "Not Allowed";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }

    }
    public function admin_edit_queue($q_name, $cat_id){
        //$queue_edit = $this->session->userdata('allow_queue_edit');
        //$read_write = $this->session->userdata('read_write_block_status');
        $queue_edit = $this->session->userdata('allow_queue_edit');
         $read_write = $this->session->userdata('read_write_block_status');
        $queue_operation = $this->session->userdata('allow_queue_add');

        if($queue_operation=='0'&&$read_write=='0'&&$queue_edit=='0'){
            $this->data['cat_id'] = $cat_id;
            $this->data['submenu'] = 'category/submenu_actions';
            $category_title = $this->category_model->get_category($cat_id);
            $this->data['queue_detail'] = $this->category_model->get_queue_by_qname($q_name);
            $this->data['queues'] = $this->category_model->get_queues($cat_id);
            
            $this->data['limits'] = $this->category_model->get_limits();
            //print_r($this->data['limits']);
            $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$category_title['title'].' -> <span style="color:darkgreen;">Edit Queue</span></span>';
            $this->data['template'] = 'category/queue_total_edit_form';
            $this->load->view('common/main',$this->data); 
        }
        else{
            $this->data['title'] = "Not Allowed";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }

    }
    public function admin_edit_queue_head($q_name, $cat_id){
        $queue_edit = $this->session->userdata('allow_queue_edit');
         $read_write = $this->session->userdata('read_write_block_status');
        $queue_operation = $this->session->userdata('allow_queue_add');

        if($queue_operation=='0'&&$read_write=='0'&&$queue_edit=='0'){
            $this->data['cat_id'] = $cat_id;
            $this->data['submenu'] = 'category/submenu_actions';
            $category_title = $this->category_model->get_category($cat_id);
            $this->data['queue_detail'] = $this->category_model->get_queue_by_qname($q_name);
            $this->data['queues'] = $this->category_model->get_queues($cat_id);
            
            $this->data['limits'] = $this->category_model->get_limits();
            //print_r($this->data['limits']);
            $this->data['title'] = 'Actions: <span style="color:#0080C0;">'.$category_title['title'].' -> <span style="color:darkgreen;">Edit Queue</span></span>';
            $this->data['template'] = 'category/queue_total_edit_form_for_head';
            $this->load->view('common/main',$this->data); 
        }
        else{
            $this->data['title'] = "Not Allowed";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);  
        }
    }
    
    public function edit_queue_operation(){
        //$q_name = $_POST['name'];
            $cat_id = $_POST['cat_id'];
            $parent = $_POST['parent'];
            //echo $parent;
            $queue_name = $_POST['name'];
            $download_limit = $_POST['download_limit'];
            $upload_limit = $_POST['upload_limit'];
            $old_queue = $this->category_model->get_queue_by_qname($queue_name);
            $somedata['tx_max_limit'] = $download_limit;
            $somedata['rx_max_limit'] = $upload_limit;
            //echo $cat_id;
            //echo "<br>".$queue_name;
            //echo "<br>".$download_limit;
            $old_upload_limit = $old_queue['rx_max_limit'];
            $old_download_limit = $old_queue['tx_max_limit'];
            //echo "<br>".$upload_limit;
            $cat_detail = $this->category_model->get_category($cat_id);
            $devices = $this->category_model->get_devices_by_category_id($cat_id);
           foreach($devices as $dev){
            //echo $dev['ip_addr'];
            
            
            if($dev['block_status']=='0'){
                if ($this->api_model->connect($dev['ip_addr'], $dev['username'], $dev['password'])) {
                    
                       $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                          "numbers"     => $queue_name,
                          //"target-addresses"     => $ips,
                          "max-limit"=>$upload_limit."/".$download_limit,
                          //"parent"=>$parent_name,
                     )); 
                    
                    //print_r($ARRAY);
                    // for result and error message .............................................. 
                      if($ARRAY!=null){
                            $this->data['record'] = $ARRAY;
                           $error[] = array(
                            'error_code' => '1',
                            'msg' => '<span class="error">Error:</span>',
                            'msg_detail' => '<span class="error">Error in Supplied Parameters!</span>',
                            'result'=>$ARRAY	
                        );
                            //$this->session->set_flashdata( 'msg','Error in array supplied'); 
                      }
                      else{
                         $this->data['record'] = $ARRAY;
                         $error[] = array(
                            'error_code' => '0',
                            'msg' => '<span>Success:</span>',
                            'msg_detail' => '<span >Edited Successfully <br>Queue Name: '.$queue_name.'</span>',
                            'result'=>$ARRAY	
                        );
                        
                        
                        
                        
                        if($old_queue['parent_queue_id']=='0'&&$parent=='0'){
                            
                        }
                        else{
                        //if($old_queue['parent_queue_id']!='0'){
                        $parent_to_add_volume = $this->category_model->get_queue_by_qid($old_queue['parent_queue_id']);
                        //echo $parent_to_add_volume['parent_queue_id'];
                        if($parent_to_add_volume[0]['parent_queue_id']=='0'||$parent_to_add_volume[0]['parent_queue_id']==''){
                        $findme_up_k   = 'k';
                                //$findme_up_m  = 'M';
                                $pos_up_k = strpos($old_upload_limit, $findme_up_k);
                                if ($pos_up_k !== false) {
                                    $int_old_upload = filter_var($old_upload_limit, FILTER_SANITIZE_NUMBER_INT);
                                } 
                                else{
                                    $int_old_upload = filter_var($old_upload_limit, FILTER_SANITIZE_NUMBER_INT);
                                    $int_old_upload = $int_old_upload*1024;
                                }
                                
                                
                               
                                $pos_down_k = strpos($old_download_limit, $findme_up_k);
                                if ($pos_down_k !== false) {
                                    $int_old_download = filter_var($old_download_limit, FILTER_SANITIZE_NUMBER_INT);
                                } 
                                else{
                                    $int_old_download = filter_var($old_download_limit, FILTER_SANITIZE_NUMBER_INT);
                                    $int_old_download = $int_old_download*1024;
                                }
                                
                                
                                
                                
                                $pos_parent_up_k = strpos($parent_to_add_volume[0]['rx_max_limit'], $findme_up_k);
                                if ($pos_parent_up_k !== false) {
                                    $int_parent_upload = filter_var($parent_to_add_volume[0]['rx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                } 
                                else{
                                    $int_parent_upload = filter_var($parent_to_add_volume[0]['rx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                    $int_parent_upload = $int_parent_upload*1024;
                                }
                                
                                
                               
                                $pos_parent_down_k = strpos($parent_to_add_volume[0]['tx_max_limit'], $findme_up_k);
                                if ($pos_parent_down_k !== false) {
                                    $int_parent_download = filter_var($parent_to_add_volume[0]['tx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                } 
                                else{
                                    $int_parent_download = filter_var($parent_to_add_volume[0]['tx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                    $int_parent_download = $int_parent_download*1024;
                                }
                                
                                $new_parent_upload = $int_parent_upload-$int_old_upload;
                                $new_parent_download = $int_parent_download-$int_old_download;
                                
                                $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                                      "numbers"     => $parent_to_add_volume[0]['name'],
                                      //"target-addresses"     => $ips,
                                      "max-limit"=>$new_parent_upload."k/".$new_parent_download."k",
                                      //"parent"=>$parent_name,
                                 )); 
                                 $adjustments['rx_max_limit'] = $new_parent_upload.'k';
                                 $adjustments['tx_max_limit'] = $new_parent_download.'k';
                                 if($ARRAY!=null){
                            
                                }
                                else{
                         
                                    $first_update = $this->category_model->edit_queue($parent_to_add_volume[0]['name'],$adjustments);
                                }
                                 
                                 
                                 
                                 
                                 $pos_current_up_k = strpos($upload_limit, $findme_up_k);
                                if ($pos_current_up_k !== false) {
                                    $int_current_upload = filter_var($upload_limit, FILTER_SANITIZE_NUMBER_INT);
                                } 
                                else{
                                    $int_current_upload = filter_var($upload_limit, FILTER_SANITIZE_NUMBER_INT);
                                    $int_current_upload = $int_current_upload*1024;
                                }
                                
                                
                               
                                $pos_current_down_k = strpos($download_limit, $findme_up_k);
                                if ($pos_current_down_k !== false) {
                                    $int_current_download = filter_var($download_limit, FILTER_SANITIZE_NUMBER_INT);
                                } 
                                else{
                                    $int_current_download = filter_var($download_limit, FILTER_SANITIZE_NUMBER_INT);
                                    $int_current_download = $int_current_download*1024;
                                }
                                $final_upload = $new_parent_upload+$int_current_upload;
                                $final_download = $new_parent_download+$int_current_download;
                                
                                $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                                      "numbers"     => $parent_to_add_volume[0]['name'],
                                      //"target-addresses"     => $ips,
                                      "max-limit"=>$final_upload."k/".$final_download."k",
                                      //"parent"=>$parent_name,
                                 ));
                                 $adjustments1['rx_max_limit'] = $final_upload.'k';
                                 $adjustments1['tx_max_limit'] = $final_download.'k'; 
                               if($ARRAY!=null){
                            
                                }
                                else{
                         
                                    $second_update = $this->category_model->edit_queue($parent_to_add_volume[0]['name'],$adjustments1);
                                } 
                        }
                        
                        }
                        
                        
                        
                        
                        
                        
                         $id_l = $this->category_model->edit_queue($queue_name,$somedata);
                         if($id_l){
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
                                $log['added_by'] = 'n/a';
                               $log['added_on'] = 'n/a';
                               $log['table_name'] = 'Queues is Edited';
                               $log['action'] = 'edit';
                               $log['fieldname'] = 'tx/rx';
                               $log['field_old_value'] = $old_queue['tx_max_limit'].'/'.$old_queue['rx_max_limit'];
                               $log['field_new_value'] = $download_limit.'/'.$upload_limit;
                               $log['edited_by'] = $this->session->userdata('login_name');
                               $log['edited_on'] = $date;
                               $log['category_name'] = $cat_detail['title'];

                               $last_log = $this->log_model->add_log_record($log);
                         }
                      }
                    
                  }
                  else{
                      $error[] = array(
                            'error_code' => '1',
                            'msg' => '<span class="error">Error:</span>',
                            'msg_detail' => '<span class="error">Error in Connection! Unable to connect: <strong>'.$dev['ip_addr'].'</strong></span>',	
                           'result'=>'Connection Fail!'
                        );
                      
                      $this->session->set_flashdata( 'msg','Error!!');
                  }
                  $this->data['cat_id'] = $cat_id;
                  $this->data['error'] = $error;     
                    $this->data['title'] = "Edit Queue";
                     $this->data['submenu'] = 'category/submenu_actions';
                    $this->data['template'] = 'category/queue_edited_successfully';
                    $this->load->view('common/main',$this->data);
                  }
            
            
    }


	
}
    function delete_category($cat_id){
        $category_detail = $this->category_model->get_category($cat_id);
        $read_write = $this->session->userdata('read_write_blocked');
         if($read_write=='0'){
        $this->data['count_device'] = $this->category_model->get_count_no_of_devices_by_category($cat_id);
        $this->data['category_detail'] = $category_detail;
        $this->data['title'] = 'Delete Category Confirmation';
        $this->data['template'] = 'category/delete_category_confirmation';
        $this->data['submenu'] = 'category/submenu_category';
        $this->load->view('common/main',$this->data);
        }
        else{
            $this->data['title'] = "Not Allowed";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data);
        }
    }
    function delete_category_yes($cat_id){
        $category_detail = $this->category_model->get_category($cat_id);
         $read_write = $this->session->userdata('read_write_blocked');
         //echo $read_write;
        if($read_write=='0'){
        if($this->db->delete('category',array('id'=>$cat_id))){
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
            $log['added_by'] = 'n/a';
                               $log['added_on'] = 'n/a';
                               $log['table_name'] = 'Category is Deleted';
                               $log['action'] = 'delete';
                               $log['fieldname'] = 'Category';
                               $log['field_old_value'] = $category_detail['title'];
                               $log['field_new_value'] = 'Deleted';
                               $log['edited_by'] = $this->session->userdata('login_name');
                               $log['edited_on'] = $date;
                               $log['category_name'] = $category_detail['title'];
                               $log['device_name'] = 'n/a';
                               $last_log = $this->log_model->add_log_record($log);
                               redirect('category/');
        }
        }
        else{
            $this->data['title'] = "Not Allowed";
            $this->data['template'] = 'admin/not_allowed';
            $this->load->view('common/main',$this->data); 
        }
        
    }
    function delete_category_no(){
        redirect('category/');
    }
    function admin_edit_queue_operation(){
        $previouse_total_ip_count = $_POST['previouse_total_count'];
        $previouse_total_ips = $_POST['previouse_ips'];
        $cat_id = $_POST['cat_id'];
        $queue_id = $_POST['queue_id'];
        $parent = $_POST['parent'];
        //echo $parent;
        $queue_old_record = $this->category_model->get_queue_by_qid($queue_id);
        $old_parent = '';
        if($queue_old_record[0]['parent_queue_id']=='0'||$queue_old_record[0]['parent_queue_id']==''){
            $old_parent = '0';
        }
        else{
            $old_parent_detail = $this->category_model->get_queue_by_qid($queue_old_record[0]['parent_queue_id']);
            $old_parent = $old_parent_detail[0]['name'];
        }
        
        //print_r($queue_old_record[0]);
        $new_q_name = $_POST['name'];
        $new_upload_limit = $_POST['upload_limit'];
        $new_download_limit = $_POST['download_limit'];
        $prv_ip = $_POST['1'];
        if($previouse_total_ip_count=='1'){
            $prv_ip = $_POST['1'];
        }
        else{
            for($j=2; $j<=$previouse_total_ip_count; $j++){
                $prv_ip = $prv_ip.",".$_POST[$j];
            }
        }
        //ips.....
        $new_count = $_POST['new_count'];
        //echo "<br>".$new_count;
        $new_ips = $prv_ip;
        //echo $new_count;
        if($previouse_total_ip_count==$new_count){
            
        }
        else{
            for($i=$previouse_total_ip_count+1; $i<=$new_count; $i++){
                if(isset($_POST[$i])){
                    if($_POST[$i]==''){
                        
                    }
                    else{
                        $new_ips = $new_ips.",".$_POST[$i];
                    }
                }
                
            }
        }
        
        //echo $new_q_name;
        
        $this->data['error'] = $new_ips;
        $this->data['parent'] = $parent;
        //echo $parent;
        $parent_final_id = '';
        if($parent=='0'||$parent==''){
            $parent_final_id = '';
        }
        else{
           $parent_detail = $this->category_model->get_queue_by_qname($parent); 
           $parent_final_id = $parent_detail['q_id'];
        }
        
        //echo $parent;
        $this->data['name'] = $new_q_name;
        $this->data['upload_limit'] = $new_upload_limit;
        $this->data['download_limit'] = $new_download_limit;
        $this->data['cat_id'] = $cat_id;
        
        $data['name'] = $new_q_name;
        //$data['rx_max_limit'] = $new_upload_limit;
        //$data['tx_max_limit'] = $new_download_limit;
        //$data['tx_max_limit'] = $new_download_limit;
        $data['parent_queue_id'] = $parent_final_id;
        //echo $parent_final_id; //.............................................. Selected Parent ID
        $data['target_address'] = $new_ips;
        $category_detail = $this->category_model->get_category($cat_id);
        $devices = $this->category_model->get_devices_by_category_id($cat_id);
        //echo $parent;
         foreach($devices as $dev){
        if($dev['block_status']=='0'){
                if ($this->api_model->connect($dev['ip_addr'], $dev['username'], $dev['password'])) {
                    if($parent=='0'&&$old_parent=='0'){
                        //echo '1';
                        $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                              "numbers"     => $queue_old_record[0]['name'],
                              "name"     => $new_q_name,
                              'target'=>$new_ips,
                              "parent" =>'none',
                              //"max-limit"=>$new_upload_limit."/".$new_download_limit,
                              //"parent"=>$parent_name,
                         )); 
                         if($ARRAY!=null){
                            $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                              "numbers"     => $queue_old_record[0]['name'],
                              "name"     => $new_q_name,
                              'target-address' =>$new_ips,
                              "parent" =>'none',
                              //"max-limit"=>$new_upload_limit."/".$new_download_limit,
                              //"parent"=>$parent_name,
                         )); 
                        }
                        $childs = $this->category_model->get_queue_by_parent_id($queue_id);
                        if($childs==null){
                            //echo '1';
                            $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                                  "numbers"     => $queue_old_record[0]['name'],
                                  "name"     => $new_q_name,
                                  'target'=>$new_ips,
                                  "parent" =>'none',
                                  "max-limit"=>$new_upload_limit."/".$new_download_limit,
                                  //"parent"=>$parent_name,
                             )); 
                             if($ARRAY!=null){
                                $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                                  "numbers"     => $queue_old_record[0]['name'],
                                  "name"     => $new_q_name,
                                  'target-address' =>$new_ips,
                                  "parent" =>'none',
                                  "max-limit"=>$new_upload_limit."/".$new_download_limit,
                                  //"parent"=>$parent_name,
                             )); 
                            }
                            $data['name'] = $new_q_name;
                            //$data['parent_queue_id'] = $parent_final_id;
                            $data['target_address'] = $new_ips;
                            $data['rx_max_limit']=$new_upload_limit;
                            $data['tx_max_limit']=$new_download_limit;
                        }
                        $data['name'] = $new_q_name;
                        //$data['parent_queue_id'] = $parent_final_id;
                        $data['target_address'] = $new_ips;
                    }
                    else if($parent!='0'&&$old_parent=='0'){
                        
                        //echo '2';
                        $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                              "numbers"     => $queue_old_record[0]['name'],
                              "name"     => $new_q_name,
                              'target'=>$new_ips,
                              "parent" =>$parent,
                              "max-limit"=>$new_upload_limit."/".$new_download_limit,
                              //"parent"=>$parent_name,
                         )); 
                         if($ARRAY!=null){
                            $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                              "numbers"     => $queue_old_record[0]['name'],
                              "name"     => $new_q_name,
                              'target-address' =>$new_ips,
                              "parent" =>$parent,
                              "max-limit"=>$new_upload_limit."/".$new_download_limit,
                              //"parent"=>$parent_name,
                         )); 
                        }
                        $data['name'] = $new_q_name;
                        $data['parent_queue_id'] = $parent_final_id;
                        $data['target_address'] = $new_ips;
                        $data['rx_max_limit']=$new_upload_limit;
                        $data['tx_max_limit']=$new_download_limit;
                        
                        
                        
                    }
                    else if($parent=='0'&&$old_parent!='0'){
                        //echo '3';
                        $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                              "numbers"     => $queue_old_record[0]['name'],
                              "name"     => $new_q_name,
                              'target'=>$new_ips,
                              "parent" =>'none',
                              "max-limit"=>$new_upload_limit."/".$new_download_limit,
                              //"parent"=>$parent_name,
                         )); 
                         if($ARRAY!=null){
                            $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                              "numbers"     => $queue_old_record[0]['name'],
                              "name"     => $new_q_name,
                              'target-address' =>$new_ips,
                              "parent" =>'none',
                              "max-limit"=>$new_upload_limit."/".$new_download_limit,
                              //"parent"=>$parent_name,
                         )); 
                        }
                        $data['name'] = $new_q_name;
                        //$data['parent_queue_id'] = $parent_final_id;
                        $data['target_address'] = $new_ips;
                        $data['rx_max_limit']=$new_upload_limit;
                        $data['tx_max_limit']=$new_download_limit;
                    }
                    else{
                        //echo '4';
                        $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                              "numbers"     => $queue_old_record[0]['name'],
                              "name"     => $new_q_name,
                              'target'=>$new_ips,
                              "parent" =>$parent,
                              "max-limit"=>$new_upload_limit."/".$new_download_limit,
                              //"parent"=>$parent_name,
                         )); 
                         if($ARRAY!=null){
                            $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                              "numbers"     => $queue_old_record[0]['name'],
                              "name"     => $new_q_name,
                              'target-address' =>$new_ips,
                              "parent" =>$parent,
                              "max-limit"=>$new_upload_limit."/".$new_download_limit,
                              //"parent"=>$parent_name,
                         )); 
                        }
                        $data['name'] = $new_q_name;
                        $data['parent_queue_id'] = $parent_final_id;
                        $data['target_address'] = $new_ips;
                        $data['rx_max_limit']=$new_upload_limit;
                        $data['tx_max_limit']=$new_download_limit;
                    }
                    
                    //print_r($ARRAY);
                    // for result and error message .............................................. 
                      if($ARRAY!=null){
                            $this->data['record'] = $ARRAY;
                           $error[] = array(
                            'error_code' => '1',
                            'msg' => '<span class="error">Error:</span>',
                            'msg_detail' => '<span class="error">Error in Supplied Parameters!</span>',
                            'result'=>$ARRAY	
                        );
                            //$this->session->set_flashdata( 'msg','Error in array supplied'); 
                      }
                      else{
                         $this->data['record'] = $ARRAY;
                         $error[] = array(
                            'error_code' => '0',
                            'msg' => '<span>Success:</span>',
                            'msg_detail' => '<span >Edited Successfully <br>Queue Name: '.$queue_old_record[0]['name'].'</span>',
                            'result'=>$ARRAY	
                        );
                        //echo 'sdsad'.$parent_final_id;
                        //bandwidth modification process.........................................
                        //adjustments........................................................................
                        //echo "Current Parent:".$parent;
                        //echo '<br>Old Parent:'.$old_parent;
                        //echo "<br>Device IP:".$dev['ip_addr'];
                        
                        
                        
                        
                        
                        
                        //END OF Adjustments..................................................................
                        
                        
                         $id_l = $this->category_model->edit_queue_by_id($queue_id,$data);
                         if($id_l){
                                $this->adjustments_done($parent,$old_parent,$dev['ip_addr'], $dev['username'], $dev['password']);
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
                                if($queue_old_record[0]['tx_max_limit']!=$new_download_limit&&$queue_old_record[0]['rx_max_limit']!=$new_upload_limit){
                                    $log['added_by'] = 'n/a';
                                   $log['added_on'] = 'n/a';
                                   $log['table_name'] = 'Queues is Edited';
                                   $log['action'] = 'edit';
                                   $log['affected_queue'] = $queue_old_record[0]['name'];
                                   $log['fieldname'] = 'tx/rx';
                                   $log['device_name'] = $dev['ip_addr'];
                                   $log['field_old_value'] = $queue_old_record[0]['tx_max_limit'].'/'.$queue_old_record[0]['rx_max_limit'];
                                   $log['field_new_value'] = $new_download_limit.'/'.$new_upload_limit;
                                   $log['edited_by'] = $this->session->userdata('login_name');
                                   $log['edited_on'] = $date;
                                   $log['category_name'] = $category_detail['title'];
    
                                   $last_log = $this->log_model->add_log_record($log);
                                }
                               if($new_q_name!=$queue_old_record[0]['name']){
                                    $log1['added_by'] = 'n/a';
                                   $log1['added_on'] = 'n/a';
                                   $log1['table_name'] = 'Queues is Edited';
                                   $log1['action'] = 'edit';
                                   $log1['fieldname'] = 'Queue Name';
                                   $log1['device_name'] = $dev['ip_addr'];
                                   $log1['affected_queue'] = $queue_old_record[0]['name'];
                                   $log1['field_old_value'] = $queue_old_record[0]['name'];
                                   $log1['field_new_value'] = $new_q_name;
                                   $log1['edited_by'] = $this->session->userdata('login_name');
                                   $log1['edited_on'] = $date;
                                   $log1['category_name'] = $category_detail['title'];
                                   $last_log = $this->log_model->add_log_record($log1);
                               }
                               //echo $old_parent;
                               if($old_parent!=$parent){
                                if($parent=='0'||$parent==''){
                                    $parent = 'No Parent';
                                }
                                if($old_parent=='0'){
                                    $p = 'No Parent';
                                }
                                else{
                                    $p = $old_parent;
                                }
                                     $log2['added_by'] = 'n/a';
                                   $log2['added_on'] = 'n/a';
                                   $log2['table_name'] = 'Queues is Edited';
                                   $log2['action'] = 'edit';
                                   $log2['fieldname'] = 'parent';
                                   $log2['device_name'] = $dev['ip_addr'];
                                   $log2['field_old_value'] = $p;
                                   $log2['affected_queue'] = $queue_old_record[0]['name'];
                                   $log2['field_new_value'] = $parent;
                                   $log2['edited_by'] = $this->session->userdata('login_name');
                                   $log2['edited_on'] = $date;
                                   $log2['category_name'] = $category_detail['title'];
                                   $last_log = $this->log_model->add_log_record($log2);
                               }
                               //echo $prv_ip;
                               //echo "<br>".$new_ips;
                               if($prv_ip!=$new_ips){
                                    $log3['added_by'] = 'n/a';
                                   $log3['added_on'] = 'n/a';
                                   $log3['table_name'] = 'Target address Edited';
                                   $log3['action'] = 'edit';
                                   $log3['fieldname'] = 'Target_address';
                                   $log3['device_name'] = $dev['ip_addr'];
                                   $log3['field_old_value'] = $prv_ip;
                                   $log3['affected_queue'] = $queue_old_record[0]['name'];
                                   $log3['field_new_value'] = $new_ips;
                                   $log3['edited_by'] = $this->session->userdata('login_name');
                                   $log3['edited_on'] = $date;
                                   $log3['category_name'] = $category_detail['title'];
                                   $last_log = $this->log_model->add_log_record($log3);
                               }
                         }
                      }
                    
                  }
                  else{
                      $error[] = array(
                            'error_code' => '1',
                            'msg' => '<span class="error">Error:</span>',
                            'msg_detail' => '<span class="error">Error in Connection! Unable to connect: <strong>'.$dev['ip_addr'].'</strong></span>',	
                           'result'=>'Connection Fail!'
                        );
                      
                      $this->session->set_flashdata( 'msg','Error!!');
                  }
            }
            }
        $this->data['error'] = $error;
        $this->data['title']='Edit Queue';
        $this->data['submenu'] = 'category/submenu_actions';
        
        $this->data['template'] = 'category/total_edit_queue_success';
        $this->load->view('common/main',$this->data);
       
       
    }
    function admin_edit_queue_operation_for_head(){
        
    }
    function delete_ip_of_queue($queue_id,$target_ip,$cat_id){
        $queue_detail = $this->category_model->get_queue_by_qid($queue_id);
        //echo $queue_detail[0]['target_address'];
        //echo "<br>".$target_ip;
        $category_detail = $this->category_model->get_category($cat_id);
        $new_ips = array();
        $count_old = 0;
        
        $exp = explode(',',$queue_detail[0]['target_address']);
        foreach($exp as $ip){
            $count_old = $count_old+1;
            if($ip==$target_ip){
                
            }
            else{
                $new_ips[] = $ip;
            }
        }
        //echo "<br>Old count:".$count_old;
        if($count_old=='1'){
            $error[] = array(
                        'error_code' => '1',
                        'msg' => '<span class="error">Error:</span>',
                        'msg_detail' => '<span class="error">Be sure that tagrget Addresses is more than one!</span>',
                        'result'=>"First Add a <strong>new</strong> target address to delete, queue <strong>having only one target address</strong> cannot be edited target address"	
                    );
        }
        else{
        $count_new = 1;
        $new_list = $new_ips[0];
        for($i=1; $i<$count_old-1; $i++){
            $count_new = $count_new+1;
            $new_list = $new_list.",".$new_ips[$i];
        }
        //echo "<br>New Count:".$count_new;
        //print_r($new_ips);
        //$data['']
        // NEW LIST OF IP TO ENTER OR SET..................................................
        //echo "<br>".$new_list;
        
        $devices = $this->category_model->get_devices_by_category_id($cat_id);
        foreach($devices as $dev){
            if ($this->api_model->connect($dev['ip_addr'], $dev['username'], $dev['password'])) {        
               $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                  "numbers"     => $queue_detail[0]['name'],
                  //"target-addresses"     => $ips,
                  "target"=>$new_list,
                  //"parent"=>$parent_name,
             )); 
                if($ARRAY==null){
                    $this->data['record'] = $ARRAY;
                     $error[] = array(
                        'error_code' => '0',
                        'msg' => '<span>Success:</span>',
                        'msg_detail' => '<span >Target Address Deleted Successfully <br>Target Address: '.$target_ip.'<br>New Target Addresses: '.$new_list.'</span>',
                        'result'=>$ARRAY	
                    );
                    $l = $this->db->update('queues',array('target_address'=>$new_list),array('q_id'=>$queue_id));
                    if($l){
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
                                $log['added_by'] = 'n/a';
                               $log['added_on'] = 'n/a';
                               $log['table_name'] = 'Target Address is removed';
                               $log['action'] = 'delete';
                               $log['fieldname'] = 'target_address';
                               $log['field_old_value'] = $target_ip;
                               $log['field_new_value'] = 'Deleted';
                               $log['edited_by'] = $this->session->userdata('login_name');
                               $log['edited_on'] = $date;
                               $log['category_name'] = $category_detail['title'];
                               $log['device_name'] = $dev['ip_addr'];
                               $log['affected_queue'] = $queue_detail[0]['name'];
                               $last_log = $this->log_model->add_log_record($log);
                    }
                }
                else{
                    $this->data['record'] = $ARRAY;
                       $error[] = array(
                        'error_code' => '1',
                        'msg' => '<span class="error">Error:</span>',
                        'msg_detail' => '<span class="error">Error in Supplied Parameters!</span>',
                        'result'=>$ARRAY	
                    );
                }
            }
            else{
              $error[] = array(
                    'error_code' => '1',
                    'msg' => '<span class="error">Error:</span>',
                    'msg_detail' => '<span class="error">Error in Connection! Unable to connect: <strong>'.$dev['ip_addr'].'</strong></span>',	
                   'result'=>'Connection Fail!'
                );
              
              $this->session->set_flashdata( 'msg','Error!!');
          }
           
        }
        }
        $this->data['template'] = 'category/target_address_edited_successfully';
        $this->data['error'] = $error;
        $this->data['title'] = 'Edit Target Target Address';
        $this->data['cat_id'] = $cat_id;
        $this->data['submenu'] = 'category/submenu_actions';
        $this->data['redirect_url'] = base_url().'category/admin_edit_queue/'.$queue_detail[0]['name'].'/'.$cat_id;
        $this->load->view('common/main',$this->data);
        //redirect('category/admin_edit_queue/'.$queue_detail[0]['name'].'/'.$cat_id);
    }
    function ajax_edit_inputs(){
        $this->data['new_count'] = $_POST['new_count'];
        $this->load->view('category/ajax_edit_inputs',$this->data);
    }
    function check_device_connection(){
        $device = $_POST['device'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        //$result = '';
        if ($this->api_model->connect($device, $username, $password)) {
            $result = $device." is connected --> <a class='detail' style='cursor:pointer;' id='".$device."'>Detail</a>";
            ?>
            
            <script type="text/javascript">
	             $('.detail').click(function(){
	               var device = $(this).attr('id');
                   //alert(device);
                    $.ajax({
            	           type:'POST',
                           url:'<?php echo base_url(); ?>category/show_device_detail/<?php echo $username; ?>/<?php echo $password; ?>',
                           data:'device='+device,
                           success:function(msg){
                                $('#device_detail').show();
                                $('#detail_results').html(msg)
                           },
                           beforeSend:function(a){
                                //$('#result_con').html('Please Wait...');
                           }
            	      }); 
                   
                });  
                
            </script>
            <?php
        }else{
            $result = $device." Connection failed";
        }
       echo $result;
    }
    function show_device_detail($username, $password=null){
        $device = $_POST['device'];
        if ($this->api_model->connect($device, $username, $password)) {  
                $name = $this->api_model->comm("/system/identity/print");
               $ARRAY = $this->api_model->comm("/system/routerboard/print");
               $ARRAY1 = $this->api_model->comm("/system/health/print");
        }
        echo "<b style:'color:#0080C0'><u>".$name[0]['name'].'</u></b>';
        echo "<br>Device:<b>".$device."</b>";
        echo '<br>Routerboard: '.$ARRAY[0]['routerboard'];
        echo '<br>Model: '.$ARRAY[0]['model'];
        echo "<br>Current Firmware: ".$ARRAY[0]['current-firmware'];
        echo "<br>";
        //print_r($ARRAY1[0]);
        
        
    }
    
    function schedule_bandwidth($queue_name,$cat_id){
        $schedule_detail_for_this = $this->category_model->get_schedule_by_queue_name($queue_name);
        if($schedule_detail_for_this!=null){
            $this->data['title'] = 'Bandwidth Scheduling';
            $this->data['cat_id'] = $cat_id;
            $this->data['record'] = $schedule_detail_for_this;
            $this->data['template'] = 'category/already_scheduled';
            $this->data['submenu'] = 'category/submenu_actions';
            $this->load->view('common/main',$this->data);
        }
        else{
            $this->data['queue_detail'] = $this->category_model->get_queue_by_qname($queue_name);
            $this->data['title'] = 'Bandwidth Scheduling';
            $this->data['cat_id'] = $cat_id;
            $this->data['limits'] = $this->category_model->get_limits();
            $this->data['template'] = 'category/schedule_bandwidth';
            $this->data['submenu'] = 'category/submenu_actions';
            $this->load->view('common/main',$this->data);
        }
        
    }
    function bandwidth_scheduling_process($cat_id,$queue_id){
        $new_bandwidth_upload = $_POST['upload_limit'];
        $new_bandwidth_downoad = $_POST['download_limit'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $comment = $_POST['comment'];
        //echo $comment;
        if($new_bandwidth_upload=='Select'||$new_bandwidth_upload=='Select'){
            //redirect to bandwidth not selected
        }
        else{
            //echo "<br>";
            //print_r($current_queue_detail);
        }
        $current_queue_detail = $this->category_model->get_queue_by_qid($queue_id);
        
        $old_bandwidth_upload = $current_queue_detail[0]['rx_max_limit'];
        $old_bandwidth_download = $current_queue_detail[0]['tx_max_limit'];
        $current_parent = $current_queue_detail[0]['parent_queue_id'];
        //echo $current_parent;
       
                $devices = $this->category_model->get_devices_by_category_id($cat_id);
                //echo $parent;
                 foreach($devices as $dev){
                    if($dev['block_status']=='0'){
                        if ($this->api_model->connect($dev['ip_addr'], $dev['username'], $dev['password'])) {
                            
                                $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                                          "numbers"     => $current_queue_detail[0]['name'],
                                          //"name"     => $new_q_name,
                                          //'target'=>$new_ips,
                                          //"parent" =>'none',
                                          "max-limit"=>$new_bandwidth_upload."/".$new_bandwidth_downoad,
                                          //"parent"=>$parent_name,
                                     )); 
                                     if($ARRAY==null){
                                        $schedule['start_time'] = $start_time;
                                        $schedule['end_time'] = $end_time;
                                        $schedule['previous_upload_limit'] = $old_bandwidth_upload;
                                        $schedule['previous_download_limit'] = $old_bandwidth_download;
                                        $schedule['scheduled_upload_limit'] = $new_bandwidth_upload;
                                        $schedule['scheduled_download_limit'] = $new_bandwidth_downoad;
                                        $schedule['queue_name'] = $current_queue_detail[0]['name'];
                                        $schedule['queue_id'] = $current_queue_detail[0]['q_id'];
                                        $schedule['cat_id'] = $cat_id;
                                        $schedule['comment'] = $comment;
                                        $schedule['scheduled_by'] = $this->session->userdata('login_name');
                                        $data['rx_max_limit'] = $new_bandwidth_upload;
                                        $data['tx_max_limit'] = $new_bandwidth_downoad;
                                        $insert_id = $this->category_model->add_schedule($schedule);
                                        $edit_orginal_table = $this->category_model->edit_queue_by_id($current_queue_detail[0]['q_id'],$data);
                                        if($insert_id){
                                            if($edit_orginal_table){
                                               
                                                if($current_parent!='0'&&$current_parent!=''){
                                                    $parent_detail = $this->category_model->get_queue_by_qid($current_parent);
                                                    //print_r($parent_detail[0]['name']);
                                                    if($parent_detail[0]['parent_queue_id']=='0'||$parent_detail[0]['parent_queue_id']==''){
                                                    //ADJUST THIS CURRENT PARENT AND CURRENT PARENT NAME=$parent_detail[0]['name']
                                                    //echo $parent_detail[0]['name'];
                                                        $this->category_model->adjust($parent_detail[0]['name'],$dev['ip_addr'],$dev['username'],$dev['password']);
                                                    
                                                    }
                                                }
                                                //log operations and  management........\ 
                                                $schedule_log['start_time'] = $start_time;
                                                $schedule_log['end_time'] = $end_time;
                                                $schedule_log['previous_bandwidth'] = $old_bandwidth_upload."/".$old_bandwidth_download;
                                                $schedule_log['new_bandwidth'] = $new_bandwidth_upload."/".$new_bandwidth_downoad;
                                                $schedule_log['queue_name'] = $current_queue_detail[0]['name'];
                                                $schedule_log['cat_id'] = $cat_id;
                                                $schedule_log['status'] = 'Active';
                                                $schedule_log['schedule_id'] = $insert_id;
                                                $schedule_log['scheduled_by'] = $this->session->userdata('login_name');
                                                $log_success = $this->category_model->add_schedule_log($schedule_log);
                                                
                                            }
                                        }
                                     }
                                
                    }
                
                
                
            }
        }
        //echo '<br>New Upload:'.$new_bandwidth_upload;
        //echo '<br>New Download:'.$new_bandwidth_downoad;
        //echo '<br>old Upload:'.$old_bandwidth_upload;
        //echo '<br>old Download:'.$old_bandwidth_download;
        
        $this->data['title'] = 'Bandwidth Scheduling';
        $this->data['cat_id'] = $cat_id;
        //$this->data['limits'] = $this->category_model->get_limits();
        $this->data['template'] = 'category/schedule_bandwidth_success';
        $this->data['submenu'] = 'category/submenu_actions';
        $this->load->view('common/main',$this->data);
    }
    
    
    
    function adjustments_done($current_parent, $old_parent,$device_ip,$device_username, $device_password){
        //echo "<br>Current Parent:".$current_parent;
        //echo '<br>Old Parent:'.$old_parent;
        //echo "<br>Device IP:".$device_ip;
        
        if($current_parent=='0'&&$old_parent=='0'){
            //No Adjustments.......................
        }
        else if($current_parent!='0'&&$old_parent=='0'){
            //Adjust current parent only
            $p_detail = $this->category_model->get_queue_by_qname($current_parent);
            if($p_detail['parent_queue_id']=='0'||$p_detail['parent_queue_id']==''){
                $this->category_model->adjust($current_parent,$device_ip,$device_username, $device_password);
            }
            
        }
        else if($current_parent=='0'&&$old_parent!='0'){
            //Adjust old parent only
            $p_detail = $this->category_model->get_queue_by_qname($old_parent);
            if($p_detail['parent_queue_id']=='0'||$p_detail['parent_queue_id']==''){
                $this->category_model->adjust($old_parent,$device_ip,$device_username, $device_password);
            }
        }
        else if($current_parent!='0'&&$old_parent!='0'){
            if($current_parent==$old_parent){
                // Adjust only current Parent
                $p_detail = $this->category_model->get_queue_by_qname($current_parent);
                if($p_detail['parent_queue_id']=='0'||$p_detail['parent_queue_id']==''){
                    $this->category_model->adjust($current_parent,$device_ip,$device_username, $device_password);
                }
            }
            else{
                //adjust current parent 
                // adjust old parent
                $p_detail_c = $this->category_model->get_queue_by_qname($current_parent);
                if($p_detail_c['parent_queue_id']=='0'||$p_detail_c['parent_queue_id']==''){
                    $this->category_model->adjust($current_parent,$device_ip,$device_username, $device_password);
                }
                $p_detail_c = $this->category_model->get_queue_by_qname($old_parent);
                if($p_detail_c['parent_queue_id']=='0'||$p_detail_c['parent_queue_id']==''){
                    $this->category_model->adjust($old_parent,$device_ip,$device_username, $device_password);
                }
            }
        }
        else{
            //no adjustments............
        }
    }
    
    
    
}
/* End of file news.php */
/* Location: ./application/controllers/news.php */