<?php
class Student extends CI_Controller{
	public function __construct(){
        parent::__construct();
        // $this->load->library('main_library');
        if($this->session->userdata('student_id') == ''){
            redirect('home');
        }
        
        $this->user_id =  $this->session->userdata('student_id');
        $this->load->model('Basic_model','basic');
        $this->load->model('Student_model','student');
        $this->table = "student_master";
        $this->add_table = "student_billing_address";
        $this->course_key="course_key_master";
        $this->course = "course_master";
        $this->current_date=date('Y-m-d');
    }

    function profile(){
        $where = array(
            'student_id' => $this->session->userdata('student_id'));
        $result['data'] = $this->basic->get_single_data($where,$this->table);
        $icai_proof = $result['data']['student_bil_ICAI_proof_status'];
        $front_proof = $result['data']['student_bil_government_front_status'];
        $back_proof = $result['data']['student_bil_government_back_status'];
        
        $verified = array();

        if($result['data']['student_bil_ICAI_proof'] != ""){
            if($front_proof == 0){
                array_push($verified,'student_bil_government_front');
            }
            if($back_proof == 0){
                array_push($verified,'student_bil_government_back');
            }
            if($icai_proof == 0){
                array_push($verified,'student_bil_ICAI_proof');
            }
            if($front_proof == 1 && $back_proof == 1 && $icai_proof == 1 ){
                array_push($verified,'verified');
            }
        }else{
            array_push($verified,'not_upload');
        }
        $result['verify_status'] = $verified;
        $result['state_code'] = $this->basic_mol->get_all_data("","state_code");
        
        $this->load->view('home/header');
        $this->load->view('student/profile',$result);
        $this->load->view('home/footer');
    }

    function cart(){
        $this->load->view('home/header');
        $this->load->view('student/cart');
        $this->load->view('home/footer');
    }

    function checkout(){
        $this->load->view('home/header');
        $this->load->view('student/checkout');
        $this->load->view('home/footer');
    }

    function course(){
        $this->load->view('home/header');
        $this->load->view('student/courses');
        $this->load->view('home/footer');
    }

    function course_details(){
        $this->load->view('home/header');
        $this->load->view('student/course-detail');
        $this->load->view('home/footer');
    }
    
    function message(){
        $this->load->view('home/header');
        $this->load->view('student/message');
        $this->load->view('home/footer');
    }

    function transactions(){
        $transaction_result=$this->basic->get_all_data(array('student_id'   =>  $this->user_id),'orders');
        $transact_data=array();
        foreach ($transaction_result as $transaction_row) {
            $transaction_row['transaction_items']=$this->basic->get_all_data(array('order_id' => $transaction_row['id']),'order_items');
            $transact_data[]=$transaction_row;
        }
        
        $data['transactions']=$transact_data; 
        $this->load->view('home/header');
        $this->load->view('student/transaction',$data);
        $this->load->view('home/footer');
    }

    function feedback(){
        $this->load->view('home/header');
        $this->load->view('student/feedback');
        $this->load->view('home/footer');
    }

    function user_transaction(){
        $transaction_result=$this->basic->get_all_data(array('student_id'   =>  $this->user_id),'orders');
        $transact_data=array();
        foreach ($transaction_result as $transaction_row) {
            $transaction_row['transaction_items']=$this->basic->get_all_data(array('order_id' => $transaction_row['id']),'order_items');
            $transact_data[]=$transaction_row;
        }

        $output=   '

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Transaction ID</td>
                                <td>Date</td>
                                <td>Transaction Details</td>
                                <td>Gross Amount</td>
                                <td>Paid Amount</td>
                            </tr>
                        </thead>
                        <tbody>';
                            $sno=0; 
                                foreach ($transact_data as $transaction_row) { 
                                $coupan_code=$transaction_row["coupon_code"]== ''? "Not Applied": $transaction_row["coupon_code"];
                                $sno++;
        $output.=   '
                                <tr>
                                    <td>'.$transaction_row["id"] .'</td>
                                    <td>'.$transaction_row["created"] .'</td>
                                    <td>
                                        <table class="table">';
                                        foreach ($transaction_row["transaction_items"] as $items) {
        $output.=   '
                                                <tr>
                                                    <td>'.$items["course_title"].'</td>
                                                    <td>'.$items["sub_total"].'</td>
                                                </tr>';
                                            }
        $output.=   '
                                        </table>
                                    </td>
                                    <td>'.((int)$transaction_row["grand_total"] + (int)$transaction_row["coupon_discount"] ) .'</td>
                                    <td>'.$transaction_row["grand_total"].'</td>
                                </tr>';
                            }
        $output.=   '
                        </tbody>
                    </table>';
        echo json_encode($output);
    }

    function reset_password(){
        $data = $this->input->post();
        $where = array(
            'student_email' => $data['student_email']
        );
        $dup_email = $this->basic->exist_or_not($where,$this->table);
        if($dup_email){
            $otp = rand(100000,999999);
            $email_status = $this->sendOTP($data['student_email'],$otp);
            $otp_insert = $this->student->otp_create($otp);
            $dataa['msg'] = 'success';
            // if($email_status= 'otp_send'){
            //     $otp_check = $this->Agent_password_model->otp_create($otp);
            // }
        }else{
            $dataa['msg'] = 'error';
        }
        echo json_encode($dataa);
    }

    function check_otp(){
        $data = $this->input->post();
        $result = $this->student->otp_verification($data['check_otp']);
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

    public function sendOTP($email,$otp){
        include_once 'PHPMailer/PHPMailer.php';
        $message_body = "ONE TIME PASSWORD IS:<br/><br/>".$otp;
        $mail = new PHPMailer();
        $mail->AddReplyTo('surajghpta1199@gmail.com','suraj gupta');
        $mail->SetFrom('surajghpta1199@gmail.com','suraj gupta');
        $mail->AddAddress($email);
        $mail->Subject = "otp to login";
        $mail->MsgHTML($message_body);
        $result = $mail->send();
        $data['msg']="otp_send";
        return $data;
    }

    public function set_password(){
        $email = $this->input->post('email');
        $data['student_password'] = md5($this->input->post('password'));
        $where = array(
            'student_email' => $email);
        $result = $this->basic->update_table($where,$data,$this->table);
        echo $result;
    }

    public function update_proof()
    {
        $folder_name = 'student_proof';
        $ICAI_proof=$this->user_id.'_icai_proof.jpg';
        $government_front=$this->user_id.'_government_proof_front.jpg';
        $government_back=$this->user_id.'_government_proof_back.jpg';
        $data = $this->input->post();
        $where = array(
            'student_id' => $this->user_id);
        $final_array= array();
        $array_1 = array($ICAI_proof,'student_bil_ICAI_proof');
        $array_2 = array($government_front,'student_bil_government_front');
        $array_3 = array($government_back,'student_bil_government_back');
        array_push($final_array,$array_1,$array_2,$array_3);
        $result = $this->upload_img($final_array,$folder_name);
        if($result == 'successfully uploaded'){
            $data['student_bil_ICAI_proof'] = $ICAI_proof;
            $data['student_bil_government_front'] = $government_front;
            $data['student_bil_government_back'] = $government_back;
            $update = $this->basic->update_table($where,$data,$this->table);
            echo 1;
        }else if('You did not select a file to upload'){
            $update = $this->basic->update_table($where,$data,$this->table);
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

    public function update_password(){
        $data = $this->input->post();
        $where = array(
            'student_password' => md5($data['old_password']),
            'student_id' => $this->user_id);
        $result = $this->basic->exist_or_not($where,$this->table);
        if($result){
            $id['student_id'] =  $this->user_id;
            $password['student_password'] = md5($data['student_password']);
            $update = $this->basic->update_table($id,$password,$this->table);
            echo 1;
            die;
        }
        echo 0;
    }

    public function update_address(){
        $data = $this->input->post();
        $data['stu_id'] = $this->user_id;
        $where =array(
            'stu_id' => $this->user_id);
        $result = $this->basic->exist_or_not($where,$this->add_table);
        if($result){
            $update = $this->basic->update_table($where,$data,$this->add_table);
            echo 1;
        }else{
            $insert = $this->basic->insert($data,$this->add_table);
            echo 1;
        }
    }

    function retrieve_address(){
        $where = array(
            'stu_id' => $this->session->userdata('student_id'));
        $result = $this->basic->get_single_data($where,$this->add_table);
        if($result != ''){
            $result['state_code_value'] = $result['stu_bil_state_code'] != "" ? $this->basic_mol->get_single_data(array('state_code_id'=>$result['stu_bil_state_code']),'state_code'):array('state_code_id'=>2);
            echo json_encode($result);
        }else{
            echo 0;
        }
    }
     function fetch_orders()
    {
        $where = array('student_id' => $this->user_id,);
        $fetch_data= 'ck.course_id,ce.course_title,ce.course_banner_img,ce.course_googledrive_link,cvvm.course_view_value_name as course_view,atvm.value as course_mode,ctvm.course_type_value_name as course_duration,ck.course_key,ck.assigned_date,ck.valid_date';
        // $fetch_data='ck.course_id,ce.course_title,ce.course_banner_img,ce.course_googledrive_link,ck.course_view,ck.course_mode,ck.course_duration,ck.course_key,ck.assigned_date,ck.valid_date,ck.course_view,cp.course_discount_price';

        $modal_data=array(
                          'select_coloumns' =>  $fetch_data,
                          'where_condition1' => $where,
                          'where_condition2' => "",
                          'where_condition3' => "",
                          'where_condition4' => "",
                          'where_condition5' => "",
                          'group_by_coloumn' => '',
                          'table' => $this->course_key .' as ck',
                          );
        $join_data=array(
                    'join_table'       => $this->course .' as ce',
                    'join_condition'   =>  'ce.course_id = ck.course_id',
                    'join_table2'        => 'course_type_value_master as ctvm',
                    'join_condition2'    => 'ctvm.course_type_value_id=ck.course_duration',
                    'join_table3'        => 'course_view_value_master as cvvm',
                    'join_condition3'    => 'cvvm.course_view_value_id=ck.course_view',
                    'join_table4'        => 'attribute_value_master as atvm',
                    'join_condition4'    => 'atvm.value_id = ck.course_mode',
                );
       $order_results=$this->student->get_all_data($modal_data,$join_data);
     
       $data['msg']='error';
       if($order_results)
       {
           $order_data='<div class="row">
                                        <div class="mb-5 combo-list">
                                            <div class="container">';
                                                $i = 1;
                                                foreach ($order_results as $order_row) {
                                                    $i++;
                                                    $status= $order_row['valid_date']==$this->current_date? '<label><strong>Status:</strong><span class="alert-danger"> Expired</span></label>':'';
                                                    //   $course_mode_res = $this->basic_mol->get_single_data(array('value_id'=>$order_row['course_mode']),'attribute_value_master');
                                                    //   $course_view_res = $this->basic_mol->get_single_data(array('value_id'=>$order_row['course_view']),'attribute_value_master');
                                                    //   $course_duration_res=$this->basic_mol->get_single_data(array('course_type_value_id'=> $order_row['course_duration']),'course_type_value_master');
                                               
        $order_data.=                           '<div class="content_box radius_all_10 box_shadow1 animation row pt-3" data-animation="fadeInUp" data-animation-delay="0.01s">
                                                    <div class="content_img radius_ltrt_10 col-md-2 col-sm-4 mb-3">
                                                        <a href="'. base_url("/home/product_detail/course/".$order_row["course_id"]."") .'"><img src="'.base_url("assets/admin/assets/images/course_images/".$order_row['course_banner_img']."").'" alt="course_img1"/></a>
                                                    </div>
                                                    <div class="content_desc col-md-6 col-sm-4 mb-3">
                                                        <h4 class="content_title"><a href="'. base_url("/home/product_detail/course/".$order_row["course_id"]."") .'">'.$order_row['course_title'].'</a></h4>
                                                        <label><strong>Mode</strong>:'.$order_row['course_mode'].' <span><strong>Duration</strong>: '.$order_row['course_duration'].' months</span><span><strong> Views</strong>: '.$order_row['course_view'].'</span></label>
                                                        <br/>
                                                        <small>Course Link: <a href="'.$order_row['course_googledrive_link'].'" target="_blank">Click Here</a></small>
                                                        <br/>
                                                        <br/>';
        $prod_order_feedback = $this->uri->segment(3) == "feedback"?"feedback":"order";
        if($prod_order_feedback == "feedback"){
            $order_data.=                          '<strong>Write A Product Review  </strong>
                                                    <i class="ti-comment-alt clipboard-icons" onclick="writeReview('.$order_row["course_id"].',1)" title="Write review" id="write_review_'.$i.'"></i>';
        }else{
            $order_data.=                          '<small> Course Key: <input type="password" id="courseKey'.$i.'" name="course_key" value="'.$order_row['course_key'].'                                    " readonly>
                                                        <i class="far fa-eye clipboard-icons" title="show password" id="toggleKey'.$i.'" onclick="show_key('.$i.')"></i>
                                                        <i class="far fa-copy clipboard-icons" id="keyTooltip'.$i.'" onclick="copyKey('.$i.')" onmouseout="outFunc('.$i.')" title="Copy to clipboard"></i>
                                                        <i class="ti-comment-alt clipboard-icons" onclick="writeReview('.$order_row["course_id"].',1)" title="Write review" id="write_review_'.$i.'"></i>
                                                    </small>';
        }
        $order_data.=                               '
                                                    </div>
                                                    <div class="content_img radius_ltrt_10 col-md-4 col-sm-4 mb-3 mt-3">
                                                        <label><strong>Purchased On:</strong> '.date_format(date_create($order_row['assigned_date']),"d , M.Y").'</label>
                                                        <br/>
                                                        '.$status.'
                                                        <br/>
                                                        <!-- <label for="price" class="alert alert-success">
                                                             ₹ '.$order_row['course_id'].'
                                                        </label> -->
                                                    </div>
                                                </div>';
                                                
                                                }

        $order_data.=                       '</div>
                                        </div>
                                    </div>';
                                    
        
        $data['msg']='success';
        $data['order_data']=$order_data;
       }
     
        
        
       echo json_encode($data);

    }

    function update_profile(){
        $data = $this->input->post();
        $folder_name = 'user_profile';
        $profile_img=$this->user_id.'_profile_img.jpg';
        $where = array(
            'student_id' => $this->user_id);
        $final_array= array();
        $array_1 = array($profile_img,'uploadfile');
        array_push($final_array,$array_1);
        $result = $this->upload_img($final_array,$folder_name);
        if($result == 'successfully uploaded'){
            $session = $this->session->userdata();

            $session['student_profile'] = $profile_img;

            $this->session->set_userdata($session);

            $data['student_profile'] = $profile_img;
            $update = $this->basic->update_table($where,$data,$this->table);
            echo 1;
        }else{
            echo $result;
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('home');
    }
}