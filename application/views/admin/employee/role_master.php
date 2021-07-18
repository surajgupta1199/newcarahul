

        <!-- ============================================================== -->
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                 Role Master
                                 <button type="button" id="add_role_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Role</button>
                                <div class="table-responsive m-t-40">
                                    <table id="tbl_role_master" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Designation</th>                                         
                                            <th>Actions</th>   
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

<div id="add_role_master" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <form id='add_role_form'>
                                    <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Designation</h5>
                                                <input type="text" spellcheck="true" placeholder="Enter Designation" class="form-control required "  name="designation" id="designation" value="" >
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="m-t-30 m-b-10">Assign Permissions</h5>
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                                <td></td>
                                                                <td>Read</td>
                                                                <td>Write</td>
                                                                <td>Modify</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                <td>Course Management</td>
                                                                <td>
                                                                      <input type="checkbox"  id="chkRead1" name="course_permissions_0" value="1">
                                                                      <label class="custom-control-label" for="chkRead1"></label>
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" id="chkWrite1" name="course_permissions_1" value="1">
                                                                    <label class="custom-control-label" for="chkWrite1"></label>
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" id="chkModify1" name="course_permissions_3" value="1">
                                                                    <label class="custom-control-label" for="chkModify1"></label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Student Management</td>
                                                                <td>
                                                                      <input type="checkbox"  id="chkRead3" name="student_permissions_0" value="1">
                                                                      <label class="custom-control-label" for="chkRead3"></label>
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" id="chkWrite3" name="student_permissions_1" value="1">
                                                                    <label class="custom-control-label" for="chkWrite3"></label>
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" id="chkModify3" name="student_permissions_2" value="1">
                                                                    <label class="custom-control-label" for="chkModify3"></label>
                                                                </td>
                                                            </tr>
                                                             <tr>
                                                                <td>Coupan Management</td>
                                                                <td>
                                                                      <input type="checkbox"  id="chkRead4" name="coupan_permissions_0" value="1">
                                                                      <label class="custom-control-label" for="chkRead4"></label>
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" id="chkWrite4" name="coupan_permissions_1" value="1">
                                                                    <label class="custom-control-label" for="chkWrite4"></label>
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" id="chkModify4" name="coupan_permissions_2" value="1">
                                                                    <label class="custom-control-label" for="chkModify4"></label>
                                                                </td>
                                                            </tr>

                                                    </tbody>
                                                </table>
                                                <label class="required_field"></label> 
                                            </div>
                                    </div>  
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

<div id="edit_role_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit_role_form">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="m-t-30 m-b-10">Designation</h5>
                            <input type="text" spellcheck="true" placeholder="Enter Designation" class="form-control required "  name="designation" id="edit_designation" value="" readonly>
                        </div>
                        <div class="col-md-12">
                            <h5 class="m-t-30 m-b-10">Assign Permissions</h5>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                            <td></td>
                                            <td>Read</td>
                                            <td>Write</td>
                                            <td>Modify</td>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr id="edit_course_permissions_rw">
                                        </tr>
                                        <tr id="edit_student_permissions_rw">
                                        </tr>
                                        <tr id="edit_coupan_permissions_rw">
                                        </tr>

                                </tbody>
                            </table>
                            <label class="required_field"></label> 
                            <input type="hidden" name="role_id" id="role_id" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary waves-effect" type="submit">Edit</button>
                  <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="view_role_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Assigned Permissions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                          
                <div class="form-group form-float">
                    <div class="row">
                        <div class="course_tabs" style="overflow-x: auto;">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td>Read</td>
                                            <td>Write</td>
                                            <td>Modify</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr id="course_permissions">
                                               
                                            </tr>
                                            <tr id="student_permissions">
                                               
                                            </tr>
                                             <tr id="coupan_permissions">
                                               
                                            </tr>

                                    </tbody>
                                </table>
                                <label class="required_field"></label> 
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
    $('#add_role_form').submit(function(){    
   
    var form = $(this);
      $.ajax({  
     url:"<?php echo base_url(); ?>admin/Role_management/add_role",   
      //base_url() = http://localhost/tutorial/codeigniter  
     type: "POST",  
     data: form.serialize(), // <--- THIS IS THE CHANGE
        dataType: "json",  
       beforeSend: function(){
                    $("#fp_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
                },
      success:function(result)  
      {    
        if(result.type=="success"){        
        $('#add_role_form').trigger("reset");
        table.ajax.reload();
        $('#fp_response').html("<br><div class='alert alert-success col-md-12'> <div class='container col-md-12'> </button> <b>" +result.msg+ "</b></div></div>");         
        }
        else if(result.msg=="role_exist")
        {     table.ajax.reload();
             $('#fp_response').html("<br><div class='alert alert-danger col-md-12'> <div class='container col-md-12'></button> <b>"+result.msg+"</b></div></div>");
        }

        else{
          $('#fp_response').html("<br><div class='alert alert-danger col-md-12'> <div class='container col-md-12'></button> <b>"+result.msg+"</b></div></div>");
         
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


    function update_status(role_id,role_status) {
        var status_data={'role_id':role_id,'role_status':role_status};
        var msg='';
        if(status==0){
            msg="You Want To De-activate Role!";
        }
        else{
            msg="You Want To Activate Role!";
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
                    url:'<?php echo base_url('admin/Role_management/update_role_status')?>',
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


    function view_permissions(role_id) {
        $.ajax({
            url:"<?php echo base_url(); ?>admin/Role_management/get_role_permissions", 
            method:"POST",
            data:{role_id:role_id},     
            dataType: 'json',     
            success:function(result)
            {
                $('#course_permissions').html(result.course_alloted_permissions);
                $('#student_permissions').html(result.student_alloted_permissions);
                $('#coupan_permissions').html(result.coupan_alloted_permissions);
                $('#view_role_model').modal('show');
            },
            error: function(response){
                console.log(response);
            }
        });
    }


    function edit_permissions(role_id) {
        $('#role_id').val(role_id); 
        $.ajax({
            url:"<?php echo base_url(); ?>admin/Role_management/set_edit_role__data", 
            method:"POST",
            data:{role_id:role_id},     
            dataType: 'json',     
            success:function(result)
            {  
               
                $('#edit_designation').val(result.designation);
                $('#edit_course_permissions_rw').html(result.course_alloted_permissions);
                $('#edit_student_permissions_rw').html(result.student_alloted_permissions);
                $('#edit_coupan_permissions_rw').html(result.coupan_alloted_permissions);
                $('#edit_role_model').modal('show');
            },
            error: function(response){
                console.log(response+'fail');
            }
        });
    }

     $('#edit_role_form').submit(function(){   
        var form = $(this);
          $.ajax({  
         url:"<?php echo base_url(); ?>admin/Role_management/edit_role",   
         type: "POST",  
         data: form.serialize(), // <--- THIS IS THE CHANGE
         dataType: "json",  
           beforeSend: function(){
                        $("#fp_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
                    },
          success:function(result)  
          { 
            if(result.type == 'success'){ 
                $('#edit_role_model').modal('hide');       
                table.ajax.reload();
                swal('Info!!',result.msg,'success') ; 
            }
            else
            {
                $('#edit_role_model').modal('hide');       
                table.ajax.reload();
                swal('Info!!',result.msg,'error') ;     

            }
           
            
          },
          error:function(result){
            alert(result);
            
          }

        });  
   
        return false;
  
    });
    $('#add_role_btn').click(function(){
        $('#add_role_master').modal('show');
        
    })

    $( document ).ready(function() {

        table = $('#tbl_role_master').DataTable({
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
                url:"<?php echo base_url(); ?>admin/Role_management/get_role_all_data", 
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
