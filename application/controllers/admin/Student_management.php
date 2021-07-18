<?php
class Student_management extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}	
	 	$this->load->model('admin_model/student_model/student_management_model','student_model');
	 	$this->load->model('Student_model','student_modl');
		$this->current_date=date('Y-m-d H:i:s');
		$this->admin_id=$this->session->userdata('admin_id');
		
	 }

	
	
	 public function index($id)
	 {
	 	# code...
	    $data['student_id']=$id;
	 	$this->load->view('admin/header');	 	
	 	$this->load->view('admin/student/student_master',$data);
	 	$this->load->view('admin/footer');

	 }
	 public function get_student_document_details()
	 {
	 	$where=array('student_id' => $this->input->post('student_id'), );
	 	$result=(array)$this->basic_mol->exist_or_not($where,'student_master');
	 	// print_r($where);die;
	 	$result['student_bil_ICAI_proof']=base_url('images/student_proof/').$result['student_bil_ICAI_proof'];
	 	$result['student_bil_government_front']=base_url('images/student_proof/').$result['student_bil_government_front'];
	 	$result['student_bil_government_back']=base_url('images/student_proof/').$result['student_bil_government_back'];
	 	echo json_encode($result);
	 }
	 public function get_student_all_data()
	 {
	    $student_id=$this->input->post('student_id');
	    $filter= $student_id == 'all' ? '' : array('student_id'=>$student_id);
	 	$check['where']= array('user_role'=>1);
	 	$check['where2']=$filter;
	 	$list = $this->student_model->get_stud_datatables('student_detail',$check);
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
			$row[] = $item->created_at;			
			
			$student_id ="'".$item->student_id ."'";	
			// print_r($student_id);		

				
               if($status==1){
					$row[] = '<button type="button" onclick="update_status('.$student_id.',2);"  class="btn btn-success btn-xs"><i class="ti-check"></i> Active </button>';
				}
				else{
				$row[] = '<button  onclick="update_status('.$student_id.',1);" id="1" class="btn btn-danger btn-xs"><i class="ti-close"></i>  Deactive </button>';	
				}

				$row[] = '<button  onclick="view_docs('.$student_id.');"  class="btn btn-primary btn-xs"><i class="ti-view"></i>  View Documents </button>';	

				if($item->stu_bil_address_1 == ""){
					$row[] = '<button type="button" class="btn btn-danger btn-xs" disabled><i class="ti-view"></i>Not Updated</button>';
				}else{
					$row[] = '<button type="button" class="btn btn-warning btn-xs" onclick="view_address('.$student_id.');"><i class="ti-view"></i>Updated</button>';
				}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->student_model->count_all(),
			"recordsFiltered" => $this->student_model->count_filtered('student_detail',$check),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();


	 }

	 public function each_student_address(){
	 	$stud_id = $this->input->post('student_id');
	 	$where = array('stu_id' => $stud_id);
	 	$result['data'] = $this->basic_mol->get_single_data($where,'student_billing_address');
	 	echo json_encode($result['data']);
	 }

	 public function update_student_status()
	 {
	 	
	 	$data=array('student_status'=>$this->input->post('student_status'));
	 	$where=array('student_id' => $this->input->post('student_id'),);
	 	$result=$this->basic_mol->update_table($where,$data,'student_master');
	 	echo $result;
	 }

	 public function update_document_status()
	 {
	 	$data=$this->input->post();
	 	$where=array('student_id' => $this->input->post('student_id'),);
	 	$result=$this->basic_mol->update_table($where,$data,'student_master');
	 	echo $result;
	 }

 	public function order(){
 		$this->load->view('admin/header');	
	 	$this->load->view('admin/student/student_order');	
		$this->load->view('admin/footer');
 	}

 	public function transaction_report(){
 		$this->load->view('admin/header');	
	 	$this->load->view('admin/student/student_transaction');	
		$this->load->view('admin/footer');
 	}


 	public function student_order_detail(){
 		$data = $this->input->post();

 		if($data['coupon_code'] != "all"){
 			$check['where']['coupon_code'] = $data['coupon_code'];
 		}

		$check['from_date'] = $data['from_date'];
		$check['to_date'] = $data['to_date'];

		$check['where']['user_role'] = 1;
 		$list = $this->student_model->get_stud_datatables('student_order',$check);
 	
 		$order_items = $this->basic_mol->get_all_data("",'order_items');

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$coupon_code = $item->coupon_code == ""?"----":$item->coupon_code;
			$array = array();
			$no++;
			$row = array();
			$row[] = $no;			
			$row[] = $item->id;			
			$row[] = '<a href="'.base_url("students/".$item->student_id).'" class="text-black">'. $item->student_first_name.' '.$item->student_last_name.'</a>';					
			
			$order_id ="'".$item->id ."'";
			$item_track_link ="'".$item->item_track_link ."'";

			$row[] = '<button  onclick="view_order('.$order_id.');"  class="btn btn-primary btn-xs"><i class="ti-view"></i>  View Order </button>';
			$cancelled_prod = $item->cancel_reason == ""? "----":$item->cancel_reason;;

			$row[] = $item->student_email;			
			$row[] = $item->student_phone;			
			$row[] = $item->grand_total;			
			$row[] = $coupon_code;			
			/*$row[] = $item->item_track_link;			
			$row[] = $cancelled_prod;	*/		
			$row[] = $item->coupon_discount;			
			$row[] = $item->grand_total;	
			$row[] = date("d-m-Y", strtotime($item->created));	

			$row[] = '<a href="'.base_url("admin/student_management/print_pdf/".$item->id).'" target="_blank"><button class="btn btn-warning btn-xs">Load Pdf</button></a>';

			$disabled = "";
			if($item->status == 3 || $item->status == 4 ){
				$disabled = "disabled";
			}
			$action = '';
			if($item->status == 1){
				$class= 'class="btn btn-success select_element"';
			}else if($item->status == 2){
				$class= 'class="btn btn-primary select_element"';
			}else if($item->status == 3){
				$class = 'class="btn btn-warning select_element"';
			}else{
				$class= 'class="btn btn-danger select_element"';
			}

			$pending = $item->status == 1 ? "selected":"";
			$pend_disabled = $item->status == 1 ? "":"disabled";
			$on_delivery = $item->status == 2 ? "selected":"";
			$delivered = $item->status == 3 ? "selected":"";
			$canceled = $item->status == 4 ? "selected":"";

			// $status_track_link = 
			
			$action .= '<select '.$class.' '.$disabled.' id="select_element_'.$no.'" onchange="update_delivered('.$order_id.','.$item_track_link.','.$no.')">
							<option  value="1" '.$pend_disabled.' '.$pending.'>Pending</option>
                            <option value="2" '.$on_delivery.' data_attr = "on_deliver">On Delivery</option>
                            <option value="3" '.$delivered .' data_attr = "delivered">Delivered</option>
                            <option value="4" '.$canceled.' data_attr = "cancel_prod">Canceled</option>
                        </select>';

            foreach($order_items as $items){
            	if($items['order_id'] == $item->id){
            		$array[] = $items['course_mode'];
            	}
            }
			$counts = array_count_values($array);

			$tracking_status = in_array(2, $array) ? (count($array) == $counts[2] ? '<button  onclick="extend_course('.$order_id.');"  class="btn btn-primary btn-xl"><i class="ti-view"></i>  Extend Date </button>':$action):$action;

          	$row[] = $tracking_status;

        	unset($array);

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->student_model->count_all(),
			"recordsFiltered" => $this->student_model->count_filtered('student_order',$check),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		exit();
 	}

 	public function prod_on_way(){
 		$where = $this->input->post();
 		$data = array('item_track_link'=>$where['item_track_link'],'status' => 2);
 		unset($where['item_track_link']);
 		$student_detail = (array)$this->basic_mol->exist_or_not(array('student_id'=>$where["id"]),'student_master');
 		$product_detail_send = $this->send_mail_prod($data['item_track_link'],$student_detail["student_email"],"is on delivery");				//trackin_link,user_mail,message
 		$output['msg'] = 'error';
 		if($product_detail_send == "detail_send"){
 			$result = $this->basic_mol->update_table($where,$data,'orders');
 			$output['msg'] = 'success';
 		}
 		echo json_encode($output);
 	}

 	public function prod_delivered(){
 		$where = $this->input->post();
	    $data['item_track_link'] = $where['item_track_link'];
 		$data['status'] = 3;
 		$student_detail = (array)$this->basic_mol->exist_or_not(array('student_id'=>$where["id"]),'student_master');
 		$product_detail_send = $this->send_mail_prod($data['item_track_link'],$student_detail["student_email"],"has been delivered");			//trackin_link,user_mail,message
 		$output['msg'] = 'error';
 		if($product_detail_send == "detail_send"){
 			$result = $this->basic_mol->update_table(array('id'=>$where['id']),$data,'orders');
 			$output['msg'] = 'success';
 		}
 		echo json_encode($output);
 	}

 	public function send_mail_prod($trackin_link,$user_email,$message){
        include_once 'PHPMailer/PHPMailer.php';
        $tracking_link = $message == "is on delivery"?"Here is a link to track the Product Detail ".$trackin_link."":"";
        $message_body = "Welcome to RSA - CA Rahul Garg!:Your is ".$message."<br/><br/>".$tracking_link;
        $mail = new PHPMailer();
        $mail->AddReplyTo('bwebtechno1@gmail.com','RSA-CA Rahul Garg');
        $mail->SetFrom('bwebtechno1@gmail.com','RSA-CA Rahul Garg');
        $mail->AddAddress($user_email);
        $mail->Subject = "Product Detail";
        $mail->MsgHTML($message_body);
        $result = $mail->send();
        $data['msg']="detail_send";
        return $data;
 	}

 	public function cancelled_prod(){
 		$where = $this->input->post();
 		$data= array('cancel_reason'=>$where['cancel_reason'],'status' => 4);
 		unset($where['cancel_reason']);
 		$result = $this->basic_mol->update_table($where,$data,'orders');
 		echo $result;
 	}

 	public function student_transaction_detail(){
 		$data = $this->input->post();

 		// if($data['coupon_code'] != "all"){
 		// 	$check['where']['coupon_code'] = $data['coupon_code'];
 		// }

		$check['from_date'] = $data['from_date'];
		$check['to_date'] = $data['to_date'];

 		$list = $this->student_model->get_stud_datatables('student_transaction',$check);

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $no;			
			$row[] = $item->order_id;			
			$row[] = $item->student_first_name;					
			$row[] = $item->student_phone;					
			$row[] = $item->transaction_number;					
			$row[] = $item->addition_description;	

			$row[] = $item->transaction_status == 1 ? '<button class="btn btn-success btn-xm">Paid</button>':'<button class="btn btn-success btn-xm">Unpaid</button>';

			$row[] = $item->created_at;	
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->student_model->count_all(),
			"recordsFiltered" => $this->student_model->count_filtered('student_transaction',$check),
			"data" => $data,
			);

		echo json_encode($output);
		exit();
 	}
 	
 	public function view_orders(){
 		$where = $this->input->post();
 		$result = $this->student_model->order_detail($where);
 		// print_r($result);die;
 		$course_key = $this->student_model->get_all_ordered_key($where,'course_key_master');
 	
 	

 		$output ="<thead>
                    <tr>
                        <th>id</th>                                          
                        <th>Title</th> 
                        <th>Mode</th> 
                        <th>View</th> 
                        <th>Duration</th> 
                        <!-- <th>Key</th> -->
                        <th>Link</th>
                        <th>Quantity</th>                                         
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>";
 		foreach($result as $row){
 		   $google_drive_links=array();
 		   $key_array = array();
 		   if($row['course_type'] == 2)
 		   {
 		       $combo_result=$this->basic_mol->get_single_data(array('combo_id' => $row['course_id']),'combo_master');
 		       $where_in_array=json_decode($combo_result['course_id']);
 		       $where=array('course_status' => 1,);
 		       $course_result=$this->student_modl->get_data_by_multiple_id($where_in_array,$where,'course_id','course_master');
 		       
 		       foreach($course_result as $course_row)
 		       {
 		           $google_drive_links[]=$course_row['course_googledrive_link'];
 		           foreach ($course_key as $single_key) {
        	 			if($single_key['course_id'] == $course_row['course_id']){
        	 				$key_array[] = $single_key['course_key'];
        	 			}
     			    }
 		       }
 		      
 		   }
 		   else
 		   {
 		       $course_result=$this->basic_mol->get_single_data(array('course_id' => $row['course_id']),'course_master');
 		       $google_drive_links[]=$course_result['course_googledrive_link'];
 		       foreach ($course_key as $single_key) {
 		           
    	 			if($single_key['course_id'] == $row['course_id']){
    	 				$key_array[] = $single_key['course_key'];
    	 			}
	 			
 			    }
 		       
 		   }
 		   
 		   
 			$mode_res=$this->basic_mol->get_single_data(array('value_id' => $row['course_mode']),'attribute_value_master');
 			$view_res=$this->basic_mol->get_single_data(array('course_view_value_id' => $row['course_view']),'course_view_value_master');
 			$duration_res=$this->basic_mol->get_single_data(array('course_type_value_id' => $row['course_duration']),'course_type_value_master');
	 		$output.='<tr>
	                    <td>'.$row['course_id'].'</td>                                          
	                    <td>'.$row["course_title"].'</td> 
	                    <td>'.$mode_res['value'].'</td>               
	                    <td>'.$view_res['course_view_value_name'].' views</td> 
	                    <td>'.$duration_res['course_type_value_name'].' months</td> 
	                    <!--<td class="text-left">
	                    	<ul>
	                    		<div class="row">-->';
	        	
 		
            //  foreach($key_array as $key_single){
            //   $output.='	
        				// 	<div class="col-md-12 row">
        				// 		<div class="col-md-6">
		          //          		<li class="text-black">'.$key_single.'</li>
	           //         		</div>
	           //         	<div class="col-md-6">
            //         				<button class="btn btn-success btn-xs mb-2" id="extend_course" type="button">extend</button>
	           //         		</div>
            //         		</div>';

            // }
          	$output.='
      					<!--</div>
          					</ul>
  					  	</td>-->
  					  	<td class="text-left">
	                    	<ul>';
  			foreach($google_drive_links as $link){
  		    $output.='  
  		                <li class="text-black">'.$link.'</li>';
  			}
  				$output.='
          					</ul>
  					  	</td>';
	             $output.='<td>'.$row["quantity"].'</td>                                         
	                    <td>'.$row["sub_total"].'</td>
	                </tr>';
            unset($key_array);
            unset($google_drive_links);
 		}

 		$output.="</tbody>
						<script>
							$('#extend_course').click(function(e){
								e.preventDefault();
								alert('hii');	
							})
						</script>";
	
 		echo $output;
 	}
 	
 	public function extend_order(){
		$where = $this->input->post();
 		$result = $this->student_model->order_detail($where);
 		$course_key = (array)$this->basic_mol->get_all_data($where,'course_key_master');

 		$output ="<thead>
                    <tr>
                        <th>Course id</th>                                          
                        <th>Course Title</th> 
                        <th>Course Key</th> 
                        <th>Course Quantity</th>                                         
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>";
 		foreach($result as $row){
 			$key_array = array();
 			foreach ($course_key as $single_key) {
 				# code...
	 			if($single_key['course_id'] == $row['course_id']){
	 				$key_array[] = $single_key['course_key'];
	 			}
 			}

	 		$output.='<tr>
	                    <td>'.$row['course_id'].'</td>                                          
	                    <td>'.$row["course_title"].'</td> 
	                    <td class="text-left">
	                    	<ul>';
            foreach($key_array as $key_single){
            $output.='	
		                    <li class="text-black">'.$key_single.'</li>';

            }
          	$output.='
          					</ul>
  					  	</td>
	                    <td>'.$row["quantity"].'</td>                                         
	                    <td>'.$row["sub_total"].'</td>
	                </tr>';
            unset($key_array);
 		}

 		$output.="</tbody>";
     //            <td>
     //                	<input type="radio" id="day_45'.$row['course_id'].'" name="extend_date" value="45 days">
					// 	<label for="day_45'.$row['course_id'].'">45 Days</label><br>
					// 	<input type="radio" id="day_90'.$row['course_id'].'" name="extend_date" value="90 days">
					// 	<label for="day_90'.$row['course_id'].'">90 Days</label><br>	
					// </td>
					// <td>
					// 	<button  onclick="extend_date('.$row['course_id'].');" id="1" class="btn btn-warning btn-xs"> Submit </button>
					// </td>
 		
 		echo $output;
 	}
 	
 	public function print_pdf(){
 		$order_id=$this->uri->segment(4);
 		$items = $this->basic_mol->get_all_data(array('order_id'=>$order_id),'order_items');
 		$item_discount = $this->basic_mol->get_single_data(array('id'=>$order_id),'orders');
 		$billing_address = $this->student_model->student_detail($item_discount['student_id']);

 		$output = "";


	  $output.= '<!DOCTYPE html>
					<html lang="en">

					<head>
					    <meta charset="UTF-8">
					    <meta name="viewport" content="width=device-width, initial-scale=1.0">
					    <meta http-equiv="X-UA-Compatible" content="ie=edge">
					    <title>Document</title>
					    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
					    <link rel="stylesheet" href='.base_url("assets/css/pdf.css").' />
					    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
					    <script
					              src="https://code.jquery.com/jquery-2.2.4.min.js"
					              integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
					              crossorigin="anonymous"></script>

					</head>

					<body>
					    <div class="container d-flex justify-content-center mt-50 mb-50">
					        <div class="row">
					            <div class="col-md-12">
					                <div class="cards" id="invoice">
					                    <div class="cards-header bg-transparent header-elements-inline">
					                        <h6 class="cards-title text-primary">Sale invoice</h6>
					                    </div>
					                    <div class="cards-body">
					                        <div class="row">
					                            <div class="col-sm-6">
					                                <div class="mb-4 pull-left">

					                                    <ul class="list list-unstyled mb-0 text-left">
					                                        <li>A2 1807 Omkar building</li>
					                                        <li>kurar police station</li>
					                                        <li>Malad east</li>
					                                        <li>Mumbai 400097</li>
					                                    </ul>
					                                </div>
					                            </div>
					                            <div class="col-sm-6">
					                                <div class="mb-4 ">
					                                    <div class="text-sm-right">
					                                        <h4 class="invoice-color mb-2 mt-md-2">Invoice</h4>
					                                        <ul class="list list-unstyled mb-0">
					                                            <li>Date: <span class="font-weight-semibold">March 15, 2020</span></li>
					                                            <li>invoice: <span class="font-weight-semibold">412536xxx</span></li>
					                                            <li>Due date: <span class="font-weight-semibold">March 30, 2020</span></li>
					                                        </ul>
					                                    </div>
					                                </div>
					                            </div>
					                        </div><br/>
					                        <div class="row">
					                            <div class="col-sm-6">
					                                <div class="mb-4 pull-left">
					                                    <div class="mb-4 mb-md-2 text-left"> <span class="text-muted">Invoice To:</span>
					                                        <ul class="list list-unstyled mb-0">
					                                            <li>
					                                                <h5 class="my-2">'.$billing_address["student_first_name"].' '.$billing_address["student_last_name"].'</h5>
					                                            </li>
					                                            <li>'.$billing_address["stu_bil_address_1"].'</li>
					                                            <li>'.$billing_address["stu_bil_address_2"].'</li>
					                                            <li>'.$billing_address["stu_bil_ciy"].' '.$billing_address["stu_bil_pin"].'</li>
					                                            <li>state: '.$billing_address["stu_bil_state"].'</li>
					                                            <li><a href="https://mail.google.com/mail/?view=cm&fs=1&to='.$billing_address["student_email"].'">'.$billing_address["student_email"].'</a></li>
					                                        </ul>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="table-responsive">
					                        <table class="table table-lg">
					                            <thead>
					                                <tr>
					                                    <th>Description</th>
					                                    <th>Quantity</th>
					                                    <th>Unit Price</th>
					                                    <th>Total</th>
					                                </tr>
					                            </thead>
					                            <tbody>';
			                            $sub_total = "";
			                            foreach($items as $row){
			                            	$type = $row['course_type'] == 1?"courses":"combo courses";
						                    $output.=   '<tr>
						                                    <td>
						                                        <h6 class="mb-0">'.$row["course_title"].'</h6> <span class="text-muted">'.$type.'</span>
						                                    </td>
						                                    <td>'.$row["quantity"].'</td>
						                                    <td>'.$row["sub_total"]/$row["quantity"].'</td>
						                                    <td><span class="font-weight-semibold">'.$row["sub_total"].'</span></td>
						                                </tr>';
			                                if($sub_total == ""){
			                                	$sub_total = $row['sub_total'];
			                                }else{
			                                	$sub_total = $sub_total+$row['sub_total'];
			                                } 
			                            }
			                            
					                    $output.='
					                            </tbody>
					                        </table>
					                    </div>
					                    <div class="cards-body">
					                        <div class="d-md-flex flex-md-wrap">
					                            <div class="pt-2 mb-3 wmin-md-400 ml-auto">
					                                <div class="table-responsive">
					                                    <table class="table">
					                                        <tbody>
					                                            <tr>
					                                                <th class="text-left">Subtotal:</th>
					                                                <td class="text-right">'.$sub_total.'</td>
					                                            </tr>
					                                            <tr>
					                                                <th class="text-left">Discount: <span class="font-weight-normal">('.($item_discount['coupon_discount']/$sub_total*100).')</span></th>
					                                                <td class="text-right">'.$item_discount['coupon_discount'].'</td>
					                                            </tr>
					                                            <tr>
					                                                <th class="text-left">Total:</th>
					                                                <td class="text-right text-primary">
					                                                    <h5 class="font-weight-semibold">'.$item_discount['grand_total'].'</h5>
					                                                </td>
					                                            </tr>
					                                        </tbody>
					                                    </table>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="cards-footer"> <span class="text-muted">Lorem ipsum dolor sit amet, consectetur
					                            adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
					                            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					                            consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
					                            fugiat nulla pariatur.Duis aute irure dolor in reprehenderit</span> </div>
					                </div>
					            </div>
					        </div>
					    </div>
					</body>

					</html>
					<script>
			        	const invoice = $("#invoice").html();
			            var opt = {
			                margin: 1,
			                filename: "myfile.pdf",
			                image: { type: "jpeg", quality: 0.98 },
			                html2canvas: { scale: 2 },
			                jsPDF: { unit: "in", format: "letter", orientation: "portrait" }
			            };
			            html2pdf().from(invoice).set(opt).save();
					</script>';
			echo $output;
 	}
}
?>
