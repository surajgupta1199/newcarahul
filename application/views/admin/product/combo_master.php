




        <!-- ============================================================== -->
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                 Combo Master
                                 <?php
                                        if($this->session->userdata('employee_roll') != 0){
                                            $course_tab_permission=$this->session->userdata('course_tab_permission');
                                             if($course_tab_permission[1] == 1){
                                ?>
                                        <button type="button" id="add_combo_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Combo</button>
                                <?php    }
                                }
                                else
                                {   ?>

                                        <button type="button" id="add_combo_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Combo</button>
                                <?php
                                }
                                ?>
                                 
                                <div class="table-responsive m-t-40">
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="dataTable tablesaw table-striped table-hover table-bordered table tablesaw-columntoggle"   width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Combo Name</th>                     
                                            <th>Combo Type</th>                     
                                            <th>Combo Date Time</th>                                         
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


<div id="add_combo_master" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Combo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <form id='add_combo_model' class="validation-wizard wizard-circle" data-val = "add">
                                    <h6>Add Combo</h6>
                                    <section id="courses_detail_form">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Combo Title</h5>
                                                <input type="text" spellcheck="true" placeholder="Combo Title" class="form-control"  name="combo_title" data_value = 'add' required>
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

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Combo Banner</h5>
                                                <input type="file"  class="form-control" name="combo_banner" id="combo_banner" required>
                                                <div class="form-group form-float" id="user_exist_or_not"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Combo Description</h5>
                                                 <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" placeholder="Description" id="combo_description" name="combo_description"></textarea>
                                            </div>
                                         
                                            <div class="col-md-12">
                                                 <h5 class="m-t-30 m-b-10">Main Category</h5>
                                            </div>

                                            <?php  foreach($main_cat as $row){?>
                                                <div class="col-md-3">
                                                      <input class="checked_cat" type="radio" id="<?php echo $row['value'];  ?>" name = "main_category" value="<?php echo $row['value_id']  ?>" >
                                                      <label for="<?php echo $row['value'];  ?>"><?php echo $row['value'];  ?></label>
                                                </div>
                                            <?php }?>

                                            <div class="col-md-12">
                                                 <h5 class="m-t-30 m-b-10">Class</h5>
                                            </div>

                                            <?php  foreach($class as $row){?>
                                                <div class="col-md-3">
                                                      <input class="checked_class" type="radio" id="<?php echo $row['value'];  ?>" name = "class" value="<?php echo $row['value_id']  ?>" >
                                                      <label for="<?php echo $row['value'];  ?>"><?php echo $row['value'];  ?></label>
                                                </div>
                                            <?php }?>

                                            <div class="col-md-12">
                                                 <h5 class="m-t-30 m-b-10">Subject Category</h5>
                                            </div>

                                            <?php foreach($subj_cat as $row){?>
                                            <div class="col-md-3">
                                                  <input class="checked" type="checkbox" id="<?php echo $row['value'];  ?>" name="subject_category[]" value="<?php echo $row['value_id']  ?>" >
                                                  <label for="<?php echo $row['value'];  ?>"><?php echo $row['value'];  ?></label>
                                            </div>
                                            <?php }?>

                                            <div class='col-md-12'>
                                                  <button class="btn btn-primary waves-effect selected_cat" data_type="add" type="button" >Select Courses</button>
                                                  <button class="btn btn-primary waves-effect change_cat_edit_1" type="button" data_type="edit" id='change_cat_1' disabled>Change Categories</button>
                                            </div>
                                            <div class='part_cat' style="width: 130%;"></div> 
                                            <div id="hidden_main_cat_value"></div>
                                            <div id="hidden_class_value"></div>
                                            <div id="hidden_value"></div>
                                        </div>
                                    </section>
                                    <h6>Additional description</h6>
                                    <section>
                                        <div class="row">


                 
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Duration</h5>
                                                <input type="text" spellcheck="true" class="form-control only_number" placeholder="Total Combo Duration" name="duration_combo" required>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Number Of Queston</h5>
                                                <input type="text" spellcheck="true" class="form-control only_number" placeholder="Total Number Of Question" name="number_question" required>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Demo Lecture link</h5>
                                                <input type="url" spellcheck="true" class="form-control" placeholder="Demo Lecture link" name="demo_lecture_link" required>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Question Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="coverage_question" name="coverage_question" ></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Theory Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="theory_question" name="theory_coverage" ></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Suitable for</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="suitable_for" name="suitable_for" ></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Other Information</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="other_info" name="other_info"></textarea>
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

<div id="edit_combo_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Combo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <form id="submit_combo" method="POST" class="validation-wizard-edit wizard-circle">
                                    <h6>Edit Combo</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                               <h5 class="m-t-30 m-b-10">Title</h5>
                                               <input type="text" spellcheck="true" class="form-control" name="combo_title" id="edit_combo_title" data-value = 'edit' value="" required>
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
                                                <label class="required_field"></label> 
                                            </div>

                                            <div id="show_mode_edit" class="col-md-12 row"></div>
                                            
                                            <div class="col-md-6">
                                               <h5 class="m-t-30 m-b-10">Course Banner</h5>
                                               <input type="file"  class="form-control" name="combo_banner" id="edit_combo_banner_img" value="" onchange="UploadUrl(this);">
                                               <div class="fileupload_img"><img type="image" id="view_img" src="assets/admin/assets/images/add-image.png" style="width: 90px;height: 90px" alt="Featured image" /></div>
                                               <div class="form-group form-float" id="user_exist_or_not"></div>
                                            </div>

                                            <div class="col-md-12">
                                               <h5 class="m-t-30 m-b-10">Description</h5>
                                               <textarea spellcheck="true" rows="4" class="form-control no-resize" required="required" id="edit_combo_description" placeholder="Description" name="combo_description" value=""></textarea>
                                            </div>

                                            <div class="col-md-12">
                                                 <h5 class="m-t-30 m-b-10">Main Category</h5>
                                            </div>

                                            <?php  foreach($main_cat as $row){?>
                                                <div class="col-md-3">
                                                    <input class="edit_checked_cat" type="radio" id="edit_<?php echo $row['value'];  ?>" name="edit_main_category" value="<?php echo $row['value_id']  ?>">
                                                    <label for="edit_<?php echo $row['value'];  ?>"><?php echo $row['value'];  ?></label>
                                                </div>
                                            <?php }?>

                                            <div class="col-md-12">
                                                 <h5 class="m-t-30 m-b-10">Class</h5>
                                            </div>

                                            <?php  foreach($class as $row){?>
                                                <div class="col-md-3">
                                                      <input class="edit_checked_class" type="radio" id="edit_<?php echo $row['value'];  ?>" name="edit_class" value="<?php echo $row['value_id']  ?>" >
                                                      <label for="edit_<?php echo $row['value'];  ?>"><?php echo $row['value'];  ?></label>
                                                </div>
                                            <?php }?>

                                            <div class="col-md-12">
                                                 <h5 class="m-t-30 m-b-10">Subject Category</h5>
                                            </div>

                                            <?php foreach($subj_cat as $row){?>
                                            <div class="col-md-3">
                                                  <input class="checked_box" type="checkbox" id="edit_<?php echo $row['value'];  ?>" value="<?php echo $row['value_id']  ?>" >
                                                  <label for="edit_<?php echo $row['value'];  ?>"><?php echo $row['value'];  ?></label>
                                            </div>
                                            <?php }?>

                                            <div class='col-md-12'>
                                                <button class="btn btn-primary waves-effect" type="button" id='change_cat_edit' >Change Courses</button>
                                            </div>

                                            <div class='col-md-12'>
                                                <button class="btn btn-primary waves-effect selected_cat" type="button" data_type="edit" id='selected_cat_edit' style="display: none;" >Select Courses</button>
                                                <button class="btn btn-primary waves-effect change_cat_edit_1" type="button" data_type="edit" id='change_cat_edit_1' style="display: none;" disabled>Change Categories</button>
                                            </div>

                                            <div class='edit_part_cat' style="width: 130%;"></div>

                                        </div>
                                            <input type="text" spellcheck="true"  name="combo_id" hidden="hidden" readonly="readonly" id="combo_id" required>
                                            <div id="edit_course_value" hidden="hidden"></div>
                                            <div id="edit_sub_cat_value" hidden="hidden"></div>    
                                            <div id="edit_main_cat_value" hidden="hidden"></div>    
                                            <div id="edit_class_value" hidden="hidden"></div>
                                    </section>
                                    <h6>Additional description</h6>
                                    <section>
                                        <div class="row">


                 
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Duration</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" placeholder="Total Course Duration" id="edit_duration_course" name="duration_combo" >
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Number Of Queston</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" placeholder="Total Number Of Question" id="edit_number_question" name="number_question" >
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Demo Lecture link</h5>
                                                <input type="url" spellcheck="true" class="form-control required" id="edit_demo_lecture_link" placeholder="Demo Lecture link" name="demo_lecture_link" >
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
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Other Information</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" id="edit_other_info" name="other_info"></textarea>
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

<div id="view_combo_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-view">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Combo Details</h4>
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
                                        <img type="image" id="combo_banner_show" class="img-thumbnail img-responsive" src="assets/admin/assets/images/accesssories.jpg"  alt="Featured image" />
                                    </div>
                                    <div class="col-md-12"></div>
                                    <div class="col-md-12 view-details">
                                        <table class="table table-striped table-bordered text-center m-t-10 ">
                                                                
                                                <tr>
                                                      <th>Combo Name</th>
                                                      <td id="combo_name_show">Accounts Beginner</td>
                                                </tr>
                                                <tr>
                                                      <th>Main Category</th>
                                                      <td id="main_category_show">Old</td>
                                                </tr>
                                                <tr>
                                                      <th>Courses Class</th>
                                                      <td id="courses_class_show">CA</td>
                                                </tr>

                                                <tr>
                                                      <th>Subject Category</th>
                                                      <td id="subject_courses_show">Accounts</td>
                                                </tr>

                                                <tr>
                                                      <th>Courses Title</th>
                                                      <td id="courses_title_show">Accounts</td>
                                                </tr>
                                                
                                                <tr>
                                                      <th>Combo Description</th>
                                                      <td id="combo_description_show">Beginner is start</td>
                                                </tr>
                                                <tr>
                                                      <th>Combo Type</th>
                                                      <td id="combo_type_show">Regular</td>
                                                </tr>
                                               
                                                <tr>
                                                      <th>combo Status</th>
                                                      <td id="combo_status_show">Active</td>
                                                </tr>
                                                            
                                        </table>
                                        <span id="combo_price"></span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab1">
                                    <div class="border radius_all_5 tab_box">
                                        <p>
                                            <table class="table">
                                                <tr>
                                                    <td>Duration: </td><td id="show_duration_combo">190 Hours (Approx.)</td>
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

    function select_mode(data){
        var course_type_id = '';
        var show_type = '';
        if(data == 'edit_course'){
            course_type_id=$('#edit_course_type_id').val();
            course_type_value = $('#edit_course_type_id').find(':selected').text();
            show_type = 'show_mode_edit';
        }else{
            course_type_id=$('#course_type_id').val();
            course_type_value = $('#edit_course_type_id').find(':selected').text();
            show_type = 'show_mode';
        }
        $.ajax({
            url:"<?php echo base_url(); ?>admin/combo_master/get_drp_data", 
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

  
    function edit_gat_value_data(value,type) {
        if(type==1){

            $.ajax({
                url:"<?php echo base_url(); ?>admin/course_master/get_drp_data", 
                method:"GET",
                data:{course_type_id:value}, 
                dataType: 'json', 
                success:function(result)
                {   

                    $('#edit_course_type_value_id').html(result);

                },
                    error: function(response){
                    console.log(response);
                }
            }); 
        }   
    }

    function update_status(combo_id,combo_status) {
        var status_data={'combo_id':combo_id,'combo_status':combo_status};
        var msg='';
        if(status==0){
            msg="You Want To De-activate combo!";
        }
        else{
            msg="You Want To Activate combo!";
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
                    url:'<?php echo base_url('admin/combo_master/update_combo_status')?>',
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
                swal("Your imaginary file is safe!");
            }
        });
    }

    function view_combo(combo_id) {
        var status = "";
        $.ajax({
            url:"<?php echo base_url(); ?>admin/combo_master/get_combo_details", 
            method:"POST",
            data:{combo_id:combo_id},     
            dataType: 'json',     
            success:function(result)
            { 
                var main_category_show = "";
                var courses_class_show = "";
                var subject_courses_show = ""
                var courses_title_show = ""
                $('#combo_name_show').html(result.combo_title);
                $('#combo_description_show').html(result.combo_description);
                $('#combo_status_show').html(result.combo_status);
                $('#combo_type_show').html(result.course_type);
                $("#combo_banner_show").prop("src",result.combo_banner);

                $('#show_duration_combo').html(result.duration_combo + ' hours (Approx.)');
                $('#show_number_question').html(result.number_question + ' Questions');
                $('#show_coverage_question').html(result.coverage_question);
                $('#show_coverage_theory').html(result.theory_coverage);
                $('#show_suitable_for').html(result.suitable_for);
                $('#view_combo_model').find('#show_lecture_demo').attr("href",result.demo_lecture_link);

                var output = "";
                for(j=0;j<result.course_mode_view.length;j++){
                    output+='<table class="table table-striped table-bordered text-center mt-20" ><tr><th colspan = 3>'+result.course_mode_view[j].part_course_view+' Times Views</th></tr><tr><th class="table-heading">'+result.course_mode_view[j].part_course_valid+' Month Validity</th><td>Actual Price</td><td>Discount Price</td></tr>'
                    for(i=0;i<result.course_mode_view[j].course_detail.length;i++){
                        output+= '<tr><th>'+result.course_mode_view[j].course_detail[i].mode+'</th><td>'+result.course_mode_view[j].course_detail[i].course_price+'</td><td>'+result.course_mode_view[j].course_detail[i].course_discount_price+'</td></tr>';
                    }
                    output+='</table><hr>';
                }
                $('#combo_price').html(output);

                for(i=0;i<result.sub_cat_id.length;i++){
                    if(subject_courses_show== ''){
                      subject_courses_show = result.sub_cat_id[i].value;
                    }else{
                      subject_courses_show = subject_courses_show + ' , ' + result.sub_cat_id[i].value;
                    }
                }

                for(i=0;i<result.course_detail.length;i++){
                    if(courses_title_show== ''){
                      courses_title_show = result.course_detail[i].course_title;
                    }else{
                      courses_title_show = courses_title_show + ' , ' + result.course_detail[i].course_title;
                    }
                }

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

                $('#show_combo_mode_view').html(course_view);

                $('#courses_class_show').html(result.value_sub_class_id[0].value);
                $('#subject_courses_show').html(subject_courses_show);
                $('#courses_title_show').html(courses_title_show);
                $('#main_category_show').html(result.value_main_cat_id[0].value);

                $('#view_combo_model').modal('show');
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function edit_combo(combo_id) {

        $(":checkbox[class=checked_box]").prop("checked",false);
        $('.selected_cat').prop('disabled', false);
        $('.change_cat_edit_1').prop('disabled', true);
        $(":checkbox[class=unchecked]").prop("checked",false);

        $('#selected_cat_edit ,#change_cat_edit_1').hide();
        $('#change_cat_edit').show();

        $.ajax({
            url:"<?php echo base_url(); ?>admin/combo_master/get_combo_details", 
            method:"POST",
            data:{combo_id:combo_id},     
            dataType: 'json',     
            success:function(result)
            { 
                $('#edit_combo_model').modal('show');
                var cat_id_val = result.cat_id_array;
                var sub_cat_id = "";
                $('#edit_course_type_id').val(result.course_type_id).change();

                setTimeout(function(){ 
                    Array.prototype.forEach.call(result.full_course_detail, function(data){
                        $("input[name='course_mode["+data.course_type_value_id+"]["+data.course_mode+"]["+data.course_view+"]']").val(data.course_price);
                        $("input[name='course_mode_discount["+data.course_type_value_id+"]["+data.course_mode+"]["+data.course_view+"]']").val(data.course_discount_price);
                    });
                 }, 500);

                $('#edit_combo_title').val(result.combo_title);
                $('#combo_id').val(result.combo_id);
                $('#edit_combo_pendrive_price').val(result.combo_pendrive_price);
                $('#edit_combo_googledrive_price').val(result.combo_googledrive_price);
                $('#edit_combo_pendrive_discount').val(result.combo_pendrive_discount);
                $('#edit_combo_googledrive_discount').val(result.combo_googledrive_discount);
                $('#edit_combo_description').val(result.combo_description);
                $('#edit_duration_course').val(result.duration_combo);
                $('#edit_number_question').val(result.number_question);
                $('#edit_combo_validity').val(result.combo_validity);
                $('#edit_demo_lecture_link').val(result.demo_lecture_link);
              
                $('#view_img').prop('src',result.combo_banner);

                $('#edit_sub_cat_value').val(result.subcat_id_string);
                $('#edit_course_value').val(result.course_id_string);

                tinymce.get('edit_combo_description').setContent(result.combo_description);
                tinymce.get('edit_coverage_question').setContent(result.coverage_question);
                tinymce.get('edit_theory_question').setContent(result.theory_coverage);
                tinymce.get('edit_suitable_for').setContent(result.suitable_for);
                tinymce.get('edit_other_info').setContent(result.other_info);

                $(":radio[class=edit_checked_class][value="+result.value_sub_class_id[0].value_id+"]").prop("checked","true");

                $(":radio[class=edit_checked_cat][value="+result.value_main_cat_id[0].value_id+"]").prop("checked","true");

                for(i=0;i<result.sub_cat_id.length;i++){
                    $(":checkbox[class=checked_box][value="+result.sub_cat_id[i].value_id+"]").prop("checked","true");
                }

                for(i=0;i<result.sub_cat_id.length;i++){
                    if(sub_cat_id== ''){
                        sub_cat_id = result.sub_cat_id[i].value_id;
                    }else{
                        sub_cat_id = sub_cat_id + ',' + result.sub_cat_id[i].value_id;
                    }
                }

                console.log(sub_cat_id);

                var course_id = result.course_id_array;

                $.ajax({
                    url:"<?php echo base_url(); ?>admin/combo_master/fetch_course/edit_course", 
                    method:"POST",
                    data:{'cat_id_value':sub_cat_id,'class':result.value_sub_class_id[0].value_id,'main_cat':result.value_main_cat_id[0].value_id},    
                    success:function(response)
                    {  
                        $('.edit_part_cat').html(response);
                        console.log(result.course_detail);
                        for(i=0;i<result.course_detail.length;i++){
                            $(":checkbox[value="+result.course_detail[i].course_id+"]").prop("checked","true");
                        }
                        $(":checkbox").prop("disabled","true");
                        $(":radio").prop("disabled","true");
                        $(":checkbox[class=unchecked]").prop("disabled",false);
                    },
                    error: function(response){
                        console.log(response + 'fail');
                    }
                });

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
            var combo_amount = $('.combo_amount');
            var combo_amount_greater_0 = 0;
            for(var i =0;i< combo_amount.length;i++){
                if($(combo_amount[i]).val() != "" || $(combo_amount[i]).val() > 0 ){
                    combo_amount_greater_0++;
                }
            }
            if(combo_amount_greater_0 == 0){
                swal('info',"Please Select Any One Validity Price",'error')
                return false;
            }

            check_cat = $("input[type=checkbox][class=checked]:checked").length;
            if(!check_cat){
                alert('select atleast one category');
                return false;
            }

            check_course = $("input[type=checkbox][class=checked_cat_type]:checked").length;
            if(!check_course){
                alert('select atleast one courses');
                return false;
            }

            return currentIndex > newIndex || !(2 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        }
        , onFinishing: function (event, currentIndex) {

            form.validate().settings.ignore = ":disabled";
            console.log(form.valid());
            if(!form.valid()){
                return false;
            }

            var formdata = new FormData(this);

            var combo_description = tinymce.get('combo_description').getContent();
            var coverage_question = tinymce.get('coverage_question').getContent();
            var suitable_for = tinymce.get('suitable_for').getContent();
            var theory_question = tinymce.get('theory_question').getContent();
            var other_info = tinymce.get('other_info').getContent();


            var main_cat_id = $('#hidden_main_cat_value').val();
            var sub_class_id = $('#hidden_class_value').val();
            var sub_cat_id = $('#hidden_value').val();
            var course_id = $('#course_value').val();

            formdata.append('course_id',course_id);
            formdata.append('main_category',main_cat_id);
            formdata.append('class',sub_class_id);
            formdata.append('subject_category',sub_cat_id);

            formdata.append('coverage_question',coverage_question);
            formdata.append('combo_description',combo_description);
            formdata.append('theory_coverage',theory_question);
            formdata.append('suitable_for',suitable_for);
            formdata.append('other_info',other_info);

          
            $.ajax({  
                type:'POST', 
                enctype: 'multipart/form-data',
                url:'<?php echo base_url(); ?>admin/combo_master/add_combo_course',
                data: formdata,
                contentType: false,  
                cache: false,  
                processData:false, 
                dataType: 'JSON',
                success:function(result)
                {
                    if(result.type == "success"){      
                        table.ajax.reload();
                        swal('info',"Combo added Successfully",'success') ;  
                        location.reload();     
                    }else if(result.type == "error"){
                        swal('info',result.message,'error') ;
                    }
                    return false;
                },
                error:function(result){
                    console.log(result+'fail');
                }

            });  

            return false;
        }
        , onFinished: function (event, currentIndex) {
            return form.validate().settings.ignore = ":disabled", form.valid()
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
            var combo_amount = $('.combo_amount');
            var combo_amount_greater_0 = 0;
            for(var i =0;i< combo_amount.length;i++){
                if($(combo_amount[i]).val() != "" || $(combo_amount[i]).val() > 0 ){
                    combo_amount_greater_0++;
                }
            }
            if(combo_amount_greater_0 == 0){
                swal('info',"Please Select Any One Validity Price",'error')
                return false;
            }
            
            check_cat = $("input[type=checkbox][class=checked_box]:checked").length;
            if(!check_cat){
                alert('select atleast one category');
                return false;
            }

            check_course = $("input[type=checkbox][class=checked_cat_type]:checked").length;
            if(!check_course){
                alert('select atleast one courses');
                return false;
            }

            return currentIndex > newIndex || !(2 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form_edit.find(".body:eq(" + newIndex + ") label.error").remove(), form_edit.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form_edit.validate().settings.ignore = ":disabled,:hidden", form_edit.valid())
        }
        , onFinishing: function (event, currentIndex) {
            form_edit.validate().settings.ignore = ":disabled";
            if(!form_edit.valid()){
                return false;
            }

            var formdata = new FormData(this);

            var cat_id = $('#edit_sub_cat_value').val();
            if($('#edit_course_value').val() == ""){
                var course_id = $('#course_value').val();
            }else{
                var course_id = $('#edit_course_value').val();
            }

            var combo_description = tinymce.get('edit_combo_description').getContent();
            var coverage_question = tinymce.get('edit_coverage_question').getContent();
            var suitable_for = tinymce.get('edit_suitable_for').getContent();
            var theory_question = tinymce.get('edit_theory_question').getContent();
            var other_info = tinymce.get('edit_other_info').getContent();

            var sub_class_id = $(':input[name=edit_class]:checked').val();
            var main_cat_id = $(':input[name=edit_main_category]:checked').val();

            formdata.append('course_id',course_id);
            formdata.append('subject_category',cat_id);
            formdata.append('coverage_question',coverage_question);
            formdata.append('combo_description',combo_description);
            formdata.append('theory_coverage',theory_question);
            formdata.append('suitable_for',suitable_for);
            formdata.append('main_category',main_cat_id);
            formdata.append('other_info',other_info);
            formdata.append('class',sub_class_id);
          
            $.ajax({  
                url:"<?php echo base_url(); ?>admin/combo_master/edit_combo",   
                type: "POST",  
                data: formdata, 
                contentType:false,
                cache:false,
                processData:false,
                dataType: 'JSON',
                success:function(result)  
                { 
                    if(result.type == "success"){ 
                        $('#edit_combo_model').modal('hide');       
                        table.ajax.reload();
                        swal('info!','successfully updated','success');      
                    }else if(result.type == "error"){ 
                        swal('info',result.message,'error') ;
                    }
                    return false;
                },
                error:function(result){
                    alert('error');
                }
            });  
       
            return false; 
        }
        , onFinished: function (event, currentIndex) {
            return form_edit.validate().settings.ignore = ":disabled", form_edit.valid()
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
                          columns: [ 0, 1, 2, 3]
                      },
                  },
                  {
                      extend: 'csv',
                      exportOptions: {
                          columns: [ 0, 1, 2, 3]
                      }
                  },
            ],
            "ajax":{
                url:"<?php echo base_url(); ?>admin/combo_master/get_course_all_data", 
                type: "POST",
                error: function(response){
                    console.log(response);
                }
            }
        });

        $('.selected_cat').click(function(e){

            e.preventDefault();

            var add_edit = $(this).attr('data_type');
            if(add_edit == 'edit'){
                var class_name = '.checked_box';
                var class_1 = 'checked_box';                     //subject category
                var class_main_cat = 'edit_checked_cat';         //main category
                var class_cat = 'edit_checked_class';            //class
                var view_result = '.edit_part_cat';
                var edit = 'edit_course';
            }else{
                var class_name = '.checked';
                var class_1 = 'checked';            //subject category
                var class_main_cat = 'checked_cat';     //main category
                var class_cat = 'checked_class';            //class
                var view_result = '.part_cat';
                var edit = 'add_course';
            }

            var main_cat_value = "";
            var class_value = "";
            var cat_id_value = "";
            //main_category
            $("input:radio[class="+class_main_cat+"]:checked").each(function () {
                if(main_cat_value == ""){
                    main_cat_value =$(this).val();
                }else{
                    main_cat_value = main_cat_value + ',' + ($(this).val());
                }
            });

            //class
            $("input:radio[class="+class_cat+"]:checked").each(function () {
                if(class_value == ""){
                    class_value =$(this).val();
                }else{
                    class_value = class_value + ',' + ($(this).val());
                }
            });

            //subject_category
            $("input:checkbox[class="+class_1+"]:checked").each(function () {
                if(cat_id_value == ""){
                    cat_id_value =$(this).val();
                }else{
                    cat_id_value = cat_id_value + ',' + ($(this).val());
                }
            });

            if(main_cat_value == ''){
                alert('please select any 1 main category');
                return false; 
            }

            if(class_value == ''){
                alert('please select any 1 class');
                return false; 
            }

            if(cat_id_value == ''){
                alert('please select any 1 category');
                return false; 
            }

            $('.selected_cat').prop('disabled', true);
            $('.change_cat_edit_1').prop('disabled', false);

            $('.'+class_main_cat).attr('disabled', true);
            $('.'+class_cat).attr('disabled', true);
            $(class_name).attr('disabled', true);

            //stored main category value in add and edit part both
            $('#hidden_main_cat_value').val(main_cat_value);
            $('#edit_main_cat_value').val(main_cat_value);

            //stored class value in add and edit part both
            $('#hidden_class_value').val(class_value);
            $('#edit_class_value').val(class_value);

            //stored category value in add and edit part both
            $('#hidden_value').val(cat_id_value);
            $('#edit_sub_cat_value').val(cat_id_value);

            $.ajax({
                url:"<?php echo base_url(); ?>admin/combo_master/fetch_course/"+edit, 
                method:"POST",
                data:{'cat_id_value':cat_id_value,'class':class_value,'main_cat':main_cat_value},    
                success:function(result)
                { 
                    $(view_result).html(result);
                },
                error: function(response){
                    console.log(response + 'fail');
                }
            });
        });

        $('#change_cat_1').click(function(e){
            e.preventDefault();
            $('.selected_cat').prop('disabled', false);
            $('.change_cat_edit_1').prop('disabled', true);
            $(':checkbox').attr('disabled', false);
            $(':radio').attr('disabled', false);
            $('.part_cat').html("");
        });

        $('#change_cat_edit').click(function(e){
            e.preventDefault();
            $('#selected_cat_edit').show();
            $('#change_cat_edit_1').show();
            $('#edit_course_value').val('');
            $('#change_cat_edit').hide();
            $('.checked_box').attr('disabled', false);
            $('.edit_checked_cat').prop('disabled', false);
            $('.edit_checked_class').prop('disabled', false);
            $('.edit_part_cat').html('');
            $(":checkbox").prop("enabled","false");
          // $(":checkbox[value != 0]").prop("enabled","false");
        });

        $('#change_cat_edit_1').click(function(e){
            e.preventDefault();
            $('.checked_box').attr('disabled', false);
            $('.selected_cat').prop('disabled', false);
            $('.edit_checked_cat').prop('disabled', false);
            $('.edit_checked_class').prop('disabled', false);
            $('.change_cat_edit_1').prop('disabled', true);
            $('.edit_part_cat').html("");
        });

        $('#course_type_id').change(function(e){
            var course_type_id=$('#course_type_id').val();
            $.ajax({
                url:"<?php echo base_url(); ?>admin/course_master/get_drp_data", 
                method:"GET",
                data:{course_type_id:course_type_id}, 
                dataType: 'json', 
                success:function(result)
                {   
                  
                    $('#course_type_value_id').html(result);
                  
                },
                error: function(response){
                    console.log(response);
                }
            });
        });

        $('#add_combo_btn').click(function(){
            $(":checkbox").prop("checked",false);
            $(":checkbox").prop("disabled",false);
            $(":radio").prop("checked",false);
            $(":radio").prop("disabled",false);
            $(".checked_cat").prop("disabled",false);
            $(".checked_class").prop("disabled",false);
            $('.selected_cat').prop('disabled', false);
            $("#change_cat_1").prop("disabled",true);
            $('#change_cat_edit').show();
            $('#selected_cat_edit').hide();
            $('.part_cat').html('');
            $('#add_combo_master').modal('show');
        });
    });




    


    
</script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->

</body>

</html>
