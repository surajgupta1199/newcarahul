<script src="https://player.vimeo.com/api/player.js"></script>
<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_50" data-parallax-bg-image="<?php echo base_url(); ?>assets/images/about_bg.jpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
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
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill"><?php echo $this->session->userdata('cart_item_count');  ?></span>
          </h4>
           <h6 class="d-flex justify-content-between align-items-center">
                <?php echo $availibility_status; ?>
           </h6>
          <ul class="list-group mb-3">
            <?php 
                
                  foreach ($cartItems as $row) {?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo $row['name']; ?></h6>
                <small class="text-muted"><?php echo $row['validity_val']; ?></small>
                <small class="text-muted"><?php echo $row['mode_val']; ?></small>
                <small class="text-muted"><?php echo $row['views_val']; ?> views</small>
              </div>
              <span class="text-muted">₹<?php echo $row['price']."  ";   echo $row['qty']  > 1 ? "X  " .$row['qty'] : '';  ?></span>
            </li>
            <?php }
                ?>
            
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Subtotal</h6>
              </div>
              <span class="text-muted">₹<?php echo $checkout_subtotal; ?></span>
            </li>
            <li class="hide" id="discount_li">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small id="promo_code">EXAMPLECODE</small>
                <input id="coup_id" type="hidden" value="" readonly>
              </div>
              <span class="text-success">- ₹<span id="discount_amount">1500</span></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span><strong>Total</strong></span>
              <strong>₹<span id="grandtotal"><?php echo $checkout_subtotal; ?></span></strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1 bg-white rounded shadow-sm">
           <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold mt-3  mb-3">Shipping address</div>
           <div class="text-center">
             <form id="upload_profile_img">
                <?php if($student_details['student_profile'] == ''){?>
                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="rounded-circle user-profile" id="img1" height="120">
                <input onchange="displayURL(this);" class="upload_image documents"  type="file" name="profile_img" id="upload_image" style="display:none;" required/>
                <label for="upload_image" id="img_upload" style="cursor: pointer;background-color: #132741;color: #c6c8ce;border-radius: 5px;text-align: center;order: none;font-size: 12px;padding: 6px 8px;left: 50%;transform: translate(-50%, 100%);top: -193px;" >Upload</label>
                <?php }else{?>
                <img src="<?php echo base_url('images/user_profile/').$student_details["student_profile"]; ?>" class="rounded-circle user-profile" id="img1" height="120">
                <input onchange="displayURL(this);" class="upload_image" type="file" name="profile_img" id="upload_image" style="display:none;" required />
                <label for="upload_image" id="img_upload" style="cursor: pointer;background-color: #132741;color: #c6c8ce;border-radius: 5px;text-align: center;order: none;font-size: 12px;padding: 6px 8px;left: 50%;transform: translate(-50%, 100%);top: -193px;" >Upload</label>
            <?php }?>
            </form>
          </div>
          <form class="needs-validation" id="update_checkout_detail" novalidate>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control" id="firstName" placeholder="" value="<?php print_r($student_details['student_first_name']); ?>" readonly>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Last name</label>
                  <input type="text" class="form-control" id="lastName" placeholder="" value="<?php print_r($student_details['student_last_name']); ?>" readonly>
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Mother name</label>
                  <?php $readonly_status= $student_details['student_mother_name'] != '' ? 'readonly':'' ?>
                  <input type="text" class="form-control" id="student_mother_name" name="student_mother_name" placeholder="" required value="<?php print_r($student_details['student_mother_name']);?>" <?php echo $readonly_status; ?>>
                  <div class="invalid-feedback">
                    Valid Mother name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Father name</label>
                  <?php $readonly_status= $student_details['student_father_name'] != '' ? 'readonly':'' ?>
                  <input type="text" class="form-control" id="student_father_name" name="student_father_name" placeholder="" required value="<?php print_r($student_details['student_father_name']); ?>" <?php echo $readonly_status; ?>>
                  <div class="invalid-feedback">
                    Valid Father name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Mobile number</label>
                  <input type="text" class="form-control" id="student_phone"  placeholder="" value="<?php print_r($student_details['student_phone']); ?>" readonly>
                  <div class="invalid-feedback">
                    Valid Mobile number is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="student_phone_option">Alternate mobile number </label>
                  <?php $readonly_status= $student_details['student_phone_option'] != '' ? 'readonly':'' ?>
                  <input type="text" class="form-control" id="student_phone_option" name="student_phone_option" required placeholder="" value="<?php print_r($student_details['student_phone_option']); ?>" <?php echo $readonly_status; ?>>
                  <div class="invalid-feedback">
                    Valid Alternate mobile number is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Email</label>
                  <input type="text" class="form-control" id="student_email" placeholder="" value="<?php print_r($student_details['student_email']); ?>" readonly>
                  <div class="invalid-feedback">
                    Valid Email is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Attempt Due Month & Year</label>
                 
                  <input type="text" class="form-control" id="student_attempt_due" placeholder="" value="May 2021" readonly>
                  <div class="invalid-feedback">
                    Valid Attempt Due Month & Year is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">ICAI Registeration </label>
                  <?php $readonly_status= $student_details['student_bil_ICAI_reg'] != '' ? 'readonly':'' ?>
                  <input type="text" class="form-control" id="student_bil_ICAI_reg" placeholder="" required name="student_bil_ICAI_reg" value="<?php print_r($student_details['student_bil_ICAI_reg']); ?>" <?php echo $readonly_status; ?>>
                  <div class="invalid-feedback">
                    Valid ICAI Registeration is required.
                  </div>
                </div>
                  <?php 
                    $registration_proof = $student_details['student_bil_ICAI_proof'] =='' ? '<div class="form-group col-md-6"><label class="mb-0">Registration Proof (Registration Form, Roll No., Marksheet)</label>
                    <input type="file" class="form-control upload_image documents" id="student_bil_ICAI_proof" required name="student_bil_ICAI_proof" multiple accept=" .jpg, .jpeg, .png, .gif"> </div>' : '' ;

                      echo $registration_proof;
                   
                    $government_proof_front = $student_details['student_bil_government_front'] =='' ? '<div class="form-group col-md-6"><label class="mb-0">Government Proof Front (Adhaar ID/ Voter ID/ Driving Licence) Front</label>
                    <input type="file" class="form-control upload_image documents" id="student_bil_government_front" required  name="student_bil_government_front" multiple accept=" .jpg, .jpeg, .png, .gif"></div>' : '';

                      echo $government_proof_front;
                  
                    $government_proof_back = $student_details['student_bil_government_back'] =='' ? '<div class="form-group col-md-6"><label class="mb-0">Government Proof Back (Adhaar ID/ Voter ID/ Driving Licence) Back</label>
                      <input type="file" class="form-control upload_image documents" required id="student_bil_government_back" name="student_bil_government_back" multiple accept=" .jpg, .jpeg, .png, .gif"></div>' : '';
                      echo $government_proof_back;
                  ?>
              </div>
              <div class="mb-3">
                <label for="address">Address <span><small><a href="<?php echo base_url(); ?>student" class="edit-links"><i class="fa fa-edit"></i> (Change Shipping Address)</a></small></span></label>
                <?php $readonly_status= $student_details['stu_bil_address_1'] != '' ? 'readonly':'' ?>
                <input type="text" class="form-control" id="address" name="stu_bil_address_1" value="<?php print_r($student_details['stu_bil_address_1']); ?>" placeholder="1234 Main St" <?php echo $readonly_status; ?>>
                <div class="invalid-feedback">
                  Please enter your shipping address.
                </div>
              </div>

              <div class="mb-3">
                <label for="address2">Address Line 2</label>
                <?php $readonly_status= $student_details['stu_bil_address_2'] != '' ? 'readonly':'' ?>
                <input type="text" class="form-control" name="stu_bil_address_2" id="address2" value="<?php print_r($student_details['stu_bil_address_2']); ?>" placeholder="Apartment or suite" <?php echo $readonly_status; ?>>
              </div>

              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="country">City</label>
                  <?php $city_status= $student_details['stu_bil_ciy'] != '' ? '<input type="text"  class="form-control" name="stu_bil_ciy" id="country"  value="'.$student_details["stu_bil_ciy"].'" readonly>': '';
                      echo $city_status;
                  ?>
                  <div class="invalid-feedback">
                    Please select a valid city.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="state">State</label>
                  <?php $state_status= $student_details['stu_bil_state'] != '' ? '<input type="text"  class="form-control"  id="state" name="stu_bil_state" value="'.$student_details['stu_bil_state'].'" readonly>' : '';
                      echo $state_status;
                  ?>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="country">Country</label>
                  <input type="text"  class="form-control"  id="country" name="stu_bil_country" value="India" readonly>
                  
                  <div class="invalid-feedback">
                    Please select a valid country.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="zip">Pincode</label>
                  <?php $readonly_status= isset($student_details['stu_bil_pin']) ? 'readonly':'' ?>
                  <input type="text" class="form-control" id="zip" name="stu_bil_pin" value="<?php print_r($student_details['stu_bil_pin']); ?>" placeholder="" <?php echo $readonly_status; ?>>
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>
                </div>
               <!--  <a class="btn btn-default rounded-pill py-2 mb-3 btn-block" id="add_profileUpdateButton">Update Details</a> -->
              </div>
              <hr class="mb-4">
              <div class="row bg-white rounded shadow-sm">
                <div class="col-lg-12">
                  <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
                  <div class="p-4">
                    <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
                    <div class="input-group mb-4 border rounded-pill p-2">
                      <input type="text" id="coupan_value" placeholder="Apply coupon"  aria-describedby="button-addon3" class="form-control border-0">
                      <div class="input-group-append border-0">
                        <button id="btnApplyCoupan" type="button" class="btn btn-default px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
                      </div>
                    </div>
                     <div class="input-group-append border-0">
                        <button id="view_codes" type="button" class="btn btn-default px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>View coupon codes</button>
                      </div>
                  </div>
                  <a id="btnPayment" class="btn btn-default rounded-pill py-2 mb-3 btn-block">Procceed to payment</a>
               </div>
               
              </div>
              <div id="view_coupan_model" class="modal fade bs-example-modal-lg" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Available Coupans</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                          <div class="modal-body">
                            <div class="form-group form-float">
                               <div class="row">
                                  <div class="col-md-12">
                                    <?php
                                          foreach($coupan_details as $coupan_row){?>
                                            <div class="coupan-card mt-2">
                                                <div class="card-header" id="heading-1-One">
                                                  <h6> <span>
                                                    <?php 
                                                    if($coupan_row['coup_code'] == 'Ranker') { 
                                                    ?>
                                                    <button id="btn_viewTerms" href="https://www.youtube.com/watch?v=C0DPdy98e4c" class="move-right btn btn-default rounded-pill terms-popup video_play">View Terms</button>
                                                    <button id="apply_coupon" type="button" class="move-right btn btn-default rounded-pill apply_coupon hide"  data-attr="<?php echo $coupan_row['coup_code']; ?>">Apply</button>
                                                    <?php } 
                                                    else{ ?><button type="button" class="move-right btn btn-default rounded-pill apply_coupon" data-attr="<?php echo $coupan_row['coup_code']; ?>">Apply</button> <?php } ?>
                                                  </span>
                                                  <a href="#collapse-1-One" aria-expanded="true" aria-controls="collapse-1-One"><strong style="border:2px dotted ;padding: 5px 15px;" id="coup_code"><?php print_r($coupan_row['coup_code']) ?></strong></a></h6>
                                                  <small>For Minimum Amount: <?php echo '<b>'.$coupan_row['coup_min_amount'].'</b> , '.$coupan_row['coup_description']; ?></small>
                                                </div>
                                            </div>
                                    <?php }?>
                                  </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
            </form>
</section>
<script type="text/javascript">

  $(document).ready(function() {
    //terms popup
    $('.terms-popup').magnificPopup({
        type: 'iframe',
        modal: true,
        callbacks: {
          open: function() {
            setTimeout(function(){
              $('.terms-popup').magnificPopup('close');
            },17000); // 10000 == 10seconds
          }
        }
      });
    });
//View coupan codes
$('#view_codes').click(function(){
  <?php
      if($this->session->userdata('student_id') != '')
      {?>
          $('#view_coupan_model').modal('show');
  <?php }
      else
      {?>
          $('#Login').modal('show');

  <?php }?>
})
//Apply Coupan
$('#btn_viewTerms').click(function(e){
    e.preventDefault();
    $('#btn_viewTerms').addClass('hide');
    $('#apply_coupon').removeClass('hide');
});
$('#btnApplyCoupan').click(function()
{
    <?php
          if($this->session->userdata('student_id') != '')
          {?>
              var coupan_code=$('#coupan_value').val();
              applyCoupan(coupan_code);

      <?php }
          else
          {?>
              $('#Login').modal('show');

      <?php }?>
});

$('.apply_coupon').click(function(e){
   
    coupan_code = $(this).attr("data-attr");
    applyCoupan(coupan_code);
})

function applyCoupan(coupan_code){
 $.ajax({
          type: 'POST',
          url: '<?php echo base_url('checkout/calculateTotal'); ?>',
          data: {coup_code:coupan_code},
          dataType: 'json',
          encode: true
          }).done(function(data) {
            if(data.msg == "Success") {
              swal('Applied Successfully');
              $('#discount_li').addClass('list-group-item d-flex justify-content-between bg-light');
              $('#discount_amount').text(data.discount_amount);
              $('#grandtotal').text(data.discounted_amount);
              $('#promo_code').text(data.promo_code);
              $('#coup_id').val(data.coup_id);
              $('#coupan_value').val('');
              $('#view_coupan_model').modal('hide');
            }
            else if(data.msg == "expiryerror")
            {
              swal('Coupan has been Expired');
              $('#coupan_value').val('');
            }
            else if(data.msg == "amounterror")
            {
              swal('Insufficient Amount To Apply');
               $('#coupan_value').val('');
            }
            else
            {
              swal("Invalid Coupan");
              $('#coupan_value').val('');
            }


      });
    event.preventDefault();
}
//Procced Payment
$('#btnPayment').click(function(){
  var coup_id=$('#coup_id').val();
  var student_mother_name=$('#student_mother_name').val();
  var student_father_name=$('#student_father_name').val();
  var student_phone_option=$('#student_phone_option').val();
  var student_bil_ICAI_reg=$('#student_bil_ICAI_reg').val();
  var numItems = $('.documents').length;


  if(student_mother_name != '' && student_father_name != '' && student_phone_option != '' && student_bil_ICAI_reg != '' && numItems === 0)
  {
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('checkout/proceed_order'); ?>',
        data: {'coup_id':coup_id,'student_mother_name':student_mother_name,'student_father_name':student_father_name,'student_phone_option':student_phone_option,'student_bil_ICAI_reg':student_bil_ICAI_reg},
        dataType: 'json',
        encode: true
        }).done(function(data) {
          if(data.msg == "Success") {
           swal('Info!',"Your Transaction Done Successfully , Thanks For Shopping!! ","success").then((willDelete) => {
                if (willDelete) {
                window.location.replace("<?php echo base_url('student/profile/courses'); ?>");
              }
            });
           
          }
          else if(data.msg == "key_available_error")
          {
              swal("Info","Can't Proceed To Payment Few Items Are Unavailble , Update Cart!!","warning");
          }
          else if(data.msg == "not_updated")
          {
              swal("Info","Can't Proceed To Payment ,  Shipping Details Are Not Updated!!","warning");
           
          }
          else
          {
              swal("Info","Can't Proceed To Payment !!","error");

          }

    });
  }
  else
  {
    swal("Info",'Please Fill All Shipping Details',"error");
    $('#update_checkout_detail').focus();
    return false;
  }
    event.preventDefault();
});

 //update profile pic on change
  $('.upload_image').on('change',function(e){
        e.preventDefault();
        swal({
            title: "Have You Checked Photo?",
            text: "Proccessing Your request",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((send_data) => {
            if(send_data) {
                var formData = new FormData(e.target.form);
                formData.append('file_name',$(this).prop('name'));
                var $image_class=$(this);
                $.ajax({
                    method:'POST', 
                    enctype: 'multipart/form-data',
                    url:'<?php echo base_url(); ?>checkout/update_photo',
                    data: formData,
                    contentType: false,  
                    cache: false,  
                    processData:false, 
                    success:function(data)
                    {
                        if(data == 1){
                            swal("Info!",'Updated successfully :-)','success');
                            $image_class.closest("div").remove();
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

<script src="https://www.youtube.com/player_api"></script>
<script>
    
    // create youtube player
    var player;
    function onYouTubePlayerAPIReady() {
        player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: 'XzZudNOwkU8', <!-- video id should be here. last component from video URL -->
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
    }

    // autoplay video
    function onPlayerReady(event) {
        event.target.playVideo();
    }

    // when video ends
    function onPlayerStateChange(event) {        
        if(event.data === 0) {            
            $('#player').css('display', 'none');
        }
    }
    
</script>