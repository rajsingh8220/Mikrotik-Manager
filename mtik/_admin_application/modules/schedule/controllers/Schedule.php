<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends MX_Controller {
	public $data = array();
    
	function __construct(){
		parent::__construct();
        $this->load->model('schedule_model');
        $this->load->model('log/log_model');
        $this->load->model('category/category_model');
		//$this->data['submenu'] = 'category/submenu_category';
        //$this->load->library('pagination');
        $this->load->model('api/api_model');        
		
	}
    function revert_back(){
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
           $date = date('Y-m-d')." ".$time;

        echo $date;
        $schedules = $this->schedule_model->get_schedules();
        //print_r($schedules);
        foreach($schedules as $scheduled_queue){
            $queue_id = $scheduled_queue['queue_id'];
            $queue_detail = $this->category_model->get_queue_by_qid($queue_id);
            $previous_upload = $scheduled_queue['previous_upload_limit'];
            $previous_download = $scheduled_queue['previous_download_limit'];
            $queue_name = $scheduled_queue['queue_name'];
            if(strtotime($date)>=strtotime($scheduled_queue['end_time'])){
                echo '<br>'.$scheduled_queue['end_time'];
                
                $devices_to_edit_in = $this->category_model->get_devices_by_category_id($scheduled_queue['cat_id']);
                foreach($devices_to_edit_in as $dev){
                    if($dev['block_status']=='0'){
                        if ($this->api_model->connect($dev['ip_addr'], $dev['username'], $dev['password'])) {
                            
                                $ARRAY = $this->api_model->comm("/queue/simple/set", array(
                                          "numbers"     =>$queue_name,
                                          //"name"     => $new_q_name,
                                          //'target'=>$new_ips,
                                          //"parent" =>'none',
                                          "max-limit"=>$previous_upload."/".$previous_download,
                                          //"parent"=>$parent_name,
                                     )); 
                                     if($ARRAY==null){
                                        $data['rx_max_limit'] = $previous_upload;
                                        $data['tx_max_limit'] = $previous_download;
                                        $edit_orginal_table = $this->category_model->edit_queue_by_id($queue_id,$data);
                                        if($edit_orginal_table){
                                            
                                            
                                            if($queue_detail[0]['parent_queue_id']!='0'||$queue_detail[0]['parent_queue_id']!=''){
                                                $parent_detail = $this->category_model->get_queue_by_qid($queue_detail[0]['parent_queue_id']);
                                                if($parent_detail[0]['parent_queue_id']=='0'||$queue_detail[0]['parent_queue_id']==''){
                                                    $this->category_model->adjust($parent_detail[0]['name'],$dev['ip_addr'], $dev['username'], $dev['password']);
                                                }
                                            }
                                            //manage log remaining
                                            //log operations and  management........\ 
                                                //$schedule_log['start_time'] = $start_time;
                                                //$schedule_log['end_time'] = $end_time;
                                                //$schedule_log['previous_bandwidth'] = $old_bandwidth_upload."/".$old_bandwidth_download;
                                                //$schedule_log['new_bandwidth'] = $new_bandwidth_upload."/".$new_bandwidth_downoad;
                                                //$schedule_log['queue_name'] = $current_queue_detail[0]['name'];
                                                //$schedule_log['cat_id'] = $cat_id;
                                                $schedule_log['status'] = 'Reverted';
                                                //$schedule_log['scheduled_by'] = $this->session->userdata('login_name');
                                                $log_success = $this->category_model->edit_schedule_log($scheduled_queue['id'],$schedule_log);
                                            
                                        }
                                     }
                            }
                    
                    }  
                }
                $deleted_schedule = $this->schedule_model->delete_schedule($scheduled_queue['id']);
           } 
           
        }
        
    }
    
 }
 