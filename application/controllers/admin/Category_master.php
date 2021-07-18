<?php
class Category_master extends CI_Controller{
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
		$this->current_date=date('Y-m-d H:i:s');
		$this->admin_id=$this->session->userdata('admin_id');
	 }

	 public function edit_cat()
	 {
	 	$cat_id =$this->input->post('cat_id');		 	
	 	$where=array('cat_id'=>$cat_id);
	 	$update_data=$this->input->post();	 
	 	echo $this->basic_mol->update_table($where,$update_data,"categorise_master");		 	
		 	
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
			 		$course_type['course_type_value_name'] = $course_type_id[$i].' Month';
			 		$course_type['course_type_id'] = $return_id;
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
	 	
	 	$this->load->view('admin/product/category_master',$result);
	 	$this->load->view('admin/footer');

	 }
	 public function get_cat_all_data()
	 {
	 	$list = $this->cat_model->get_cat_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$status=$item->cat_status;
			$row[] = $no;			
			$row[] = $item->cat_name;			
			$row[] = $item->cat_date_time;			
			$cat_name="'".$item->cat_name."'";
			$cat_id ="'".$item->cat_id ."'";		

				$row[] = '<button type="button" onclick="edit_cat('.$cat_id .','.$cat_name.');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
               if($status==1){
					$row[] = '<button type="button" onclick="update_status('.$cat_id.',0);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
				}
				else{
				$row[] = '<button  onclick="update_status('.$cat_id.',1);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
				}
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->cat_model->count_all(),
			"recordsFiltered" => $this->cat_model->count_filtered(),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();


	 }

	 public function update_status()
	 {
	 	$id=$this->uri->segment(3);
	 	$status=$this->uri->segment(4);
	 	$status=array('status'=>$status);
	 	$result=$this->zone->update_status($id,$status);
	 	echo $result;
	 }


}
?>
