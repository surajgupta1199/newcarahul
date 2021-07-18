




        <!-- ============================================================== -->
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                 Combo Master
                                 <button type="button" id="add_combo_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Combo</button>
                                <div class="table-responsive m-t-40">
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="dataTable tablesaw table-striped table-hover table-bordered table tablesaw-columntoggle"   width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Combo Name</th>                                         
                                            <th>Combo Pendrive Price</th>           
                                            <th>Combo Googledrive Price</th>           
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
                                <form id='add_combo_model' class="tab-wizard wizard-circle">
                                    <h6>Add course</h6>
                                    <section id="courses_detail_form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Combo Title</h5>
                                                <input type="text" spellcheck="true" class="form-control"  name="combo_title" data_value = 'add' required>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Course Type</h5>
                                                <select class="form-control" name="course_type_id" id="course_type_id" required="required">
                                                    <option value="">-- Please select type --</option>
                                                    <option value="1">Regular</option>
                                                    <option value="2">Fast Track</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Combo Pendrive Price</h5>
                                                <input type="text" spellcheck="true" class="form-control only_number" name="combo_pendrive_price"  required>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Combo Discount On Pendrive Price</h5>
                                                <input type="text" spellcheck="true" class="form-control only_number" name="combo_pendrive_discount"  id="combo_pendrive_discount"  required>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Combo Googledrive Price</h5>
                                                <input type="text" spellcheck="true" class="form-control only_number" name="combo_googledrive_price"  required>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Combo Discount On Googledrive Price</h5>
                                                <input type="text" spellcheck="true" class="form-control only_number" name="combo_googledrive_discount"  id="combo_googledrive_discount"  required>
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Course Plan</h5>
                                                <select class="form-control" name="course_type_value_id" id="course_type_value_id" required>
                                                    <option value="">-- Please select plan --</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Combo Banner</h5>
                                                <input type="file"  class="form-control" name="combo_banner" id="combo_banner" required>
                                                <div class="form-group form-float" id="user_exist_or_not"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Combo Description</h5>
                                                 <textarea spellcheck="true" rows="4" class="form-control no-resize m-t-30  m-b-10" required="required" placeholder="Description" id="combo_description" name="combo_description"></textarea>
                                            </div>
                                         
                                            <div class="col-md-12">
                                                 <h5 class="m-t-30 m-b-10">Category</h5>
                                            </div>

                                            <?php foreach($all_cats as $row){?>
                                            <div class="col-md-3">
                                                  <input class="checked" type="checkbox" id="<?php echo $row['cat_name'];  ?>" name="cat_id[]" value="<?php echo $row['cat_id']  ?>" >
                                                  <label for="<?php echo $row['cat_name'];  ?>"><?php echo $row['cat_name'];  ?></label>
                                            </div>
                                            <?php }?>
                                            <div class='col-md-12'>
                                                  <button class="btn btn-primary waves-effect selected_cat" data_type="add" type="button" >Select Courses</button>
                                                  <button class="btn btn-primary waves-effect change_cat_edit_1" type="button" data_type="edit" id='change_cat_1' disabled>Change Categories</button>
                                            </div>
                                            <div class='part_cat' style="width: 130%;"></div> 
                                            <div id="hidden_value"></div>
                                        </div>
                                    </section>
                                    <h6>Additional description</h6>
                                    <section>
                                        <div class="row">


                 
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Duration</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" placeholder="Total Combo Duration" name="duration_combo" >
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Number Of Queston</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" placeholder="Total Number Of Question" name="number_question" >
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Question Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control required no-resize m-t-30  m-b-10" id="coverage_question" name="coverage_question"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Theory Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control required no-resize m-t-30  m-b-10" id="theory_question" name="theory_coverage"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Suitable for</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control required no-resize m-t-30  m-b-10" id="suitable_for" name="suitable_for"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Availability</h5>
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <input type='checkbox' value='1' class="check_avail" id='pendrive_availability' name='combo_availability[]'>
                                                        <label for='pendrive_availability'>Pen Drive</label>
                                                    </div>
                                                    <div class='col-md-6'>
                                                        <input type='checkbox' value= '2' class="check_avail" id='googledrive_availability' name='combo_availability[]'>
                                                        <label for='googledrive_availability'>Google Drive</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Validity</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" name="combo_validity"  placeholder="Combo Validity">
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Demo Lecture link</h5>
                                                <input type="text" spellcheck="true" class="form-control required" placeholder="Demo Lecture link" name="demo_lecture_link" >
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
                                <form id="submit_combo" method="POST" class="tab-wizard wizard-circle">
                                    <h6>Edit Combo</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                               <h5 class="m-t-30 m-b-10">Title</h5>
                                               <input type="text" spellcheck="true" class="form-control" name="combo_title" id="edit_combo_title" data-value = 'edit' value="" required>
                                            </div>
                                             <div class="col-md-6">
                                               <h5 class="m-t-30 m-b-10">Course Type</h5>
                                               <select class="form-control" name="course_type_id" id="edit_course_type_id"  onchange="edit_gat_value_data(this.value,1)" required="required">
                                                  <option value="">-- Please select type --</option>
                                                  <option value="1">Regular</option>
                                                  <option value="2">Fast Track</option>
                                                 
                                               </select>
                                            </div>
                                            <div class="col-md-6">
                                               <h5 class="m-t-30 m-b-10">Pendrive Price</h5>
                                               <input type="text" spellcheck="true" class="form-control only_number" name="combo_pendrive_price" id="edit_combo_pendrive_price"  value="" required>
                                            </div>
                                            <div class="col-md-6">
                                               <h5 class="m-t-30 m-b-10"> Discount On Pendrive Price </h5>
                                               <input type="text" spellcheck="true" class="form-control only_number" name="combo_pendrive_discount" value="" id="edit_combo_pendrive_discount" data_value = 'edit' required>
                                            </div>
                                            <div class="col-md-6">
                                               <h5 class="m-t-30 m-b-10">Googledrive Price</h5>
                                               <input type="text" spellcheck="true" class="form-control only_number" name="combo_googledrive_price" id="edit_combo_googledrive_price"  value="" required>
                                            </div>
                                            <div class="col-md-6">
                                               <h5 class="m-t-30 m-b-10"> Discount On Googledrive Price </h5>
                                               <input type="text" spellcheck="true" class="form-control only_number" name="combo_googledrive_discount" value="" id="edit_combo_googledrive_discount" data_value = 'edit' required>
                                            </div>
                                           
                                           
                                            <div class="col-md-6">
                                               <h5 class="m-t-30 m-b-10">Course Plan</h5>
                                               <select class="form-control" name="course_type_value_id" id="edit_course_type_value_id" required>
                                                  <option value="">-- Please select plan --</option>
                                                </select>
                                            </div>
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
                                                 <h5 class="m-t-30 m-b-10">Category</h5>
                                              </div>
                                               <?php foreach($all_cats as $row){?>
                                              <div class="col-md-3">
                                                  <input class="checked_box" type="checkbox" id="<?php echo $row['cat_name']."_1";  ?>" name="cat_id[]" value="<?php echo $row['cat_id']  ?>" data-value="read-only" disabled="disabled">
                                                  <label for="<?php echo $row['cat_name'].'_1';  ?>"><?php echo $row['cat_name'];  ?></label>
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
                                            <div id="edit_cat_value" hidden="hidden"></div>                         
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
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Question Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control required no-resize m-t-30  m-b-10" id="edit_coverage_question" name="coverage_question"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Theory Coverage</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control required no-resize m-t-30  m-b-10" id="edit_theory_question" name="theory_coverage"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Suitable for</h5>
                                                <textarea spellcheck="true" rows="4" class="form-control required no-resize m-t-30  m-b-10" id="edit_suitable_for" name="suitable_for"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Availability</h5>
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <input type='checkbox' value="1" id='edit_pendrive_availability' class="unchecked" name='combo_availability[]'>
                                                        <label for='edit_pendrive_availability'>Pen Drive</label>
                                                    </div>
                                                    <div class='col-md-6'>
                                                        <input type='checkbox' value="2" id='edit_googledrive_availability' class="unchecked" name='combo_availability[]'>
                                                        <label for='edit_googledrive_availability'>Google Drive</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Validity</h5>
                                                <input type="text" spellcheck="true" class="form-control required only_number" id="edit_combo_validity" name="combo_validity"  placeholder="Course Validity">
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Demo Lecture link</h5>
                                                <input type="text" spellcheck="true" class="form-control required" id="edit_demo_lecture_link" placeholder="Demo Lecture link" name="demo_lecture_link" >
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
                    <h4 class="modal-title" id="myLargeModalLabel">Course Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                      <div class="modal-body">
                          <form autocomplete="off" id="edit_course_form"   method="POST">
                                  <div class="form-group form-float">
                                             <div class="row">
                                              <div class="col-md-12">
                                                   <img type="image" id="combo_banner_show" src="assets/admin/assets/images/accesssories.jpg" class="img-thumbnail img-responsive" alt="Featured image" />
                                                </div>
                                                 <div class="col-md-12"></div>
                                              <div class="col-md-12">
                                                  <table class="table table-striped table-bordered text-center m-t-10">
                                                    
                                                      <tr>
                                                              <th>Combo Name</th>
                                                              <td id="combo_name_show">Accounts Beginner</td>
                                                      </tr>
                                                      <tr>
                                                              <th>Category Name</th>
                                                              <td id="category_name_show">Accounts</td>
                                                      </tr>
                                                      <tr>
                                                              <th>Courses Name</th>
                                                              <td id="courses_name_show">Accounts</td>
                                                      </tr>
                                                      <tr>
                                                              <th>Combo Pendrive Price</th>
                                                              <td id="combo_pendrive_price_show">50</td>
                                                      </tr>
                                                       <tr>
                                                              <th>Combo Pendrive Discount in %</th>
                                                              <td id="combo_pendrive_discount_show">10%</td>
                                                      </tr>
                                                      <tr>
                                                              <th>Combo Googledrive Price</th>
                                                              <td id="combo_googledrive_price_show">50</td>
                                                      </tr>
                                                     
                                                      <tr>
                                                              <th>Combo Googledrive Discount in %</th>
                                                              <td id="combo_googledrive_discount_show">10%</td>
                                                      </tr>
                                                     
                                                      <tr>
                                                              <th>Combo Type</th>
                                                              <td id="combo_type_show">Regular</td>
                                                      </tr>
                                                      <tr>
                                                              <th>Combo Plan</th>
                                                              <td id="combo_plan_show">9 month</td>
                                                      </tr>
                                                      <tr>
                                                              <th>combo Status</th>
                                                              <td id="combo_status_show">Active</td>
                                                      </tr>
                                                       <tr>
                                                              <th>Combo Description</th>
                                                              <td id="combo_description_show">Beginner is start</td>
                                                      </tr>
                                                
                                                  </table>
                                               </div>
                                             </div>
                                                
                                  </div>
                                 
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
  <style>
  .ck-editor__editable_inline {
    min-height: 200px !important;
  }
</style>
<script src="<?php echo base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">

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

  function view_combo(combo_id) {
      $.ajax({
          url:"<?php echo base_url(); ?>admin/combo_master/get_combo_details", 
          method:"POST",
          data:{combo_id:combo_id},     
          dataType: 'json',     
          success:function(result)
          {  
              var cat_name = "";
              var course_name = "";
              $('#combo_name_show').html(result.combo.combo_title);
              $('#combo_pendrive_price_show').html(result.combo.combo_pendrive_price);
              $('#combo_googledrive_price_show').html(result.combo.combo_googledrive_price);
              $('#combo_pendrive_discount_show').html(result.combo.combo_pendrive_discount);
              $('#combo_googledrive_discount_show').html(result.combo.combo_googledrive_discount);
              $('#combo_description_show').html(result.combo.combo_description);
              $('#combo_type_show').html(result.combo.course_type);
              $("#combo_banner_show").prop("src",result.combo.combo_banner);
              $('#combo_plan_show').html(result.combo.month);
            

              for(i=0;i<result.cat_type.length;i++){
                if(cat_name== ''){
                  cat_name = result.cat_type[i];
                }else{
                  cat_name = cat_name + ',' + result.cat_type[i];
                }
              }

              for(i=0;i<result.course_type.length;i++){
                if(course_name== ''){
                  course_name = result.course_type[i];
                }else{
                  course_name = course_name + ',' + result.course_type[i];
                }
              }

              $('#category_name_show').html(cat_name);
              $('#courses_name_show').html(course_name);

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
              console.log(result);
              var cat_id_val = result.combo.cat_id_array;
              var cat_id_value = "";
              $('#edit_course_type_id').val(result.combo.course_type_id).change();

               setTimeout(function () {
            $('#edit_course_type_value_id').val(result.combo.course_type_value_id).change();        
              }, 1000);

              $('#edit_combo_title').val(result.combo.combo_title);
              $('#combo_id').val(result.combo.combo_id);
              $('#edit_combo_pendrive_price').val(result.combo.combo_pendrive_price);
              $('#edit_combo_googledrive_price').val(result.combo.combo_googledrive_price);
              $('#edit_combo_pendrive_discount').val(result.combo.combo_pendrive_discount);
              $('#edit_combo_googledrive_discount').val(result.combo.combo_googledrive_discount);
              $('#edit_combo_description').val(result.combo.combo_description);
              $('#edit_duration_course').val(result.combo.duration_combo);
              $('#edit_number_question').val(result.combo.number_question);
              $('#edit_combo_validity').val(result.combo.combo_validity);
              $('#edit_demo_lecture_link').val(result.combo.demo_lecture_link);
              
              $('#view_img').prop('src',result.combo.combo_banner);
              $('#edit_cat_value').val(result.combo.cat_id_string);
              $('#edit_course_value').val(result.combo.course_id_string);
              
              edit_description_val.setData(result.combo.combo_description);
              edit_coverage_question.setData(result.combo.coverage_question);
              edit_suitable_for.setData(result.combo.suitable_for);
              edit_theory_question.setData(result.combo.theory_coverage);

              $('#edit_combo_model').modal('show');

              for(i=0;i<result.combo.cat_id_array.length;i++){
                  $(":checkbox[class=checked_box][value="+result.combo.cat_id_array[i]+"]").prop("checked","true");
              }

              var availability = JSON.parse(result.combo.combo_availability);

              for(i=0;i<availability.length;i++){
                  $(":checkbox[class=unchecked][value="+availability[i]+"]").prop("checked","true");
              }



              for(i=0;i<cat_id_val.length;i++){
                  if(cat_id_value== ''){
                    cat_id_value = cat_id_val[i];
                  }else{
                    cat_id_value = cat_id_value + ',' + cat_id_val[i];
                  }
              }

              var course_id = result.combo.course_id_array;

              $.ajax({
                  url:"<?php echo base_url(); ?>admin/combo_master/fetch_course/edit_course", 
                  method:"POST",
                  data:{'cat_id_value':cat_id_value},    
                  success:function(result)
                  {  
                      $('.edit_part_cat').html(result);
                      for(i=0;i<course_id.length;i++){
                        $(":checkbox[value="+course_id[i]+"]").prop("checked","true");
                      }
                      $(":checkbox").prop("disabled","true");
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


  var add_description_val = ""; 
  var coverage_question_val = ""; 
  var theory_question_val = ""; 
  var suitable_for_val = "";

  $('#add_combo_model').submit(function(e){
    e.preventDefault();
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

    check_avail = $("input[type=checkbox][class=check_avail]:checked").length;
    if(!check_avail){
      alert('select atleast one availability courses');
      return false;
    }

    var formdata = new FormData(this);

    var course_id = $('#course_value').val();
    var cat_id = $('#hidden_value').val();

    formdata.append('course_id',course_id);
    formdata.append('cat_id',cat_id);

    formdata.append('combo_description',add_description_val.getData());
    formdata.append('coverage_question',coverage_question_val.getData());
    formdata.append('theory_coverage',theory_question_val.getData());
    formdata.append('suitable_for',suitable_for_val.getData());
    console.log(formdata);

    
    $.ajax({  
        type:'POST', 
        enctype: 'multipart/form-data',
        url:'<?php echo base_url(); ?>admin/combo_master/add_combo_course',
        data: formdata,
        contentType: false,  
        cache: false,  
        processData:false, 
        success:function(data)
        {
            if(data == 1){
                swal('combo lecture added successfully :-)');
                $('#add_combo_model').trigger("reset");
                $('#add_combo_master').modal('hide');
                table.ajax.reload();
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

    return false;

  });




  var edit_description_val = "";
  var edit_coverage_question = "";
  var edit_theory_question = "";
  var edit_suitable_for = "";

  $('#submit_combo').submit(function(e){
      e.preventDefault();

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

      check_avail = $("input[type=checkbox][class=unchecked]:checked").length;
    if(!check_avail){
      alert('select atleast one availability e.g Pendrive');
      return false;
    }

      var formdata = new FormData(this);

      var cat_id = $('#edit_cat_value').val();
      if($('#edit_course_value').val() == ""){
          var course_id = $('#course_value').val();
      }else{
          var course_id = $('#edit_course_value').val();
      }

      formdata.append('course_id',course_id);
      formdata.append('cat_id',cat_id);

      formdata.append('combo_description',edit_description_val.getData());
      formdata.append('coverage_question',edit_coverage_question.getData());
      formdata.append('theory_coverage',edit_theory_question.getData());
      formdata.append('suitable_for',edit_suitable_for.getData());

      formdata.append('cat_id',cat_id);
      formdata.append('course_id',course_id);

      
      $.ajax({  
          url:"<?php echo base_url(); ?>admin/combo_master/edit_combo",   
          type: "POST",  
          data: formdata, 
          contentType:false,
          cache:false,
          processData:false,
          success:function(result)  
          { 
              if(result == 1){
                  swal('info!','successfully updated','success');
                  location.reload();
                  $('#edit_combo_model').modal('hide');
              }else{
                  alert(result);
                  // $('#edit_combo_model').modal('hide');
              }
          },
          error:function(result){
              alert('error');
          }
      });  
   
      return false; 
  });

  // $('#update_combo_courses').click(function(e){
  //     e.preventDefault();

  //     check_cat = $("input[type=checkbox][class=checked_box]:checked").length;
  //     if(!check_cat){
  //       alert('select atleast one category');
  //       return false;
  //     }

  //     check_course = $("input[type=checkbox][class=checked_cat_type]:checked").length;
  //     if(!check_course){
  //       alert('select atleast one courses');
  //       return false;
  //     }

  //     var formData = new FormData(e.target.form);
  //     var cat_id = $('#edit_cat_value').val();
  //     if($('#edit_course_value').val() == ""){
  //         var course_id = $('#course_value').val();
  //     }else{
  //         var course_id = $('#edit_course_value').val();
  //     }
  //     formData.append('cat_id',cat_id);
  //     formData.append('course_id',course_id);
  //     formData.append('combo_description',edit_description_val.getData());
  //     $.ajax({  
  //         url:"<?php echo base_url(); ?>admin/combo_master/edit_combo",   
  //         type: "POST",  
  //         data: formData, 
  //         contentType:false,
  //         cache:false,
  //         processData:false,
  //         beforeSend: function(){
  //                       $("#fp_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
  //                     },
  //         success:function(result)  
  //         { 
  //             if(result == 1){
  //                 swal('info!','successfully updated','success');
  //                 location.reload();
  //                 $('#edit_combo_model').modal('hide');
  //             }else{
  //                 alert(result);
  //                 $('#edit_combo_model').modal('hide');
  //             }
  //         },
  //         error:function(result){
  //             alert('error');
  //         }
  //     });  
   
  //     return false; 
  // });




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
                      columns: [ 0, 1,2,3]
                  },
              } 
          ],
          "ajax":{
              url:"<?php echo base_url(); ?>admin/combo_master/get_course_all_data", 
              type: "POST",
              error: function(response){
                  console.log(response);
              }
          }
      });

        ClassicEditor
          .create(document.querySelector('#edit_combo_description'))
          .then(editor => {
            edit_description_val = editor;

          })
          .catch(error => {
            console.error(error);
        }); 

        ClassicEditor
            .create(document.querySelector('#edit_coverage_question'))
            .then(editor => {
                edit_coverage_question = editor;

            })
            .catch(error => {
                console.error(error);
        }); 

        ClassicEditor
            .create(document.querySelector('#edit_theory_question'))
            .then(editor => {
                edit_theory_question = editor;

            })
            .catch(error => {
                console.error(error);
        }); 

        ClassicEditor
            .create(document.querySelector('#edit_suitable_for'))
            .then(editor => {
                edit_suitable_for = editor;

            })
            .catch(error => {
                console.error(error);
        }); 


        ClassicEditor
          .create(document.querySelector('#combo_description'))
          .then(editor => {
            add_description_val = editor;

          })
          .catch(error => {
            console.error(error);
        });

        
        ClassicEditor
            .create(document.querySelector('#coverage_question'))
            .then(editors => {
                coverage_question_val = editors;

            })
            .catch(error => {
                console.error(error);
            });

        
        ClassicEditor
            .create(document.querySelector('#theory_question'))
            .then(editor => {
                theory_question_val = editor;

            })
            .catch(error => {
                console.error(error);
            }); 

        
        ClassicEditor
            .create(document.querySelector('#suitable_for'))
            .then(editor => {
                suitable_for_val = editor;

            })
            .catch(error => {
                console.error(error);
            });  

      $('.selected_cat').click(function(e){

        e.preventDefault();

        var add_edit = $(this).attr('data_type');
        if(add_edit == 'edit'){
            var class_name = '.checked_box';
            var class_1 = 'checked_box';
            var view_result = '.edit_part_cat';
            var edit = 'edit_course';
        }else{
            var class_name = '.checked';
            var class_1 = 'checked';
            var view_result = '.part_cat';
            var edit = 'add_course';
        }

        var cat_id_value = "";
        $("input:checkbox[class="+class_1+"]:checked").each(function () {
            if(cat_id_value == ""){
                cat_id_value =$(this).val();
            }else{
                cat_id_value = cat_id_value + ',' + ($(this).val());
            }
        });

        if(cat_id_value == ''){
            alert('please select any 1 category');
            return false; 
        }

        $('.selected_cat').prop('disabled', true);
        $('.change_cat_edit_1').prop('disabled', false);

        $(class_name).attr('disabled', true);
        $('#hidden_value').val(cat_id_value);
        $('#edit_cat_value').val(cat_id_value);
        $.ajax({
            url:"<?php echo base_url(); ?>admin/combo_master/fetch_course/"+edit, 
            method:"POST",
            data:{'cat_id_value':cat_id_value},    
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
        $('.checked').attr('disabled', false);
        $('.part_cat').html("");
      });

      $('#change_cat_edit').click(function(e){
          e.preventDefault();
          $('#selected_cat_edit').show();
          $('#change_cat_edit_1').show();
          $('#edit_course_value').val('');
          $('#change_cat_edit').hide();
          $('.checked_box').attr('disabled', false);
          $('.edit_part_cat').html('');
          $(":checkbox").prop("enabled","false");
          // $(":checkbox[value != 0]").prop("enabled","false");
      });

      $('#change_cat_edit_1').click(function(e){
          e.preventDefault();
          $('.checked_box').attr('disabled', false);
          $('.selected_cat').prop('disabled', false);
          $('.change_cat_edit_1').prop('disabled', true);
          $('.edit_part_cat').html("");
      });

      // $('#edit_pendrive_availability').prop('disabled',false);
      // $('#edit_googledrive_availability').prop('disabled',false);

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
