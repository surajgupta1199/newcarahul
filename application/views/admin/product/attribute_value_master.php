

        <!-- ============================================================== -->
                        <div class="card">
                            <div class="card-body">
                                 Please Select Otpion to Add<br>
                                 <select class="btn btn-primary pull-left mt-2" id="select_type_value_id">
                                    <?php 
                                        foreach ($data as $row) {
                                            $value = $row["attribute_id"] == 1? "selected":"";
                                            echo '<option '.$value.' value="'.$row["attribute_id"].'" name="attribute_id">'.$row["title"].'</option>';
                                        } 
                                    ?>
                                </select>

                                 <br>
                                  <?php
                                        if($this->session->userdata('employee_roll') != 0){
                                            $course_tab_permission=$this->session->userdata('course_tab_permission');
                                             if($course_tab_permission[1] == 1){

                                ?>
                                               <button type="button" id="add_attr_val_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Attribute Values</button>
                                <?php 
                                    }
                                }
                                else
                                {
                                ?>
                                                <button type="button" id="add_attr_val_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Attribute Values</button>
                                <?php
                                }
                                 ?>
                                 
                                <div class="table-responsive m-t-40">
                                  Attribute Value Master
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Attribute ID</th>
                                            <th>Attribute Name</th>
                                            <th>Attribute Date Time</th>
                                            <th>Status</th>
                                            <?php
                                              if($this->session->userdata('employee_roll') == 0){ ?>                                        
                                                <th>Action</th>
                                            <?php
                                              }
                                            ?>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody></tbody>                                      
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                        
                   




    <div id="add_attr_val_modl" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Add Attribute</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  </div>
                  <div class="modal-body">
                    <form autocomplete="off" id="add_attribute_value_form" method="POST">
                     
                           <div class="row">
                              <div class="col-md-12">
                                  <select class="btn btn-default pull-left mt-2" id="select_type_value">
                                      <?php 
                                          foreach ($data as $row) {
                                              $value = $row["attribute_id"] == 1? "selected":"";
                                              echo '<option '.$value.' value="'.$row["attribute_id"].'">'.$row["title"].'</option>';
                                          } 
                                      ?>
                                  </select>
                              </div>
                              <div class="col-md-12" id="course_type_add">

                                  <div class="col-md-12 selected_type" data_value="1">
                                      <h5 class="m-t-30 m-b-10">Category Name</h5>
                                      <input type="text" spellcheck="true" placeholder="Enter Category Name (ex: Accounting..)" class="form-control" name="value" required>
                                      <input type="text" id="attr_type_id" name="attr_type_id" value="1" hidden>
                                  </div> 

                              </div>                                    
                              <div class="col-md-12 text-right mt-3">
                                 <button class="btn btn-primary waves-effect" type="submit">Submit</button>
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
          </div>                                    <!-- /.modal-dialog -->
   </div> 



   <div class="col-md-12 selected_type" id="course_cat" style="display: none;">
      <h5 class="m-t-30 m-b-10">Category Name</h5>
      <input type="text" spellcheck="true" placeholder="Enter Category Name (ex: Accounting..)" class="form-control" name="value" required>
      <input type="text" name="attr_type_id" id="attr_type_id" value="1" hidden>
  </div> 

  <div class="col-md-12 selected_type" id="course_class" style="display: none;">
      <h5 class="m-t-30 m-b-10">Course Class</h5>
      <input type="text" spellcheck="true" placeholder="Course Class (ex: CA..)" class="form-control" name="value" required>
      <input type="text" name="attr_type_id" id="attr_type_id" value="2" hidden>
  </div> 

  <div class="col-md-12 selected_type" id="course_mode" style="display: none;">
      <h5 class="m-t-30 m-b-10">Course Mode</h5>
      <input type="text" spellcheck="true" placeholder="Enter Course Mode (ex: Pendrive..)" class="form-control" name="value" required>
      <input type="text" name="attr_type_id" id="attr_type_id" value="5" hidden>
  </div>  

  <div class="col-md-12 selected_type" id="course_type" style="display: none;">
      <h5 class="m-t-30 m-b-10">Course Type</h5>
      <input type="text" spellcheck="true" placeholder="Course Type (ex: Regular..)" class="form-control" name="value" required>

      <h5 class="m-t-30 m-b-10">Course Validity(In Month)</h5>
      <input type="text" spellcheck="true" placeholder="Course Validity (ex: 03,06 (comma seperated in month)..)" class="form-control" id="course_type_value_name" name="course_type_value_name" required>

      <h5 class="m-t-30 m-b-10">Course View</h5>
      <input type="text" spellcheck="true" placeholder="Course View (ex: 1.5,1.7,..)" class="form-control" name="course_view_value_name" required>

      <input type="text" name="attr_type_id" id="attr_type_id" value="4" hidden>
  </div>  


<!--   <div class="col-md-12 selected_type" id="course_view" style="display: none;">
      <h5 class="m-t-30 m-b-10">Course View</h5>
      <input type="text" spellcheck="true" placeholder="Course View (ex: 1.5,1.7,..)" class="form-control" name="value" required>
      <input type="text" name="attr_type_id" id="attr_type_id" value="6" hidden>
  </div>  -->

  <div class="col-md-12 selected_type" id="subj_cat" style="display: none;">
      <h5 class="m-t-30 m-b-10">Subject Category</h5>
      <input type="text" spellcheck="true" placeholder="Subject Category (ex: ECO,LAW,..)" class="form-control" name="value" required>
      <input type="text" name="attr_type_id" id="attr_type_id" value="3" hidden>
  </div> 


<div id="edit_type_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Attribute</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                      <div class="modal-body">
                          <form autocomplete="off" id="edit_attr_type_form"   method="POST">

                              <div class="row">
                                  <div class="col-md-12">
                                      <select class="btn btn-default pull-left mt-2" id="edit_attribute_value" disabled>
                                          <?php 
                                              foreach ($data as $row) {
                                                  echo '<option value="'.$row["attribute_id"].'">'.$row["title"].'</option>';
                                              } 
                                          ?>
                                      </select>
                                  </div>
                                  <div class="col-md-12">

                                      <div class="col-md-12">
                                          <h5 class="m-t-30 m-b-10">Attribute Name</h5>
                                          <input type="text" spellcheck="true" class="form-control" id="attr_type_value" name="value" required>
                                      </div> 

                                      <div class="col-md-12" id="edit_validity_type_mode">
                                      </div> 

                                      <input type="text" id="attr_value_id" name="value_id" hidden>
                                      <input type="text" id="edit_attr_type_id" name="attr_type_id" hidden>

                                  </div>                                    
                                  <div class="col-md-12 mt-3 text-right">
                                    <button class="btn btn-primary waves-effect" type="submit">Update</button>
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
<script type="text/javascript">



function update_status(type_id,type_status) {
    var status_data={'value_id':type_id,'status':type_status};
    var msg='';
    if(type_status==1){
        msg="You Want To De-activate Zone!";
    }
    else{
        msg="You Want To Activate Zone!";
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
                url:'<?php echo base_url('admin/attribute_master/edit_type_status')?>',
                type: "POST",  
                data: status_data,
                dataType:"JSON",
                success:function (response) {
                  console.log(response);
                  if(response.msg == "success"){
                      swal("Status Has Been Changed.", {
                         icon: "success",
                      });
                      table.ajax.reload();
                  }else{
                      swal("Status Has Not Been Changed.", {
                          icon: "error",
                      });
                  }
                },
                error:function (error) {
                    alert(response);
                }
            }); 
        } else {
            swal("Status Not Changed");
        }
    });
}

function delete_type(value_id){
    swal({
            title: "Are You Sure?",
            text: "Want to delete Attribute Value!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {          
                $.ajax({  
                    url:"<?php echo base_url(); ?>admin/attribute_master/delete_attr_value",  
                    type: "POST",  
                    data: {'attr_value_id':value_id},
                    dataType: "JSON", 
                    success:function(result)  
                    { 
                        if(result.type != "error"){
                            swal('info',result.message,'success');
                            table.ajax.reload();
                        }else{
                            swal('info',result.message,'error');
                        }
                    },
                    error:function(result){
                        alert(result);
                    
                    }
                });
            } else {
              swal("Attribute Value has been safe!");
            }
        });
}


    function edit_type(value_id,value,attr_id,validity_mode) {   
        $('#attr_type_value ').val(value);
        $('#attr_value_id ').val(value_id);
        $('#edit_attr_type_id ').val(attr_id);
        $("#edit_attribute_value").val(attr_id).change();  
        if(attr_id == 4){
            $('#edit_validity_type_mode').html('<h5 class="m-t-30 m-b-10">Course Validity(In Month)</h5><input type="text" id="validity_type_mode" spellcheck="true" placeholder="Course Validity (ex: 3,6 (comma seperated in month)..)" value="'+validity_mode+'" class="form-control" name="course_type_value_name" required>');
        }else{
            $('#edit_validity_type_mode').html('');
        }   
        $('#edit_type_model').modal('show');

    }


    $('#edit_attr_type_form').submit(function(){   

        if($('#edit_attr_type_id').val() == 4){
            var validity_value = $('#validity_type_mode').val();
            var check_validity_value =  /^(?!.*([0-9][0-9]).*\1)[0-9][0-9](?:,[0-9][0-9]){0,6}$/.test(validity_value);

            if(check_validity_value != true){
                swal("Number Should be 2 digit unique and comma seperated", {
                    icon: "error",
                });
                return false;
            }
        }

        var form = $(this);
        $.ajax({  
            url:"<?php echo base_url(); ?>admin/attribute_master/edit_attr_type_value",   
            //base_url() = http://localhost/tutorial/codeigniter  
            type: "POST",  
            data: form.serialize(), // <--- THIS IS THE CHANGE
            dataType: "JSON",
            success:function(result)  
            { 
                if(result.msg == "success"){   
                    $('#edit_type_model').modal('hide');  
                    swal("Attribute updated sucessfully", {
                       icon: "success",
                    });   
                    table.ajax.reload();        
                }else{
                    swal("Attribute Name Already exists", {
                       icon: "error",
                    });  
                }
            },
            error:function(result){
                alert(result);
            
            }
        });  
       
        return false;
      
        // body...
    });

    $('#select_type_value').change(function(e){
        e.preventDefault();
        var selected_value = $('#select_type_value').val();
        if(selected_value == "1"){
            $('#course_type_add').html($('#course_cat').html())
            return false;
        }
        if(selected_value == "2"){
            $('#course_type_add').html($('#course_class').html())
            return false; 
        }
        if(selected_value == "5"){
            $('#course_type_add').html($('#course_mode').html())
            return false; 
        }
        if(selected_value == "4"){
            $('#course_type_add').html($('#course_type').html())
            return false;
        }
        if(selected_value == "6"){
            $('#course_type_add').html($('#course_view').html())
            return false;
        }
        if(selected_value == "3"){
            $('#course_type_add').html($('#subj_cat').html())
            return false;
        }
    });

    $('#select_type_value_id').change(function(e){

        var value_id = $('#select_type_value_id').val();

        // if(value_id == 4){
            // $('#table').find('th').eq(2).after('<td class="remove_class">Month</td><td class="remove_class">View</td>');
        // }else{
            // $('table tr').find('th:eq(' + 2 + '),td:eq(' + 2 + ')' ).remove();
        // }

        // var table_id = document.getElementById('table'); 
        // var row = table_id.rows;

        // // Removing the column at index(1).  
        // var i = 1; 
        // for (var j = 0; j < row.length; j++) {

        //     // Deleting the ith cell of each row.
        //     row[j].deleteCell(i);
        // }

        // setTimeout(function(){
            $('#table').DataTable().destroy();
            load_table(value_id);
        // },3000);

    });



$('#add_attribute_value_form').submit(function(e){    
      e.preventDefault();

      if($('#attr_type_id').val() == 4){

          var validity_value = $('#course_type_value_name').val();
          var check_validity_value =  /^(?!.*([0-9][0-9]).*\1)[0-9][0-9](?:,[0-9][0-9]){0,6}$/.test(validity_value);

          if(check_validity_value != true){
              swal("Number Should be unique or comma seperated", {
                  icon: "error",
              });
              return false;
          }
      }

      var form = $(this);
      $.ajax({  
          url:"<?php echo base_url(); ?>admin/attribute_master/attr_type_value",   
          //base_url() = http://localhost/tutorial/codeigniter  
          type: "POST",  
          data: form.serialize(), // <--- THIS IS THE CHANGE
          dataType: "json",
          success:function(result)  
          { 
              console.log(result);     
              if(result.type == "success"){        
                  $('#add_attribute_value_form').trigger("reset");
                  table.ajax.reload();
                  swal('info',result.message,'success');
                  $('#add_attr_val_modl').modal('hide');
              }else{
                  swal('info',result.message,'error');
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


         $('#add_attr_val_btn').click(function(){
            $('#select_type_value').val(1).change();
            $('#add_attr_val_modl').modal('show');
        })

         load_table(1);

         function load_table(id_value){
             $( document ).ready(function() {
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
                                columns: [ 0, 1, 2]
                            },
                        },
                        {
                            extend: 'csv',
                            exportOptions: {
                                columns: [ 0, 1, 2]
                            }
                        },
                     
                  ],
                  "ajax":{
                      url:"<?php echo base_url(); ?>admin/attribute_master/get_cat_all_data", 
                      type: "POST",
                      data:{'attr_type_id':id_value},
                      error: function(response){
                        console.log(response);
                      }
                    }
                });
              });
         }

    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
   
</body>

</html>
