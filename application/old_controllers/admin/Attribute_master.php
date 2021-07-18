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
	 	$where['value'] = $this->input->post('value');	
	 	$where['attr_type_id'] = $this->input->post('attr_type_id');	

	 	if($data['attr_type_id'] == 4){
	 		$course_type_id = explode(',',$data['course_type_value_name']);
	 		unset($data['course_type_value_name']);
	 	}

	 	$result['msg'] = "error";
	 	if(empty($this->basic_mol->exist_or_not($where,"attribute_value_master"))){

	 		$return_id = $this->basic_mol->insert($data,"attribute_value_master");

	 		if($data['attr_type_id'] == 4){
		 		for($i=0;$i<count($course_type_id);$i++){
			 		$course_type['course_type_value_name'] = $course_type_id[$i];
			 		$course_type['course_type_id'] = $return_id;
			 		$course_type['course_type_value_status'] = 1;
			 		$this->basic_mol->insert($course_type,"course_type_value_master");
		 		}
		 	}
 			$result['msg'] = "success";
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


	 public function get_cat_all_data()
	 {
	 	$data_ajax = $this->input->post('attr_type_id');
	 	$list = $this->attr_model->get_cat_datatables($data_ajax);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$validity_mode = "";

			if($item->attr_type_id == 4){
				$where_mode['course_type_id'] = $item->value_id;
				$result = $this->basic_mol->get_all_data($where_mode,'course_type_value_master');
				foreach ($result as $row) {
					# code...
					if($validity_mode == ""){
						$validity_mode = $row['course_type_value_name'];
					}else{
						$validity_mode = $validity_mode.','.$row['course_type_value_name'];
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
				$row[] = $item->value.' ( '.$validity_mode.'  In Months )';	
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
			if($this->session->userdata('employee_roll') != 0){
                $course_tab_permission=$this->session->userdata('course_tab_permission');
                    if($course_tab_permission[2] == 1){
						$edit_btn='<button type="button" onclick="edit_type('.$value_id .','.$value.','.$attr_id.','.$valid_type_mode.');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
					}
			}
			else{
					$edit_btn='<button type="button" onclick="edit_type('.$value_id .','.$value.','.$attr_id.','.$valid_type_mode.');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
			}				

				$row[] = $edit_btn;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->attr_model->count_all(),
			"recordsFiltered" => $this->attr_model->count_filtered($data_ajax),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();


	 }


}
?>
