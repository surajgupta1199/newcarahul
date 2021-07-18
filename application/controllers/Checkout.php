<?php
class Checkout extends CI_Controller{
    
    public function  __construct(){
        parent::__construct();
        
       $this->load->model('Student_model','student_modl');
       $this->cart_tbl = "cart_master";
       $this->course = "course_master";
       $this->coupan = "coupon_master";
       $this->student_master= "student_master";
       $this->stud_billing_address= "student_billing_address";
       $this->course_key="course_key_master";
       $this->current_date=date('Y-m-d');
       if($this->session->userdata('student_id') != ''){
            $this->user_id =  $this->session->userdata('student_id');
        }
    }
    
  function index(){
  		$data=array();

      $where2='ct.product_price_mode = cp.course_mode';
      $where3='ct.product_validity = cp.course_type_value_id';
      $where4='ct.product_views = cp.course_view';
      $where5='ct.product_type = cp.course_type';
      $where = array('student_id' => $this->user_id,);
      $fetch_data='cp.course_discount_price,ct.*,avm1.value as mode_val,cvvm.course_view_value_name as views_val,ctvm.course_type_value_name as validity_val';

      $modal_data=array(
                        'select_coloumns' =>  $fetch_data,
                        'where_condition1' => $where,
                        'where_condition2' => $where2,
                        'where_condition3' => $where3,
                        'where_condition4' => $where4,
                        'where_condition5' => $where5,
                        'table' => $this->cart_tbl .' as ct',
                        );
      $join_data=array(
                  'join_table'   => 'course_price_master as cp',
                  'join_condition' =>  'cp.course_id = ct.product_id ',
                  'join_table2'        => 'attribute_value_master as avm1',
                  'join_condition2'    => 'avm1.value_id = ct.product_price_mode',
                  'join_table3'        => 'course_view_value_master as cvvm',
                  'join_condition3'    => 'cvvm.course_view_value_id = ct.product_views',
                  'join_table4'        => 'course_type_value_master as ctvm',
                  'join_condition4'    => 'ctvm.course_type_value_id = ct.product_validity',
                  );

      $cart_res = $this->student_modl->get_all_data($modal_data,$join_data);

      if(empty($cart_res))
      {
        redirect('Cart/');
      }
      else
      {
        $cart_data=array();
        $checkout_total=0;
        $coupan_type_id=array(); 
        $assigning_data=array();
        $assigning_data_row=array();
       
        for($i=0;$i<count($cart_res);$i++){
          $product_type= $cart_res[$i]['product_type'] == 1 ? 'course' :'combo';
            $where = array($product_type.'_id' => $cart_res[$i]['product_id'] );
            $product_data = $this->basic_mol->get_all_data($where,$product_type.'_master');
            for($j=0;$j<count($product_data);$j++){
              if($product_type == 'combo')
              {
                  $combo_course_ids=json_decode($product_data[$j]['course_id']);
                  foreach ($combo_course_ids as $value) {
                    for($k=0;$k<$cart_res[$i]['product_quantity'];$k++)
                    {
                       $assigning_data[]=$value .'_' .$cart_res[$i]['product_views']. '_' .$cart_res[$i]['product_validity'];
                    }
                  }
              }
              else
              {
                for($k=0;$k<$cart_res[$i]['product_quantity'];$k++)
                {
                  
                  $assigning_data[]=$cart_res[$i]['product_id'] .'_' .$cart_res[$i]['product_views']. '_' .$cart_res[$i]['product_validity'];
                }
              }
              $coupan_type_id[]=$product_data[$j]['course_type_id'];
              $cart_data[] = array(
                    'rowid'    => $cart_res[$i]['product_id'],  
                    'qty'    => $cart_res[$i]['product_quantity'],
                    'price'    => $cart_res[$i]['course_discount_price'],
                    'name'    => $product_data[$j][$product_type.'_title'],
                    'product_type' => $cart_res[$i]['product_type'],
                    'product_validity'    => $cart_res[$i]['product_validity'],
                    'product_price_mode'    => $cart_res[$i]['product_price_mode'],
                    'product_views'    => $cart_res[$i]['product_views'],
                    'validity_val'    => $cart_res[$i]['validity_val'].' months',
                    'mode_val'    => $cart_res[$i]['mode_val'],
                    'views_val'    => $cart_res[$i]['views_val'],
                    'image' => base_url('images/'.$product_type.'_banner/'.$product_data[$j][$product_type.'_banner_img']),
                    'subtotal'=>$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price']
                );

              }
          $subtotal=$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price'];
          $checkout_total += $subtotal;
        }
       
        array_push($coupan_type_id,0);
        $where_in_array=$coupan_type_id;
        $where=array('coupon_status'  => 1);
        $current_date=date("Y-m-d");
        $coloumn_name='cat_id';
        $coupan_res=$this->student_modl->get_data_by_multiple_id($where_in_array,$where,$coloumn_name,$this->coupan);
        $valid_coupans=array();
        foreach ($coupan_res as $row) {
          if($current_date >= $row['coup_start_date'] && $current_date <=  $row['coup_end_date']){
            $valid_coupans[]=$row;
          }
        $data['coupan_details']=$valid_coupans;

        }
        
        $check_availibility_array=array_count_values($assigning_data);
        $status=array();
        foreach ($check_availibility_array as $key => $value) {

          $availablity_parms=explode("_",$key);
          $where=array(
                        'course_id' =>  $availablity_parms[0],
                        'course_view'   =>  $availablity_parms[1],
                        'course_duration'   =>  $availablity_parms[2],
                        'student_id'    =>  '',
                      );
          $coloumn_name="course_key_id";
          $total_keys=$this->student_modl->count_total_rows($coloumn_name,$where,$this->course_key);
          $status[]= $value <= $total_keys ? "available" : "not_available";
        }
       
        $data['availibility_status']='<label><small class="alert-success">(Check Your Items Before Payment)</small></label>';
        
        if(in_array("not_available", $status))
        {
          $data['availibility_status']='<label><small class="alert-danger">(Please Update Your Cart!! Few Items are not available)</small></label>';
         
        }
        
        $data['cartItems']=$cart_data;
        $data['checkout_subtotal']=$checkout_total;
        $where=array('student_master.student_id' => $this->user_id  , );
        $fetch_data='student_master.*,student_billing_address.*';
        $modal_data=array(
                          'select_coloumns' =>  $fetch_data,
                          'where_condition1' => $where,
                          'where_condition2' => '',
                          'where_condition3' => '',
                          'where_condition4' => '',
                          'where_condition5' => '',
                          'table' => $this->student_master,
                          );
        
        $join_data=array(
                 'join_table' => $this->stud_billing_address,
                 'join_condition' => 'student_billing_address.stu_id=student_master.student_id',
                 'join_table2'    => '',
                 'join_condition2'=> '',
                 'join_table3'        => '',
                 'join_condition3'    => '',
                 'join_table4'        => '',
                 'join_condition4'    => '',
                 'join_table5'        => '',
                 'join_condition5'    => '',
        );
        $student_data=$this->student_modl->get_all_data($modal_data,$join_data);
        
        $data['state_code_value'] = $student_data[0]['stu_bil_state_code'] != "" ? $this->basic_mol->get_single_data(array('state_code_id'=>$student_data[0]['stu_bil_state_code']),'state_code'):"";

        $data['state_code'] = $this->basic_mol->get_all_data("","state_code");
        
        if($student_data){
          $data['student_details']=$student_data[0];
          $this->load->view('home/header');
          $this->load->view('student/checkout',$data);
          $this->load->view('home/footer');
        }
        else
        {
          redirect('student/profile');
        }
      }
  }

  function checkAddress(){
  	 $data=array();
  	 $where = array('stu_id' => $this->user_id);
  	 $data['msg']="Error";
  	 if(!empty($this->basic_mol->exist_or_not($where,$this->stud_billing_address)))
      {
      	$data['msg']="Success";
      }
     echo json_encode($data);
  }

  function calculateTotal(){
      $data=array();
      $where=$this->input->post();
      $coupan_data=(array)$this->basic_mol->exist_or_not($where,$this->coupan);
      if(!empty($this->basic_mol->exist_or_not($where,$this->coupan)))
      {
          
          $where2='ct.product_price_mode = cp.course_mode';
          $where3='ct.product_validity = cp.course_type_value_id';
          $where4='ct.product_views = cp.course_view';
          $where5='ct.product_type = cp.course_type';
          $where = array('student_id' => $this->user_id,);
          $fetch_data='cp.course_discount_price,ct.*,avm1.value as mode_val,cvvm.course_view_value_name as views_val,ctvm.course_type_value_name as validity_val';

          $modal_data=array(
                            'select_coloumns' =>  $fetch_data,
                            'where_condition1' => $where,
                            'where_condition2' => $where2,
                            'where_condition3' => $where3,
                            'where_condition4' => $where4,
                            'where_condition5' => $where5,
                            'table' => $this->cart_tbl .' as ct',
                            );
          $join_data=array(
                      'join_table'   => 'course_price_master as cp',
                      'join_condition' =>  'cp.course_id = ct.product_id ',
                      'join_table2'        => 'attribute_value_master as avm1',
                      'join_condition2'    => 'avm1.value_id = ct.product_price_mode',
                      'join_table3'        => 'course_view_value_master as cvvm',
                      'join_condition3'    => 'cvvm.course_view_value_id = ct.product_views',
                      'join_table4'        => 'course_type_value_master as ctvm',
                      'join_condition4'    => 'ctvm.course_type_value_id = ct.product_validity',
                      );

          $cart_res = $this->student_modl->get_all_data($modal_data,$join_data);

          $course_price=array();
          $cart_data=array();
          $checkout_sub_total=0;
          $coupan_type_id=array();
          for($i=0;$i<count($cart_res);$i++){
             if($cart_res[$i]['product_type'] == 1)
              {
                $where = array('course_id' => $cart_res[$i]['product_id'] );
                $product_data = $this->basic_mol->get_all_data($where,$this->course);
                for($j=0;$j<count($product_data);$j++){
                  $coupan_type_id[]=$product_data[$j]['course_type_id'];
                   $cart_data[] = array(
                        'rowid'    => $cart_res[$i]['product_id'],  
                        'qty'    => $cart_res[$i]['product_quantity'],
                        'price'    => $cart_res[$i]['course_discount_price'],
                        'name'    => $product_data[$j]['course_title'],
                        'product_type' => $cart_res[$i]['product_type'],
                        'product_validity'    => $cart_res[$i]['product_validity'],
                        'product_price_mode'    => $cart_res[$i]['product_price_mode'],
                        'product_views'    => $cart_res[$i]['product_views'],
                        'validity_val'    => $cart_res[$i]['validity_val'].' months',
                        'mode_val'    => $cart_res[$i]['mode_val'],
                        'views_val'    => $cart_res[$i]['views_val'],
                        'image' => base_url('images/course_banner/'.$product_data[$j]['course_banner_img']),
                        'subtotal'=>$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price']
                    );

                  }
              }
              else{
                    $where = array('combo_id' => $cart_res[$i]['product_id'] );
                    $product_data = $this->basic_mol->get_all_data($where,'combo_master');
                    for($j=0;$j<count($product_data);$j++){
                      $coupan_type_id[]=$product_data[$j]['course_type_id'];
                       $cart_data[] = array(
                            'rowid'    => $cart_res[$i]['product_id'],  
                            'qty'    => $cart_res[$i]['product_quantity'],
                            'price'    => $cart_res[$i]['course_discount_price'],
                            'name'    => $product_data[$j]['combo_title'],
                            'product_type' => $cart_res[$i]['product_type'],
                            'product_validity'    => $cart_res[$i]['product_validity'],
                            'product_price_mode'    => $cart_res[$i]['product_price_mode'],
                            'product_views'    => $cart_res[$i]['product_views'],
                            'validity_val'    => $cart_res[$i]['validity_val'].' months',
                            'mode_val'    => $cart_res[$i]['mode_val'],
                            'views_val'    => $cart_res[$i]['views_val'],
                            'image' => base_url('images/combo_banner/'.$product_data[$j]['combo_banner_img']),
                            'subtotal'=>$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price']
                        );

                      }
              }
            $subtotal=$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price'];
            $checkout_sub_total += $subtotal;

          }
          $current_date=date("Y-m-d");
          if($current_date >= $coupan_data['coup_start_date'] && $current_date <=  $coupan_data['coup_end_date'])
          {
              $data['msg']='amounterror';
              $total_after_discount=0;
              if($checkout_sub_total >= $coupan_data['coup_min_amount'])
              {
                if($coupan_data['coup_discount_type']==2)
                {
                   $total_after_discount= $checkout_sub_total - $coupan_data['coup_discount'];
                   $data['discount_amount']=$coupan_data['coup_discount'];
                   $data['discounted_amount']=$total_after_discount;
                }
                else
                {
                  $total_after_discount=$checkout_sub_total - ($checkout_sub_total*$coupan_data['coup_discount'])/100;
                  $data['discount_amount']=($checkout_sub_total*$coupan_data['coup_discount'])/100;
                  $data['discount_percent']=$coupan_data['coup_discount'];
                  $data['discounted_amount']=$total_after_discount;
                  
                }
                $data['promo_code']=$coupan_data['coup_code'];
                $data['coup_id']=$coupan_data['coup_id'];
                $data['msg']='Success';
              }
          }
          else
          {
            $data['msg']='expiryerror';
          }
          
      }
      else
      {
        $data['msg']='Invalid';

      }
      
      echo json_encode($data);    
  }
  
  function proceed_order(){
    $data=array();
    $update_data =$this->input->post();
    $student_detail = array(
          'student_mother_name' => $update_data['student_mother_name'],
          'student_father_name' => $update_data['student_father_name'],
          'student_phone_option' => $update_data['student_phone_option'],
          'student_bil_ICAI_reg'=>$update_data['student_bil_ICAI_reg']) ;

    $where_stu_detail['student_id'] = $this->user_id;

    $update_result = $this->basic_mol->update_table($where_stu_detail,$student_detail,'student_master');
    if($update_result){
      
        $where2='ct.product_price_mode = cp.course_mode';
        $where3='ct.product_validity = cp.course_type_value_id';
        $where4='ct.product_views = cp.course_view';
        $where5='ct.product_type = cp.course_type';
        $where = array('student_id' => $this->user_id,);
        $fetch_data='cp.course_discount_price,ct.*,avm1.value as mode_val,cvvm.course_view_value_name as views_val,ctvm.course_type_value_name as validity_val';

        $modal_data=array(
                          'select_coloumns' =>  $fetch_data,
                          'where_condition1' => $where,
                          'where_condition2' => $where2,
                          'where_condition3' => $where3,
                          'where_condition4' => $where4,
                          'where_condition5' => $where5,
                          'table' => $this->cart_tbl .' as ct',
                          );
        $join_data=array(
                    'join_table'   => 'course_price_master as cp',
                    'join_condition' =>  'cp.course_id = ct.product_id ',
                    'join_table2'        => 'attribute_value_master as avm1',
                    'join_condition2'    => 'avm1.value_id = ct.product_price_mode',
                    'join_table3'        => 'course_view_value_master as cvvm',
                    'join_condition3'    => 'cvvm.course_view_value_id = ct.product_views',
                    'join_table4'        => 'course_type_value_master as ctvm',
                    'join_condition4'    => 'ctvm.course_type_value_id = ct.product_validity',
                    );

        $cart_res = $this->student_modl->get_all_data($modal_data,$join_data);


        $cart_data=array();
        $checkout_total=0;
        $coupan_type_id=array(); 
        $assigning_data=array();
        $verify_data=array();
        
       
        for($i=0;$i<count($cart_res);$i++){
         
          if($cart_res[$i]['product_type'] == 1)
          {
            $where = array('course_id' => $cart_res[$i]['product_id'] );
           
            $product_data = $this->basic_mol->get_all_data($where,$this->course);
            for($j=0;$j<count($product_data);$j++){
              for($k=0;$k<$cart_res[$i]['product_quantity'];$k++)
              {
                $verify_data[]=$cart_res[$i]['product_id'].'_'.$cart_res[$i]['product_views']. '_' .$cart_res[$i]['product_validity'];
                $assigning_data[]=$cart_res[$i]['product_id'].'_'.$cart_res[$i]['product_views']. '_' .$cart_res[$i]['product_validity']. '_' .$cart_res[$i]['validity_val'].  '_' 
                .$cart_res[$i]['product_price_mode']. '_'. $cart_res[$i]['product_quantity'];
              }
              $coupan_type_id[]=$product_data[$j]['course_type_id'];
              $cart_data[] = array(
                    'rowid'    => $cart_res[$i]['product_id'],  
                    'qty'    => $cart_res[$i]['product_quantity'],
                    'price'    => $cart_res[$i]['course_discount_price'],
                    'name'    => $product_data[$j]['course_title'],
                    'product_type' => $cart_res[$i]['product_type'],
                    'product_validity'    => $cart_res[$i]['product_validity'],
                    'product_price_mode'    => $cart_res[$i]['product_price_mode'],
                    'product_views'    => $cart_res[$i]['product_views'],
                    'validity_val'    => $cart_res[$i]['validity_val'].' months',
                    'mode_val'    => $cart_res[$i]['mode_val'],
                    'views_val'    => $cart_res[$i]['views_val'],
                    'image' => base_url('images/course_banner/'.$product_data[$j]['course_banner_img']),
                    'subtotal'=>$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price']
                );

              }

          }
          
          else{
                $where = array('combo_id' => $cart_res[$i]['product_id'] );
                $product_data = $this->basic_mol->get_all_data($where,'combo_master');
                for($j=0;$j<count($product_data);$j++){
                  $combo_course_ids=json_decode($product_data[$j]['course_id']);
                  foreach ($combo_course_ids as $value) {
                    for($k=0;$k<$cart_res[$i]['product_quantity'];$k++)
                    {
                       $verify_data[]=$value .'_' .$cart_res[$i]['product_views']. '_' .$cart_res[$i]['product_validity'];
                       $assigning_data[]=$value .'_' .$cart_res[$i]['product_views']. '_' .$cart_res[$i]['product_validity']. '_' .$cart_res[$i]['validity_val']. '_' . $cart_res[$i]['product_price_mode'].'_'.$cart_res[$i]['product_quantity'];
                    }
                  }
                  $coupan_type_id[]=$product_data[$j]['course_type_id'];
                  $cart_data[] = array(
                         'rowid'    => $cart_res[$i]['product_id'],  
                        'qty'    => $cart_res[$i]['product_quantity'],
                        'price'    => $cart_res[$i]['course_discount_price'],
                        'name'    => $product_data[$j]['combo_title'],
                        'product_type' => $cart_res[$i]['product_type'],
                        'product_validity'    => $cart_res[$i]['product_validity'],
                        'product_price_mode'    => $cart_res[$i]['product_price_mode'],
                        'product_views'    => $cart_res[$i]['product_views'],
                        'validity_val'    => $cart_res[$i]['validity_val'].' months',
                        'mode_val'    => $cart_res[$i]['mode_val'],
                        'views_val'    => $cart_res[$i]['views_val'],
                        'image' => base_url('images/combo_banner/'.$product_data[$j]['combo_banner_img']),
                        'subtotal'=>$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price']
                    );

                  }
          }
         
          
          $subtotal=$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price'];
          $checkout_total += $subtotal;
        }
        $check_availibility_array=array_count_values($verify_data);
        
        
        $status=array();
        foreach ($check_availibility_array as $key => $value) {

          $availablity_parms=explode("_",$key);
          $where=array(
                        'course_id' =>  $availablity_parms[0],
                        'course_view'   =>  $availablity_parms[1],
                        'course_duration'   =>  $availablity_parms[2],
                        'student_id'    =>  '',
                      );
                $coloumn_name="course_key_id";
                $total_keys=$this->student_modl->count_total_rows($coloumn_name,$where,$this->course_key);
                $status[]= $value <= $total_keys ? "available" : "not_available";
               
        }
        
        
        if(in_array("not_available", $status))
        {
          $data['msg']='key_available_error';
         
        }
        else
        {
          $coup_id=$this->input->post('coup_id');
             
              if(!empty($coup_id))
              {
                
                $coupan_data=(array)$this->basic_mol->exist_or_not(array('coup_id'=> $coup_id,),$this->coupan);
               
                if(!empty($this->basic_mol->exist_or_not(array('coup_id'=> $coup_id,),$this->coupan)))
                {
                    
                    $current_date=date("Y-m-d");
                    if($current_date >= $coupan_data['coup_start_date'] && $current_date <=  $coupan_data['coup_end_date'])
                    {
                        $data['msg']='amounterror';
                        $total_after_discount=0;
                        if($checkout_total >= $coupan_data['coup_min_amount'])
                        {
                          if($coupan_data['coup_discount_type']==2)
                          {
                             $total_after_discount= $checkout_total - $coupan_data['coup_discount'];
                             $data['discount_amount']=$coupan_data['coup_discount'];
                             $data['discounted_amount']=$total_after_discount;
                          }
                          else
                          {
                            $total_after_discount=$checkout_total - ($checkout_total*$coupan_data['coup_discount'])/100;
                            $data['discount_amount']=($checkout_total*$coupan_data['coup_discount'])/100;
                            $data['discount_percent']=$coupan_data['coup_discount'];
                            $data['discounted_amount']=$total_after_discount;
                            
                          }
                          $data['promo_code']=$coupan_data['coup_code'];
                          $data['coup_id']=$coupan_data['coup_id'];
                          $order_insert_data=array(
                            'student_id'  => $this->user_id,
                            'grand_total' => $data['discounted_amount'],
                            'coupon_code' => $data['promo_code'],
                            'coupon_type' => $coupan_data['coup_discount_type'],
                            'coupon_discount' =>  $data['discount_amount'],
                            'created'         => $this->current_date
                          );
                          $order_insert_res=$this->basic_mol->insert($order_insert_data,'orders');
                          if($order_insert_res)
                          {
                              $result=array();
                              foreach ($cart_data as $cart_row) {
                               
                                $order_item_insert_data=array(
                                  'order_id'  =>  $order_insert_res,
                                  'course_id' =>  $cart_row['rowid'],
                                  'course_title' => $cart_row['name'],
                                  'course_type' =>  $cart_row['product_type'],
                                  'course_mode' =>  $cart_row['product_price_mode'],
                                  'course_duration' =>  $cart_row['product_validity'],
                                  'course_view'     =>  $cart_row['product_views'],
                                  'quantity'    =>  $cart_row['qty'],
                                  'sub_total'   =>  $cart_row['subtotal']

                                );
                                $result[]=$this->basic_mol->insert($order_item_insert_data,'order_items');
                              }
                              if($result)
                              {
                                 $msg='
                                          <h3>Your order is placed on Order id : #'.$order_insert_res.'</h3>
                                          <br/>
                                          <table border="1px solid #000000">
                                            <tr>
                                                <th>product_id</th>
                                                <th>product_title</th>
                                                <th>product_mode</th>
                                                <th>product_duration</th>
                                                <th>product_view</th>
                                                <th>quantity</th>
                                                <th>sub_total</th>
                                            </tr>';
                                           foreach ($cart_data as $cart_row) {
                                              $msg.= '<tr>
                                                          <td>'.$cart_row['rowid'].'</td>
                                                          <td>'.$cart_row['name'].'</td>
                                                          <td>'.$cart_row['mode_val'].'</td>
                                                          <td>'.$cart_row['validity_val'].'</td>
                                                          <td>'.$cart_row['views_val'].'</td>
                                                          <td>'.$cart_row['qty'].'</td>
                                                          <td> ₹'.$cart_row['subtotal'].'</td>
                                                      </tr>';
                                           }
                                           $msg.= '
                                                      <tr>
                                                            <td>Discount Recieved: ₹'.$data['discount_amount'].'</td>
                                                          <td colspan="5" style="float:right"><b>Grand Total : ₹'.$data['discounted_amount'].'</b></td>
                                                      </tr>
                                                  </table>';
                                           
                                           $customer_res=$this->basic_mol->get_single_data(array('student_id' => $this->user_id,),$this->student_master);
                                           $response=$this->sendMail($customer_res['student_email'],$msg);
                                $assigned_result =array();
                   
                               $check_availibility_array=array_count_values($assigning_data);
                              
                               foreach ($check_availibility_array as $key => $value) {
                                
                                    $to_assigning_row=explode("_",$key);
                                    $datetime = new \DateTime();
                                    $datetime->modify('+'.$to_assigning_row[3]. 'months');
                                    $valid_date=$datetime->format('Y-m-d');
                                    $where=array(
                                                'course_id' =>  $to_assigning_row[0],
                                                'course_view'   =>  $to_assigning_row[1],
                                                'course_duration'   =>  $to_assigning_row[2],
                                                'student_id'    =>  '',
                                              );
                               
                                    $assign_keys_data=array(
                                                  'student_id'    =>  $this->user_id,
                                                  'order_id'      =>  $order_insert_res,
                                                  'course_mode'     =>  $to_assigning_row[4],
                                                  'assigned_date' =>  $this->current_date,
                                                  'valid_date'    =>  $valid_date    
                                    );
                                    
                                    $limit=$value;
                                    $assigned_result=$this->student_modl->update_table_with_limit($where,$assign_keys_data,$limit,$this->course_key);
                                }
                                 if($assigned_result)
                                  {
                                     
                                     $empty_cart_result=$this->basic_mol->delete(array('student_id'  => $this->user_id),$this->cart_tbl);
                                      if( $empty_cart_result)
                                      {
                                        $where = array('student_id' => $this->user_id,
                                          'order_id'  => $order_insert_res,
                                        );
                          
                                          $fetch_data='ce.*,ck.*';
                                          $modal_data=array(
                                                            'select_coloumns' =>  $fetch_data,
                                                            'where_condition1' => $where,
                                                            'where_condition2' => '',
                                                            'where_condition3' => '',
                                                            'where_condition4' => '',
                                                            'where_condition5' => '',
                                                            'group_by_coloumn' => '',
                                                            'table' => $this->course_key .' as ck',
                                                            );
                                          $join_data=array(
                                                      'join_table'         =>  'course_master as ce',
                                                      'join_condition'     =>  'ce.course_id = ck.course_id',
                                                      'join_table2'        => '',
                                                      'join_condition2'    => '',
                                                      'join_table3'        => '',
                                                      'join_condition3'    => '',
                                                      'join_table4'        => '',
                                                      'join_condition4'    => '',
                                                  );
                                         $order_results=$this->student_modl->get_all_data($modal_data,$join_data);
                                         $msg='
                                                  <h3>Keys Assigned On your  Order id : #'.$order_insert_res.' are </h3>
                                                  <br/>
                                                  <table border="1px solid #000000">
                                                    <tr>
                                                        <th>product_title</th>
                                                        <th>product_mode</th>
                                                        <th>product_duration</th>
                                                        <th>product_view</th>
                                                        <th>product_key</th>
                                                        <th>Product link</th>
                                                    </tr>';
                                          foreach ($order_results as $order_row) {
                                                    $course_mode_result=$this->basic_mol->get_single_data(array('value_id' => $order_row['course_mode']),'attribute_value_master');
                                                    $course_view_result=$this->basic_mol->get_single_data(array('value_id' => $order_row['course_view']),'attribute_value_master');
                                                    $course_duration_result=$this->basic_mol->get_single_data(array('course_type_value_id' => $order_row['course_duration']),'course_type_value_master');
                                            $msg.=  '
                                                      <tr>
                                                          <td>'.$order_row['course_title'].'</td>
                                                          <td>'.$course_mode_result['value'].'</td>
                                                          <td>'.$course_duration_result['course_type_value_name'].' months </td>
                                                          <td>'.$course_view_result['value'].'</td>
                                                          <td>'.$order_row['course_key'].'</td>
                                                          <td>'.$order_row['course_googledrive_link'].'</td>
                                                      </tr>';
                
                                          }
                                          $msg.= '</table>';
                                          
                                          $customer_res=$this->basic_mol->get_single_data(array('student_id' => $this->user_id,),$this->student_master);
                                          $response=$this->sendMail($customer_res['student_email'],$msg);
                                        $data['msg']='Success';
                                        $count_item=array('cart_item_count' =>  0);
                                        $this->session->set_userdata($count_item);

                                      }

                                  }
                              }

                          }
                          
                        }
                    }
                    else
                    {
                      $data['msg']='expiryerror';
                    }
                    
                }
               
              }
              else
              {
                
                $order_insert_data=array(
                  'student_id'  => $this->user_id,
                  'grand_total' => $checkout_total,
                  'created'         => $this->current_date
                );
                $order_insert_res=$this->basic_mol->insert($order_insert_data,'orders');
                if($order_insert_res)
                {
                    $result=array();
                    foreach ($cart_data as $cart_row) {
                     
                      $order_item_insert_data=array(
                        'order_id'  =>  $order_insert_res,
                        'course_id' =>  $cart_row['rowid'],
                        'course_title' => $cart_row['name'],
                        'course_type' =>  $cart_row['product_type'],
                        'course_mode' =>  $cart_row['product_price_mode'],
                        'course_duration' =>  $cart_row['product_validity'],
                        'course_view'     =>  $cart_row['product_views'],
                        'quantity'    =>  $cart_row['qty'],
                        'sub_total'   =>  $cart_row['subtotal']

                      );
                      $result[]=$this->basic_mol->insert($order_item_insert_data,'order_items');
                     }
                }
                if($result)
                {
                   $msg='
                          <h3>Your order is placed on Order id : #'.$order_insert_res.'</h3>
                          <br/>
                          <table border="1px solid #000000">
                            <tr>
                                <th>product_id</th>
                                <th>product_title</th>
                                <th>product_mode</th>
                                <th>product_duration</th>
                                <th>product_view</th>
                                <th>quantity</th>
                                <th>sub_total</th>
                            </tr>';
                   foreach ($cart_data as $cart_row) {
                      $msg.= '<tr>
                                  <td>'.$cart_row['rowid'].'</td>
                                  <td>'.$cart_row['name'].'</td>
                                  <td>'.$cart_row['mode_val'].'</td>
                                  <td>'.$cart_row['validity_val'].'</td>
                                  <td>'.$cart_row['views_val'].'</td>
                                  <td>'.$cart_row['qty'].'</td>
                                  <td> ₹'.$cart_row['subtotal'].'</td>
                              </tr>';
                   }
                   $msg.= '
                              <tr>
                                  <td colspan="7" style="float:right"><b>Grand Total : ₹'.$checkout_total.'</b></td>
                              </tr>
                          </table>';
                   
                   $customer_res=$this->basic_mol->get_single_data(array('student_id' => $this->user_id,),$this->student_master);
                   $response=$this->sendMail($customer_res['student_email'],$msg);
                  
                   $assigned_result =array();
                   
                   $check_availibility_array=array_count_values($assigning_data);
                  
                   foreach ($check_availibility_array as $key => $value) {
                    
                        $to_assigning_row=explode("_",$key);
                        $datetime = new \DateTime();
                        $datetime->modify('+'.$to_assigning_row[3]. 'months');
                        $valid_date=$datetime->format('Y-m-d');
                        $where=array(
                                    'course_id' =>  $to_assigning_row[0],
                                    'course_view'   =>  $to_assigning_row[1],
                                    'course_duration'   =>  $to_assigning_row[2],
                                    'student_id'    =>  '',
                                  );
                   
                        $assign_keys_data=array(
                                      'student_id'    =>  $this->user_id,
                                      'order_id'      =>  $order_insert_res,
                                      'course_mode'     =>  $to_assigning_row[4],
                                      'assigned_date' =>  $this->current_date,
                                      'valid_date'    =>  $valid_date    
                        );
                        
                        $limit=$value;
                        $assigned_result=$this->student_modl->update_table_with_limit($where,$assign_keys_data,$limit,$this->course_key);
                    }
                   
                  
                        if($assigned_result)
                        {
                          $where = array('student_id' => $this->user_id,
                                          'order_id'  => $order_insert_res,
                                        );
                          
                          $fetch_data='ce.*,ck.*';
                          $modal_data=array(
                                            'select_coloumns' =>  $fetch_data,
                                            'where_condition1' => $where,
                                            'where_condition2' => '',
                                            'where_condition3' => '',
                                            'where_condition4' => '',
                                            'where_condition5' => '',
                                            'group_by_coloumn' => '',
                                            'table' => $this->course_key .' as ck',
                                            );
                          $join_data=array(
                                      'join_table'         =>  'course_master as ce',
                                      'join_condition'     =>  'ce.course_id = ck.course_id',
                                      'join_table2'        => '',
                                      'join_condition2'    => '',
                                      'join_table3'        => '',
                                      'join_condition3'    => '',
                                      'join_table4'        => '',
                                      'join_condition4'    => '',
                                  );
                         $order_results=$this->student_modl->get_all_data($modal_data,$join_data);
                         $msg='
                                  <h3>Keys Assigned On your  Order id : #'.$order_insert_res.' are </h3>
                                  <br/>
                                  <table border="1px solid #000000">
                                    <tr>
                                        <th>product_title</th>
                                        <th>product_mode</th>
                                        <th>product_duration</th>
                                        <th>product_view</th>
                                        <th>product_key</th>
                                        <th>Product link</th>
                                    </tr>';
                          foreach ($order_results as $order_row) {
                                    $course_mode_result=$this->basic_mol->get_single_data(array('value_id' => $order_row['course_mode']),'attribute_value_master');
                                    $course_view_result=$this->basic_mol->get_single_data(array('value_id' => $order_row['course_view']),'attribute_value_master');
                                    $course_duration_result=$this->basic_mol->get_single_data(array('course_type_value_id' => $order_row['course_duration']),'course_type_value_master');
                            $msg.=  '
                                      <tr>
                                          <td>'.$order_row['course_title'].'</td>
                                          <td>'.$course_mode_result['value'].'</td>
                                          <td>'.$course_duration_result['course_type_value_name'].' months </td>
                                          <td>'.$course_view_result['value'].'</td>
                                          <td>'.$order_row['course_key'].'</td>
                                          <td>'.$order_row['course_googledrive_link'].'</td>
                                      </tr>';

                          }
                          $msg.= '</table>';
                          
                          $customer_res=$this->basic_mol->get_single_data(array('student_id' => $this->user_id,),$this->student_master);
                          $response=$this->sendMail($customer_res['student_email'],$msg);
                          $empty_cart_result=$this->basic_mol->delete(array('student_id'  => $this->user_id),$this->cart_tbl);
                          if($empty_cart_result)
                          {
                             $data['msg']='Success';
                             $count_item=array('cart_item_count' =>  0);
                             $this->session->set_userdata($count_item);

                          }

                        }
                }
            }
        } 
    }
    else{
          $data['msg']='not_updated';
    }
    echo json_encode($data); 
          
  }
  public function sendMail($email,$msg){
    include_once 'PHPMailer/PHPMailer.php';
    $message_body = $msg;
    $mail = new PHPMailer();
    $mail->AddReplyTo('bwebtechno1@gmail.com','RSA-CA Rahul Garg');
    $mail->SetFrom('bwebtechno1@gmail.com','RSA-CA Rahul Garg');
    $mail->AddAddress($email);
    $mail->Subject = "Order Summary";
    $mail->MsgHTML($message_body);
    $result = $mail->send();
    $data['msg']="mail_send";
    return $data;
  }

  function update_photo(){
    $file_name = $this->input->post('file_name');
        $folder_name = $file_name == "profile_img" ?'user_profile':"student_proof";
        $profile_img=$this->user_id.'_'.$file_name.'.jpg';
        $where = array(
            'student_id' => $this->user_id);
        $final_array= array();
        $array_1 = array($profile_img,$file_name);
        array_push($final_array,$array_1);
        $result = $this->upload_img($final_array,$folder_name);
        if($result == 'successfully uploaded'){
          if($file_name == "profile_img"){
              $session = $this->session->userdata();

              $session['student_profile'] = $profile_img;

              $this->session->set_userdata($session);
          }

          $table_col_name = $file_name == "profile_img" ? "student_profile" : $file_name ;

            $data[$table_col_name] = $profile_img;
            $update = $this->basic_mol->update_table($where,$data,$this->student_master);
            echo 1;
        }else{
            echo $result;
        }
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

    public function update_address(){
        
    }
   
}