<?php
class Course_master extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}	
	 	$this->load->model('admin_model/product_model/course_model','course_model'); 	
		$this->current_date=date('Y-m-d H:i:s');
		$this->tbl_course_type_value="course_type_value_master";
	 }

	 public function get_drp_data()
	 {
	 	$where=array('course_type_id' => $this->input->get('course_type_id'), );
	 	$drp_data=$this->basic_mol->get_all_data($where,$this->tbl_course_type_value);
	 	$mode_master=$this->basic_mol->get_all_data(array('status' => 0,'attr_type_id'=>5 ),'attribute_value_master');     //(where,table)
	 	$course_views =$this->basic_mol->get_all_data(array('course_view_id'=>$where['course_type_id']),'course_view_value_master');     //(where,table)
	 	$plans="";
	 	$no = 1;
	 		
 		foreach ($course_views as $view) {
		 	foreach ($drp_data as $row) {
		 		$plans.='<div class="col-md-12 "><h5 class="m-t-30 "><strong>'.$row["course_type_value_name"].' Month Validity  </strong><span class="btn btn-sm btn-rounded btn-info">('.$view["course_view_value_name"].' times view)</span></h5></div>';
		 		foreach ($mode_master as $mode) {
			 		$plans.='<div class="col-md-6">
		                        <h5 class="m-t-30 m-b-10">'.$mode["value"].' '.$this->input->get("course_type_value").' Price</h5>
		                        <input type="text" spellcheck="true" class="form-control only_number course_amount" name="course_mode['.$row["course_type_value_id"].']['.$mode["value_id"].']['.$view["course_view_value_id"].']" id="course_price'.$no.'"  value="" >
		                        <label class="required_field"></label> 
		                    </div>
		                    <div class="col-md-6">
		                        <h5 class="m-t-30 m-b-10"> Discounted Price</h5>
		                        <input type="text" spellcheck="true" class="form-control only_number" name="course_mode_discount['.$row["course_type_value_id"].']['.$mode["value_id"].']['.$view["course_view_value_id"].']" value="" id="course_discount'.$no.'"  >
		                        <label class="required_field"></label> 
		                    </div>';
		 		}
		 	}
		}

	 	
	 	echo json_encode($plans);
	 }

	 public function get_course_details()
	 {
	 	$where=$this->input->post();
	 	$data = $this->fetch_part_course_data($where); 
		echo json_encode($data);
	 }

 	public function fetch_part_course_data($where){
 		$data = $this->course_model->particular_course_value($where);

 		$where['course_type'] = 1;
		$data['full_course_detail'] = $this->course_model->get_full_part_course_data($where,'course_price_master');
		$data['availability'] = $this->course_model->fetch_course_availibity_view($where,'course_mode','course_price_master');
		$data['view'] = $this->course_model->fetch_course_availibity_view($where,'course_view','course_price_master');

		$course_price = $this->course_model->get_particular_data($where,'course_price_master');
		$course_mode = $this->course_model->get_particular_mode($where,'course_price_master');

		$data['course_mode_view'] = array();
		$i=0;
		foreach($course_mode as $row){
			foreach($course_price as $key=>$each_courses_month){
				foreach($each_courses_month as $each_courses){
					if($each_courses['course_view'] == $row['course_view']){
						$data['course_mode_view'][$i]['part_course_view'] = $each_courses['value'];
						$data['course_mode_view'][$i]['part_course_valid'] = $each_courses['course_validity'];
						$data['course_mode_view'][$i]['course_detail'][] = $each_courses;
					}
				}
			$i++;
			}
		}

		if($data['course_status']==1)
		{
			$status="Active";
		}

		else
		{
			$status="Deactive";
		}

		$data['course_status']=$status;

		
		$data['course_banner_img']=base_url('images/course_banner/').$data['course_banner_img'];
		return $data;
 	}

	public function add_course(){
		$data = $this->input->post();

		$output['message'] = "Course name already exists";
		$output['type'] = "error";

		if(empty($this->basic_mol->exist_or_not(array('course_title'=>$data['course_title']),"course_master"))){
			$last_id = $this->course_model->get_last_id();
			if(empty($last_id)){
				$last_id['course_id'] = 0;
			}
			$price_master = array();

			$course_banner = ($last_id['course_id']+1).'_course_image.jpg';
			$final_array= array();
			$array_1 = array($course_banner,'course_banner_img');
			array_push($final_array,$array_1);
			$result = $this->upload_img($final_array,'course_banner');

			$output['message'] = "The filetype you are attempting to upload is not allowed";
			$output['type'] = "error";

			if($result == 'successfully uploaded'){
	            $data['course_banner_img'] = $course_banner;
	            $data['course_date_time'] = $this->current_date;
	            $data['added_by'] = $this->session->userdata('employee_id');

	            $course_mode = $data['course_mode'];
		 		$course_mode_discount = $data['course_mode_discount'];
		 		unset($data['course_mode'],$data['course_mode_discount']);

	            $return_id = $this->basic_mol->insert($data,"course_master");

				foreach($course_mode as $key=>$value){
					foreach($value as $mode => $view_price){
						foreach($view_price as $view => $price){
							if($price !=""){
								$discounted_price = $course_mode_discount[$key][$mode][$view] == ""?$price:$course_mode_discount[$key][$mode][$view];
								$price_master[] = array(
													'course_id' =>$return_id,
													'course_type_value_id' => $key,
													'course_mode' => $mode,
													'course_view' => $view,
													'course_price' => $price,
													'course_type' => 1,
													'course_discount_price' => $discounted_price
												);			
							}
						}
					}	
				}

				$i=1;
				foreach($price_master as $row){
					$result = $this->basic_mol->insert($row,"course_price_master");
					$i++;
				}

				$output['message'] = "Course successfully inserted";
				$output['type'] = "success";
	        }
	    }

        echo json_encode($output);
	}

	public function edit_course(){
		$data = $this->input->post();

		$course_mode = $data['course_mode'];
 		$course_mode_discount = $data['course_mode_discount'];

 		unset($data['course_mode'],$data['course_mode_discount']);

 		$price_master = array();

 		foreach($course_mode as $key=>$value){
			foreach($value as $mode => $view_price){
				foreach($view_price as $view => $price){
					if($price !=""){
						$discounted_price = $course_mode_discount[$key][$mode][$view] == ""?$price:$course_mode_discount[$key][$mode][$view];
						$price_master[] = array(
											'course_id' =>$data['course_id'],
											'course_type_value_id' => $key,
											'course_mode' => $mode,
											'course_view' => $view,
											'course_price' => $price,
											'course_type' => 1,
											'course_discount_price' => $discounted_price
										);			
					}
				}
			}	
		}

		$where = array(	
			'course_id' => $data['course_id']);

		$where_del = array('course_id' => $data['course_id'],
							'course_type' => 1);

    	$data['updated_on'] = $this->current_date;
    	$data['updated_by'] = $this->session->userdata('employee_id');
		$course_banner = $data['course_id'].'_course_image.jpg';

		$final_array= array();
		$array_1 = array($course_banner,'course_banner_img');
		array_push($final_array,$array_1);
		$result = $this->upload_img($final_array,'course_banner');

		$output['message'] = "Course name already exists";
		$output['type'] = "error";

		if(empty($this->basic_mol->edit_exist_or_not(array('course_title'=>$data['course_title']),$where,'course_master'))){			//$where , $where_in, $table
			$output['message'] = "error while updating courses";
			$output['type'] = "error";

			if($result == 'successfully uploaded'){
	            $data['course_banner_img'] = $course_banner;

	            $update = $this->basic_mol->update_table($where,$data,"course_master");

	            $delete_data = $this->basic_mol->delete($where_del,'course_price_master');

				$i=1;

				foreach($price_master as $row){
					$result = $this->basic_mol->insert($row,"course_price_master");
					$i++;
				}

				$output['message'] = "Course successfully inserted";
				$output['type'] = "success";
	            
	        }else{

	            $update = $this->basic_mol->update_table($where,$data,"course_master");

	            $delete_data = $this->basic_mol->delete($where_del,'course_price_master');

				$i=1;
				foreach($price_master as $row){
					$result = $this->basic_mol->insert($row,"course_price_master");
					$i++;
				}

				$output['message'] = "Course successfully inserted";
				$output['type'] = "success";
	        }
	    }
        echo json_encode($output);
	}

	public function upload_img($final_array,$folder_name){
        $count_img =  count($final_array);
        $c1 = 0;
        $s1 = 0;
        for($i=0;$i<count($final_array);$i++){
            $config = array(
                    'upload_path' => './images/'.$folder_name.'/',
                    'file_name' => $final_array[$i][0],
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => TRUE,
                    'max_size' => "5048000" // Can be set to particular file size , here it is 5 MB(2048 Kb)
                    
                    );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload($final_array[$i][1])){
                $s1++;
                $message = 'success';
            }else{
                $c1++;
                $message = $this->upload->display_errors();
                continue;
            }
        }
        if($s1 == $count_img){
            return 'successfully uploaded';
        }else if($c1 == $count_img){
            return $message;
        }
    }

	 public function index()
	 {
	 	# code...
	 	$data['main_cat'] = $this->basic_mol->get_all_data(array('status'=>0,'attr_type_id'=>1),"attribute_value_master");
	 	$data['class'] = $this->basic_mol->get_all_data(array('status'=>0,'attr_type_id'=>2),"attribute_value_master");
	 	$data['subj_cat'] = $this->basic_mol->get_all_data(array('status'=>0,'attr_type_id'=>3),"attribute_value_master");
	 	$data['type'] = $this->basic_mol->get_all_data(array('status'=>0,'attr_type_id'=>4),"attribute_value_master");

		$this->load->view('admin/header'); 	 	
	 	$this->load->view('admin/product/course_master',$data);
	 	$this->load->view('admin/footer');

	 }

	 public function get_course_all_data()
	 {
	 	$list = $this->course_model->get_cat_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$status=$item->course_status;
			$row[] = $no;
			$row[] = $item->course_id;
			$row[] = $item->course_main_category;
			$row[] = $item->course_class;
			$row[] = $item->course_subject_category;
			$row[] = $item->course_title;
			$row[] = $item->course_type;

			$row[] = $item->course_date_time;
			$course_id ="'".$item->course_id ."'";
			$edit_btn='';
			if($this->session->userdata('employee_roll') != 0){
                $course_tab_permission=$this->session->userdata('course_tab_permission');
                    if($course_tab_permission[2] == 1){
						$edit_btn='<button type="button" onclick="edit_course('.$course_id .');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
					}
			}
			else{
					$edit_btn='<button type="button" onclick="edit_course('.$course_id .');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
			}		

				$row[] =$edit_btn.'
					<button type="button" onclick="view_course('.$course_id .');"  class="btn waves-effect waves-light btn-xs btn-primary"><i class="ti-marker-alt"></i> View</button>

				';
				
               if($status==1){
					$row[] = '<button type="button" onclick="update_status('.$course_id.',2);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
				}
				else{
				$row[] = '<button  onclick="update_status('.$course_id.',1);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
				}
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->course_model->count_all(),
			"recordsFiltered" => $this->course_model->count_filtered(),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();


	 }

	 public function update_course_status()
	 {
	 	$data=array('course_status'=>$this->input->post('course_status'));
	 	$where=array('course_id' => $this->input->post('course_id'),);
	 	$result=$this->basic_mol->update_table($where,$data,'course_master');
	 	echo $result;
	 }


}
?>
