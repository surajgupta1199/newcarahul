

        <!-- ============================================================== -->
                        <div class="card">
                            <div class="card-body">
                                 <?php
                                        if($this->session->userdata('employee_roll') != 0){
                                            $course_tab_permission=$this->session->userdata('course_tab_permission');
                                             if($course_tab_permission[1] == 1){

                                ?>
                                               <button type="button" id="add_attr_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Attribute Type</button>
                                <?php 
                                    }
                                }
                                else
                                {
                                ?>
                                                <button type="button" id="add_attr_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Attribute Type</button>
                                <?php
                                }
                                 ?>
                                 
                                <div class="table-responsive m-t-40">
                                  Attribute Master
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Attribute Name</th>                                         
                                            <th>Attribute Date Time</th> 
                                            <th>Status</th>
                                            <?php
                                              if($this->session->userdata('employee_roll') != 0){
                                                  $course_tab_permission=$this->session->userdata('course_tab_permission');
                                                      if($course_tab_permission[2] == 1){
                                            ?>                                        
                                            <th>Edit</th>
                                            <?php
                                              }
                                            }
                                            else
                                            {
                                            ?>
                                               <th>Edit</th>
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
                       
                        
                   




    <div id="add_attr_master" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Add Attribute</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  </div>
                  <div class="modal-body">
                    <form autocomplete="off" id="add_cat_form" method="POST">
                     
                           <div class="row">
                              <div class="col-md-12">

                                  <div class="col-md-12 selected_type" data_value="1">
                                      <h5 class="m-t-30 m-b-10">Attribute Name</h5>
                                      <input type="text" spellcheck="true" placeholder="Enter Attribute Name" class="form-control" name="title" required>
                                  </div> 

                              </div>                                    
                          </div>
                         <br>
                         <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
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

                                      <div class="col-md-12">
                                          <h5 class="m-t-30 m-b-10">Attribute Name</h5>
                                          <input type="text" spellcheck="true" class="form-control" id="attr_title_name" name="title" required>
                                      </div>
                                      <input name="attribute_id" id="edit_attribute_id" hidden>

                                  </div>                                    
                              </div>
                              <br>
                              <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
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



function update_status(attr_id,attr_status) {
    var status_data={'attribute_id':attr_id,'status':attr_status};
    var msg='';
    if(attr_status==1){
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
                url:'<?php echo base_url('admin/add_attribute_master/update_attr_status')?>',
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


    function edit_type(attr_id,attr_title) {   
      $('#attr_title_name ').val(attr_title);
      $('#edit_attribute_id ').val(attr_id);

      $('#edit_type_model').modal('show');
    }


    $('#edit_attr_type_form').submit(function(){   
        var form = $(this);
        $.ajax({  
            url:"<?php echo base_url(); ?>admin/add_attribute_master/edit_attr_type",   
            //base_url() = http://localhost/tutorial/codeigniter  
            type: "POST",  
            data: form.serialize(), // <--- THIS IS THE CHANGE
            dataType: "JSON",  
            beforeSend: function(){
                        $("#fp_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
                    },
            success:function(result)  
            { 
                if(result.type == "success"){   
                    $('#edit_type_model').modal('hide');  
                    swal("Attribute updated sucessfully", {
                       icon: "success",
                    });   
                    table.ajax.reload();        
                }else{
                    swal(result.message, {
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

$('#add_cat_form').submit(function(e){    
      e.preventDefault();

      var form = $(this);
      $.ajax({  
          url:"<?php echo base_url(); ?>admin/add_attribute_master/add_attr_type",   
          //base_url() = http://localhost/tutorial/codeigniter  
          type: "POST",  
          data: form.serialize(), // <--- THIS IS THE CHANGE
          dataType: "json",  
          beforeSend: function(){
                    $("#fp_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
                },
          success:function(result)  
          {  
              if(result.type == "success"){        
                  $('#add_cat_form').trigger("reset");
                  table.ajax.reload();
                  $('#fp_response').html("<br><div class='alert alert-success col-md-12'> <div class='container col-md-12'> </button> <b> New Category Added Successfully.</b></div></div>");         
                  }

              else{
                  $('#fp_response').html("<br><div class='alert alert-danger col-md-12'> <div class='container col-md-12'></button> <b>"+result.message+"</b></div></div>");
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


         $('#add_attr_btn').click(function(){
            $('#add_attr_master').modal('show');
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
                      url:"<?php echo base_url(); ?>admin/add_attribute_master/get_all_attr", 
                      type: "POST",
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
