<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operation extends MX_Controller {
	public $data = array();
	function __construct(){
		parent::__construct();
                $this->load->library('login_lib');
                $login = new login_lib();
                if($login->is_logged_in()==FALSE){
                redirect('login');
                }
		//$this->load->model('home/home_model');
		$this->data['submenu'] = 'operation/submenu_operation';
                $this->load->library('pagination');
                $this->load->model('api/api_model');
                $this->load->model('category/category_model');
                $this->load->model('log/log_model');
		//$this->setup();
	}
    

    
    
    public function add_queue(){
        //$queue_operation = $this->session->userdata('allow_queue_add');
        //$read_write = $this->session->userdata('read_write_blocked');
        $queue_operation = $this->session->userdata('allow_queue_add');
        if($queue_operation=='0'){
        $total_ips = $_POST['count'];
        $somedata['rx_max_limit'] =  $_POST['upload_limit'];
        $somedata['tx_max_limit'] =  $_POST['download_limit'];
        $somedata['name'] = $_POST['name'];
        $somedata['multiple_ips'] = $_POST['multiple_ips'];
        $somedata['cat_id'] = $_POST['cat_id'];
        $somedata['parent_queue_id'] = $_POST['parent'];
        $ips =  $_POST['ips'];
        $somedata['target_address'] = $ips;
        //echo 'pa:'.$_POST['parent'];
        $cat_detail = $this->category_model->get_category($somedata['cat_id']);
        
        //for parent....
        $parent_name = '';
        if($somedata['parent_queue_id']=='0'){
            
        }
        else{
           $parent_detail = $this->category_model->get_queue_by_qid($somedata['parent_queue_id']); 
           if(isset($parent_detail)){
                $parent_name = $parent_detail[0]['name'];
            }
            else{
                $parent_name = '';
            }
        }
        
        $exp = explode(',',$ips);
        
        $error  = array();
        //echo 'ppppp'.$parent_name;
        //echo $total_ips;
        //echo $name;
        //$ip = $this->session->userdata('mikro_ip');
           //$mikro_username = $this->session->userdata('mikro_username');
           //$mikro_passsword = $this->session->userdata('mikro_passsword');
           //$this->api_model->debug = true;
           //echo $ips;
           //echo "<br>";
           //echo $parent_name;
           //echo "<br>";
           //echo $somedata['name'];
           //echo "<br>";
           $adjusted_max_upload = '0';
           $adjusted_max_download = '0';
           //echo $somedata['rx_max_limit']."/".$somedata['tx_max_limit'];
           $devices = $this->category_model->get_devices_by_category_id($somedata['cat_id']);
           foreach($devices as $dev){
            //echo $dev['ip_addr'];
            if($dev['block_status']=='0'){
                if ($this->api_model->connect($dev['ip_addr'], $dev['username'], $dev['password'])) {
                    if($parent_name!=''){
                        $parent_to_add_volume = $this->category_model->get_queue_by_qname($parent_name);
                        //echo $parent_to_add_volume['parent_queue_id'];
                        if($parent_to_add_volume['parent_queue_id']=='0'||$parent_to_add_volume['parent_queue_id']==''){
                            $all_child = $this->category_model->get_queue_by_parent_id($parent_to_add_volume['q_id']);
                            //print_r($all_child);
                            
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
                                
                            
                                $findme_up_k   = 'k';
                                $pos_current_up_k = strpos($somedata['rx_max_limit'], $findme_up_k);
                                if ($pos_current_up_k !== false) {
                                    $som_upload = filter_var($somedata['rx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                } 
                                else{
                                    $som_upload = filter_var($somedata['rx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                    $som_upload = $som_upload*1024;
                                }
                                
                                
                                $pos_current_down_k = strpos($somedata['tx_max_limit'], $findme_up_k);
                                if ($pos_current_down_k !== false) {
                                    $som_download = filter_var($somedata['tx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                } 
                                else{
                                    $som_download = filter_var($somedata['tx_max_limit'], FILTER_SANITIZE_NUMBER_INT);
                                    $som_download = $som_download*1024;
                                }
                                $adjusted_max_upload = $adjusted_max_upload+$som_upload;
                                $adjusted_max_download = $adjusted_max_download+$som_download;
                                $adjustments['rx_max_limit'] = $adjusted_max_upload.'k';
                                $adjustments['tx_max_limit'] = $adjusted_max_download.'k';
                                $ARRAY1 = $this->api_model->comm("/queue/simple/set", array(
                                      "numbers"     => $parent_name,
                                      //"target-addresses"     => $ips,
                                      "max-limit"=>$adjusted_max_upload."k/".$adjusted_max_download."k",
                                      //"parent"=>$parent_name,
                                 )); 
                                if($ARRAY1!=null){
                            
                                }
                                else{
                         
                                    $id_l = $this->category_model->edit_queue($parent_name,$adjustments);
                                }
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                        }
                       $ARRAY = $this->api_model->comm("/queue/simple/add", array(
                          "name"     => $somedata['name'],
                          "parent"=>$parent_name,
                          "target-addresses"     => $ips,
                          "max-limit"=>$somedata['rx_max_limit']."/".$somedata['tx_max_limit'],
                          
                        )); 
                        if(is_array($ARRAY)){
                            $ARRAY = $this->api_model->comm("/queue/simple/add", array(
                              "name"     => $somedata['name'],
                              "parent"=>$parent_name,
                              "target"     => $ips,
                              "max-limit"=>$somedata['rx_max_limit']."/".$somedata['tx_max_limit'],
                              
                            )); 
                        }
                    }
                    if($parent_name==''){
                        //echo 'not parent';
                        $ARRAY = $this->api_model->comm("/queue/simple/add", array(
                          "name"     => $somedata['name'],
                          "target-addresses"     => $ips,
                          "max-limit"=>$somedata['rx_max_limit']."/".$somedata['tx_max_limit'],
                          
                        ));
                        if(is_array($ARRAY)){
                            $ARRAY = $this->api_model->comm("/queue/simple/add", array(
                              "name"     => $somedata['name'],
                              //"parent"=>$parent_name,
                              "target"     => $ips,
                              "max-limit"=>$somedata['rx_max_limit']."/".$somedata['tx_max_limit'],
                              
                            )); 
                        }   
                    }
                    //print_r($ARRAY);
                    // for result and error message .............................................. 
                      /**

 *                         if($parent_name!=''){
 *                             //$this->data['record'] = $ARRAY;
 *                             //echo '1';
 *                             $ARRAY = $this->api_model->comm("/queue/simple/add", array(
 *                                   "name"     => $somedata['name'],
 *                                   "target"     => $ips,
 *                                   "max-limit"=>$somedata['rx_max_limit']."/".$somedata['tx_max_limit'],
 *                                   "parent"=>$parent_name,
 *                                   
 *                              ));   
 *                           }
 *                           if($parent_name==''){
 *                             //echo 'not parent';
 *                                 $ARRAY = $this->api_model->comm("/queue/simple/add", array(
 *                                   "name"     => $somedata['name'],
 *                                   //"parent"=>$parent_name,
 *                                   "target"     => $ips,
 *                                   "max-limit"=>$somedata['rx_max_limit']."/".$somedata['tx_max_limit'],
 *                                   
 *                              ));   
 *                           }
 *                             //$this->session->set_flashdata( 'msg','Error in array supplied'); 
 *                       
 */
                       if(is_array($ARRAY)){
                            $error[] = array(
                            'error_code' => '1',
                            'msg' => '<span class="error">Error:</span>',
                            'msg_detail' => '<span class="error">Error in Supplied Parameters!</span>',
                            'result'=>$ARRAY	
                            );
                        }
                      else{
                         //$this->data['record'] = $ARRAY;
                         $error[] = array(
                            'error_code' => '0',
                            'msg' => '<span>Success:</span>',
                            'msg_detail' => '<span >Added Successfully</span>',
                            'result'=>$ARRAY	
                        );
                        print_r($ARRAY);
                         if(!is_array($ARRAY)){
                            $id_l = $this->category_model->add_queue($somedata);
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
                                                $log['added_by'] = $this->session->userdata('login_name');
                                               $log['added_on'] = $date;
                                               $log['table_name'] = 'New Queue Added';
                                               $log['fieldname'] = 'queue_name';
                                               $log['field_old_value'] = 'n/a';
                                               $log['field_new_value'] = $somedata['name'];
                                               $log['edited_by'] = 'n/a';
                                               $log['action'] = 'add';
                                               $log['edited_on'] = 'n/a';
                                               $log['category_name'] = $cat_detail['title'];
                                               $log['device_name'] = $dev['ip_addr'];
                                               $last_log = $this->log_model->add_log_record($log);
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
             
            }//.....................................
            
            //redirect('operation/');
            $this->data['error'] = $error;
            $this->data['total_ips'] = $total_ips;
            $this->data['upload_limit'] = $somedata['rx_max_limit'];
            $this->data['download_limit'] = $somedata['tx_max_limit'];
            $this->data['queue_name'] = $somedata['name'];
            $this->data['ips'] = $ips;
            $this->data['cat_id'] = $somedata['cat_id'];
            $this->data['parent'] = $somedata['parent_queue_id'];
            $this->data['all_ips'] = $exp;
            
            $this->load->view('operation/queue_added_successfully',$this->data);
        }
        else{
            $this->load->view('admin/not_allowed'); 
        }
        
    }
    
    
    public function tree_view(){
        $this->data['title'] = "Queue Tree View";
        $this->data['template'] = 'operation/queue_tree_view';
        $this->load->view('common/main',$this->data);
    }
    public function check_ips(){
        $ip = $_POST['ip'];
        $cat_id = $_POST['cat_id'];
        $flag = '0';
        $queues = $this->category_model->get_queues($cat_id);
        foreach($queues as $q){
            if($q['multiple_ips']=='0'){
                if($q['target_address']==$ip){
                    $flag = '1';
                    break;
                }
                else{
                    
                }
            }
            else if($q['multiple_ips']=='1'){
                $exp = explode(',',$q['target_address']);
                foreach($exp as $e){
                    if($e==$ip){
                    $flag = '1';
                    break;
                    }
                    else{
                        
                    }
                }
            }
        }
        
        if($flag=='1'){
            echo '1'; // for already Exist
        }
        else{
            echo '0'; // for new one
        }
    }
    public function check_name(){
        $name = $_POST['name'];
        $cat_id = $_POST['cat_id'];
        $flag = '0';
        $queues = $this->category_model->get_queues($cat_id);
        foreach($queues as $q){
            
                if($q['name']==$name){
                    $flag = '1';
                    break;
                }
                else{
                    
                }
           
        }
        //print_r($queues);
        //compare every queue in $queue......................................
        
        
        //to do....
        
        
        
        //...............................................................
        if($flag=='1'){
            echo '1'; // for already Exist
        }
        else{
            echo '0'; // for new one
        }
    }
    
    
   
    
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */