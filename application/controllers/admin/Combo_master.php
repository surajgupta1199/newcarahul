<?php
class Combo_master extends CI_Controller{
	public $current_date='';
	function __construct()
	{
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}	
	 	$this->load->model('admin_model/product_model/Combo_model','combo_model');
		$this->current_date = date('Y-m-d H:i:s');
		$this->employee_id = $this->session->userdata('employee_id');
		$this->table = " combo_master";
		$this->tbl_course_type_value="course_type_value_master";
	}

	public function index()
	{
	 	# code...

	 	$data['main_cat'] = $this->basic_mol->get_all_data(array('status'=>0,'attr_type_id'=>1),"attribute_value_master");
	 	$data['class'] = $this->basic_mol->get_all_data(array('status'=>0,'attr_type_id'=>2),"attribute_value_master");
	 	$data['subj_cat'] = $this->basic_mol->get_all_data(array('status'=>0,'attr_type_id'=>3),"attribute_value_master");
	 	$data['type'] = $this->basic_mol->get_all_data(array('status'=>0,'attr_type_id'=>4),"attribute_value_master");

	 	$data['show_js_css']="table";
	 	$this->load->view('admin/header',$data);	 	
	 	$this->load->view('admin/product/combo_master');
	 	$this->load->view('admin/footer');
	}

	public function fetch_course(){
		// $result['value'] = $sub_cat_id;
		$add_edit = $this->uri->segment(4);
		
		$where['sub_cat_id'] = $this->input->post('cat_id_value');
		$where['class'] = $this->input->post('class');
		$where['main_cat'] = $this->input->post('main_cat');
		$result['edit_add'] = $add_edit == 'add_course' ? 'add_course':'edit_course';
		$result['data'] = $this->combo_model->get_part_data("course_master",$where,array('course_status' => 1)); //1 status active
		echo $this->load->view('show_courses',$result,true);
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
		                        <input type="text" spellcheck="true" class="form-control only_number combo_amount" name="course_mode['.$row["course_type_value_id"].']['.$mode["value_id"].']['.$view["course_view_value_id"].']" id="course_price'.$no.'"  value="">
		                        <label class="required_field"></label> 
		                    </div>
		                    <div class="col-md-6">
		                        <h5 class="m-t-30 m-b-10"> Discounted Price</h5>
		                        <input type="text" spellcheck="true" class="form-control only_number" name="course_mode_discount['.$row["course_type_value_id"].']['.$mode["value_id"].']['.$view["course_view_value_id"].']" value="" id="course_discount'.$no.'" >
		                        <label class="required_field"></label> 
		                    </div>';
		 		}
		 	}
		}

	 	
	 	echo json_encode($plans);
	 }

	public function add_combo_course(){
		$data = $this->input->post();

 		$output['message'] = "Combo name already exists";
		$output['type'] = "error";

		if(empty($this->basic_mol->exist_or_not(array('combo_title'=>$data['combo_title']),"combo_master"))){
			$last_id = $this->combo_model->get_last_data($this->table,'combo_id','combo_id','DESC');
			if(empty($last_id)){
				$last_id['combo_id'] = 0;
			}
			$price_master = array();

			$data['course_id'] = json_encode(explode(',',$data['course_id']));
			$data['subject_category'] = json_encode(explode(',',$data['subject_category']));

			$combo_banner = ($last_id['combo_id']+1).'_combo_image.jpg';
			$final_array= array();
			$array_1 = array($combo_banner,'combo_banner');
			array_push($final_array,$array_1);
			$result = $this->upload_img($final_array,'combo_banner');

			$output['message'] = $result;
			$output['type'] = "error";

			if($result == 'successfully uploaded'){
	            $data['combo_banner_img'] = $combo_banner;
	            $data['combo_date_time'] = $this->current_date;
	            $data['added_by'] = $this->employee_id;

	            $course_mode = $data['course_mode'];
		 		$course_mode_discount = $data['course_mode_discount'];
		 		unset($data['course_mode'],$data['course_mode_discount']);

	            $return_id = $this->basic_mol->insert($data,$this->table);

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
													'course_type' => 2,
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

				$output['message'] = "Combo successfully inserted";
				$output['type'] = "success";
	        }
	    }

        echo json_encode($output);
	}


	public function edit_combo(){
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
											'course_id' =>$data['combo_id'],
											'course_type_value_id' => $key,
											'course_mode' => $mode,
											'course_view' => $view,
											'course_price' => $price,
											'course_type' => 2,
											'course_discount_price' => $discounted_price
										);	
					}		
				}
			}	
		}

		$where = array(	
			'combo_id' => $data['combo_id']);

		$where_del = array('course_id' => $data['combo_id'],
							'course_type' => 2);

		$data['subject_category'] = json_encode(explode(',',$data['subject_category']));
		$data['course_id'] = json_encode(explode(',',$data['course_id']));

    	$data['updated_on'] = $this->current_date;
    	$data['updated_by'] = $this->employee_id;
		$combo_banner = $data['combo_id'].'_combo_image.jpg';

		$final_array= array();
		$array_1 = array($combo_banner,'combo_banner');
		array_push($final_array,$array_1);
		$result = $this->upload_img($final_array,'combo_banner');

		$output['message'] = "Combo Course name already exists";
		$output['type'] = "error";

		if(empty($this->basic_mol->edit_exist_or_not(array('combo_title'=>$data['combo_title']),$where,'combo_master'))){			//$where , $where_in, $table
			$output['message'] = "error while updating combo courses";
			$output['type'] = "error";
			if($result == 'successfully uploaded'){
	            $data['combo_banner_img'] = $combo_banner;

	            $update = $this->basic_mol->update_table($where,$data,$this->table);

	            $delete_data = $this->basic_mol->delete($where_del,'course_price_master');

				$i=1;

				foreach($price_master as $row){
					$result = $this->basic_mol->insert($row,"course_price_master");
					$i++;
				}

				$output['message'] = "Course successfully inserted";
				$output['type'] = "success";
	            
	        }else if('You did not select a file to upload'){

	            $update = $this->basic_mol->update_table($where,$data,$this->table);

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

	 public function get_combo_details()
	 {
	 	$where = $this->input->post();

		$data=$this->combo_model->get_particular_data($where,'combo_master');
		$data['combo_banner']=base_url('images/combo_banner/').$data['combo_banner_img'];
		$data['combo_status'] = $data['combo_status'] == 1?"active":"deactive";

		$data['subcat_id_string'] = implode(',',json_decode($data['subject_category']));
		$data['course_id_string'] = implode(',',json_decode($data['course_id']));

		$data['value_main_cat_id'] = $this->combo_model->get_attr_name('attribute_value_master',$data['main_category'],"value_id",'');
		$data['value_sub_class_id'] = $this->combo_model->get_attr_name('attribute_value_master',$data['class'],"value_id",'');
		$data['sub_cat_id'] = $this->combo_model->get_attr_name('attribute_value_master',json_decode($data['subject_category']),"value_id",'implode');
		$data['course_detail'] = $this->combo_model->get_attr_name('course_master',json_decode($data['course_id']),"course_id",'implode');

		$data['availability'] = $this->combo_model->fetch_combo_availibity_view(array('course_id'=>$where['combo_id'],'course_type'=>2),'course_mode','course_price_master');
		$data['view'] = $this->combo_model->fetch_combo_availibity_view(array('course_id'=>$where['combo_id'],'course_type'=>2),'course_view','course_price_master');

		$data['full_course_detail'] = $this->combo_model->get_full_part_course_data(array('course_id'=>$where['combo_id'],'course_type'=>2),'course_price_master');

		$course_price = $this->combo_model->get_particular_courses_data(array('course_id'=>$where['combo_id'],'course_type'=>2),'course_price_master');
		$course_mode = $this->combo_model->get_particular_mode(array('course_id'=>$where['combo_id'],'course_type'=>2),'course_price_master');

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

		echo json_encode($data);
	 }

	 public function get_course_all_data()
	 {
	 	$list = $this->combo_model->get_cat_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$status=$item->combo_status;
			$row[] = $no;			
			$row[] = $item->combo_title;
			$row[] = $item->course_type;		
			$row[] = $item->combo_date_time;			
			$combo_title="'".$item->combo_title."'";
			$combo_id ="'".$item->combo_id ."'";		
			$edit_btn='';
			if($this->session->userdata('employee_roll') != 0){
                $course_tab_permission=$this->session->userdata('course_tab_permission');
                    if($course_tab_permission[2] == 1){
						$edit_btn='<button type="button" onclick="edit_combo('.$combo_id .');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
					}
			}
			else{
				$edit_btn='<button type="button" onclick="edit_combo('.$combo_id .');"  class="btn waves-effect waves-light btn-xs btn-info"><i class="ti-marker-alt"></i> Edit</button>';
			}			

				$row[] =$edit_btn. '<button type="button" onclick="view_combo('.$combo_id .');"  class="btn waves-effect waves-light btn-xs btn-primary"><i class="ti-marker-alt"></i> View</button>';
               if($status==1){
					$row[] = '<button type="button" onclick="update_status('.$combo_id.',0);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
				}
				else{
				$row[] = '<button  onclick="update_status('.$combo_id.',1);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
				}
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->combo_model->count_all(),
			"recordsFiltered" => $this->combo_model->count_filtered(),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();


	 }

	 public function update_combo_status()
	 {
	 	
	 	$data=array('combo_status'=>$this->input->post('combo_status'));
	 	$where=array('combo_id' => $this->input->post('combo_id'),);
	 	$result=$this->basic_mol->update_table($where,$data,'combo_master');
	 	echo $result;
	}

	public function demo(){

		$this->load->view('demo');
	}


}
?>
