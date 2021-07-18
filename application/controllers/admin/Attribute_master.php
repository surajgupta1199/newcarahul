<?php
class Attribute_master extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}
	 	$this->load->model('admin_model/product_model/category_model','cat_model'); 
	 	$this->load->model('admin_model/product_model/Attribute_model','attr_model'); 		
		$this->current_date=date('Y-m-d H:i:s');
		$this->admin_id=$this->session->userdata('admin_id');
	 }

	 public function attr_type_value()
	 {
	 	$data = $this->input->post();
	 	$check_duplicate_view = "non_unique";
	 	$error_message = "";

	 	$data['created_at'] = $this->current_date;
	 	$where['value'] = $this->input->post('value');	
	 	$where['attr_type_id'] = $this->input->post('attr_type_id');	

	 	if($data['attr_type_id'] == 4){
	 		$course_type_id = explode(',',$data['course_type_value_name']);
	 		$course_view_id = explode(',',$data['course_view_value_name']);
	 		unset($data['course_type_value_name']);
	 		unset($data['course_view_value_name']);

	 		//check repeated view value exists or not
	 		if(count($course_view_id) != 1){
	 			$check_duplicate_view = count($course_view_id) == count(array_unique($course_view_id)) ? "" : "Duplicate Course View Value Entered Please Check"; //"non-unique"
	 			$error_message = $check_duplicate_view;
	 		}

	 		if($error_message != ""){
		 		$result['type'] = "error";
		 		$result['message'] = $error_message;
		 		echo json_encode($result);
		 		exit();
	 		}

	 		//check repeated month value in database exist or not
		 	for($i=0;$i<count($course_type_id);$i++) {
		 		# code...
		 		$duplicate_month = $this->basic_mol->exist_or_not(array('course_type_value_name'=>$course_type_id[$i]),'course_type_value_master');	
		 		if(!empty($duplicate_month)){
		 			if($error_message == ""){
		 				$error_message = $duplicate_month->course_type_value_name;
		 			}else{
		 				$error_message = $error_message .' ,'. $duplicate_month->course_type_value_name;
		 			}
		 		}

		 	}
	 		//assigned error message
	 		if($error_message !=""){
	 			$error_message = $error_message . ' Month Already Exists.';	
	 		}
	 	}
	 	
	 	$result['type'] = "error";
	 	$result['message'] = "Content Name Already Exists.";

	 	if(empty($this->basic_mol->exist_or_not($where,"attribute_value_master"))){

	 		$result['type'] = "error";
	 		$result['message'] = $error_message;

	 		if($error_message == ""){
		 		$return_id = $this->basic_mol->insert($data,"attribute_value_master");

		 		if($data['attr_type_id'] == 4){
			 		for($i=0;$i<count($course_type_id);$i++){
				 		$course_type['course_type_value_name'] = $course_type_id[$i];
				 		$course_type['course_type_id'] = $return_id;
				 		$course_type['created_at'] = $this->current_date;
				 		$this->basic_mol->insert($course_type,"course_type_value_master");
			 		}

			 		for($i=0;$i<count($course_view_id);$i++){
			 			$course_view['course_view_value_name'] = $course_view_id[$i];
				 		$course_view['course_view_id'] = $return_id;
				 		$course_view['created_at'] = $this->current_date;
				 		$this->basic_mol->insert($course_view,"course_view_value_master");
				 	}
			 	}

	 			$result['type'] = "success";
	 			$result['message'] = "New Category Added Successfully.";
	 		}
	 	}
		 

	 	echo json_encode($result);
	 }

	 public function index()
	 {
	 	
	 	$result['data'] = $this->basic_mol->get_all_data(array('status' => 0),'attribute_master');	
	 	$this->load->view('admin/header');
	 	
	 	$this->load->view('admin/product/attribute_value_master',$result);
	 	$this->load->view('admin/footer');

	 }

	 public function edit_type_status(){
	 	$where['value_id'] = $this->input->post('value_id');
	 	$data['status'] = $this->input->post('status');
	 	$result = $this->basic_mol->update_table($where,$data,"attribute_value_master");
	 	$output['msg'] = 'error';
	 	if($result){
	 		$output['msg'] = 'success';
	 	}
	 	echo json_encode($output);
	 }

	 public function edit_attr_type_value(){
	 	$data = $this->input->post();
	 	$where['value_id'] = $data['value_id'];

	 	if($data['attr_type_id'] == 4){
		 	$course_type_id = explode(',',$data['course_type_value_name']);
		 	unset($data['course_type_value_name']);
	 	}

	 	$output['msg'] = 'error';

	 	if(empty($this->basic_mol->edit_exist_or_not(array('value'=>$data['value']),$where,'attribute_value_master'))){

	 		$result = $this->basic_mol->update_table($where,$data,'attribute_value_master');

	 		$output['msg'] = 'error';
		 	if($result){

		 		if($data['attr_type_id'] == 4){
		 			$validity_mode['course_type_value_status'] = 1;
		 			$validity_mode['course_type_id'] = $data['value_id'];
		 			$delete_colm = $this->basic_mol->delete(array('course_type_id' => $data['value_id']),'course_type_value_master');

		 			for($i=0;$i<count($course_type_id);$i++){
		 				$validity_mode['course_type_value_name'] = $course_type_id[$i];
		 				$insert_col = $this->basic_mol->insert($validity_mode,'course_type_value_master');
		 			}
		 		}

	 			$output['msg'] = 'success';
		 	}

		 }

	 	echo json_encode($output);
	 }

	 public function delete_attr_value(){
	 	$attr_value = $this->input->post('attr_value_id');
	 	$assigned_attr_course = $this->attr_model->check_assigned_attr($attr_value);
	 	$output['type'] = "error";
	 	$output['message'] = "attribute use in some courses";
	 	if(empty($assigned_attr_course)){
	 		$delete_attr_value = $this->basic_mol->delete(array('value_id' => $attr_value),'attribute_value_master');
	 		$output['type'] = "success";
	 		$output['message'] = "deleted attribute successfully";
	 	}
	 	echo json_encode($output);
	 }


	 public function get_cat_all_data()
	 {
	 	$attr_value_id = $this->input->post('attr_type_id');
	 	$list = $this->attr_model->get_cat_datatables($attr_value_id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$validity_mode = "";
			$validity_view = "";

			if($item->attr_type_id == 4){
				$where_mode['course_type_id'] = $item->value_id;
				$where_view['course_view_id'] = $item->value_id;
				$result = $this->basic_mol->get_all_data($where_mode,'course_type_value_master');
				$course_view_result = $this->basic_mol->get_all_data($where_view,'course_view_value_master');
				foreach ($result as $row) {
					# code...
					if($validity_mode == ""){
						$validity_mode = $row['course_type_value_name'];
					}else{
						$validity_mode = $validity_mode.','.$row['course_type_value_name'];
					}
				}

				foreach ($course_view_result as $row) {
					# code...
					if($validity_view == ""){
						$validity_view = $row['course_view_value_name'];
					}else{
						$validity_view = $validity_view.','.$row['course_view_value_name'];
					}
				}
			}

			$no++;
			$row = array();
			$status=$item->status;
			$row[] = $no;			
			$row[] = $item->value_id;
			if($item->attr_type_id == 6){
				$row[] = $item->value.' views';			
			}else if($item->attr_type_id == 4){
				$row[] = $item->value.' ( '.$validity_mode.'  In Months)'.' ( '.$validity_view.'  In View)';	
			}else{
				$row[] = $item->value;			
			}			
			$row[] = $item->created_at;			
			$value="'".$item->value."'";
			$value_id ="'".$item->value_id ."'";		
			$attr_id ="'".$item->attr_type_id ."'";		
			$valid_type_mode ="'".$validity_mode ."'";
			if($status==0){
				$row[] = '<button type="button" onclick="update_status('.$value_id.',1);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
			}
			else{
				$row[] = '<button  onclick="update_status('.$value_id.',0);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
			}
			$edit_btn='';
			if($this->session->userdata('employee_roll') == 0){
                $edit_btn='<button type="button" onclick="edit_type('.$value_id .','.$value.','.$attr_id.','.$valid_type_mode.');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>
        			<button type="button" onclick="delete_type('.$value_id .');"  class="btn waves-effect waves-light btn-xs btn-danger"><i class="ti-trash"></i> Delete</button>';
			}				

				$row[] = $edit_btn;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->attr_model->count_all(),
			"recordsFiltered" => $this->attr_model->count_filtered($attr_value_id),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();


	 }


}
?>
