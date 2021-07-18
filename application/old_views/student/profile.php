<?php     

    $icai_status = $data['student_bil_ICAI_proof_status'] == 1 ? "disabled": "";
    $front_img_status = $data['student_bil_government_front_status'] == 1 ? "disabled": "";
    $back_img_status = $data['student_bil_government_back_status'] == 1 ? "disabled": "";
?>

<style type="text/css">
    .social-prof, .social-prof h3, .social-prof p {
    color: #fff;
    text-align: center;
}

.social-prof .wrapper {
    width: 70%;
    margin: auto;
    margin-top: -290px;
}

.social-prof img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin-bottom: 20px;
    border: 5px solid #fff;
    /*border: 10px solid #70b5e6ee;*/
}

.social-prof h3 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 0;
}

.social-prof p {
    font-size: 18px;
}

.social-prof .nav-tabs {
    border: none;
}

</style>
<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_50" data-parallax-bg-image="<?php echo base_url(); ?>assets/images/about_bg.jpg">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-6">
            	<div class="page-title">
            		<h1>Profile</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->

<!-- START SECTION FEATURE -->
<section class="bg_gray">
    <div class="container">
        <div class="img" style="    background-image: linear-gradient(150deg, rgba(63, 174, 255, .3)15%, rgba(63, 174, 255, .3)70%, rgba(63, 174, 255, .3)94%), url(https://bootdey.com/img/Content/flores-amarillas-wallpaper.jpeg);height: 350px;background-size: cover;"></div>
        <div class="card social-prof">
            <div class="card-body">
                <div class="wrapper">
                    <form id="upload_profile_img">
                        <?php if($data['student_profile'] == ''){?>
                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="rounded-circle user-profile" id="img1">
                        <input onchange="displayURL(this);" type="file" name="uploadfile" id="upload_image" style="display:none;"/>
                        <label for="upload_image" id="img_upload" style="cursor: pointer;position: absolute;background-color: #132741;color: #c6c8ce;border-radius: 5px;text-align: center;order: none;font-size: 12px;padding: 12px 24px;left: 50%;transform: translate(-50%, 100%);top: -193px;" >Upload</label>
                        <?php }else{?>
                        <img src="<?php echo base_url('images/user_profile/').$data["student_profile"]; ?>" class="rounded-circle user-profile" id="img1">
                        <input onchange="displayURL(this);" type="file" name="uploadfile" id="upload_image" style="display:none;"/>
                        <label for="upload_image" id="img_upload" style="cursor: pointer;position: absolute;background-color: #132741;color: #c6c8ce;border-radius: 5px;text-align: center;order: none;font-size: 12px;padding: 12px 24px;left: 50%;transform: translate(-50%, 100%);top: -193px;" >Upload</label>
                    <?php }?>
                    </form>
                    <h3><?php echo $data['student_first_name'].' '.$data['student_last_name']  ?></h3>
                    <p>Student</p>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <ul class="nav nav-tabs justify-content-center mt-5">
                            <li><a class="nav-link" data-toggle="tab" href="#profile">Account</a></li>
                            <li><a class="nav-link" data-toggle="tab" name="retrieve_address" id= 'retrieve_address' href="#address">Address</a></li>
                            <li><a class="nav-link" data-toggle="tab" id= 'user_order' href="#courses">Orders</a></li>
                            <li><a class="nav-link" data-toggle="tab" id= 'user_feedback' href="#feedback">Feedback</a></li>
                            <li><a class="nav-link" id= 'user_transaction' href="<?php echo base_url(); ?>student/transactions">Transactions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-body profile">
            <div class="row gutters-sm">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="profile" class="tab-pane fade">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row" id='remove_field'>
                                                <div class="form-group col-md-12 text-center">
                                                    <label id='document_verified_status'></label>
                                                </div>
                                            </div>
                                            <form id="profile-details">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">First Name</h6>
                                                        <input type="text" class="form-control" value='<?php echo $data['student_first_name']; ?>' name="student_first_name"aria-describedby="emailHelp" placeholder="Enter First Name..." required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Last Name</h6>
                                                        <input type="text" class="form-control" value='<?php echo $data['student_last_name']; ?>' name="student_last_name"aria-describedby="emailHelp" placeholder="Enter Last Name..." required>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Mother's Name</h6>
                                                        <input type="text" class="form-control" value='<?php echo $data['student_mother_name']; ?>' name="student_mother_name"aria-describedby="emailHelp" placeholder="Enter Mother's Name..." required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Father's Name</h6>
                                                        <input type="text" class="form-control" value='<?php echo $data['student_father_name']; ?>' name="student_father_name" aria-describedby="emailHelp" placeholder="Enter Father's Name..." required>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Mobile No.</h6>
                                                        <input type="text" class="form-control only_number" value='<?php echo $data['student_phone']; ?>' name="student_phone" aria-describedby="emailHelp" placeholder="Enter Mobile Number..." maxlength="10" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Email Id</h6>
                                                        <input type="text" class="form-control" value='<?php echo $data['student_email']; ?>' id="student_email" name="student_email" aria-describedby="emailHelp" data-value="read_only" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Alternate mobile number</h6>
                                                        <input type="text" class="form-control only_number" value='<?php echo $data['student_phone_option']; ?>' name="student_phone_option" aria-describedby="emailHelp" maxlength="10" placeholder="Enter Alternate Number..." required>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">ICAI Registration No.</h6>
                                                        <input type="text" class="form-control" value='<?php echo $data['student_bil_ICAI_reg']; ?>' name="student_bil_ICAI_reg" aria-describedby="emailHelp" placeholder="Enter ICAI reg no..." required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Registration Proof (Registration Form, Roll No., Marksheet)</h6>
                                                        <img id="profile_upload" src="<?php echo base_url('images/student_proof/').$data["student_bil_ICAI_proof"]; ?>" style="width: 80px;height: 100px;" alt="your image">
                                                        <input type="file" class="form-control" data-value = "<?php echo $data['student_bil_ICAI_proof']; ?>" id="student_bil_ICAI_proof" name="student_bil_ICAI_proof" aria-describedby="emailHelp" placeholder="Father's Name"multiple accept=" .jpg, .jpeg, .png, .gif" <?php echo $icai_status; ?>>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Government Proof (Adhaar ID/ Voter ID/ Driving Licence) Front</h6>
                                                        <img id="doc_upload_front" src="<?php echo base_url('images/student_proof/').$data["student_bil_government_front"]; ?>" style="width: 80px;height: 100px;" alt="your image">
                                                        <input type="file" class="form-control" value='<?php echo $data['student_bil_government_front']; ?>' id="student_bil_government_front" data-value = "<?php echo $data['student_bil_government_front']; ?>" name="student_bil_government_front" aria-describedby="emailHelp" placeholder="Father's Name" multiple accept=" .jpg, .jpeg, .png, .gif" <?php echo $front_img_status; ?>>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Government Proof (Adhaar ID/ Voter ID/ Driving Licence) Back</h6>
                                                        <img id="doc_upload_back" src="<?php echo base_url('images/student_proof/').$data["student_bil_government_back"]; ?>" style="width: 80px;height: 100px;" alt="your image">
                                                        <input type="file" class="form-control" value='<?php echo $data['student_bil_government_back']; ?>' id="student_bil_government_back" name="student_bil_government_back" data-value = "<?php echo $data['student_bil_government_back']; ?>" aria-describedby="emailHelp" placeholder="Father's Name" multiple accept=" .jpg, .jpeg, .png, .gif" <?php echo $back_img_status; ?>>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Attempt Due Month</h6>
                                                        <select name="student_bil_attempt_due_month" id="student_bil_attempt_due_month" class="form-control " data-required="1" data-placeholder="">
                                                            <option value="1" selected="selected">May</option>
                                                            <option value="2">November</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Attempt Due Year</h6>
                                                        <select name="student_bil_attempt_due_year" id="student_bil_attempt_due_year" class="form-control " data-required="1" data-placeholder="">
                                                            <option value="1" selected="selected">2021</option>
                                                            <option value="2">2022</option>
                                                            <option value="3">2023</option>
                                                            <option value="4">2024</option>
                                                            <option value="5">2025</option>
                                                            <option value="6">2026</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="text" id="profile_uploaded" hidden="hidden">
                                                <hr />
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <!-- <button type="button" title="Enable Edit Details!!" class="btn btn-default" id="editButton" name="submit" value="Submit"><i class="fa fa-pencile" ></i>Edit</button> -->
                                                        <button type="button" title="Enable Edit Details!!" class="btn btn-default" id="editCancelButton" name="submit" value="Submit"><i class="fa fa-pencile" ></i>Cancel</button>
                                                        <button type="button" title="Enable Edit Details!!" class="btn btn-default" id="profileUpdateButton" name="submit" value="Submit"><i class="fa fa-pencile" ></i>Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row no-gutters mt-5">
                                                <div class="col-md-12 animation" data-animation="fadeInLeft" data-animation-delay="0.02s">
                                                    <h6>Reset Password</h6>
                                                    <div class="field_form">
                                                        <form id='update_password' name="enq">
                                                            <div class="row">
                                                                <div class="form-group col-12">
                                                                    <input placeholder="Enter Password" id="password" class="form-control" name="password" type="password" required>
                                                                 </div>
                                                                <div class="form-group col-12">
                                                                    <input placeholder="Enter New Password" id="new-password" class="form-control" name="new-password" type="password" required>
                                                                </div>
                                                                <div class="form-group col-12">
                                                                    <input placeholder="Confirm Password" id="cnfm-password" class="form-control" name="cnfm-password" type="password" required>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <button type="submit" title="Submit Your Message!" class="btn btn-default" id="restPassButton" name="submit" value="Submit">Submit</button>
                                                                </div>
                                                                <div class="col-lg-12 text-center">
                                                                    <div id="alert-msg" class="alert-msg text-center"></div>
                                                                </div>
                                                            </div>
                                                        </form>     
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div id="address" class="tab-pane fade">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <form id="profile-details-address">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Address Line 1</h6>
                                                        <input type="text" class="form-control" id="stu_bil_address_1" name='stu_bil_address_1' aria-describedby="emailHelp" placeholder="Address Line 1" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Address Line 2</h6>
                                                        <input type="text"  class="form-control" id="stu_bil_address_2" name='stu_bil_address_2' aria-describedby="emailHelp" placeholder="Address Line 2" required>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Select City</h6>
                                                        <select class="form-control" id="stu_bil_ciy" required>
                                                            <option val="1">Mumbai</option>
                                                            <option val="2">Delhi</option>
                                                            <option val="3">Hariyana</option>
                                                            <option val="4">Chandigarh</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Select State</h6>
                                                        <select class="form-control" id='stu_bil_state' required>
                                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                <option value="Assam">Assam</option>
                                                                <option value="Bihar">Bihar</option>
                                                                <option value="Chandigarh">Chandigarh</option>
                                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                                <option value="Daman and Diu">Daman and Diu</option>
                                                                <option value="Delhi">Delhi</option>
                                                                <option value="Lakshadweep">Lakshadweep</option>
                                                                <option value="Puducherry">Puducherry</option>
                                                                <option value="Goa">Goa</option>
                                                                <option value="Gujarat">Gujarat</option>
                                                                <option value="Haryana">Haryana</option>
                                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                                <option value="Jharkhand">Jharkhand</option>
                                                                <option value="Karnataka">Karnataka</option>
                                                                <option value="Kerala">Kerala</option>
                                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                                <option value="Maharashtra">Maharashtra</option>
                                                                <option value="Manipur">Manipur</option>
                                                                <option value="Meghalaya">Meghalaya</option>
                                                                <option value="Mizoram">Mizoram</option>
                                                                <option value="Nagaland">Nagaland</option>
                                                                <option value="Odisha">Odisha</option>
                                                                <option value="Punjab">Punjab</option>
                                                                <option value="Rajasthan">Rajasthan</option>
                                                                <option value="Sikkim">Sikkim</option>
                                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                                <option value="Telangana">Telangana</option>
                                                                <option value="Tripura">Tripura</option>
                                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                <option value="Uttarakhand">Uttarakhand</option>
                                                                <option value="West Bengal">West Bengal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">State Code</h6>
                                                        <input class= "form-control only_number" placeholder="Enter State Code" id="stu_bil_state_code" class="form-control" maxlength="6" name="stu_bil_state_code" type="text" required/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Select Country</h6>
                                                        <select class="form-control" id="stu_bil_country" required>
                                                            <option value="India">India</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6 class="mb-0">Pincode</h6>
                                                        <input class= "form-control only_number" placeholder="Enter Postal code" id="stu_bil_pin" class="form-control" maxlength="6" name="stu_bil_pin" type="text" required/>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="button" title="Enable Edit Details!!" class="btn btn-default" id="add_profileUpdateButton" name="submit" value="Submit"><i class="fa fa-pencile" ></i>Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="courses" class="tab-pane fade">
                                   
                                </div>
                                <div id="feedback" class="tab-pane fade">
                                    <div class="row no-gutters">
                                        <div class="col-md-12 animation" data-animation="fadeInLeft" data-animation-delay="0.02s">
                                            <div class="padding_eight_all">
                                                <div class="field_form">
                                                    <form method="post" name="enq">
                                                        <div class="row">
                                                            <div class="form-group col-12">
                                                                <input required="required" placeholder="Enter Name" id="first-name" class="form-control" name="name" type="text">
                                                             </div>
                                                            <div class="form-group col-12">
                                                                <input required="required" placeholder="Enter Email" id="email" class="form-control" name="email" type="email">
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <input required="required" placeholder="Enter Phone No." id="phone" class="form-control" name="phone" type="tel">
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <input placeholder="Enter Subject" id="subject" class="form-control" name="subject" type="text">
                                                            </div>
                                                            <div class="form-group col-lg-12">
                                                                <textarea required="required" placeholder="Review" id="description" class="form-control" name="message" rows="3"></textarea>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <button type="submit" title="Submit Your Message!" class="btn btn-default" id="submitButton" name="submit" value="Submit">Submit</button>
                                                            </div>
                                                            <div class="col-lg-12 text-center">
                                                                <div id="alert-msg" class="alert-msg text-center"></div>
                                                            </div>
                                                        </div>
                                                    </form>     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="rating-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Review And Rating</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="rating">
                                <span class="rating_count" onclick="my_id_value(1)" data-value="1"><i class="ion-android-star-outline"></i></span>
                                <span class="rating_count" onclick="my_id_value(2)"  data-value="2"><i class="ion-android-star-outline"></i></span> 
                                <span class="rating_count" onclick="my_id_value(3)" data-value="3"><i class="ion-android-star-outline"></i></span>
                                <span class="rating_count" onclick="my_id_value(4)" data-value="4"><i class="ion-android-star-outline"></i></span>
                                <span class="rating_count" onclick="my_id_value(5)" data-value="5"><i class="ion-android-star-outline"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <textarea required="required" id="review_desc" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                            <input type="hidden" id="product_details" product_id="" product_type="" readonly>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-default" id="btn_AddReview" name="submit" value="Submit">Submit Review</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   function show_key(key_id) {
       
      var password = document.getElementById('courseKey'+key_id);
      var y = document.getElementById('toggleKey'+key_id);
      
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        y.classList.toggle('fa-eye-slash');
        
    }
    function copyKey(key_id) {
      var copyText = document.getElementById('courseKey'+key_id);
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      document.execCommand("copy");
      
      var tooltip = document.getElementById("keyTooltip"+key_id);
      alert("Copied: " + copyText.value);
    }

    function outFunc(key_id) {
      var tooltip = document.getElementById('courseKey'+key_id);
      
    }
    $(document).ready(function(){

        $('.only_number').keyup(function(e){
            e.preventDefault();
            if (/\D/g.test(this.value))
            {
                this.value = this.value.replace(/\D/g, '');
                alert('Only Number Allowed')
            }
        });

        $('.nav-tabs').find('a[href="#<?php echo $this->uri->segment(3); ?>"]').click();

        $(".rating-modal").on('click', function(){
            $("#rating-modal").show();
        });

        $(".close").on('click', function(){
            $("#rating-modal").hide();
        });

        <?php 
            if($verify_status[0] != 'not_upload' && $verify_status[0] != 'verified'){
                $status = implode(',',$verify_status);
                echo '  $("#document_verified_status").html("* document are not verified or under process").css("color","red");';
            }
            if($verify_status[0] == 'not_upload'){
                echo '$("#document_verified_status").html("*please upload all document and information").css("color","black");';
            }
            if($verify_status[0] == 'verified' ){
                echo '  $("#document_verified_status").html("*your document has been verified ").css("color","blue");
                        $("#retrieve_address,#user_order,#user_feedback,#user_transaction").css("pointer-events","unset");';
            }

            if($data['student_bil_attempt_due_month'] != ""){
                echo '$("#student_bil_attempt_due_month").val('.$data['student_bil_attempt_due_month'].').change();';
                echo '$("#student_bil_attempt_due_year").val('.$data['student_bil_attempt_due_year'].').change();';
            }

        ?>

        // $("#retrieve_address,#user_order,#user_feedback,#user_transaction").css("pointer-events","none");

    });

    function writeReview(product_id,product_type)
    {
        $('#product_details').attr('product_id',product_id);                                                              
        $('#product_details').attr('product_type',product_type);                                                              
                                                            
        $("#rating-modal").show();
    }

    $("#profileUpdateButton").on("click",function(e){
        e.preventDefault();

        var icai_proof = $('#student_bil_ICAI_proof').attr('data-value');
        var front_proof = $('#student_bil_government_front').attr('data-value');
        var back_proof = $('#student_bil_government_back').attr('data-value');
        if(!icai_proof){
            swal("Select ICAI Proof document");
            return false;
        }

        if(!front_proof){
            swal("Select Front Image Proof document");
            return false;
        }

        if(!back_proof){
            swal("Select Back Image document");
            return false;
        }

        swal({
            title: "Have You Checked Details?",
            text: "Proccessing Your request",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((send_data) => {
            if (send_data) {
                var formData = new FormData(e.target.form);
                console.log(formData);
                $.ajax({
                    method:'POST', 
                    enctype: 'multipart/form-data',
                    url:'<?php echo base_url(); ?>student/update_proof',
                    data: formData,
                    contentType: false,  
                    cache: false,  
                    processData:false, 
                    success:function(data)
                    {
                        console.log(data);
                        if(data == 1){
                            swal('Details updated successfully :-)');
                            location.reload();
                        }
                        else{    
                            swal('Error while updating details ;-(.');
                        }
                        return false;
                    },
                    error:function(data){
                        console.log(data+'fail');
                    }
                });
            }else{
                location.reload();
            }
        });
        return false;
    });

    $('#update_password').submit(function(e){
        e.preventDefault();
        swal({
            title: "Have You Checked Details?",
            text: "Proccessing Your request",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((send_data) => {
            if (send_data) {
                var password = $('#password').val();
                var new_password = $('#new-password').val();
                var cnfm_password = $('#cnfm-password').val();
                if(new_password != cnfm_password){
                    alert('new password and confirm password does not match');
                    return false;
                }
                $.ajax({
                    method:'POST', 
                    enctype: 'multipart/form-data',
                    url:'<?php echo base_url(); ?>student/update_password',
                    data: {'student_password':new_password,'old_password':password},
                    cache: false,  
                    success:function(data)
                    {
                        console.log(data);
                        if(data == 1){
                            swal('Details updated successfully :-)');
                            location.reload();
                        }
                        else{    
                            swal('Enter incorrect current password ;-(.');
                        }
                        return false;
                    },
                    error:function(data){
                        console.log(data+'fail');
                    }
                });
            }else{
                location.reload();
            }
        });
    });

    $('#retrieve_address').click(function(e){
        e.preventDefault();

        $.ajax({
            url:'<?php echo base_url(); ?>student/retrieve_address',
            dataType:'JSON',
            success:function(data)
            {
                if(data != 0){
                    $('#stu_bil_address_1').val(data.stu_bil_address_1);
                    $('#stu_bil_address_2').val(data.stu_bil_address_2);
                    $('#stu_bil_ciy').val(data.stu_bil_ciy).change();
                    $('#stu_bil_country').val(data.stu_bil_country).change();
                    $('#stu_bil_state').val(data.stu_bil_state).change();
                    $('#stu_bil_pin').val(data.stu_bil_pin);
                    $('#stu_bil_state_code').val(data.stu_bil_state_code);
                }
                
                return false;
            },
            error:function(data){
                console.log(data+'fail');
            }
        });
    });
    
    $('#user_order').click(function(e){
         e.preventDefault();
         $.ajax({
            url:'<?php echo base_url(); ?>student/fetch_orders',
            dataType:'JSON',
            success:function(data)
            { 
                if(data.msg=='success')
                {
                    $('#courses').html(data.order_data);
                }
                else
                {
                    $('#courses').html('<label class="text-center">No Orders Placed Yet.</label>');
                }
               
            },
            error:function(data){
                console.log(data+'fail');
            }
        });
    });
    
    $('#student_bil_ICAI_proof').change(function(){
        readURL(this,0);
    });
    $('#student_bil_government_back').change(function(){
        readURL(this,1);
    });
    $('#student_bil_government_front').change(function(){
        readURL(this,2);
    });

    function readURL(input,type) {
    if (input.files && input.files[0]) {
            var reader = new FileReader();
            if(type==0){
                reader.onload = function(e) {
                    $('#profile_upload').attr('src', e.target.result).width(80).height(100);
                    $('#student_bil_ICAI_proof').attr('data-value','icai_image_uploaded');
                }
            }
            if(type==1){
                reader.onload = function(e) {
                    $('#doc_upload_back').attr('src', e.target.result).width(80).height(100);
                    $('#student_bil_government_back').attr('data-value','back_image_uploaded');
                }
            }
            if(type==2){
                reader.onload = function(e) {
                    $('#doc_upload_front').attr('src', e.target.result).width(80).height(100);
                    $('#student_bil_government_front').attr('data-value','front_image_uploaded');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#add_profileUpdateButton').click(function(e){
        e.preventDefault();
        swal({
            title: "Have You Details?",
            text: "Proccessing Your request",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((send_data) => {
            if (send_data) {
                var form = new FormData(e.target.form);
                var city = $('#stu_bil_ciy').val();
                var state = $('#stu_bil_state').val();
                var country = $('#stu_bil_country').val();
                var state_code = $('#stu_bil_state_code').val();
                form.append('stu_bil_ciy',city);
                form.append('stu_bil_state',state);
                form.append('stu_bil_country',country);
                form.append('stu_bil_state_code',state_code);
                $.ajax({
                    method:'POST', 
                    enctype: 'multipart/form-data',
                    url:'<?php echo base_url(); ?>student/update_address',
                    data:form,
                    contentType: false,  
                    processData:false,
                    cache: false,
                    success:function(data)
                    {
                        console.log(data);
                        if(data == 1){
                            // $('#profile_uploaded').val('uploaded profile');
                            swal('Details updated successfully :-)');
                            location.reload();
                        }
                        else{    
                            swal('Error while updating please refresh ;-(.');
                        }
                        return false;
                    },
                    error:function(data){
                        console.log(data+'fail');
                    }
                });
            }else{
                location.reload();
            }
        });
    });

    $('#upload_image').on('change',function(e){
        e.preventDefault();
        swal({
            title: "Have You Checked Photo?",
            text: "Proccessing Your request",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((send_data) => {
            if (send_data) {
                var formData = new FormData(e.target.form);
                $.ajax({
                    method:'POST', 
                    enctype: 'multipart/form-data',
                    url:'<?php echo base_url(); ?>student/update_profile',
                    data: formData,
                    contentType: false,  
                    cache: false,  
                    processData:false, 
                    success:function(data)
                    {
                        console.log(data);
                        if(data == 1){
                            swal('profile updated successfully :-)');
                            location.reload();
                        }
                        else{    
                            alert(data);
                        }
                        return false;
                    },
                    error:function(data){
                        console.log(data+'fail');
                    }
                });
            }else{
                location.reload();
            }
        });
    });
</script>