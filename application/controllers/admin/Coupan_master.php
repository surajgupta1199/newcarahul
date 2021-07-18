<?php
class Coupan_master extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}	
	 	$this->load->model('admin_model/product_model/coupan_model','coupan_model'); 	
		$this->current_date=date('Y-m-d H:i:s');
		$this->employee_id=$this->session->userdata('employee_id');
		
	 }

	 public function get_drp_data()
	 {
	 	
		$get_all_types=$this->basic_mol->get_all_data(array('attr_type_id'=>4,'status'=>0),'attribute_value_master');
		
	 	$categories="<option value='0'>-- Please select category --</option>";
	 	foreach ($get_all_types as $row) {
	 		$categories.='<option value='.$row['value_id'].'>'.$row['value'].'</option> ';
	 	}
	 	
	 	echo json_encode($categories);
	 }
	
	 public function get_coupan_particular_data()
	 {
	 	
	 	$where=array('coup_id' => $this->input->post('coup_id'),);
	 	
	 	$coupan_result=(array)$this->basic_mol->exist_or_not($where,'coupon_master');	 	
	 	
	 	echo json_encode($coupan_result);
	 }
	 
	 public function edit_coupan()
	 {
			$coupan_id =$this->input->post('coup_id');		 	
		 	$where=array('coup_id'=>$coupan_id);
		 	$update_data=$this->input->post();
		 	$data['updated_by']=$this->employee_id;
		 	$data['updated_on']=$this->current_date;

		 	echo $this->basic_mol->update_table($where,$update_data,"coupon_master");
		
	 }
	 public function add_coupan(){
		$data =$this->input->post();
		
		$coup_code=$this->input->post('coup_code');
	 	$where=array('coup_code'=>$coup_code);	 	
	 	if(empty($this->basic_mol->exist_or_not($where,"coupon_master"))){
	 		$data=$this->input->post();
	 		$data['coupon_date_time']=$this->current_date;
	 		
	 		$data['added_by']=$this->employee_id;
	 		
	 		$this->basic_mol->insert($data,"coupon_master");
	 		echo 1;
	 		exit();
	 	}	 	
	 	echo 2;
	}

	 public function index()
	 {
	 	# code...
	 	
	 	$this->load->view('admin/header');	 	
	 	$this->load->view('admin/product/coupan_master');
	 	$this->load->view('admin/footer');

	 }
	 public function get_coupan_all_data()
	 {
	 	$list = $this->coupan_model->get_coupan_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$status=$item->coupon_status;
			$row[] = $no;			
			$row[] = $item->coup_title;			
			$row[] = $item->coup_code;			
			$row[] = $item->coup_description;			
			$row[] = $item->coup_min_amount;			
			$row[] = $item->coup_discount;
			$type = $item->coup_discount_type == 1 ? 'In Percentage' : 'In Amount';			
			$row[] = $type;			
			$row[] = $item->coup_start_date;			
			$row[] = $item->coup_end_date;			
			
			$coup_id ="'".$item->coup_id ."'";		
            if($status==1){
				$row[] = '<button type="button" onclick="update_status('.$coup_id.',2);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
			}
			else{
			$row[] = '<button  onclick="update_status('.$coup_id.',1);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
			}
			$edit_btn='';
			if($this->session->userdata('employee_roll') != 0){
                $coupan_tab_permissions=$this->session->userdata('coupan_tab_permissions');
                    if($coupan_tab_permissions[2] == 1){
						$edit_btn='<button type="button" onclick="edit_coupan('.$coup_id .');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
					}
			}
			else{
					$edit_btn='<button type="button" onclick="edit_coupan('.$coup_id .');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
			}				
			

				$row[] = $edit_btn;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->coupan_model->count_all(),
			"recordsFiltered" => $this->coupan_model->count_filtered(),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();


	 }

	 public function update_coupan_status()
	 {
	 	
	 	$data=array('coupon_status'=>$this->input->post('coupon_status'));
	 	$where=array('coup_id' => $this->input->post('coup_id'),);
	 	$result=$this->basic_mol->update_table($where,$data,'coupon_master');
	 	echo $result;
	 }


}
?>
