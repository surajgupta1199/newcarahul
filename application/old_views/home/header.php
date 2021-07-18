<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Anil z" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="CA Rahul Garg - Education & Courses">
<meta name="keywords" content="academy, course, education, elearning, learning, education, university , college , school , online education , tution center ">

<!-- SITE TITLE -->
<title>CA Rahul Garg - Education & Courses</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
<!-- Animation CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.css" />    
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" />
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet" /> 
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet" />
<!-- Icon Font CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themify-icons.css" />
<!-- FontAwesome CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/all.min.css" />
<!--- owl carousel CSS-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/owlcarousel/css/owl.carousel.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/owlcarousel/css/owl.theme.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/owlcarousel/css/owl.theme.default.min.css" />
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/magnific-popup.css" />
<!-- Style CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css" />
<link rel="stylesheet" id="layoutstyle" href="<?php echo base_url(); ?>assets/color/theme-blue-light.css" />
<!-- Latest jQuery --> 
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

<!-- LOADER -->
<div id="preloader">
    <span class="spinner"></span>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- END LOADER --> 

<!-- <div class="alertbox">
    <div class="alert bg_danger" role="alert">
        <div class="container">
            <div class="row">               
                <div class="col-md-12 text-center">
                    <div class="alertbox_content">
                        <span>Unlimited online course &amp; video tutorials downloads! <a href="#"><u>Get 30% off</u></a></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div> -->

<div class="modal fade lr_popup not_dismiss" id="Login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <div class="row no-gutters">
                    <div class="col-lg-5">
                        <div class="h-100 background_bg radius_ltlb_5" data-img-src="<?php echo base_url(); ?>assets/images/login_img.jpg"></div>
                    </div>
                    <div class="col-lg-7">  
                        <div class="padding_eight_all">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="login-tab1" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="signup-tab1" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">Sign Up</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="login" role="tabpanel">
                                    <div class="heading_s1 mb-3 hidden">
                                        <h4>Login</h4>
                                    </div>
                                    <form id='login_form' class="login">
                                        <div class="form-group">
                                            <input type="email" required="" class="form-control" name="student_email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" required="" type="password" name="student_password" placeholder="Password">
                                        </div>
                                        <div class="login_footer form-group">
                                            <a href="#" id='reset' name='reset'>Lost your password?</a>
                                            <div class="chek-form mb-3">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                                    <label class="form-check-label" for="exampleCheckbox3">Remember me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <button type="submit" class="btn btn-default btn-block" name="login">Log in</button>
                                        </div>
                                    </form>
                                    <div class="heading_s1 mb-3 reset1" style='display:none;'>
                                        <h4>Reset</h4>
                                    </div>
                                    <form id='reset_pass' class="login" style="display: none;">
                                        <div class="form-group">
                                            <input type="email" required="" class="form-control" id='reset_email_id' name="student_email" placeholder=" Enter Email">
                                        </div>
                                        <span id='incorrect'></span>
                                        <div class="login_footer form-group generate_otp">
                                            <a href="#" id='user_login' name='login'>Login</a>
                                        </div>
                                        <div class="form-group generate_otp">
                                            <button type="submit" class="btn btn-default btn-block" id="email_verify" name="reset">Email Verify</button>
                                        </div>
                                    </form>
                                    <span id='sub_button'></span>
                                </div>
                                <div class="tab-pane fade" id="signup" role="tabpanel">
                                    <div class="heading_s1 mb-3">
                                        <h4>Sign Up</h4>
                                    </div>
                                    <form id='sign_up_form' class="login">
                                    	<div class="form-group">
                                            <input type="text" required="" class="form-control" name="student_first_name" placeholder="First name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required="" class="form-control" name="student_last_name" placeholder="Last name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required="" class="form-control verify_email only_number" name="student_phone" id='stud_mob' placeholder="Mobile Number">
                                            <span class="veriry_btn email_verified alert alert-primary" data-value="otp_verify">Send OTP</span>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control only_number" required="" type="text" id="phone_otp_verify" onKeyPress="if(this.value.length==6) return false;" placeholder="Enter Mobile OTP">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" required="" class="form-control verify_email" id="verify_student_email" name="student_email" placeholder="Email">
                                            <span id="email_verified" class="veriry_btn email_verified alert alert-primary" data-value="otp_verify">Send OTP</span>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control only_number" required="" type="text" id="check_otp_verify" onKeyPress="if(this.value.length==6) return false;" placeholder="Enter Email OTP">
                                        </div>
                                        <div class="form-group" id="check_otp"></div>
                                        <div class="form-group">
                                            <input class="form-control" required="" type="password" id='student_password' name="student_password" placeholder="Password">
                                        </div>
                                        <span id='email_exists'></span>
                                        <div class="form-group">
                                            <button type="submit" id="sign_up_submit" title="Please filled all input" class="btn btn-default btn-block" disabled>Sign Up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="reset" role="tabpanel">
                                    <div class="heading_s1 mb-3">
                                        <h4>Reset Password</h4>
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

<style>
.email_verified{
    cursor: pointer;
}
#sign_up_submit{
    cursor: not-allowed;
}
</style>

<!-- START HEADER -->
<header class="header_wrap dark_skin bg-dark">
    <div class="top-header light_skin ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <ul class="contact_detail list_none text-center text-md-left">
                        <li><a href="#"><i class="ti-mobile"></i>123-456-7890</a></li>
                        <li><a href="#"><i class="ti-email"></i>info@yourmail.com</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-wrap align-items-center justify-content-md-end justify-content-center mt-2 mt-md-0">
                        <ul class="list_none social_icons text-center text-md-right">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                        <ul class="list_none header_list border_list ml-1">
                            <?php if($this->session->userdata('student_id') == null){?>
                            <li><a href="#" id='show_modal'>Login</a></li>
                        <?php }?>
                            <li><a href="https://www.dtdc.in/" target="_blank" class="btn btn-default btn-sm">Track Order</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg"> 
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img class="logo_light" src="<?php echo base_url(); ?>assets/images/logo.svg" alt="logo" />
                <img class="logo_dark" src="<?php echo base_url(); ?>assets/images/logo.svg" alt="logo" />
                <img class="logo_default" src="<?php echo base_url(); ?>assets/images/logo.svg" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="ion-android-menu"></span> </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="animated">
                        <a class="nav-link <?php echo isset($active_route) && $active_route == 'index' ? 'active' : ''; ?> " href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li>
                        <a class="nav-link <?php echo isset($active_route) && $active_route == 'about' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>home/about">About Us</a>
                    </li>
                    <li>
                        <a class="nav-link <?php echo isset($active_route) && $active_route == 'course' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>home/course">Courses</a>
                    </li>
                    <li>
                        <a class="nav-link <?php echo isset($active_route) && $active_route == 'privacy' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>home/privacy">Important Policies</a>
                    </li>
                    <li>
                        <a class="nav-link <?php echo isset($active_route) && $active_route == 'gallery' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>home/gallery">Gallery</a>
                    </li>
                    <!--<li>
                        <a class="nav-link <?php //echo isset($active_route) && $active_route == 'freecourse' ? 'active' : ''; ?>" href="<?php //echo base_url(); ?>home/freecourse">Free Resources</a>
                    </li>-->
                    <li>
                        <a class="nav-link <?php echo isset($active_route) && $active_route == 'contact' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>home/contact">Contact</a>
                    </li>
                    <li>
                        <a class="nav-link <?php echo isset($active_route) && $active_route == 'faq' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>home/faq">Faq</a>
                    </li>
                    <?php if($this->session->userdata('student_id') != null){?>
                    <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Profile</a>
                        <div class="dropdown-menu">
                            <ul> 
                                <li>
                                    <a class="dropdown-item nav-link nav_item" href="<?php echo base_url(); ?>student/profile/profile">
                                        <?php if($this->session->userdata('student_profile') == ""){
                                            echo '<img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="nav-profile-img"><b>'.$this->session->userdata("student_first_name").' '.$this->session->userdata("student_last_name").'</b>';
                                        }else{
                                            echo '<img src="'.base_url("images/user_profile/".$this->session->userdata("student_profile")."").'" class="nav-profile-img"><b>'.$this->session->userdata("student_first_name").' '.$this->session->userdata("student_last_name").'</b>';
                                        }?>
                                    </a>
                                </li>
                                <li><a class="dropdown-item nav-link nav_item" href="<?php echo base_url(); ?>student/profile/courses">Purchased Courses</a></li>
                                <li><a class="dropdown-item nav-link nav_item" href="<?php echo base_url(); ?>student/profile/feedback">Feedback</a></li>
                                <li><a class="dropdown-item nav-link nav_item" href="<?php echo base_url(); ?>student/transactions">Transaction</a></li>
                                <li><a class="dropdown-item nav-link nav_item" href="<?php echo base_url(); ?>Cart/">Cart</a></li>
                                <li><a class="dropdown-item nav-link nav_item" id="li_Checkout">Checkout</a></li>
                                <li><a class="dropdown-item nav-link nav_item" href="<?php echo base_url(); ?>student/logout">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                <?php }?>
                </ul>
            </div>
            <ul class="navbar-nav attr-nav align-items-center">
                <li><a href="<?php echo base_url('Cart/') ?>" class="nav-link"><i class="ion-ios-cart"></i><span class="badge badge-pill badge-default ml-2" id="cart_count"><?php 
                if($this->session->userdata('student_id') != null){print_r($this->session->userdata('cart_item_count'));}else{echo $this->cart->total_items();} ?></span></a>
                    <!-- <div class="search-overlay">
                        <div class="search_wrap">
                            <form>
                                <input type="text" placeholder="Search" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                    </div> -->
                </li>
            </ul>
        </nav>
    </div>
</header>
<!-- END HEADER --> 
<script>
    $('document').ready(function(){
        $('.only_number').keyup(function(e){
            e.preventDefault();
            if (/\D/g.test(this.value))
            {
                this.value = this.value.replace(/\D/g, '');
                alert('Only Number Allowed')
            }
        });

        $('#sign_up_form').submit(function(e){
            e.preventDefault();
            var password =  $('#student_password').val();
            var cnf_password = $('#cnf_student_password').val();
            var student_email = $('#verify_student_email').val();
            var mob = $('#stud_mob').val();
            if(mob.length != 10){
                swal('error','please enter 10 digit mobile number','error');
                return false;
            }

            var form = new FormData(this);
            form.append('student_email',student_email)
            $.ajax({
                url: '<?php echo base_url("home/sign_up"); ?>',
                type: "POST",
                data:form,
                processData:false,
                cache:false,
                contentType:false,
                dataType: "json",
                success:function(result){
                    console.log(result.msg);
                    if(result.msg == 'success'){
                        swal('info','successfully sign up please login','success');
                        $('#sign_up_form').trigger('reset');
                        location.reload();
                    }else if(result.msg == 'email exist'){ 
                        swal('info','email already exist');
                    }
                }
            })

        });

        $('#login_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url("home/login"); ?>',
                type: "POST",
                data:$(this).serialize(),
                processData:false,
                cache:false,
                dataType: "json",
                success:function(result){
                    if(result.msg == 'success'){
                        swal('info','successfully login','success');
                        location.reload();
                    }else if(result.msg == 'deactive'){ 
                        swal('error','your account has been deactive please contact.','error');
                    }else{
                        swal('error','email password does not match','error');
                    }
                }
            })
        });

        $('#reset').click(function(e){
            $('#login_form,#sub_button,#incorrect,.hidden').hide();
            $('#reset_pass,.generate_otp,.reset1').show();
        });
        $('#signup-tab1').click(function(e){
            e.preventDefault();
            $('#sign_up_form').trigger('reset');
            $('#verify_student_email').attr('disabled',false);
            $('#email_verified').attr('data-value','otp_verify');
            document.getElementById("email_verified").textContent="Send OTP";
            $('#check_otp').html('');
            $('#reset_pass,.reset1').hide();
            $('#login_form,.hidden').show();
            $('#email_verified').show();
        })
        $('#user_login').click(function(e){
            e.preventDefault();
            $('#login_form,.hidden').show();
            $('#reset_pass,.reset1').hide();
        });
        $('.close').click(function(){
            $('.reset1,#reset_pass,#sub_button').hide();
            $('#login_form').show();
        });
        $('#show_modal').click(function(e){
            $('.not_dismiss').modal({backdrop: 'static', keyboard: false}); 
        })
    });
    
    $('#email_verify').click(function(e){
        e.preventDefault();
        var email = $('#reset_email_id').val();
        $.ajax({
            url: '<?php echo base_url("home/reset_password"); ?>',
            type: "POST",
            data:{'student_email':$('#reset_email_id').val()},
            dataType:'JSON',
            success:function(result){
                $('#incorrect').show();
                $('#sub_button').show();
                if(result.msg == 'error'){
                    $('#incorrect').html('email id not exist.').css('color','red');
                }else{
                    $('#incorrect').show();
                    $('.generate_otp').hide();
                    $('#incorrect').html('<div class="form-group"><input type="number" required="" class="form-control" onKeyPress="if(this.value.length==6) return false;" id="pass_otp" name="pass_otp" placeholder=" Enter OTP" ></div>');
                    $('#pass_otp').keyup(function() {
                        if ($(this).val().length == 6) {
                            
                            
                            var otp = $('#pass_otp').val();
                            var checked = verify_email_otp(otp,email,1);
                            if(checked == "error"){
                                swal('error','enter wrong otp','error');
                            }else{
                                $('#incorrect').html('<div class="form-group"><input class="form-control" required="" type="password" id="reset_password_1" name="student_password" placeholder="Password"></div><div class="form-group"><input class="form-control" required="" type="password" id="reset_cnf_password_1" name="cnf_student_password" placeholder="Confirm Password"></div>');
                                $('#sub_button').html('<div class="form-group"><button type="submit" id="reset_password" class="btn btn-default btn-block">Reset Password</button></div>');
                            }
                        }
                    });
                }
            }
        })
    })
    
    function verify_email_otp(otp,email,type){
        var message = "";
        $.ajax({
            url: '<?php echo base_url("home/check_otp"); ?>',
            type: "POST",
            data:{'reset_email_id':email,'check_otp':otp,'type':type},
            dataType: "json",
            async:false,
            success:function(result){
                if(result.msg == 'error'){
                    message = "error";
                }else{
                    message = "success";
                }
            },
            error:function(result){
                alert(result);
                return false;
            }
        });
        return message;
    }
    
    
    $('#sub_button').click(function(e){
        e.preventDefault();
        var email = $('#reset_email_id').val();
        var password = $('#reset_password_1').val();
        var cnf_password = $('#reset_cnf_password_1').val();
        if(password != cnf_password){
            alert('wrong password enter');
            return false;
        }
        $.ajax({
            url: '<?php echo base_url("home/set_password"); ?>',
            type: "POST",
            data:{'email':email,'password':password},
            success:function(result){
                if(result == 1){
                    swal('info','successfully updated','success');
                    $('.reset1,#reset_pass,#sub_button').hide();
                    $('#login_form').show();
                }else{
                    swal('info','password not updated','error');
                }
            }
        });
    })
    
    $('#li_Checkout').click(function(){
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url('checkout/checkAddress'); ?>',
          data: {},
          dataType: 'json',
          encode: true
          }).done(function(data) {
            if(data.msg == "Success") {
              
              window.location.replace("<?php echo base_url('/Checkout'); ?>");
            }
            
            else
            {
             swal('Info!',"Shipping Address Not Listed With Your Account","warning").then((willDelete) => {
                  if (willDelete) {
                  window.location.replace("<?php echo base_url('student'); ?>");
                }
              });
              
            }
      });
      event.preventDefault();
    })
    
    $('#verify_student_email').keyup(function(e){
        e.preventDefault();
        send_otp();
    })

    $('#email_verified').click(function(e){
        e.preventDefault();
        send_otp();  
    })

    function send_otp(){
        var email = $('#verify_student_email').val();
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        if(!pattern.test(email))
        {
          return false;
        }

        var data_value = $('#email_verified').attr('data-value');

        if(data_value != "otp_verify"){
            $('#email_verified').attr('data-value','otp_verify');
            document.getElementById("email_verified").textContent="Send OTP";
            $('#check_otp').html('');
            $('#verify_student_email').attr('disabled',false);
        }else{
            var email = $('#verify_student_email').val();
            console.log(email);
            $.ajax({
                url: '<?php echo base_url("home/check_email"); ?>',
                type: "POST",
                data:{'student_email':email},
                dataType: "json",
                success:function(result){
                    if(result.msg == 'error'){
                        $('#email_exists').html('email id already exist.').css('color','red');
                    }else{
                        $('#email_exists').html('');
                        $('#verify_student_email').attr('disabled',true);
                        $('#email_verified').attr('data-value','change-email');
                        document.getElementById("email_verified").textContent="Edit Email";
                        // $('#check_otp').html('');
                        $('#check_otp_verify').keyup(function() {
                            if ($(this).val().length == 6) {
                                var otp = $('#check_otp_verify').val();
                                var checked = verify_email_otp(otp,email,2);
                                if(checked == "error"){
                                    swal('error','enter wrong otp','error');
                                }else{
                                    swal('success','otp matched','success');
                                    $('#email_verified').hide();
                                    $('#sign_up_submit').attr('disabled',false);
                                    $('#sign_up_submit').css('cursor','pointer');
                                    $('#check_otp_verify').attr('disabled',true);
                                }
                            }
                        });
                    }
                }
            });
        }
    }

</script>