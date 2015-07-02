<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terminal extends MX_Controller {
	public $data = array();
	function __construct(){
		parent::__construct();
                $this->load->library('login_lib');
                $login = new login_lib();
                if($login->is_logged_in()==FALSE){
                redirect('login');
                }
                if(!$this->session->userdata('mikro_ip')){
                    redirect('error/');
                }
		//$this->load->model('home/home_model');
		$this->data['submenu'] = 'terminal/terminal_submenu';
                //$this->load->library('pagination');
                $this->load->model('api/api_model');
		//$this->setup();
	}
    function index(){
            $this->data['title'] = 'Terminal';
            $this->data['ip'] = $this->session->userdata('mikro_ip');
            $this->data['musername'] = $this->session->userdata('mikro_username');
            $this->data['mpassword'] = $this->session->userdata('mikro_passsword');
            
            $this->data['template'] = 'terminal/terminal';
         $this->load->view('common/main',$this->data);  
    }
    function log(){
        $this->data['title'] = 'Log';
            $this->data['ip'] = $this->session->userdata('mikro_ip');
            $this->data['musername'] = $this->session->userdata('mikro_username');
            $this->data['mpassword'] = $this->session->userdata('mikro_passsword');
            
            if ($this->api_model->connect($this->data['ip'], $this->data['musername'], $this->data['mpassword'])) {
            
               $this->api_model->write('/log/print');
            
               $READ = $this->api_model->read(false);
               $ARRAY = $this->api_model->parse_response($READ);
               $this->data['record'] = $ARRAY;
               $this->data['msg'] = 'Success!!';
            }
            else{
                $this->data['msg'] = 'Connection Failure!!';
                $this->data['record'] = '';
            }
            
            $this->data['template'] = 'terminal/log';
         $this->load->view('common/main',$this->data);
    }
    function command_execute(){
        $comm = $_POST['command'];
        $this->data['ip'] = $this->session->userdata('mikro_ip');
            $this->data['musername'] = $this->session->userdata('mikro_username');
            $this->data['mpassword'] = $this->session->userdata('mikro_passsword');
            
            if ($this->api_model->connect($this->data['ip'], $this->data['musername'], $this->data['mpassword'])) {
            
               $this->api_model->write($comm);
            
               $READ = $this->api_model->read(false);
               $ARRAY = $this->api_model->parse_response($READ);
               foreach($ARRAY as $a){
                    print_r($a)."<br>";
               }
            }
            else{
                echo "Error";
            }
    }
	
    
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */