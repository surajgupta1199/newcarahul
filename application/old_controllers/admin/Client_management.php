<?php
class Client_management extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}	
	 	$this->load->model('admin_model/Client_management_model','client_model'); 	
		$this->current_date=date('Y-m-d H:i:s');
		$this->admin_id=$this->session->userdata('admin_id');
		$this->tbl_course_type_value="course_type_value_master";
		$this->student='student_master';
	 }

	  public function index()
	 {
	 	# code...
		$this->load->view('admin/header'); 	 	
	 	$this->load->view('admin/client/client_master');
	 	$this->load->view('admin/footer');
	 }

	public function add_client(){

		$data=$this->input->post();
		unset($data['student_confirm_password']);
		$data['student_password'] = md5($this->input->post('student_password'));
		$data['user_role']=2;
        $where = array(
            'student_email' => $data['student_email']
        );
        $dup_email = $this->basic_mol->exist_or_not($where,$this->student);
        if($dup_email){
            $dataa['msg'] = 'email exist';
        }else{
            $result = $this->basic_mol->insert($data,$this->student);
            $dataa['msg'] = 'error';
            if($result){
                $dataa['msg'] = 'success';
            }
        }
        echo json_encode($dataa);
	}

	 public function get_client_all_data()
	 {
	 	$list = $this->client_model->get_stud_datatables('student_detail');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$status=$item->student_status;
			$row[] = $no;			
			$row[] = $item->student_last_name.' '.$item->student_first_name.' '.$item->student_father_name.' '. $item->student_mother_name;			
			$row[] = $item->student_phone;			
			$row[] = $item->student_email;			
			$row[] = $item->client_discount.'%';			
			
			$student_id ="'".$item->student_id ."'";	
			// print_r($student_id);		

				
               if($status==1){
					$row[] = '<button type="button" onclick="update_status('.$student_id.',2);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
				}
				else{
				$row[] = '<button  onclick="update_status('.$student_id.',1);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
				}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->client_model->count_all(),
			"recordsFiltered" => $this->client_model->count_filtered('student_detail'),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();


	 }

	
	 
	 public function update_student_status()
	 {
	 	
	 	$data=array('student_status'=>$this->input->post('student_status'));
	 	$where=array('student_id' => $this->input->post('student_id'),);
	 	$result=$this->basic_mol->update_table($where,$data,'student_master');
	 	echo $result;
	 }


}
?>
