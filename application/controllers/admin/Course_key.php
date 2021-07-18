<?php
class Course_key extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}	
		$this->current_date=date('Y-m-d H:i:s');
		$this->load->model('admin_model/Key_model/Key_management_model','key_mol'); 	
		$this->admin_id=$this->session->userdata('admin_id');
	 }

	 public function index(){
	 	
	 	$this->load->view('admin/header');	 	
	 	$this->load->view('admin/course_key_add');
	 	$this->load->view('admin/footer');
	 }

	 public function import_csv(){
	    $data=array();
	 	if(isset($_FILES['file']['name'])){
	 	    $batch_id=uniqid(time());
	 		$config['file_name'] = $batch_id.'_keygenerate.csv';
			$config['upload_path'] = 'assets/Key_Docs';
			$config['allowed_types'] = 'csv|xlsx';
			$config['overwrite'] = TRUE;
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			$c=0;
			$error_data= array();
			$error_log_row= array();
			$key_generation_data= array();
			while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
			{
				if($c<>0){	/* SKIP THE FIRST ROW */
						
					// $course_view_db = $this->basic_mol->exist_or_not(array('attr_type_id'=>6,'value_id'=>$filesop[2]),'attribute_value_master');
					$course_duration_db = $this->basic_mol->exist_or_not(array('course_type_value_name'=>(int)$filesop[1]),'course_type_value_master');
					$course_view_db = $this->basic_mol->exist_or_not(array('course_view_value_name'=>(double)$filesop[2],'course_view_id'=>$course_duration_db->course_type_id),'course_view_value_master');
					$course_id_db = $this->basic_mol->exist_or_not(array('course_id'=>$filesop[0]),'course_master');

					//course id
					$course_id = empty($course_id_db) ? "invalid" : $filesop[0];
					if($course_id == 'invalid')
					{
				  		$error_log_row['coloumn_name'][]="course_id";
					  	$error_log_row['error_type'][]="course id not exists";
					  	$error_log_row['message'][]=$filesop[0]." Invalid Course ID";
					}

					// //particular course fall in given duration
					// if($course_duration_db->course_type_id != $course_id_db->course_type_id)
					// {
				 //  		$error_log_row['coloumn_name'][]="course_id_with_duration";
					//   	$error_log_row['error_type'][]="course id with duration not exits";
					//   	$error_log_row['message'][]=$filesop[0]." Course ID Does Not Match With ".$filesop[1]." Duration Please Check Datatable";
					// }

					//course duration
					$course_duration = empty($course_duration_db) ? "unknown" : $filesop[1];
					if($course_duration == 'unknown')
					{
					  $error_log_row['coloumn_name'][]="course_duration";
					  $error_log_row['error_type'][]="duration error";
					  $error_log_row['message'][]=$filesop[1]." Invalid Course Duration";
					}
					
					$course_validity = $course_duration != "unknown" ? $this->basic_mol->get_single_data(array('course_type_value_name'=>(int)$filesop[1]),'course_type_value_master') : "";
					$course_validity_id = $course_validity != "" ? $course_validity['course_type_value_id'] : "invalid_id";

					//Course View
					$course_view = empty($course_view_db) ? "unknown" : $filesop[2];
					$course_views = $course_view != "unknown" ? $this->basic_mol->get_single_data(array('course_view_value_name'=>(double)$filesop[2]),'course_view_value_master') : "";
					$course_view_id = $course_views != "" ? $course_views['course_view_value_id'] : "invalid";

					if($course_view == 'unknown')
					{
						$error_log_row['coloumn_name'][] = "course_view";
						$error_log_row['error_type'][] =	"course view error";
						$error_log_row['message'][] =	$filesop[2]." Invalid Course View Please refer Attribute Value Tab";
					}


					//check validation duration with view 
					if($course_view != 'unknown' && $course_duration != "unknown")
					{
						if($course_views['course_view_id'] != $course_validity['course_type_id'])
						{
							$error_log_row['coloumn_name'][] = "course_view";
							$error_log_row['error_type'][] =	"course view error";
							$error_log_row['message'][] =	$filesop[2]." Invalid Course View with Duration Please refer Attribute Value Tab";
						}
					}

					$key_exist_or_not_result=$this->basic_mol->exist_or_not(array('course_key'=>$filesop[3]),'course_key_master');

					if(!empty($key_exist_or_not_result))
					{
						$error_log_row['coloumn_name'][]= "course_key";
						$error_log_row['error_type'][]="course key exist";
						$error_log_row['message'][]=$filesop[3]." Duplicate Key";
					}
					

					$key_generation_data[]=array(
						'course_id' => $filesop[0],
						'course_view' => $course_view_id,
						'course_duration' => $course_validity_id,
						'course_key' => $filesop[3],
						'batch_id'	 => $batch_id,
						'uploaded_date'	=> date('Y-m-d H:i:s'),
					);
				}
				$c = $c + 1;

			}

			for($i=0;$i<count($key_generation_data);$i++){
				if($i != count($key_generation_data) - 1){
					for($j=($i+1);$j<count($key_generation_data);$j++){
						if($key_generation_data[$i]['course_key'] == $key_generation_data[$j]['course_key']){
							$error_log_row['coloumn_name'][]= "duplicate_key_csv_file";
							$error_log_row['error_type'][]="Duplicate_key_enter_on_csv";
							$error_log_row['message'][]=$key_generation_data[$i]['course_key']." Duplicate Key on csv file";
						}
					}
				}
			}

			if(empty($error_log_row))
			{
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config); 
				
				if(!$this->upload->do_upload('file')){
					$data['message'] = $this->upload->display_errors();
					$data['type'] = "upload_error";
					
				}else{
				    $dump_key_generation_data=array();
					foreach ($key_generation_data as $row) {
						
						$dump_key_generation_data=$this->basic_mol->insert($row,"course_key_master");
					}
					if($dump_key_generation_data)
					{
						$batch_data=array('batch_id' => $batch_id,
										  'uploaded_path' => $config['file_name'] );
						$batch_result=$this->basic_mol->insert($batch_data,"key_master_excel");
						if($batch_result){
							$data['type']="success";
							$data['message']="Excel Uploaded Successfully!!";
						}

					}
					
				}
			}
			else
			{
				

				$data['type']="error";
				$data['message']="Errors Occured In Uploaded File";

				$error_data_table = array();
				$no = 0;
				$error_logs=
							'<table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
		                                       <thead>
		                                        <tr>
		                                            <th>No</th>                             
		                                            <th>Coloumn Name</th>
		                                            <th>Error</th>
		                                            <th>Message</th> 
		                                        </tr>
		                                        </thead>
		                                    
		                                        <tbody>';    

				for($i=0; $i< count($error_log_row['coloumn_name']);$i++){
					$no++;
					$error_logs .= 
									'<tr>
											<td>' .$no. '</td>
											<td>' .$error_log_row['coloumn_name'][$i].'</td>
											<td>'.$error_log_row['error_type'][$i].'</td>
											<td>' .$error_log_row['message'][$i]. '</td>
									</tr>';
				}

				$error_logs .= 
								'</tbody>
								</table>';

								
				$data['error_log_tbl']=$error_logs;
				
				

			}
	 		
	 	
	 	
	 	}
	 	echo json_encode($data);
	}
	
	
	function manage_key(){
		$this->load->view('admin/header');	 	
	 	$this->load->view('admin/course_manage_key.php');
	 	$this->load->view('admin/footer');
	}

	function fetch_all_course_key(){

		$list = $this->key_mol->get_cat_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {

			$no++;
			$row = array();
			$row[] = $no;			
			$row[] = $item->course_id;			
			$row[] = $item->course_title;			
			$row[] = $item->course_key;			
			$row[] = $item->view;	
			$row[] = $item->course_type_value_name.' Month';		

			$assigned_date ="'".$item->assigned_date ."'";
			$expired_date ="'".$item->valid_date ."'";
			$extended_date ="'".$item->extended_Date ."'";

			if($item->student_id ==0){
				$row[] = '<button type="button" disabled class="btn btn-success btn-xs"> Not Assigned </button>';
			}
			else{
				$row[] = '<button  onclick="view_assign_key('.$item->student_id.','.$assigned_date.','.$expired_date.','.$extended_date.');" class="btn btn-warning btn-xs">  Assigned </button>';	
			}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->key_mol->count_all(),
			"recordsFiltered" => $this->key_mol->count_filtered(),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();
	}

	function view_student_detail(){
		$where = $this->input->post();
		$result = $this->basic_mol->get_single_data($where,'student_master');
		echo json_encode($result);
	}


}
?>
