<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bandwidth extends MX_Controller {
	public $data = array();
	function __construct(){
		parent::__construct();
                $this->load->library('login_lib');
                $login = new login_lib();
                if($login->is_logged_in()==FALSE){
                redirect('login');
                }
		//$this->load->model('category_model');
        $this->load->model('log/log_model');
        $this->load->model('bandwidth_model');
		$this->data['submenu'] = 'bandwidth/submenu_bandwidth';
        //$this->load->library('pagination');
        //$this->load->model('api/api_model');
        
		//$this->setup();
	}
    
    function index(){
        $this->data['records'] = $this->bandwidth_model->get_limits();
        $this->data['title'] = "Bandwidth Defined";
        $this->data['template'] = 'bandwidth/bandwidth';
        $this->load->view('common/main',$this->data);
    }
    function add(){
        $d['title'] = $_POST['title'];
        $d['limits'] = $_POST['bandwidth'];
        $last_id = $this->bandwidth_model->add($d);
        if($last_id){
            redirect('bandwidth/');
        }
    }
    function delete($id){
        $this->db->delete('bandwidth',array('id'=>$id));
        redirect('bandwidth/');
    }
    
    
}
/* End of file news.php */
/* Location: ./application/controllers/news.php */