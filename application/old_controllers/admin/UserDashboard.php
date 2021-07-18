<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserDashboard extends CI_Controller {  
    function __construct()
    {
        parent::__construct();       
         $this->dept_type = $this->session->dept_type;
        $this->emp_id = $this->session->id;
        $this->load->helper('date');
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Asia/Kolkata'));
        $this->current_date=$now->format('Y-m-d');

    }

    function index()
    {
        if($this->session->userdata('employee_id') == null)
        {
            redirect(base_url('admin/userDashboard'));
            return ;
        }
        // $data['clients'] = $this->bulk_master->get_client($this->dept_type, $this->emp_id);
        $data['show_js_css']='table';       
        $this->load->view('admin/header',$data);      
        $this->load->view('admin/index');
        $this->load->view('admin/footer');
    }

    public function count_task()
    {
            
            echo json_encode($data);
    }

   

}
