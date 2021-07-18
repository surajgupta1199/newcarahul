
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>/assets/images/logo.svg">
    <title>CA Rahul Garg-Education</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>/assets/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>/assets/admin/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url()?>/assets/admin/css/colors/blue.css" id="theme" rel="stylesheet">
    <script src="<?php echo base_url()?>/assets/admin/js/sweetalert.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(<?php echo base_url()?>/assets/admin/assets/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form autocomplete="off" class="form-horizontal form-material" id="loginform">
                        <h3 class="box-title m-b-20">Sign In</h3>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="email" spellcheck="true" class="form-control" name="employee_email_id" placeholder="Enter Email" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                 <input type="password" class="form-control" name="employee_password" placeholder="Enter Password" required>
                         </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 font-14">
                                <div class="checkbox checkbox-primary pull-left p-t-0">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup"> Remember me </label>
                                </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><!-- <i class="fa fa-lock m-r-5"></i> --> Forgot pwd?</a> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                            <div class="col-xs-12">
                                <div class="input-group" id="response"></div>

                            </div>
                        </div>
                       
                    </form>
                    <form autocomplete="off" class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="email" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                            <div class="col-xs-12">
                                 <div class="input-group" id="rec_response"></div>
                         </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url()?>/assets/admin/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url()?>/assets/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url()?>/assets/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url()?>/assets/admin/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url()?>/assets/admin/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url()?>/assets/admin/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url()?>/assets/admin/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url()?>/assets/admin/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url()?>/assets/admin/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url()?>/assets/admin/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
<script type="text/javascript">
    $("#loginform").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
           url:"<?php echo base_url(); ?>admin/user_login/login", 
            type: "POST",
            data: formData,
            beforeSend: function(){
                  $("#response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
            },
            success: function(response){
            console.log(response);     
                    
                if(response == 1) {
                    $("#response").html("<div class='alert bg-teal alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>Shortly you will redirect to your dashbard.</div>");
                    window.open('<?php echo base_url('admin/userDashboard') ?>', '_self');
                }
                else{
                   $("#response").html("<div class='alert bg-red alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>Username or Password is invalid </div>"); 
                }
                
                
                // }
            },
            cache: false,
            contentType: false,
             processData: false
         });
     });

    $("#recoverform").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url:"<?php echo base_url();?>mailer/email/reset_Password", 
            type: "POST",
            data: formData,
            beforeSend: function(){
                  $("#rec_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
            },
            success: function(response){
            console.log(response);
                
                 if(response == 3){
                   $("#rec_response").html("<div class='alert bg-red alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>Email id does not exist</div>"); 
                }else if(response == 1) {
                    swal('Password reset Link has been sent to your mail account');
                   window.location.replace("<?php echo base_url();?>admin/userDashboard");
                }else{
                   swal('Message Could not be Send');
                }
                
            },
            cache: false,
            contentType: false,
             processData: false
         });
     });
  </script>

