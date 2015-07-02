<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log extends MX_Controller {
	public $data = array();
	function __construct(){
		parent::__construct();
                $this->load->library('login_lib');
                $login = new login_lib();
                if($login->is_logged_in()==FALSE){
                redirect('login');
                }
		$this->load->model('log_model');
		$this->data['submenu'] = 'log/submenu_log';
                $this->load->library('pagination');
		//$this->setup();
	}
    
    function index(){
        $this->data['records'] = $this->log_model->get_log();
        
        $this->data['add_log'] = $this->log_model->get_log_by_action('add');
        $this->data['edit_log'] = $this->log_model->get_log_by_action('edit');
        $this->data['delete_log'] = $this->log_model->get_log_by_action('delete');
        
        $this->data['title'] = "Logs";
        $this->data['template'] = 'log/logs';
        $this->load->view('common/main',$this->data);
    }
    function find_log_form(){
        //$this->data['records'] = $this->log_model->get_log();
        $this->data['title'] = "Logs: <span style='color:#0080C0;'>Find Logs</span>";
        $this->data['template'] = 'log/find_logs_form';
        $this->load->view('common/main',$this->data);
    }
    function find_logs(){
        $data['category_name'] = $_POST['category_name'];
        $data['username'] = $_POST['username'];
        $data['edited_date'] = $_POST['edited_date'];
        $data['from_date'] = $_POST['from_date'];
        $data['to_date'] = $_POST['to_date'];
        
        
        $results = $this->log_model->search_log($data);
        $this->data['records'] =$results;
        //$this->data['num_results'] = $results['num_rows'];
        
        //$this->data['records'] = $this->log_model->search_log($data);
        $this->data['title'] = "Logs: <span style='color:#0080C0;'>Find Logs</span>";
        $this->data['template'] = 'log/log_results';
        $this->load->view('common/main',$this->data);
    }
    
    function new_entries_log($action){
        $this->data['records'] = $this->log_model->get_log_by_action($action);
        $this->data['title'] = "Logs: <span style='color:#0080C0;'>New Entries made by users</span>";
        $this->data['template'] = 'log/additions';
        $this->load->view('common/main',$this->data);
    }
    function updates_log($action){
        $this->data['records'] = $this->log_model->get_log_by_action($action);
        $this->data['title'] = "Logs: <span style='color:#0080C0;'>Updates</span>";
        $this->data['template'] = 'log/updates';
        $this->load->view('common/main',$this->data);
    }
    function removals_logs($action){
       $this->data['records'] = $this->log_model->get_log_by_action($action);
        $this->data['title'] = "Logs: <span style='color:#0080C0;'>Deletions and removals</span>";
        $this->data['template'] = 'log/deletions';
        $this->load->view('common/main',$this->data); 
    }
    function detail($log_id){
        $this->data['title'] = "Log Title";
        $this->data['records'] = $this->log_model->get_log_by_log_id($log_id);
        $this->data['template'] = 'log/detail';
        $this->load->view('common/main', $this->data);
    }
    function schedules(){
        //$schedules = 
        //print_r($schedules);
        $this->data['title'] = "Scheduling Logs";
        $this->data['records'] = $this->log_model->get_all_schedule_log();
        $this->data['template'] = 'log/schedule_log';
        $this->load->view('common/main', $this->data);
    }
    
    
	
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */