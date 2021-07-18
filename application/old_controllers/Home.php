<?php
class Home extends CI_Controller{
	public function __construct(){
        parent::__construct();
      
        $this->load->library('cart');
        $this->load->library("pagination");
        $this->current_date=date('Y-m-d H:i:s');
        $this->load->model('admin_model/User_model','user_modl');
        $this->load->model('Student_model','student_modl');
        $this->load->model('Basic_model','basic');
        $this->attr_val_tbl = "attribute_value_master";
        $this->course = "course_master";
        $this->combo = "combo_master";
        $this->student_master="student_master";
        $this->cart_tbl = "cart_master";
        $this->table = "student_master";
        $this->course_key="course_key_master";
    }

	function index(){
	    $data['active_route'] = 'index';
	    $data['banner_image'] = $this->basic_mol->get_all_data(array('status'=>0),'front_img_banner_master');
		$this->load->view('home/header',$data);
		$this->load->view('home/index');
		$this->load->view('home/footer');
	}

	function about(){
	    $data['active_route'] = 'about';
		$this->load->view('home/header',$data);
		$this->load->view('home/about');
		$this->load->view('home/footer');
	}

	function gallery(){
	    $data['active_route'] = 'gallery';
		$this->load->view('home/header',$data);
		$this->load->view('home/gallery');
		$this->load->view('home/footer');
	}

	function faq(){
	    $data['active_route'] = 'faq';
		$this->load->view('home/header',$data);
		$this->load->view('home/faq');
		$this->load->view('home/footer');
	}

	function csr(){
	    $data['active_route'] = 'csr';
		$this->load->view('home/header',$data);
		$this->load->view('home/csr');
		$this->load->view('home/footer');
	}

	function page_not_found(){
	    $data['active_route'] = 'page_not_found';
		$this->load->view('home/404');
	}

	function course(){
	    $data['active_route'] = 'course';
		$where = array(
			'cat_status' => 1);
		$result['main_category'] = $this->basic_mol->get_all_data(array('attr_type_id'=>1,'status'=>0),'attribute_value_master');
		$result['sub_category'] = $this->basic_mol->get_all_data(array('attr_type_id'=>3,'status'=>0),'attribute_value_master');
		$result['class'] = $this->basic_mol->get_all_data(array('attr_type_id'=>2,'status'=>0),'attribute_value_master');
		$result['course_type'] = $this->basic_mol->get_all_data(array('attr_type_id'=>4,'status'=>0),'attribute_value_master');
		$this->load->view('home/header',$data);
		$this->load->view('home/courses',$result);
		$this->load->view('home/footer');
	}
	
	function freecourse(){
	    $data['active_route'] = 'freecourse';
		$where = array(
			'cat_status' => 1);
		$result['data'] = $this->basic_mol->get_all_data($where,$this->course_cat);
		$this->load->view('home/header',$data);
		$this->load->view('home/courses',$result);
		$this->load->view('home/footer');
	}

    function combo(){
        $data['active_route'] = 'course';
		$this->load->view('home/header',$data);
		$this->load->view('home/combo');
		$this->load->view('home/footer');
	}

	function product_detail(){
	    $data['active_route'] = 'course';
		$product_id = $this->uri->segment(4);
		$product_type= $this->uri->segment(3);
		$prod_type= $product_type == 'course'? 1 : 2;
		$product_result= $this->basic_mol->get_all_data(array($product_type.'_id' =>  $product_id,),$product_type.'_master');
		$category_result=$this->student_modl->get_data_by_multiple_id(json_decode($product_result[0]['subject_category']),array('status'=>0),'value_id',$this->attr_val_tbl);
		$category_names=array();
		foreach ($category_result as $category) {
			$category_names[]=$category['value'];
		}
		$data['product_details']=array(
					'product_id'		  => $product_result[0][$product_type.'_id'],
					'product_type'		  => $prod_type,
					'product_title'		  => $product_result[0][$product_type.'_title'],
					'product_category'	  => implode(" , ",$category_names),
					'product_image'		  => base_url("images/".$product_type."_banner/".$product_result[0][''.$product_type.'_banner_img'].""),
					'type'				  => $product_result[0]['course_type_id'],
					'product_description' => $product_result[0][$product_type.'_description'],
					'product_duration'	  => $product_result[0]['duration_'.$product_type],
					'number_of_questions' => $product_result[0]['number_question'],
					'question_coverage'	  => $product_result[0]['coverage_question'],
					'theory_coverage'	  => $product_result[0]['theory_coverage'],
					'suitable_for'		  => $product_result[0]['suitable_for'],
					'demo_lecture_link'	  => $product_result[0]['demo_lecture_link']

				);
		if($product_type=='combo')
		{
			$data['combo_course_list']=$this->student_modl->get_data_by_multiple_id(json_decode($product_result[0]['course_id']),array('course_status'=>1),'course_id',$this->course);

		}
		$where = array('product_id' => $product_result[0]["".$product_type."_id"],
		'product_type'	=> $prod_type
	    );
		$fetch_data='student_first_name,student_last_name,student_profile,rating_count,rating_review,rated_on';
		$modal_data=array(
	          'select_coloumns' =>  $fetch_data,
	          'where_condition1' => $where,
	          'where_condition2' => '',
	          'where_condition3' => '',
	          'where_condition4' => '',
	          'table' => 'rating_master',
		 );
		$join_data=array(
					'join_table'		=> $this->student_master,
					'join_condition'	=> 'student_master.student_id = rating_master.student_id',
					'join_table2'		=> '',
					'join_condition2'	=>  '',
					'join_table3'        => '',
	                'join_condition3'    => '',
	                'join_table4'        => '',
	                'join_condition4'    => '', );
		$data['review_results']=$this->student_modl->get_all_data($modal_data,$join_data);
		
		$total_count=0;
		foreach ($data['review_results'] as $review_row) {
			$total_count += $review_row['rating_count'];
		}
		$data['total_user_review_count']=0;
		$data['average_count']=0;
		if(count($data['review_results'])>0)
		{
			$data['total_user_review_count']=count($data['review_results']);
		    $average_rating=$total_count/count($data['review_results']);
			$data['average_count']=number_format((float)$average_rating, 1, '.', '');
			$where=array(
							'product_id' => $product_id,
							'product_type' => $prod_type
						);
			$stars_count_res=$this->student_modl->get_starwise_count($where,'rating_master');
			foreach ($stars_count_res as $key => $stars_row) {
				$value[$stars_row['stars']]['total_rating'] = $stars_row['star_count'];
				$value[$stars_row['stars']]['in_percent'] = (($stars_row['star_count']/count($data['review_results'])))*100;
				$star_key[] = $stars_row['stars'];
			}
			$rating_not_given = array_diff(range(1,5),$star_key);
			foreach ($rating_not_given as $row) {
				$array3[$row]['total_rating'] = 0;
				$array3[$row]['in_percent'] = 0;
			}
			$sort = array_replace($value,$array3);
			Ksort($sort);

			$data['final_stars_count']=$sort;
		}
		$data['availability'] = $this->student_modl->fetch_course_availibity_view(array('course_id' => $product_id ,'course_type'	=> $prod_type),'course_mode','course_price_master');
		$data['view'] = $this->student_modl->fetch_course_availibity_view(array('course_id' => $product_id ,'course_type'	=> $prod_type),'course_view','course_price_master');
		$data['mode_drp_data'] = $this->basic_mol->get_all_data(array('attr_type_id'=>5,'status'=>0),'attribute_value_master');
		$data['plan_drp_data'] = $this->basic_mol->get_all_data(array('course_type_id'	=>	$product_result[0]['course_type_id']),'course_type_value_master'); 
		$data['views_drp_data'] = $this->basic_mol->get_all_data(array('attr_type_id'=>6,'status'=>0),'attribute_value_master');
		$this->load->view('home/header',$data);
		$this->load->view('home/course-detail');
		$this->load->view('home/footer');
	}

   function set_prices_onload(){
   		$where = $this->input->post();
		$price_res = $this->student_modl->get_min_prod_price($where,'course_price_master');
		if($price_res)
		{
			$data['course_price']=$price_res['course_price'];
			$data['course_dicounted_price']=$price_res['course_discount_price'];
			$actual_course_price= 100 - (($price_res['course_discount_price'] / $price_res['course_price']) * 100);
			$data['course_save_price'] = number_format((float)$actual_course_price, 2, '.', '');
			$data['course_mode']=$price_res['course_mode'];
			$data['course_type_value_id']=$price_res['course_type_value_id'];
			$data['course_view']=$price_res['course_view'];
		}

	    echo json_encode($data);
   }
   function get_cart_btn_status()
   {
   		$where=$this->input->post();
		$this->user_id =  $this->session->userdata('student_id');
	    $where['student_id']=$this->user_id;
		$data['msg']= 'error';
	    if(empty($this->basic_mol->exist_or_not($where,$this->cart_tbl)))
	    {
	    	$data['msg']= 'success';
	    }
	    echo json_encode($data);
   }
   function  set_prices()
	{
		$data=array();
		$product_data=$this->input->post();
		 
		$where=$this->input->post();
		unset($where['product_quantity']);
		
		$mode_results=$this->basic_mol->get_all_data($where,'course_price_master');

		
		if($mode_results)
		{
			if($product_data['course_type'] == 1)
            {

            	$where=array(
            					'course_id'	=>	$product_data['course_id'],
            					'course_view' 	=>	$product_data['course_view'],
            					'course_duration' 	=>	$product_data['course_type_value_id'],
            					'student_id'		=>	'',
            				);
            	$coloumn_name="course_key_id";
            	$total_keys=$this->student_modl->count_total_rows($coloumn_name,$where,$this->course_key);
            	
            	
            	if($product_data['product_quantity'] <= $total_keys)
            	{
            		
            			$data['msg']="success";
            		
            	}
            	else
            	{
            		$data['msg']="not available";
            		
            	}
            }
	        else
	        {
	        	$where=array('combo_id'	=> $product_data['course_id']);
	        	$combo_result=$this->basic->get_single_data($where,$this->combo);
	        	$course_ids=json_decode($combo_result['course_id']);
	        	$total_keys=0;
	        	$status=array();
	        	foreach ($course_ids as $course_id) {

	        		$where=array(
	        					'course_id'	=>	$course_id,
	        					'course_view' 	=>	$product_data['course_view'],
	        					'course_duration' 	=>	$product_data['course_type_value_id'],
	        					'student_id'		=>	'',
	        				);
	            	$coloumn_name="course_key_id";
	            	$total_keys =$this->student_modl->count_total_rows($coloumn_name,$where,$this->course_key);

	            	if($product_data['product_quantity'] <= $total_keys)
	        		{
	        			$status[]= "available";
	        		}
	        		else
	        		{
	        			$status[]= "not_available";
	        		}
	        	}

			      if(in_array("not_available", $status))
			      {
			      	$data['msg']="not available";
			      }
			      else
			      {
			      	$data['msg']="success";
			      }
	        }


			$data['course_price']=$mode_results[0]['course_price'];
			$data['course_dicounted_price']=$mode_results[0]['course_discount_price'];
			$actual_course_price= 100 - (($mode_results[0]['course_discount_price'] / $mode_results[0]['course_price']) * 100);
			$data['course_save_price'] = number_format((float)$actual_course_price, 2, '.', '');
		}

		echo json_encode($data);
	}
	function addToCart(){
	    
		$qty=$this->input->post('product_quantity');
		$msg_data=array();	
        $data =$this->input->post();
		if($this->session->userdata('student_id') != ''){
			
            $this->user_id =  $this->session->userdata('student_id');

            if($data['product_type'] == 1)
            {

            	$where=array(
            					'course_id'	=>	$data['product_id'],
            					'course_view' 	=>	$data['product_views'],
            					'course_duration' 	=>	$data['product_validity'],
            					'student_id'		=>	'',
            				);
            	$coloumn_name="course_key_id";
            	$total_keys=$this->student_modl->count_total_rows($coloumn_name,$where,$this->course_key);
            	if($data['product_quantity'] <= $total_keys)
            	{
            		$data['student_id']=$this->user_id;
		            $data['added_on']=$this->current_date;
		            $cart_result=$this->basic_mol->insert($data,$this->cart_tbl);
			            if($cart_result)
			            {
			            	
			            	$msg_data['msg']='success';
			            	$initial_cart_count=$this->session->userdata('cart_item_count');
			                $updated_count=$initial_cart_count+$qty;

			                $count_item=array('cart_item_count' =>  $updated_count);
			                $this->session->set_userdata($count_item);
			            }
            	}
            	else
            	{
            		$data['msg']="not available";
            		
            	}
            }
            else
            {
            	$where=array('combo_id'	=> $data['product_id']);
            	$combo_result=$this->basic->get_single_data($where,$this->combo);
            	$course_ids=json_decode($combo_result['course_id']);
            	$total_keys=0;
            	$status=array();
            	foreach ($course_ids as $course_id) {

            		$where=array(
            					'course_id'	=>	$course_id,
            					'course_view' 	=>	$data['product_views'],
            					'course_duration' 	=>	$data['product_validity'],
            					'student_id'		=>	'',
            				);
	            	$coloumn_name="course_key_id";
	            	$total_keys =$this->student_modl->count_total_rows($coloumn_name,$where,$this->course_key);
	            	if($data['product_quantity'] <= $total_keys)
	        		{
	        			$status[]= "available";
	        		}
	        		else
	        		{
	        			$status[]= "not_available";
	        		}
            	}
            	
            		 if(in_array("not_available", $status))
				      {
				      	$data['msg']="not available";
				      }
				      else
				      {
				      	$data['student_id']=$this->user_id;
			            $data['added_on']=$this->current_date;
			            $cart_result=$this->basic_mol->insert($data,$this->cart_tbl);
				            if($cart_result)
				            {
				            	
				            	$msg_data['msg']='success';
				            	$initial_cart_count=$this->session->userdata('cart_item_count');
				                $updated_count=$initial_cart_count+$qty;

				                $count_item=array('cart_item_count' =>  $updated_count);
				                $this->session->set_userdata($count_item);
				            }
				      }

	            	
            }
            
        }
        else
        {
		        	 // Fetch specific course by ID
		       $where = array(
					'course_id' => $product_id);
		       $course = $this->basic_mol->get_single_data($where,$this->course);
		       $course_price=$price_type == 'Googledrive Price' ? $course['course_googledrive_price'] : $course['course_pendrive_price'];
		       $prive_type_value=$price_type == 'Googledrive Price' ? 1 : 2;
		        // Add product to the cart
		       $type=$course['course_type_id'] == 1 ? 'Regular' : 'Fast Track';
		        $data = array(
		            'id'    => $course['course_id'],	
		            'qty'   => $qty,
		            'price_type'=>$prive_type_value,
		            'price' => $course_price,
		            'type'	=> $type,
		            'name'  => $course['course_title'],
		            'image' => $course['course_banner_img']
		        );
		        
		        
		        if($course)
		        {
		        	$this->cart->insert($data);
		        	
		        	 $msg_data['msg']='success';
		        }
        }
		
       

        echo json_encode($msg_data);
    }

	function contact(){
	    $data['active_route'] = 'contact';
		$this->load->view('home/header',$data);
		$this->load->view('home/contact_html');
		$this->load->view('home/footer');
	}

	function privacy(){
	    $data['active_route'] = 'privacy';
		$this->load->view('home/header',$data);
		$this->load->view('home/privacy');
		$this->load->view('home/footer');
	}

    function login(){
        $data['student_email'] = $this->input->post('student_email');
        $data['student_password'] = md5($this->input->post('student_password'));
        $where = array(
            'student_email' => $data['student_email'],
            'student_password' => $data['student_password']
        );
        $check_email_pass =(array)$this->basic->exist_or_not($where,$this->student_master);
        if($check_email_pass){
            if($check_email_pass['student_status'] !=1){
                $dataa['msg'] = 'deactive';
            }else{
               
            $this->session->set_userdata($check_email_pass);
            $dataa['msg'] = 'success';
            // $this->user_id =  $this->session->userdata('student_id');
            // $cart_data['cart_items']=$this->cart->contents();
            // foreach ($cart_data['cart_items'] as $row) {
                
            //     $data = array(
            //                 'student_id' => $this->user_id ,
            //                 'course_id'  => $row['id'],
            //                 'course_quantity' => $row['qty'],
            //                 'course_price_type' => $row['price_type'],
            //                 'added_on'          => $this->current_date
            //     );
                 
            //     $where=array('course_id' => $row['id'],
            //             'student_id'=>$this->user_id, );
            //     if(empty($this->basic_mol->exist_or_not($where,$this->cart_tbl))){
            //         $cart_result=$this->basic_mol->insert($data,$this->cart_tbl);
            //     }
                
            // }
            
            $this->user_id =  $this->session->userdata('student_id');
            $where = array(
            'student_id' => $this->user_id);
            $cart_items_res=$this->basic_mol->get_all_data($where,$this->cart_tbl);
            $quantity=0;
            for($i=0;$i<count($cart_items_res);$i++){
                $quantity += $cart_items_res[$i]['product_quantity'];
            }
            $count_item=array('cart_item_count' =>  $quantity);
            $this->session->set_userdata($count_item); 
            }
        }else{
            $dataa['msg'] = 'error';
        }
        echo json_encode($dataa);
    }

    function sign_up(){
        $data = $this->input->post();
        $data['student_password'] = md5($this->input->post('student_password'));
        unset($data['cnf_student_password']);
        $where = array(
            'student_email' => $data['student_email']
        );
        $dup_email = $this->basic->exist_or_not($where,$this->student_master);
        if($dup_email){
            $dataa['msg'] = 'email exist';
        }else{
            $result = $this->basic->insert($data,$this->student_master);
            $dataa['msg'] = 'error';
            if($result){
                $dataa['msg'] = 'success';
            }
        }
        echo json_encode($dataa);
    }
    
    function reset_password(){
        $data = $this->input->post();
        $where = array(
            'student_email' => $data['student_email']
        );
        $dup_email = $this->basic->exist_or_not($where,$this->table);
        $dataa['msg'] = 'error';
        if($dup_email){
            $otp = rand(100000,999999);
            $email_status = $this->sendOTP($data['student_email'],$otp);
            $dataa['msg'] = 'error';
            if($email_status['msg'] == 'otp_send'){
                $otp_insert = $this->student_modl->otp_create($otp,1);
                $dataa['msg'] = 'success';
            }
        }
        echo json_encode($dataa);
    }
    
    public function set_password(){
        $email = $this->input->post('email');
        $data['student_password'] = md5($this->input->post('password'));
        $where = array(
            'student_email' => $email);
        $result = $this->basic->update_table($where,$data,$this->table);
        echo $result;
    }
    
    public function sendOTP($email,$otp){
        include_once 'PHPMailer/PHPMailer.php';
        $message_body = "Welcome to RSA - CA Rahul Garg!:Your Verification Number To Complete Your Registration is:<br/><br/>".$otp;
        $mail = new PHPMailer();
        $mail->AddReplyTo('bwebtechno1@gmail.com','RSA-CA Rahul Garg');
        $mail->SetFrom('bwebtechno1@gmail.com','RSA-CA Rahul Garg');
        $mail->AddAddress($email);
        $mail->Subject = "otp to login";
        $mail->MsgHTML($message_body);
        $result = $mail->send();
        $data['msg']="otp_send";
        return $data;
    }
    
    function check_otp(){
        $data = $this->input->post();
        $result = $this->student_modl->otp_verification($data['check_otp'],array('type'=>$data['type']));
        if($result){
            $dat['is_expired'] = 1;
            $where = array(
                'otp' => $data['check_otp']);
            $update_otp_status = $this->basic->update_table($where,$dat,'otp_pass_reset');
            $dataa['msg'] = 'success';
        }else{
            $dataa['msg'] = 'error';
        }
        echo json_encode($dataa);
    }
    
    public function check_email(){
    	$where = $this->input->post();
    	$dup_email = $this->basic->exist_or_not($where,$this->table);
        if($dup_email){
            $dataa['msg'] = 'error';
        }else{
        	$otp = rand(100000,999999);
            $email_status = $this->sendOTP($where['student_email'],$otp);
            $otp_insert = $this->student_modl->otp_create($otp,2);
            $dataa['msg'] = 'success';
        }
        echo json_encode($dataa);
    }

    function where_input($where){
    	foreach ($where as $key => $value) {
	   		# code...
	   		if($value == ""){
	   			unset($where[$key]);
	   		}
	   	}
	   	return $where;
    }

    function fetch_course(){
	   	$search_title=$_GET['search_title'];
	   	$iten_id=$_GET['subject_category'];
	   	$class_id=$_GET['class'];
	   	$main_cat_id=$_GET['main_category'];
	   	$filter=$_GET['filter'];
	   	if($iten_id == "all"){
	   		if($filter == "all"){
	   			$where['main_category'] = $main_cat_id == "" ? "":$main_cat_id;
	   			$where['class'] = $class_id =="" ? "":$class_id;
			   	$where_course = $this->where_input($where);
			   	$where_combo = $this->where_input($where);
			   	$where_course['course_status'] =1;
		   		$where_combo['combo_status'] =1;
			   	
		   		$array_1 = $this->user_modl->get_all_data_search(array('course_status' => 1),'course_master','course_title',$search_title);		//$where,$table,$table_column,$search
		   		$array_2 = $this->user_modl->get_all_data_search(array('combo_status' => 1),'combo_master','combo_title',$search_title);		//$where,$table,$table_column,$search
		   		$result = array_merge($array_1,$array_2);
	   		}else{
	   			$where['main_category'] = $main_cat_id == "" ? "":$main_cat_id;
	   			$where['class'] = $class_id =="" ? "":$class_id;

			   	$where_course = $this->where_input($where);
			   	$where_combo = $this->where_input($where);
			   	$where_course['course_status'] =1;
		   		$where_combo['combo_status'] =1;

			   	$where_course['course_type_id'] =$filter;
			   	$where_combo['course_type_id'] =$filter;
	   			$array_1 = $this->user_modl->get_all_data_search(array('course_status' => 1,'course_type_id'=>$filter),'course_master','course_title',$search_title);
		   		$array_2 = $this->user_modl->get_all_data_search(array('combo_status' => 1,'course_type_id'=>$filter),'combo_master','combo_title',$search_title);
		   		$result = array_merge($array_1,$array_2);
	   		}
	   	}else if($iten_id == "combo"){
	   		$table = 'combo';
		   	$where['class'] = $class_id != ""?$class_id:"";
		   	$where['main_category'] = $main_cat_id != ""?$main_cat_id:"";
		   	$where['course_type_id'] = $filter != 'all' ? $filter:"";
		   	$where['combo_status'] = 1;
	   	}
	   	else{
		   	$where['subject_category'] = $iten_id != ""?$iten_id:"";
		   	$where['class'] = $class_id != ""?$class_id:"";
		   	$where['main_category'] = $main_cat_id != ""?$main_cat_id:"";
		   	$where['course_status'] = 1;
   			$where['course_type_id'] = $filter != 'all' ? $filter:"";
		   	$table = 'course';
	   	}

	   	if($iten_id != "all"){
		   	foreach ($where as $key => $value) {
		   		# code...
		   		if($value == ""){
		   			unset($where[$key]);
		   		}
		   	}
	   	}

	   	$result = ($iten_id == "all") ? $result : $this->user_modl->get_all_data_search($where,$table.'_master',''.$table.'_title',$search_title);	  //$where,$table,$search
	   	$config = array();
		$config["base_url"] = base_url() . "home/course";
		$config["total_rows"] = count($result);
		$config["per_page"] =9;
		$config["uri_segment"] = 3;
		$config["use_page_numbers"] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination " id="pagination">';
		$config["full_tag_close"] = '</ul>';
		$config["first_tag_open"] = '<li>';
		$config["first_tag_close"] = '</li>';
		$config["last_tag_open"] = '<li>';
		$config["last_tag_close"] = '</li>';
		$config['next_link'] = '&gt;';
		$config["next_tag_open"] = '<li>';
		$config["next_tag_close"] = '</li>';
		$config["prev_link"] = "&lt;";
		$config["prev_tag_open"] = "<li>";
		$config["prev_tag_close"] = "</li>";
		$config["cur_tag_open"] = "<li class='active'><a href='#'>";
		$config["cur_tag_close"] = "</a></li>";
		$config["num_tag_open"] = "<li>";
		$config["num_tag_close"] = "</li>";
		$config["num_links"] = 1;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);	
		if($page != 0){
		$page = ($page - 1) * $config["per_page"];
		}

		if(($iten_id == "all")){
			$where_course['course_status'] =1;
		   	$where_combo['combo_status'] =1;
	   		if($filter == "all"){
	   			$where['main_category'] = $main_cat_id == "" ? "":$main_cat_id;
	   			$where['class'] = $class_id =="" ? "":$class_id;

			   	$where_course = $this->where_input($where);
			   	$where_combo = $this->where_input($where);
			   	$where_course['course_status'] =1;
		   		$where_combo['combo_status'] =1;

		   		$courses_1 = $this->user_modl->get_courses($config["per_page"], $page,$where_course,'course_master','course_title',$search_title);			//$where,$table,$search
		   		$combo_1 = $this->user_modl->get_courses($config["per_page"], $page,$where_combo,'combo_master','combo_title',$search_title);				//$where,$table,$search
		   		$courses = array_merge($courses_1,$combo_1);
	   		}else{
	   			$where['main_category'] = $main_cat_id == "" ? "":$main_cat_id;
	   			$where['class'] = $class_id =="" ? "":$class_id;

			   	$where_course = $this->where_input($where);
			   	$where_combo = $this->where_input($where);
			   	$where_course['course_status'] =1;
		   		$where_combo['combo_status'] =1;

			   	$where_course['course_type_id'] =$filter;
			   	$where_combo['course_type_id'] =$filter;
	   			$courses_1 = $this->user_modl->get_courses($config["per_page"], $page,$where_course,'course_master','course_title',$search_title);			//$where,$table,$search
		   		$combo_1 = $this->user_modl->get_courses($config["per_page"], $page,$where_combo,'combo_master','combo_title',$search_title);				//$where,$table,$search
		   		$courses = array_merge($courses_1,$combo_1);
	   		}
		}else{
			$courses = $this->user_modl->get_courses($config["per_page"], $page,$where,$table.'_master',''.$table.'_title',$search_title);			//$where,$table,$search
		}

		$output='';
		if(empty($courses)){
			$output.= '1';
		}else{

			$output.= 	'<ul class="grid_container gutter_medium grid_col3 masonry">';

			foreach($courses as $row){
				$first_key = array_key_first($row);

				$table = $first_key == "course_id"?"course":"combo";
				$type = $first_key == "course_id"?"1":"2";

				$where_price = array(
									'course_id'=>$row[$table.'_id'],
									'course_type' => $type);
				$price = $this->student_modl->get_min_prod_price($where_price,'course_price_master');

								$where = array('product_id' => $row[$table.'_id'],
								'product_type'	=> $type,
							   );
                				$fetch_data='student_first_name,student_last_name,student_profile,rating_count,rating_review,rated_on';
                				$modal_data=array(
                                      'select_coloumns' =>  $fetch_data,
                                      'where_condition1' => $where,
                                      'where_condition2' => '',
                                      'where_condition3' => '',
                                      'where_condition4' => '',
                                      'table' => 'rating_master',
                        		 );
                				$join_data=array(
                							'join_table'		=> $this->student_master,
                							'join_condition'	=> 'student_master.student_id = rating_master.student_id',
                							'join_table2'		=> '',
                							'join_condition2'	=>  '' ,
	                						'join_table3'        => '',
			                                'join_condition3'    => '',
			                                'join_table4'        => '',
			                                'join_condition4'    => '',);
                				$review_results=$this->student_modl->get_all_data($modal_data,$join_data);
								
								$total_count=0;
								foreach ($review_results as $review_row) {
									$total_count += $review_row['rating_count'];
								}
								if(count($review_results)>0)
								{
								     $average_rating=$total_count/count($review_results);
									$average_count=number_format((float)$average_rating, 1, '.', '');
								}
								else
								{
									$average_count=0;
								}
								
				$output.=
				                ' <li class="grid_item">
				                        <div class="content_box radius_all_10 box_shadow1">
				                            <div class="content_img radius_ltrt_10">
				                                <a href="'. base_url("/home/product_detail/".$table."/".$row["".$table."_id"]."") .'"><img src="'.base_url("images/".$table."_banner/".$row[''.$table.'_banner_img']."").'" alt="course_img1"/></a>
				                            </div>
				                            <div class="content_desc">
				                                <h4 class="content_title"><a href="'. base_url("/home/product_detail/".$table."/".$row["".$table."_id"]."") .'"> '.$row["".$table."_title"].'</a></h4>
				                                <div class="courses_info">
				                                    <div class="rating_stars">';

				                                    for($i=1;$i<=5;$i++)
											 			{
											 				if($average_count>=1)
											 				{ 
																$output.= '<i class="ion-android-star"></i>';
											 					$average_count--;

											 				}
											 				else
											 				{
											 					if($average_count >= 0.5)
											 					{ 
																	$output.= '<i class="ion-android-star-half"></i>';
												 					$average_count -= 0.5;	
											 					}
											 					else
											 					{
											 						$output.= '<i class="icon ion-android-star-outline"></i>';
											 					}
											 				}
											 			}

				                                 $output.=  
				                             	   '</div>
				                                    <!-- <ul class="list_none content_meta">
				                               <li><a class="rating" data-id="1" data-toggle="tooltip" data-placement="top"  title="Add Review"><i class="ti-comment-alt" onclick="writeReview('.$row["".$table."_id"].',1)"></i></a></li>
				                                    </ul> -->
				                                </div>
				                            </div>
				                            <div class="content_footer">
				                                <div class="price">
				                                	<span><del>₹'.$price["course_price"].'</del></span>
				                                </div>
				                                <div class="price">
				                                	<span class="alert alert-info">₹'.$price["course_discount_price"].'</span>
				                                </div>
				                                <div class="price">
				                                	<span class="alert alert-warning">'.number_format((float)(100 - ($price["course_discount_price"]/$price["course_price"]*100)), 1, '.', '').'% OFF</span>
				                                </div>
				                            </div>
				                            
				                        </div>
				                    </li>';
	        }
	            $output.=
				                '</ul>';
				          
		}
        $output_1 = array(
					'pagination_link'  => $this->pagination->create_links(),
					'all_cat_product'   => $output
					
					);
	   	echo json_encode($output_1);
	}

	function purchased_status()
	{
		if(!empty($this->basic_mol->exist_or_not(array('student_id'	=> $this->session->userdata('student_id')),'orders')))
		{
			$data['msg']="error";	
		
			if(!empty($this->basic_mol->exist_or_not($this->input->post(),'order_items')))
			{
				$data['msg']="success";
			}
			
		}
		echo json_encode($data);
	}

	function addReview(){
		$data=$this->input->post();

		$where=array('student_id' => $this->session->userdata('student_id'),
					  'product_id'=> $data['product_id'],
					  'product_type'=>$data['product_type']
					 ); 
		 if(empty($this->basic_mol->exist_or_not($where,'rating_master')))
	      {
			$data['student_id']=$this->session->userdata('student_id');
			$data['rated_on']=$this->current_date;
			$review_results=$this->basic_mol->insert($data,'rating_master');

			$data['msg']="error";
			if($review_results)
			{
	      		$data['msg']="Success";
			}
	      }
	      else
	      {
	      	$data['msg']="warning";
	      }

		echo json_encode($data);
	}

}