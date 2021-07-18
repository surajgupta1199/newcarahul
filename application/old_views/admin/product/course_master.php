

        <!-- ============================================================== -->
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                 Course Master
                                  <?php
                                        if($this->session->userdata('employee_roll') != 0){
                                            $course_tab_permission=$this->session->userdata('course_tab_permission');
                                             if($course_tab_permission[1] == 1){

                                ?>
                                                <button type="button" id="add_course_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Course</button>
                                <?php 
                                    }
                                }
                                else
                                {
                                ?>
                                                <button type="button" id="add_course_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Course</button>
                                <?php
                                }
                                 ?>
                                 
                                <div class="table-responsive m-t-40">
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>   
                                            <th>Course ID</th>    
                                            <th>Main Category</th>    
                                            <th>Class</th>    
                                            <th>Subject Category</th>                                           
                                            <th>Course Title</th>
                                             <th>Course Type</th> 
                                            <th>Course Date Time</th>                                         
                                            <th>Action</th>
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

<div id="add_course_master" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Course</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <form id='add_course_model' class="validation-wizard wizard-circle">
                                    <h6>Add course</h6>
                                    <section id="courses_detail_form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Main Category</h5>
                                                <select class="form-control required" name="main_category" id="main_cat" >
                                                    <option value="">-- Please select category --</option>
                                                    <?php 
                                                        foreach($main_cat as $row){
                                                            echo '<option value='.$row["value_id"].'>'.$row['value'].'</option> ';
                                                        }?>
                                                
                                               </select>
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Class</h5>
                                                <select class="form-control required" name="class" id="cat_class" >
                                                    <option value="">-- Please select category --</option>
                                                    <?php 
                                                        foreach($class as $row){
                                                            echo '<option value='.$row["value_id"].'>'.$row['value'].'</option> ';
                                                        }?>
                                                
                                               </select>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Subject Category</h5>
                                                <select class="form-control required" name="subject_category" id="cat_class" >
                                                    <option value="">-- Please select category --</option>
                                                    <?php 
                                                        foreach($subj_cat as $row){
                                                            echo '<option value='.$row["value_id"].'>'.$row['value'].'</option> ';
                                                        }?>
                                                
                                               </select>
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Title</h5>
                                                <input type="text" spellcheck="true" placeholder="Course Title" class="form-control required "  name="course_title" id="course_title" value="" >
                                                <label class="required_field"></label> 
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Course Type</h5>
                                                <select class="form-control required " onchange="select_mode('add_course');" name="course_type_id" id="course_type_id">
                                                    <option value="">-- Please select type --</option>
                                                    <?php 
                                                        foreach($type as $row){
                                                            echo '<option value='.$row["value_id"].'>'.$row['value'].'</option> ';
                                                    }?>
                                                </select>
                                                <label class="required_field"></label> 
                                            </div>
                                            <div id="show_mode" class="col-md-12 row"></div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Course Banner</h5>
                                                <input type="file"  class="form-control required" name="course_banner_img" id="course_banner_img" >
                                                <div class="form-group form-float" id="user_exist_or_not"></div>
                                                <label class="required_field"></label> 
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Description</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control  no-resize" id="course_description" placeholder="Description" name="course_description" value=""></textarea>
                                                <label class="required_field"></label> 
                                            </div>
                                        </div>                        
                                    </section>
                                    <h6>Additional description</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">GooglrDrive Link</h5>
                                                <input type="url" spellcheck="true" class="form-control required" placeholder="GoogleDrive Link" name="course_googledrive_link" >
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Duration</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" placeholder="Total Course Duration" name="duration_course" >
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Number Of Queston</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" placeholder="Total Number Of Question" name="number_question" >
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Question Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="coverage_question" name="coverage_question"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Theory Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="theory_question" name="theory_coverage"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Suitable for</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="suitable_for" name="suitable_for"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Demo Lecture link</h5>
                                                <input type="url" spellcheck="true" class="form-control required" placeholder="Demo Lecture link" name="demo_lecture_link" >
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
                                                <select class="form-control required" name="main_category" id="edit_main_cat" >
                                                    <option value="">-- Please select category --</option>
                                                    <?php 
                                                        foreach($main_cat as $row){
                                                            echo '<option value='.$row["value_id"].'>'.$row['value'].'</option> ';
                                                        }
                                                   ?>
                                               </select>
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Class</h5>
                                                <select class="form-control required" name="class" id="edit_cat_class" >
                                                    <option value="">-- Please select category --</option>
                                                    <?php 
                                                        foreach($class as $row){
                                                            echo '<option value='.$row["value_id"].'>'.$row['value'].'</option> ';
                                                        }?>
                                                
                                               </select>
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Subject Category</h5>
                                                <select class="form-control required" name="subject_category" id="edit_cat_category" >
                                                    <option value="">-- Please select category --</option>
                                                    <?php 
                                                        foreach($subj_cat as $row){
                                                            echo '<option value='.$row["value_id"].'>'.$row['value'].'</option> ';
                                                        }?>
                                                
                                               </select>
                                            </div>
             
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Title</h5>
                                                <input type="text" spellcheck="true" class="form-control required"  name="course_title" id="edit_course_title" value="" >
                                            </div>
                                              
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Course Type</h5>
                                                <select class="form-control required " onchange="select_mode('edit_course');" name="course_type_id" id="edit_course_type_id">
                                                    <option value="">-- Please select type --</option>
                                                    <?php 
                                                        foreach($type as $row){
                                                            echo '<option value='.$row["value_id"].'>'.$row['value'].'</option> ';
                                                    }?>
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
                                                <h5 class="m-t-30 m-b-10">GooglrDrive Link</h5>
                                                <input type="url" spellcheck="true" class="form-control required" placeholder="GoogleDrive Link" id="edit_course_googledrive_link" name="course_googledrive_link" >
                                            </div>
                                
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
                        <div class="course_tabs container" style="overflow-x: auto;">
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
                                        <img type="image" height="400" id="course_banner_show" class="img-thumbnail img-responsive" src="assets/admin/assets/images/accesssories.jpg"  alt="Featured image" />
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
                                                            
                                        </table><hr>
                                        <span id="course_price"></span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab1">
                                    <div class="border radius_all_5 tab_box">
                                        <p>
                                            <table class="table">
                                                <tr>
                                                    <td>GoogleDrive Link: </td><td id="view_course_googledrive_link"></td>
                                                </tr>
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
                                                    <td id="show_availability">
                                                        <ul>
                                                            <li>Pen Drive</li>
                                                            <li>Virtual Centres</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Views: </td>
                                                    <td id="show_course_mode_view">
                                                        <ul>
                                                            <li>1.5 view</li>
                                                            <li>2 view</li>
                                                        </ul>
                                                    </td>
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









<style>
.wizard-content .wizard > .steps > ul > li.error .step {
    border-color:#009efb;
    color: #009efb;
}
</style> 
<script src="https://cdn.tiny.cloud/1/ngfvhzf2ix6enim2socjbla1w8go6wgmtzry81qcmbyane9y/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">

    tinymce.init({
          selector: 'textarea',
      height: 250,
      menubar: false,
      plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor forecolor| alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
           
      });

    function UploadUrl(input) 
    {
        if(input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $('#view_img')
                    .attr('src', e.target.result)
                    .width(80)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function update_status(course_id,course_status) {
        var status_data={'course_id':course_id,'course_status':course_status};
        var msg='';
        if(status==0){
            msg="You Want To De-activate Course!";
        }
        else{
            msg="You Want To Activate Course!";
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
                    url:'<?php echo base_url('admin/course_master/update_course_status')?>',
                    type: "POST",  
                    data: status_data,
                    success:function (response) {
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

                var output = "";
                for(j=0;j<result.course_mode_view.length;j++){
                    output+='<table class="table table-striped table-bordered text-center mt-20" ><tr><th colspan = 3>'+result.course_mode_view[j].part_course_view+' Times Views</th></tr><tr><th class="table-heading">'+result.course_mode_view[j].part_course_valid+' Month Validity</th><td>Actual Price</td><td>Discount Price</td></tr>'
                    for(i=0;i<result.course_mode_view[j].course_detail.length;i++){
                        output+= '<tr><th>'+result.course_mode_view[j].course_detail[i].mode+'</th><td>'+result.course_mode_view[j].course_detail[i].course_price+'</td><td>'+result.course_mode_view[j].course_detail[i].course_discount_price+'</td></tr>';
                    }
                    output+='</table><hr>';
                }
                $('#course_price').html(output);

                $('#course_description_show').html(result.course_description);
                $('#course_type_show').html(result.course_type_id);
                $('#course_status_show').html(result.course_status);
                $('#view_course_googledrive_link').html(result.course_googledrive_link);
                $('#show_duration_course').html(result.duration_course + ' hours (Approx.)');
                $('#show_number_question').html(result.number_question + ' Questions');
                $('#show_coverage_question').html(result.coverage_question);
                $('#show_coverage_theory').html(result.theory_coverage);
                $('#show_suitable_for').html(result.suitable_for);
                $('#view_course_model').find('#show_lecture_demo').attr("href",result.demo_lecture_link);

                var availability = '<ul>'
                Array.prototype.forEach.call(result.availability, function(data){
                    availability+='<li>'+data.value+'</li>'
                });
                availability+= '</ul>'

                $('#show_availability').html(availability);

                var course_view = '<ul>'
                Array.prototype.forEach.call(result.view, function(data){
                    course_view+='<li>'+data.value+' view</li>'
                });
                course_view+= '</ul>'

                $('#show_course_mode_view').html(course_view);
                
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
            url:"<?php echo base_url(); ?>admin/course_master/get_course_details", 
            method:"POST",
            data:{course_id:course_id},     
            dataType: 'json',     
            success:function(result)
            {  
                $('#edit_course_model').modal('show');
                $('#edit_main_cat').val(result.main_category).change();
                $('#edit_cat_class').val(result.class).change();
                $('#edit_cat_category').val(result.subject_category).change();
                $('#edit_course_type_id').val(result.course_type_id).change();

                $('#edit_duration_course').val(result.duration_course);
                $('#edit_number_question').val(result.number_question);
                $('#edit_course_title').val(result.course_title);
                $('#edit_coverage_question').val(result.coverage_question);
                $('#edit_course_googledrive_link').html(result.course_googledrive_link);
                $('#edit_theory_question').val(result.theory_coverage);
                $('#edit_suitable_for').val(result.suitable_for);
                tinymce.get('edit_course_description').setContent(result.course_description);
                tinymce.get('edit_coverage_question').setContent(result.coverage_question);
                tinymce.get('edit_theory_question').setContent(result.theory_coverage);
                tinymce.get('edit_suitable_for').setContent(result.suitable_for);
                $('#edit_demo_lecture_link').val(result.demo_lecture_link);
                                    
                $("#view_img").prop("src",result.course_banner_img);

                setTimeout(function(){ 
                    Array.prototype.forEach.call(result.full_course_detail, function(data){
                        console.log(data);
                        $("input[name='course_mode["+data.course_type_value_id+"]["+data.course_mode+"]["+data.course_view+"]']").val(data.course_price);
                        $("input[name='course_mode_discount["+data.course_type_value_id+"]["+data.course_mode+"]["+data.course_view+"]']").val(data.course_discount_price);
                    });
                 }, 500);


                // $('#view_img').prop('src',result.course_result.course_banner_img);
                
                
            },
            error: function(response){
                console.log(response+'fail');
            }
        });
    }

    function select_mode(data){
        var course_type_id = '';
        var show_type = '';
        if(data == 'edit_course'){
            course_type_id=$('#edit_course_type_id').val();
            course_type_value = $('#edit_course_type_id').find(':selected').text();
            show_type = 'show_mode_edit';
        }else{
            course_type_id=$('#course_type_id').val();
            course_type_value = $('#course_type_id').find(':selected').text();
            show_type = 'show_mode';
        }
        $.ajax({
            url:"<?php echo base_url(); ?>admin/course_master/get_drp_data", 
            method:"GET",
            data:{course_type_id:course_type_id,course_type_value:course_type_value}, 
            dataType: 'json', 
            success:function(result)
            {  
                $("#"+show_type).html(result);
                
            },
            error: function(response){
            console.log(response);
            }
        }); 
    }

    var form = $(".validation-wizard").show();
    $(".validation-wizard").steps({
        ignore: [],
        headerTag: "h6"
        , bodyTag: "section"
        , transitionEffect: "fade"
        , titleTemplate: '<span class="step">#index#</span> #title#'
        , labels: {
            finish: "Submit"
        }
        , onStepChanging: function (event, currentIndex, newIndex) {

            return currentIndex > newIndex || !(2 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        }
        , onFinishing: function (event, currentIndex) {

            form.validate().settings.ignore = ":disabled";
            if(!form.valid()){
                alert('failed all field are required');
                return false;
            }

            var formdata = new FormData(this);

            var course_description = tinymce.get('course_description').getContent();
            var coverage_question = tinymce.get('coverage_question').getContent();
            var suitable_for = tinymce.get('suitable_for').getContent();
            var theory_question = tinymce.get('theory_question').getContent();

            formdata.append('coverage_question',coverage_question);
            formdata.append('course_description',course_description);
            formdata.append('theory_coverage',theory_question);
            formdata.append('suitable_for',suitable_for);

        
            $.ajax({  
                url:"<?php echo base_url('admin/course_master/add_course'); ?>",   
                type: "POST",  
                data: formdata,
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'JSON',
                success:function(result)  
                {
                    if(result.type == "success"){ 
                        $('#add_course_model').trigger("reset");
                        $('#add_course_master').modal('hide');       
                        table.ajax.reload();
                        swal("Course added Successfully") ;       
                    }else if(result.type == "warning"){
                        alert(result.message);
                    }else{
                        alert(result.message);
                    }
                    return false;
                
                },
                error:function(result){
                    alert(result);
            
                }

            });  

            return false;
        }
    }), 
    
    $(".validation-wizard").validate({
        ignore: "input[type=hidden]"
        , errorClass: "text-danger"
        , successClass: "text-success"
        , highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        }
        , unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        }
        , errorPlacement: function (error, element) {
            error.insertAfter(element)
        }
        , rules: {
            email: {
                email: !0
            }
        }
    })

    var form_edit = $(".validation-wizard-edit").show();
    $(".validation-wizard-edit").steps({
        ignore: [],
        headerTag: "h6"
        , bodyTag: "section"
        , transitionEffect: "fade"
        , titleTemplate: '<span class="step">#index#</span> #title#'
        , labels: {
            finish: "Submit"
        }
        , onStepChanging: function (event, currentIndex, newIndex) {

            return currentIndex > newIndex || !(2 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form_edit.find(".body:eq(" + newIndex + ") label.error").remove(), form_edit.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form_edit.validate().settings.ignore = ":disabled,:hidden", form_edit.valid())

        }
        , onFinishing: function (event, currentIndex) {
            form_edit.validate().settings.ignore = ":disabled";
            if(!form_edit.valid()){
                alert('failed all field are required');
              return false;
            }

            var form = new FormData(this);

            var course_description = tinymce.get('edit_course_description').getContent();
            var coverage_question = tinymce.get('edit_coverage_question').getContent();
            var suitable_for = tinymce.get('edit_suitable_for').getContent();
            var theory_question = tinymce.get('edit_theory_question').getContent();

            form.append('course_description',course_description);
            form.append('coverage_question',coverage_question);
            form.append('theory_coverage',theory_question);
            form.append('suitable_for',suitable_for);

            $.ajax({  
                url:"<?php echo base_url(); ?>admin/course_master/edit_course",   
                //base_url() = http://localhost/tutorial/codeigniter  
                type: "POST",  
                data: form, // <--- THIS IS THE CHANGE
                dataType:"JSON",
                contentType:false,
                cache:false,
                processData:false, 
                success:function(result)  
                { 
                    if(result.type == "success"){ 
                        $('#edit_course_model').modal('hide');       
                        table.ajax.reload();
                        swal("Course Updated Successfully") ;     
                    }else{
                         alert(result.message);
                    }
                    return false;
                
                },
                error:function(result){
                    alert(result);
                }
            });
        }
    }), 

    $(".validation-wizard-edit").validate({
        ignore: "input[type=hidden]"
        , errorClass: "text-danger"
        , successClass: "text-success"
        , highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        }
        , unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        }
        , errorPlacement: function (error, element) {
            error.insertAfter(element)
        }
        , rules: {
            email: {
                email: !0
            }
        }
    })


    $('#add_course_btn').click(function(){
        $('#add_course_master').modal('show');
        
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
                          columns: [ 0, 1, 2, 3, 4,5]
                      },
                  },
                  {
                      extend: 'csv',
                      exportOptions: {
                          columns: [ 0, 1, 2, 3, 4,5]
                      }
                  },
                  
            ],
            "ajax":{
                url:"<?php echo base_url(); ?>admin/course_master/get_course_all_data", 
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
