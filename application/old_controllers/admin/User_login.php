<?php 
class User_login extends CI_Controller{

	function __construct()
	 {
	 	
	 	parent::__construct(); 
	 	
	 	$this->load->model('admin_model/User_model','user');
	 	$this->role='role_master';
	 }

	 public function index()
	{
		if($this->session->userdata('employee_id') != null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}
		$this->load->view('admin/login');
	}
	public function login()
	{
		$employee_email_id = $this->input->post('employee_email_id');
		$password = $this->input->post('employee_password');
		$result = $this->user->get_user($employee_email_id,$password);

		if($result != NULL)
		{
			$permissions_result=$this->basic_mol->get_single_data(array('role_id'	=> $result['employee_roll']),$this->role);
			
			if($permissions_result)
			{
				$alloted_permissions=(array)json_decode($permissions_result['permissions']);
				$result['course_tab_permission']=json_decode($alloted_permissions['course_permissions']);
				$result['attribute_tab_permissions']=json_decode($alloted_permissions['attribute_permissions']);
				$result['student_tab_permissions']=json_decode($alloted_permissions['student_permissions']);
				$result['coupan_tab_permissions']=json_decode($alloted_permissions['coupan_permissions']);
			}
			
			$this->session->set_userdata($result);

			echo 1;
		}
		else
		{
			echo 2;
		}		
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/User_login');
	}

}

?>