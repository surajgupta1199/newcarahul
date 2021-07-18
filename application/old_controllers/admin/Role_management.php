<?php
class Role_management extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}	
	 	$this->load->model('admin_model/employee_model/Role_management_model','role_mdl'); 	
		$this->current_date=date('Y-m-d H:i:s');
		$this->role='role_master';
	 }

	  public function index()
	 {
	 	# code...
		$this->load->view('admin/header'); 	 	
	 	$this->load->view('admin/employee/role_master');
	 	$this->load->view('admin/footer');
	 }

	public function add_role(){

		$data=$this->input->post();

		$course_permissions=array();
		$student_permissions=array();
		$coupan_permissions=array();
		for($i = 0; $i<=2; $i++) {
			
		   $course_permissions[] = isset($data['course_permissions_'.$i]) ? $data['course_permissions_'.$i] : 0;
		   $student_permissions[] = isset($data['student_permissions_'.$i]) ? $data['student_permissions_'.$i] : 0;
		   $coupan_permissions[] = isset($data['coupan_permissions_'.$i]) ? $data['coupan_permissions_'.$i] : 0;
		}
		
		
		$permissions=array(
		'course_permissions'	=>	json_encode($course_permissions),
		'student_permissions'	=>	json_encode($student_permissions),
		'coupan_permissions'	=>	json_encode($coupan_permissions)

		);


        $where = array(
            'designation' => $data['designation']
        );
        $dup_role = $this->basic_mol->exist_or_not($where,$this->role);
        if($dup_role){
            $response_data['type'] = 'role_exist';
            $response_data['msg'] = 'Role Already Exist';
        }else{
        	$insert_role_data['designation']=$data['designation'];
			$insert_role_data['permissions']=json_encode($permissions);
			$insert_role_data['created_on']=$this->current_date;
            $result = $this->basic_mol->insert($insert_role_data,$this->role);
            $response_data['type'] = 'error';
            $response_data['msg'] = 'Role Not Added';
            if($result){
                $response_data['type'] = 'success';
                $response_data['msg'] = 'Role Added Successfully';
            }
        }
        echo json_encode($response_data);
	}

	 public function get_role_all_data()
	 {
	 	$list = $this->role_mdl->get_role_datatables($this->role);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$status=$item->role_status;
			$row[] = $no;			
			$row[] = $item->designation;
			$role_id ="'".$item->role_id ."'";	
			$row[]='<button class="btn btn-primary btn-xs waves-effect waves-light" onclick="view_permissions('.$role_id.')"><i class="ti-view"></i> View Permissions </button>
					<button type="button" onclick="edit_permissions('.$role_id .');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit Permissions</button>';
			
               if($status==0){
					$row[] = '<button type="button" onclick="update_status('.$role_id.',1);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
				}
				else{
				$row[] = '<button  onclick="update_status('.$role_id.',0);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
				}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->role_mdl->count_all(),
			"recordsFiltered" => $this->role_mdl->count_filtered($this->role),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();


	 }
	 public function get_role_permissions()
	 {
	 	$permission_result=$this->basic_mol->get_single_data(array('role_id'=>$this->input->post('role_id')),$this->role);

	 	$alloted_permissions=(array)json_decode($permission_result['permissions']);
	 	$course_permissions=json_decode($alloted_permissions['course_permissions']);
	 	$student_permissions=json_decode($alloted_permissions['student_permissions']);
	 	$coupan_permissions=json_decode($alloted_permissions['coupan_permissions']);

	 	
	 	$course_alloted_permissions='<td>Course Management</td>';
		$student_alloted_permissions='<td>Student Management</td>';
		$coupan_alloted_permissions='<td>Coupan Management</td>';
		for($i = 0; $i<=2; $i++) {
			
		   $course_alloted_permissions.= $course_permissions[$i]==1 ? '<td><button type="button" class="btn btn-success btn-xs"><i class="ti-check"></i></button></td>' : '<td><button type="button" class="btn btn-danger btn-xs"><i class="ti-close"></i></button></td>';
		   $student_alloted_permissions.= $student_permissions[$i]==1 ? '<td><button type="button" class="btn btn-success btn-xs"><i class="ti-check"></i></button></td>' : '<td><button type="button" class="btn btn-danger btn-xs"><i class="ti-close"></i></button></td>';
		   $coupan_alloted_permissions.= $coupan_permissions[$i]==1 ? '<td><button type="button" class="btn btn-success btn-xs"><i class="ti-check"></i></button></td>': '<td><button type="button" class="btn btn-danger btn-xs"><i class="ti-close"></i></button></td>';
		}
		$respnse_data['course_alloted_permissions']=$course_alloted_permissions;
		$respnse_data['student_alloted_permissions']=$student_alloted_permissions;
		$respnse_data['coupan_alloted_permissions']=$coupan_alloted_permissions;
		echo json_encode($respnse_data);

	 }
	 public function set_edit_role__data()
	 {
	 	$role_result=$this->basic_mol->get_single_data(array('role_id'=>$this->input->post('role_id')),$this->role);
	 	$alloted_permissions=(array)json_decode($role_result['permissions']);
	 	$course_permissions=json_decode($alloted_permissions['course_permissions']);
	 	$student_permissions=json_decode($alloted_permissions['student_permissions']);
	 	$coupan_permissions=json_decode($alloted_permissions['coupan_permissions']);

	 	$course_alloted_permissions='<td>Course Management</td>';
		$student_alloted_permissions='<td>Student Management</td>';
		$coupan_alloted_permissions='<td>Coupan Management</td>';
		for($i = 0; $i<=2; $i++) {
			
		   $course_alloted_permissions.= $course_permissions[$i]==1 ? '<td>
                                              <input type="checkbox"  id="edit_course_permissions'.$i.'" class="chk-col-green" name="edit_course_permissions_'.$i.'" value="1" checked>
                                              <label class="custom-control-label" for="edit_course_permissions'.$i.'"></label>
                                        </td>' : '<td>
                                              <input type="checkbox"  id="edit_course_permissions'.$i.'" class="chk-col-green" name="edit_course_permissions_'.$i.'" value="1">
                                              <label class="custom-control-label" for="edit_course_permissions'.$i.'"></label>
                                        </td>';
		   $student_alloted_permissions.= $student_permissions[$i]==1 ? '<td>
                                              <input type="checkbox"  id="edit_student_permissions'.$i.'" class="edit_student_permissions" name="edit_student_permissions_'.$i.'" value="1" checked>
                                              <label class="custom-control-label" for="edit_student_permissions'.$i.'"></label>
                                        </td>' : '<td>
                                              <input type="checkbox"  id="edit_student_permissions'.$i.'" class="edit_student_permissions" name="edit_student_permissions_'.$i.'" value="1">
                                              <label class="custom-control-label" for="edit_student_permissions'.$i.'"></label>
                                        </td>';
		   $coupan_alloted_permissions.= $coupan_permissions[$i]==1 ? ' <td>
                                              <input type="checkbox"  id="edit_coupan_permissions'.$i.'" class="edit_coupan_permissions" name="edit_coupan_permissions_'.$i.'" value="1" checked>
                                              <label class="custom-control-label" for="edit_coupan_permissions'.$i.'"></label>
                                        </td>': '<td>
                                              <input type="checkbox"  id="edit_coupan_permissions'.$i.'" class="edit_coupan_permissions" name="edit_coupan_permissions_'.$i.'" value="1">
                                              <label class="custom-control-label" for="edit_coupan_permissions'.$i.'"></label>
                                        </td>';
		}
		$respnse_data['course_alloted_permissions']=$course_alloted_permissions;
		$respnse_data['student_alloted_permissions']=$student_alloted_permissions;
		$respnse_data['coupan_alloted_permissions']=$coupan_alloted_permissions;

	 	$respnse_data['designation']=$role_result['designation'];
	 	echo json_encode($respnse_data);
	 }
	 public function edit_role()
	 {
	 	$data=$this->input->post();
	 	
	 	$edit_course_permissions=array();
		$edit_student_permissions=array();
		$edit_coupan_permissions=array();
		for($i = 0; $i<=2; $i++) {
			
		   $edit_course_permissions[] = isset($data['edit_course_permissions_'.$i]) ? $data['edit_course_permissions_'.$i] : 0;
		   $edit_student_permissions[] = isset($data['edit_student_permissions_'.$i]) ? $data['edit_student_permissions_'.$i] : 0;
		   $edit_coupan_permissions[] = isset($data['edit_coupan_permissions_'.$i]) ? $data['edit_coupan_permissions_'.$i] : 0;
		}
		
		
		$permissions=array(
		'course_permissions'	=>	json_encode($edit_course_permissions),
		'student_permissions'	=>	json_encode($edit_student_permissions),
		'coupan_permissions'	=>	json_encode($edit_coupan_permissions)

		);
		
		$role_data['designation']=$data['designation'];
		$role_data['permissions']=json_encode($permissions);
		$where=array('role_id' => $data['role_id'],);
		$update_role=$this->basic_mol->update_table($where,$role_data,$this->role);
		$respnse_data['type']="error";
		$respnse_data['msg']="Problem Occured While Updating Role!!";
		if($update_role)
		{
			$respnse_data['type']="success";
			$respnse_data['msg']="Role Updated Successfully!!";
		}

		echo json_encode($respnse_data);
	 }
	 public function update_role_status()
	 {
	 	$data=array('role_status'=>$this->input->post('role_status'));
	 	$where=array('role_id' => $this->input->post('role_id'),);
	 	$result=$this->basic_mol->update_table($where,$data,$this->role);
	 	echo $result;
	 }


}
?>
