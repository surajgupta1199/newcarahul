<?php
class Employee_management extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}	
	 	$this->load->model('admin_model/employee_model/Employee_management_model','employee_model'); 	
		$this->current_date=date('Y-m-d H:i:s');
		$this->admin_id=$this->session->userdata('employee_id');
		$this->role='role_master';
		$this->employee='employee_master';
	 }

	  public function index()
	 {
	 	$data['roles']=$this->basic_mol->get_all_data(array('role_status' => 0),$this->role);
		$this->load->view('admin/header'); 	 	
	 	$this->load->view('admin/employee/employee_master',$data);
	 	$this->load->view('admin/footer');
	 }

	public function add_emp(){

		$data=$this->input->post();
		unset($data['employee_confirm_password']);
		$data['employee_password'] = md5($this->input->post('employee_password'));
		$data['employee_date_time'] = $this->current_date;
        $where = array(
            'employee_email_id' => $data['employee_email_id']
        );
        $dup_email = $this->basic_mol->exist_or_not($where,$this->employee);
        if($dup_email){
            $dataa['msg'] = 'email exist';
        }else{
            $result = $this->basic_mol->insert($data,$this->employee);
            $dataa['msg'] = 'error';
            if($result){
                $dataa['msg'] = 'success';
            }
        }
        echo json_encode($dataa);
	}

	 public function get_emp_all_data()
	 {
	 	$list = $this->employee_model->get_emp_datatables($this->employee);
	 	
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$status=$item->employee_status;
			$row[] = $no;			
			$row[] = $item->employee_name;			
			$row[] = $item->designation;			
			$row[] = $item->employee_phone;			
			$row[] = $item->employee_email_id;
			$row[] = $item->employee_date_time;			
			$employee_id ="'".$item->employee_id ."'";	
			$row[]=  '<button type="button" onclick="edit_employee('.$employee_id .');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
			
				
               if($status==0){
					$row[] = '<button type="button" onclick="update_status('.$employee_id.',1);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
				}
				else{
				$row[] = '<button  onclick="update_status('.$employee_id.',0);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
				}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->employee_model->count_all(),
			"recordsFiltered" => $this->employee_model->count_filtered($this->employee),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();

	 }

	 public function get_particular_emp_data()
	 {
	 	$particular_emp_data_res=$this->basic_mol->get_single_data(array('employee_id' => $this->input->post('employee_id'),),$this->employee);
	 	echo json_encode($particular_emp_data_res);
	 }
	 public function edit_emp()
	 {
	 	$data=$this->input->post();
	 	$where= array('employee_email_id' =>	$data['employee_email_id'],
	 				  'employee_id != '	=>		$data['employee_id'],
	 				 );
	 	$duplicate_result=$this->basic_mol->exist_or_not($where,$this->employee);
	 	$response_data['type']='warning';
	 	$response_data['msg']='Email Id Already Registered';
	 	if(empty($duplicate_result))
	 	{
	 		$update_emp_data=$this->basic_mol->update_table(array('employee_id' => $data['employee_id'],),$data, $this->employee);
	 		$response_data['type']='error';
	 		$response_data['msg']='Could Not Update Details! Updation failed';
	 		if($update_emp_data)
	 		{
	 			$response_data['type']='success';
	 			$response_data['msg']='Details Updated Sucessfully';
	 		}

	 	}
	 	echo json_encode($response_data);
	 }
	 public function update_emp_status()
	 {
	 	
	 	$data=array('employee_status'=>$this->input->post('employee_status'));
	 	$where=array('employee_id' => $this->input->post('employee_id'),);
	 	$result=$this->basic_mol->update_table($where,$data,$this->employee);
	 	echo $result;
	 }


}
?>
