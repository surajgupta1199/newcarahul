<?php
class Add_attribute_master extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		} 
		$this->admin_id=$this->session->userdata('admin_id');
	 	$this->load->model('admin_model/product_model/Add_attribute_model','add_attr_model'); 		
		$this->current_date=date('Y-m-d H:i:s');
	 }

	 public function index()
	 {
	 	
	 	$result['data'] = $this->basic_mol->get_all_data(array('status' => 0),'attribute_master');	
	 	$this->load->view('admin/header');
	 	
	 	$this->load->view('admin/product/add_attriibute_master',$result);
	 	$this->load->view('admin/footer');

	 }

	 public function get_all_attr(){
	 	$list = $this->add_attr_model->get_cat_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$status=$item->status;
			$row[] = $no;			
			$row[] = $item->title;			
			$row[] = $item->created_at;	

			$attribute_id ="'".$item->attribute_id ."'";
			$title ="'".$item->title ."'";
           	if($status==0){
				$row[] = '<button type="button" onclick="update_status('.$attribute_id.',1);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
			}
			else{
				$row[] = '<button  onclick="update_status('.$attribute_id.',0);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
			}
			$edit_btn='';
			if($this->session->userdata('employee_roll') == 0){
                $edit_btn='	<button type="button" onclick="edit_type('.$attribute_id .','.$title.');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>
                			<button type="button" onclick="delete_attr_type('.$attribute_id .');"  class="btn waves-effect waves-light btn-xs btn-danger"><i class="ti-trash"></i> Delete</button>';
			}		
				$row[] = $edit_btn;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->add_attr_model->count_all(),
			"recordsFiltered" => $this->add_attr_model->count_filtered(),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();
	 }

	 public function delete_attr(){
	 	$attr_id = $this->input->post('attr_id');
	 	$assigned_attr_in_attr_value = $this->add_attr_model->check_assigned_attr($attr_id);
	 	$output['type'] = "error";
	 	$output['message'] = "this attribute use in some Atrribute Value Master";
	 	if(empty($assigned_attr_in_attr_value)){
	 		$delete_attr_value = $this->basic_mol->delete(array('attribute_id' => $attr_id),'attribute_master');
	 		$output['type'] = "success";
	 		$output['message'] = "deleted attribute successfully";
	 	}
	 	echo json_encode($output);
	 }

 	public function update_attr_status(){
 		$where['attribute_id'] = $this->input->post('attribute_id');
	 	$data['status'] = $this->input->post('status');
	 	$result = $this->basic_mol->update_table($where,$data,"attribute_master");
	 	$output['msg'] = 'error';
	 	if($result){
	 		$output['msg'] = 'success';
	 	}
	 	echo json_encode($output);
	 }

 	public function add_attr_type(){
 		$data = $this->input->post();
 		$output['type'] = "error";
 		$output['message'] = "attribute already exists";
 		if(empty($this->basic_mol->exist_or_not($data,"attribute_master"))){
 			$data['created_at'] = $this->current_date;
 			$result = $this->basic_mol->insert($data,'attribute_master');
 			$output['type'] = "error";
 			$output['message'] = "unable to insert attribute";
 			if($result){
 				$output['type'] = "success";
 				$output['message'] = "successfully added attribute";
 			}
 		}
 		echo json_encode($output);
 	}

 	public function edit_attr_type(){
 		$data = $this->input->post();
 		$where['attribute_id'] = $this->input->post('attribute_id');
 		$output['type'] = "error";
 		$output['message'] = "attribute already exists";
 		if(empty($this->basic_mol->edit_exist_or_not(array('title'=>$data['title']),$where,"attribute_master"))){
 			$data['created_at'] = $this->current_date;
 			$result = $this->basic_mol->update_table($where,$data,'attribute_master');
 			$output['type'] = "error";
 			$output['message'] = "unable to insert attribute";
 			if($result){
 				$output['type'] = "success";
 				$output['message'] = "successfully added attribute";
 			}
 		}
 		echo json_encode($output);
 	}
}
?>
