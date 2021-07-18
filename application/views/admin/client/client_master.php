

        <!-- ============================================================== -->
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                 Client Master
                                 <button type="button" id="add_client_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Client</button>
                                <div class="table-responsive m-t-40">
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Client Name</th>                                         
                                            <th>Client Phone</th> 
                                            <th>Client Email</th>
                                            <th>Dicount Alloted</th>                                         
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tbody></tbody>                                      
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                        
                    </div>
                </div>

<div id="add_client_master" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <form id='add_client_form' class="">
                                    
                                    <section id="client_detail_form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">First Name</h5>
                                                <input type="text" spellcheck="true" placeholder="Enter First Name" class="form-control required "  name="student_first_name" id="student_first_name" value="" >
                                            </div>
             
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Last Name</h5>
                                                <input type="text" spellcheck="true" placeholder="Enter Last Name" class="form-control required "  name="student_last_name" id="student_last_name" value="" >
                                                <label class="required_field"></label> 
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Mobile Number</h5>
                                                <input type="text" spellcheck="true" placeholder="Enter Mobile Number" class="form-control only_number required "  name="student_phone" id="student_phone" value="" >
                                                
                                                <label class="required_field"></label> 
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Email</h5>
                                                <input type="email" spellcheck="true" placeholder="Enter Email" class="form-control required "  name="student_email" id="student_email" value="" >
                                                <label class="required_field"></label> 
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Password</h5>
                                                <input type="password" spellcheck="true" placeholder="Enter Password" class="form-control required "  name="student_password" id="student_password" value="" >
                                                <label class="required_field"></label> 
                                            </div>
                                             <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Confirm Password</h5>
                                                <input type="password" spellcheck="true" placeholder="Enter Confirm Password" class="form-control required "  name="student_confirm_password" id="student_confirm_password" value="" >
                                            
                                                <label class="required_field"></label> 
                                            </div>
                                             <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Discount To Assign</h5>
                                                <input type="text" spellcheck="true" placeholder="Enter Discount In %" class="form-control required "  name="client_discount" id="client_discount" value="" >
                                            
                                                <label class="required_field"></label> 
                                            </div>
                                        </div>                        
                                    </section>
                                    <div id=fp_response> </div> 
                            </div>
                        </div>
                       <div class="modal-footer">
                          <button class="btn btn-primary waves-effect" type="submit">Save</button>
                          <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                     </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="edit_course_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Course</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <form id="submit_courses" method="POST" class="validation-wizard-edit wizard-circle">
                                    <h6>Edit course</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Category</h5>
                                                <select class="form-control required" name="cat_id" id="edit_cat_id" >
                                                    <option value="">-- Please select category --</option>
                                                    <?php 
                                                        foreach($all_cats as $cat){
                                                            echo '<option value='.$cat["cat_id"].'>'.$cat['cat_name'].'</option> ';
                                                        }?>
                                                
                                               </select>
                                            </div>
             
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Title</h5>
                                                <input type="text" spellcheck="true" class="form-control required"  name="course_title" id="edit_course_title" value="" >
                                            </div>
                                              
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Course Type</h5>
                                                <select class="form-control required" name="course_type_id" onchange="select_mode('edit_course');" id="edit_course_type_id" >
                                                    <option value="">-- Please select type --</option>
                                                    <option value="1">Regular</option>
                                                    <option value="2">Fast Track</option>
                                                 
                                               </select>
                                            </div>
                                            <div id="show_mode_edit" class="col-md-12 row"></div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Course Banner</h5>
                                                <input type="file"  class="form-control" name="course_banner_img" id="edit_course_banner_img" value="" onchange="UploadUrl(this);" >
                                                <div class="fileupload_img"><img type="image" id="view_img" src="assets/admin/assets/images/add-image.png" style="width: 90px;height: 90px" alt="Featured image" /></div>
                                                <div class="form-group form-float" id="user_exist_or_not"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Description</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize" id="edit_course_description" placeholder="Description" name="course_description" value=""></textarea>
                                            </div>
                                        </div>
                                        <input type="text" spellcheck="true"  name="course_id" hidden="hidden" readonly="readonly" id="course_id" >                         
                                    </section>
                                    <h6>Additional description</h6>
                                    <section>
                                        <div class="row">


                 
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Duration</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" placeholder="Total Course Duration" id="edit_duration_course" name="duration_course" >
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Number Of Queston</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" placeholder="Total Number Of Question" id="edit_number_question" name="number_question" >
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Question Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="edit_coverage_question" name="coverage_question"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Theory Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="edit_theory_question" name="theory_coverage"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Suitable for</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="edit_suitable_for" name="suitable_for"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Demo Lecture link</h5>
                                                <input type="url" spellcheck="true" class="form-control required" id="edit_demo_lecture_link" placeholder="Demo Lecture link" name="demo_lecture_link" >
                                            </div>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="view_course_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-view">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Course Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                          
                <div class="form-group form-float">
                    <div class="row">
                        <div class="course_tabs" style="overflow-x: auto;">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="overview-tab1" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="overview-tab1" data-toggle="tab" href="#description" role="tab" aria-controls="overview" aria-selected="true">Additional Description</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab1">

                                    <div class="col-md-12">
                                        <img type="image" id="course_banner_show" class="img-thumbnail img-responsive" src="assets/admin/assets/images/accesssories.jpg"  alt="Featured image" />
                                    </div>
                                    <div class="col-md-12"></div>
                                    <div class="col-md-12 view-details">
                                        <table class="table table-striped table-bordered text-center m-t-10 ">
                                                                
                                                <tr>
                                                      <th>Course Name</th>
                                                      <td id="course_name_show">Accounts Beginner</td>
                                                </tr>
                                                <tr>
                                                      <th>Category Name</th>
                                                      <td id="category_name_show">Accounts</td>
                                                </tr>
                                              
                                                <tr>
                                                      <th>Course Type</th>
                                                      <td id="course_type_show">Regular</td>
                                                </tr>
                                                
                                                <tr>
                                                      <th>Course Status</th>
                                                      <td id="course_status_show">Active</td>
                                                </tr>
                                                <tr>
                                                      <th>Course Description</th>
                                                      <td id="course_description_show">Beginner is start</td>
                                                </tr>
                                                            
                                        </table>
                                        <span id="course_price"></span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab1">
                                    <div class="border radius_all_5 tab_box">
                                        <p>
                                            <table class="table">
                                                <tr>
                                                    <td>Duration: </td><td id="show_duration_course">190 Hours (Approx.)</td>
                                                </tr>
                                                <tr>
                                                    <td>No. of Questions: </td><td id="show_number_question">500+ </td>
                                                </tr>
                                                <tr>
                                                    <td>Question Coverage: </td>
                                                    <td id="show_coverage_question">
                                                        <ul>
                                                            <li>All Questions of</li>
                                                            <li>Study Material,</li>
                                                            <li>Practice Manual,</li>
                                                            <li>RTPs,</li>
                                                            <li>MTPs,</li>
                                                            <li>100% Coverage of Past Exam Qs (since year 2000)</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Theory Coverage: </td>
                                                    <td id="show_coverage_theory">
                                                        <ul>
                                                            <li>Class Puzzle</li>
                                                            <li>Home Puzzle</li>
                                                            <li>Accounting Standard Gatha</li>
                                                            <li>Revision Book</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Suitable for: </td>
                                                    <td id="show_suitable_for">
                                                        <ul>
                                                            <li>Students studying first time</li>
                                                            <li>Students who have studied from any other teacher but did not practice much questions and are weak in concept</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Availability: </td>
                                                    <td>
                                                        <ul>
                                                            <li>Pen Drive</li>
                                                            <li>Virtual Centres</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Views: </td><td>2</td>
                                                </tr>
                                                <tr>
                                                    <td>Demo Lecture Link: </td><td><a href="https://www.youtube.com/watch?v=7Si7k-eBalc&t=12744s" id="show_lecture_demo" target="blank">Click Here</a></td>
                                                </tr>
                                                
                                            </table>
                                        </p>
                                    </div>
                                </div>
                            </div>                           
                                  
                           
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                                    <!-- /.modal-dialog -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div> 
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#add_client_form').submit(function(){    
   
    var form = $(this);
      $.ajax({  
     url:"<?php echo base_url(); ?>admin/Client_management/add_client",   
      //base_url() = http://localhost/tutorial/codeigniter  
     type: "POST",  
     data: form.serialize(), // <--- THIS IS THE CHANGE
        dataType: "json",  
       beforeSend: function(){
                    $("#fp_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
                },
      success:function(result)  
      {    
        if(result.msg=="success"){        
        $('#add_client_form').trigger("reset");
        table.ajax.reload();
        $('#fp_response').html("<br><div class='alert alert-success col-md-12'> <div class='container col-md-12'> </button> <b> New Client Added Successfully.</b></div></div>");         
        }
        else if(result.msg=="email exist")
        {     table.ajax.reload();
             $('#fp_response').html("<br><div class='alert alert-danger col-md-12'> <div class='container col-md-12'></button> <b>Client Email Already Exists.</b></div></div>");
        }

        else{
          $('#fp_response').html("<br><div class='alert alert-danger col-md-12'> <div class='container col-md-12'></button> <b>Client Not Added.</b></div></div>");
         
        }
        return false;
        
      },
      error:function(result){
        alert(result);
        
      }

    });  
   
 return false;
  
    // body...
}); 


     function update_status(student_id,student_status) {
    var status_data={'student_id':student_id,'student_status':student_status};
    var msg='';
    if(status==0){
        msg="You Want To De-activate Client!";
    }
    else{
        msg="You Want To Activate Client!";
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
                url:'<?php echo base_url('admin/Client_management/update_student_status')?>',
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


    function view_course(course_id) {
        $.ajax({
            url:"<?php echo base_url(); ?>admin/course_master/get_course_details", 
            method:"POST",
            data:{course_id:course_id},     
            dataType: 'json',     
            success:function(result)
            {
                $('#course_name_show').html(result.course_title);
                $('#category_name_show').html(result.cat_name);

                var course_month = result.course_type_id == "Regular"? '6 Month' : '3 Month';

                var i=0;
                var output = "";
                for(j=0;j<result.course_price.length/2;j++){
                    output+='<table class="table table-striped table-bordered text-center mt-20" ><tr><th class="table-heading">'+course_month+'</th><td>Actual Price</td><td>Discount Price</td></tr><tr><th>PenDrive</th><td>'+result.course_price[i].course_price+'</td><td>'+result.course_price[i].course_discount_price+'</td></tr><tr><th>Google Drive</th><td>'+result.course_price[i+1].course_price+'</td><td>'+result.course_price[i+1].course_discount_price+'</td></tr></table>';
                    i+=2;
                    course_month =  course_month == "6 Month" ? '9 Month' : '4 Month'; 
                }
                $('#course_price').html(output);

                $('#course_description_show').html(result.course_description);
                $('#course_type_show').html(result.course_type_id);
                $('#course_status_show').html(result.course_status);
                $('#show_duration_course').html(result.duration_course + ' hours (Approx.)');
                $('#show_number_question').html(result.number_question + ' Questions');
                $('#show_coverage_question').html(result.coverage_question);
                $('#show_coverage_theory').html(result.theory_coverage);
                $('#show_suitable_for').html(result.suitable_for);
                $('#view_course_model').find('#show_lecture_demo').attr("href",result.demo_lecture_link);
                
                $("#course_banner_show").prop("src",result.course_banner_img);
                $('#view_course_model').modal('show');
            },
            error: function(response){
                console.log(response);
            }
        });
    }


    function edit_course(course_id) {
        $(":checkbox[class=course_checked]").prop("checked",false);
        $('#course_id').val(course_id); 
        $.ajax({
            url:"<?php echo base_url(); ?>admin/course_master/get_course_particular_data", 
            method:"POST",
            data:{course_id:course_id},     
            dataType: 'json',     
            success:function(result)
            {  
                $('#edit_course_model').modal('show');
                $('#edit_cat_id').val(result.course_result.cat_id).change();
                
                $('#edit_course_type_value_id').html(result.course_result.course_type_value);
                $('#edit_course_type_id').val(result.course_result.course_type_id).change();
                $('#edit_course_title').val(result.course_result.course_title);
                $('#edit_course_pendrive_price').val(result.course_result.course_pendrive_price);
                $('#edit_course_pendrive_discount').val(result.course_result.course_pendrive_discount);
                $('#edit_course_googledrive_discount').val(result.course_result.course_googledrive_discount);
                $('#edit_course_googledrive_price').val(result.course_result.course_googledrive_price);
                $('#edit_duration_course').val(result.course_result.duration_course);
                $('#edit_number_question').val(result.course_result.number_question);
                $('#edit_coverage_question').val(result.course_result.coverage_question);
                $('#edit_theory_question').val(result.course_result.theory_coverage);
                $('#edit_suitable_for').val(result.course_result.suitable_for);
                $('#edit_course_validity').val(result.course_result.course_validity);
                $('#edit_demo_lecture_link').val(result.course_result.demo_lecture_link);

                setTimeout(function(){ 
                    Array.prototype.forEach.call(result.course_price, function(data){
                        $("input[name='course_mode["+data.course_type_value_id+"]["+data.course_mode+"]']").val(data.course_price);
                        $("input[name='course_mode_discount["+data.course_type_value_id+"]["+data.course_mode+"]']").val(data.course_discount_price);
                    });
                 }, 500);


                $('#view_img').prop('src',result.course_result.course_banner_img);
                
                
            },
            error: function(response){
                console.log(response+'fail');
            }
        });
    }

    $('#add_client_btn').click(function(){
        $('#add_client_master').modal('show');
        
    })

    $( document ).ready(function() {

        $('.only_number').keyup(function(e){
            e.preventDefault();
            if (/\D/g.test(this.value))
            {
                this.value = this.value.replace(/\D/g, '');
                alert('Only Number Allowed')
            }
        });
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
                url:"<?php echo base_url(); ?>admin/Client_management/get_client_all_data", 
                type: "POST",
                error: function(response){
                  console.log(response);
                }
            }
        });
    });
</script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
   
</body>

</html>
