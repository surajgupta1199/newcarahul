            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                 Student Master
                                 
                                <div class="table-responsive m-t-40">
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Student Name</th>                                         
                                            <th>Student Phone</th> 
                                            <th>Student Email</th>                                         
                                            <th>Created at</th>                                         
                                            <th>Status</th>
                                            <th>View</th>
                                            <th>User Address</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody></tbody>                                      
                                       
                                    </table>
                                    <input type="hidden" id="stud_id" value="<?php echo $student_id; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         <div id="view_docs_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Verify Documents</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                      <div class="modal-body">
                          <form autocomplete="off" id="verify_doc_form"   method="POST">
                                  <div class="form-group form-float">
                                        <div class="row">
                                            <?php
                                                  if($this->session->userdata('employee_roll') != 0){
                                                      $coupan_tab_permissions=$this->session->userdata('coupan_tab_permissions');
                                                          if($coupan_tab_permissions[2] == 1){
                                             ?>                                         
                                                          <div class="checkbox" id="select_all_div" style="width: 100px;margin-top: 15px;margin-left: 10px;float: left;right: 90px;position: absolute;">
                                                                <input type="checkbox" id="checkall">
                                                                <label for="checkall">
                                                                    Select All
                                                                </label>
                                                          </div>
                                                          <div style="width: 100px;margin-top: 8px;margin-left: 46px;float: left;right: -13px;position: absolute;" id="verify_div">
                                                              <button style="padding: 7px 6px;" class="btn-primary" id="btn_Verify">Verify</button>
                                                          </div>
                                            <?php
                                                }
                                            }
                                            else
                                            {
                                            ?>
                                                          <div class="checkbox" id="select_all_div" style="width: 100px;margin-top: 15px;margin-left: 10px;float: left;right: 90px;position: absolute;">
                                                                <input type="checkbox" id="checkall">
                                                                <label for="checkall">
                                                                    Select All
                                                                </label>
                                                          </div>
                                                          <div style="width: 100px;margin-top: 8px;margin-left: 46px;float: left;right: -13px;position: absolute;" id="verify_div">
                                                              <button style="padding: 7px 6px;" class="btn-primary" id="btn_Verify">Verify</button>
                                                          </div>

                                          <?php
                                          }
                                          ?>
                                              <div class="col-md-12" style="margin-top: 76px;">
                                                 <div class="checkbox" style="float: right;" id="icai_proof_div">
                                                  <input type="checkbox" name="student_bil_ICAI_proof_status" id="checkbox1" value="0" class="post_ids get_checkbox">
                                                  <label for="checkbox<?php echo 1;?>">
                                                  </label>
                                                </div>
                                                <div style="float: right;display: none" id="icai_verify_div">
                                                 
                                                  <button type="button"   class="btn btn-info btn-xs m-b-10"><i class="ti-check"></i> Verified </button>
                                                </div>
                                                   
                                                   <img type="image" id="student_bil_ICAI_proof_show" src="assets/admin/assets/images/accesssories.jpg" style="width: 465px; height: 200px" alt="Featured image" />
                                                   <div class="form-group form-float">
                                                    <label>ICAI Proof</label>
                                                    </div>
                                              </div>
                                                 
                                              <div class="col-md-6">
                                               <div class="checkbox" style="float: right;" id="government_front_div">
                                                  <input type="checkbox" name="student_bil_government_front_status" id="checkbox2" value="0" class="post_ids get_checkbox">
                                                  <label for="checkbox<?php echo 2;?>">
                                                  </label>
                                                </div> 
                                                <div style="float: right;display: none" id="government_front_verify_div">
                                                  <button type="button"   class="btn btn-info btn-xs m-b-10"><i class="ti-check"></i> Verified </button>
                                                </div>
                                                 <img type="image" id="student_bil_government_front" id="student_bil_government_front_show" src="assets/admin/assets/images/accesssories.jpg" style="width: 226px; height: 200px" alt="Featured image" />
                                                <label>Government Proof Front</label>
                                               </div>
                                               <div class="col-md-6">
                                                 <div class="checkbox" style="float: right;" id="government_back_div">
                                                  <input type="checkbox" name="student_bil_government_back_status" id="checkbox3" value="0" class="post_ids get_checkbox">
                                                  <label for="checkbox<?php echo 3; ?>">
                                                  </label>
                                                </div>
                                                <div style="float: right;display: none" id="government_back_verify_div">
                                                   <button type="button"   class="btn btn-info btn-xs m-b-10"><i class="ti-check"></i> Verified </button>
                                                </div>
                                                 <img type="image" id="student_bil_government_back" id="student_bil_government_front_show" src="assets/admin/assets/images/accesssories.jpg"   style="width: 219px; height: 200px" alt="Featured image" />
                                                <label>Government Proof Back</label>
                                               </div>
                                        </div>
                                                
                                  </div>
                                 <input type="text" spellcheck="true"  name="student_id" hidden="hidden" readonly="readonly" id="student_id" required>
                                  <div id=fp_response> </div>                              
                                  
                            </form>
                    </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                  </div>
            </div>
            <!-- /.modal-content -->
        </div>
                                    <!-- /.modal-dialog -->
 </div> 


  <div id="view_add_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Verify Documents</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="profile-details-address">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <h6 class="mb-0">Address Line 1</h6>
                                <input type="text" class="form-control" id="stu_bil_address_1" readonly="readonly">
                            </div>
                            <div class="form-group col-md-12">
                                <h6 class="mb-0">Address Line 2</h6>
                                <input type="text"  class="form-control" id="stu_bil_address_2" readonly="readonly">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <h6 class="mb-0">User City</h6>
                                <input type="text"  class="form-control" id="user_city" readonly="readonly">
                            </div>
                            <div class="form-group col-md-12">
                                <h6 class="mb-0">User State</h6>
                                <input type="text"  class="form-control" id="user_state" readonly="readonly">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <h6 class="mb-0">User Country</h6>
                                <input type="text"  class="form-control" id="user_country" readonly="readonly">
                            </div>
                            <div class="form-group col-md-12">
                                <h6 class="mb-0">User Postal code</h6>
                                <input type="text"  class="form-control" id="user_post_code" readonly="readonly">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
                                    <!-- /.modal-dialog -->
  </div>


<script type="text/javascript">




$("#checkall").click(function () {
$(".get_checkbox").each(function(){
    var $this = $(this);
    if($("#checkall").is(":checked")){
         $(this).val(1);
    }else{
        $(this).val(0);
    }
    

    
});
   $('input:checkbox').not(this).prop('checked', this.checked);
 });

 $("#checkbox1").click(function () {
                if($("#checkbox1").is(":checked")){
                     $(this).val(1);
                }else{
                    $(this).val(0);
                }
});
 $("#checkbox2").click(function () {
                if($("#checkbox2").is(":checked")){
                     $(this).val(1);
                }else{
                    $(this).val(0);
                }
});
 $("#checkbox3").click(function () {
                if($("#checkbox3").is(":checked")){
                     $(this).val(1);
                }else{
                    $(this).val(0);
                }
});

$('#verify_doc_form').submit(function(e){
    var msg='';
    e.preventDefault();
    swal({
        title: "Are You Sure?",
        text: 'Want Verify This Documents',
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {          
        $.ajax({
                url:'<?php echo base_url('admin/student_management/update_document_status')?>',
               type: "POST",  
               data: new FormData(this),
               contentType:false,
               cache:false,
               processData:false,
               dataType: "json",
                success:function (response) {
                    console.log(response);
                    if(response==1)
                    {
                         swal("Document Has Been Verified.", {
                      icon: "success",

                      });
                      $('#view_docs_model').modal('hide');
                    }
                    else
                    {
                      swal("Verification Failed");
                    }
                   
                },
                error:function (error) {
                    alert(error);
                }
            }); 
        } else {
        // swal("Your imaginary file is safe!");
        }
    });
});

    function update_status(student_id,student_status) {
    var status_data={'student_id':student_id,'student_status':student_status};
    var msg='';
    if(status==0){
        msg="You Want To De-activate Student!";
    }
    else{
        msg="You Want To Activate Student!";
    }
    swal({
        title: "Are You Sure?",
        text: msg,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {          
        $.ajax({
                url:'<?php echo base_url('admin/student_management/update_student_status')?>',
               type: "POST",  
              data: status_data,
                success:function (response) {
                    console.log(response);
                    if(response==1)
                    {
                         swal("Status Has Been Changed.", {
                      icon: "success",

                      });
                      table.ajax.reload();
                    }
                    else
                    {
                      swal("no change");
                    }
                   
                },
                error:function (error) {
                    alert(response);
                }
            }); 
        } else {
        // swal("Your imaginary file is safe!");
        }
    });
}


function view_address(student_id){
    $.ajax({  
        url:"<?php echo base_url(); ?>admin/student_management/each_student_address",
        method:"POST",
        data:{student_id:student_id},   
        dataType: 'json',
        success:function(result){
            console.log(result);
            $('#stu_bil_address_1').val(result.stu_bil_address_1);
            $('#stu_bil_address_2').val(result.stu_bil_address_2);
            $('#user_city').val(result.stu_bil_ciy);
            $('#user_state').val(result.stu_bil_state);
            $('#user_country').val(result.stu_bil_country);
            $('#user_post_code').val(result.stu_bil_pin);
            $('#view_add_model').modal('show');
        },
        error: function(response){
            console.log(response+'fail');
        }

    });
}



function view_docs(student_id) {
$('#student_id').val(student_id); 
$.ajax({
      url:"<?php echo base_url(); ?>admin/student_management/get_student_document_details", 
      method:"POST",
      data:{student_id:student_id},     
      dataType: 'json',     
      success:function(result)
      { 
        $("#student_bil_ICAI_proof_show").prop("src",result.student_bil_ICAI_proof);
        $("#student_bil_government_front").prop("src",result.student_bil_government_front);
        $("#student_bil_government_back").prop("src",result.student_bil_government_back);
        if(result.student_bil_ICAI_proof_status == 1)
        {
           $('#icai_proof_div').hide();
           $('#icai_verify_div').show();
        }
        if(result.student_bil_government_front_status == 1)
        {
           $('#government_front_div').hide();
           $('#government_front_verify_div').show();
        }
         if(result.student_bil_government_back_status == 1)
        {
           $('#government_back_div').hide();
           $('#government_back_verify_div').show();
        }
        if(result.student_bil_ICAI_proof_status==1 &&  result.student_bil_government_front_status == 1 && result.student_bil_government_back_status == 1)
        {
            $('#select_all_div').hide();
            $('#verify_div').hide();
        }
        $('#view_docs_model').modal('show');
      },
      error: function(response){
        console.log(response);
      }
    });


}

    
    $( document ).ready(function() {
     var id = $('#stud_id').val();
     table = $('#table').DataTable({
         "aLengthMenu": [[10, 25, 50, 100, 500, 1000, 2000, 5000], [10, 25, 50, 100, 500, 1000, 2000, 5000]],
         dom: 'lBfrtip',
        paging: true,
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "language": {
                "processing": "<span class='col-teal' style='font-size:16px;back'> </span>",
        },
        responsive: true,
        "buttons": [
        
             {
              extend: 'excel',
              exportOptions:
              {
                  columns: [ 0, 1, 2, 3, 4]
              },
          },
          {
              extend: 'csv',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
              }
          },
           
        ],
        "ajax":{
           url:"<?php echo base_url(); ?>admin/student_management/get_student_all_data", 
            type: "POST",
            data:{'student_id': id},
            error: function(response){
              console.log(response);
            }
          }
      });
});
</script>
   
