

        <!-- ============================================================== -->
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                 Employee Master
                                 <button type="button" id="add_employee_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Employee</button>
                                <div class="table-responsive m-t-40">
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Employee Name</th>                                         
                                            <th>Employee Designation</th>                                         
                                            <th>Employee Phone</th> 
                                            <th>Employee Email</th>
                                            <th>Created On</th>
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

<div id="add_employee_master" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <form id='add_employee_form' class="">
                                    
                                    <section id="employee_detail_form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Designation(Role)</h5>
                                                <select id="employee_roll" name="employee_roll" class="form-control" required>
                                                    <option value="0">--Select Designation--</option>
                                                    <?php
                                                        foreach ($roles as $role) {
                                                    ?>
                                                            <option value="<?php echo $role['role_id'] ?>"><?php echo $role['designation'] ?></option>
                                                    <?php   
                                                           
                                                        }
                                                    ?>
                                                </select>
                                                <label class="required_field"></label> 
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Name</h5>
                                                <input type="text" spellcheck="true" placeholder="Enter Name" class="form-control required "  name="employee_name" id="employee_name" value="" >
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Mobile Number</h5>
                                                <input type="text" spellcheck="true" placeholder="Enter Mobile Number" class="form-control only_number required "  name="employee_phone" id="employee_phone" value="" >
                                                
                                                <label class="required_field"></label> 
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Email</h5>
                                                <input type="email" spellcheck="true" placeholder="Enter Email" class="form-control required"  name="employee_email_id" id="employee_email_id" value="" >
                                                <label class="required_field"></label> 
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Password</h5>
                                                <input type="password" spellcheck="true" placeholder="Enter Password" class="form-control required"  name="employee_password" id="employee_password" value="" >
                                                <label class="required_field"></label> 
                                            </div>
                                             <div class="col-md-6">
                                                <h5 class="m-t-30 m-b-10">Confirm Password</h5>
                                                <input type="password" spellcheck="true" placeholder="Enter Confirm Password" class="form-control required"  name="employee_confirm_password" id="employee_confirm_password" value="" >
                                            
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
<div id="edit_edit_emp_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="edit_employee_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <section id="employee_detail_form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="m-t-30 m-b-10">Designation(Role)</h5>
                                        <select id="edit_employee_roll" name="employee_roll" class="form-control" required>
                                            <option value="0">--Select Designation--</option>
                                            <?php
                                                foreach ($roles as $role) {
                                            ?>
                                                    <option value="<?php echo $role['role_id'] ?>"><?php echo $role['designation'] ?></option>
                                            <?php   
                                                   
                                                }
                                            ?>
                                        </select>
                                        <label class="required_field"></label> 
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="m-t-30 m-b-10">Name</h5>
                                        <input type="text" spellcheck="true" placeholder="Enter Name" class="form-control required"  name="employee_name" id="edit_employee_name" value="" >
                                    </div>

                                    <div class="col-md-12">
                                        <h5 class="m-t-30 m-b-10">Mobile Number</h5>
                                        <input type="text" spellcheck="true" placeholder="Enter Mobile Number" class="form-control only_number required"  name="employee_phone" id="edit_employee_phone" value="" >
                                        
                                        <label class="required_field"></label> 
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="m-t-30 m-b-10">Email</h5>
                                        <input type="email" spellcheck="true" placeholder="Enter Email" class="form-control required"  name="employee_email_id" id="edit_employee_email_id" value="" >
                                        <label class="required_field"></label> 
                                        <input type="hidden" id="employee_id" name="employee_id" value="">
                                    </div>
                                </div>           
                            </section>
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
<script type="text/javascript">
    $('#add_employee_form').submit(function(){    
        var password=$('#employee_password').val();
        var cnf_password=$('#employee_confirm_password').val();
        if(password == cnf_password)
        {
            var form = $(this);
              $.ajax({  
             url:"<?php echo base_url(); ?>admin/Employee_management/add_emp",   
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
                $('#add_employee_form').trigger("reset");
                table.ajax.reload();
                $('#fp_response').html("<br><div class='alert alert-success col-md-12'> <div class='container col-md-12'> </button> <b> New Employee Added Successfully.</b></div></div>");         
                }
                else if(result.msg=="email exist")
                {     table.ajax.reload();
                     $('#fp_response').html("<br><div class='alert alert-danger col-md-12'> <div class='container col-md-12'></button> <b>Employee Email Already Exists.</b></div></div>");
                }

                else{
                  $('#fp_response').html("<br><div class='alert alert-danger col-md-12'> <div class='container col-md-12'></button> <b>Employee Not Added.</b></div></div>");
                 
                }
               
                
                return false;
              },
              error:function(result){
                alert(result);
                
              }

            });  
        }
        else{
            swal('Info!','Confirm Password Does Not Match With Password','warning');
            return false;
        }
        
   
    return false;

    // body...
}); 


     function update_status(employee_id,employee_status) {
        var status_data={'employee_id':employee_id,'employee_status':employee_status};
        var msg='';
        if(status==0){
            msg="You Want To De-activate Employee!";
        }
        else{
            msg="You Want To Activate Employee!";
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
                    url:'<?php echo base_url('admin/Employee_management/update_emp_status')?>',
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


    function edit_employee(employee_id) {
        $('#employee_id').val(employee_id); 
        $.ajax({
            url:"<?php echo base_url(); ?>admin/Employee_management/get_particular_emp_data", 
            method:"POST",
            data:{employee_id:employee_id},     
            dataType: 'json',     
            success:function(result)
            {  
                $('#edit_employee_roll').val(result.employee_roll).change();
                $('#edit_employee_name').val(result.employee_name);
                $('#edit_employee_phone').val(result.employee_phone);
                $('#edit_employee_email_id').val(result.employee_email_id);
                $('#edit_edit_emp_model').modal('show');
            },
            error: function(response){
                console.log(response+'fail');
            }
        });
     return false;
    }
     $('#edit_employee_form').submit(function(){   
        var form = $(this);
          $.ajax({  
         url:"<?php echo base_url(); ?>admin/Employee_management/edit_emp",   
         type: "POST",  
         data: form.serialize(), // <--- THIS IS THE CHANGE
         dataType: "json",  
           beforeSend: function(){
                        $("#fp_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
                    },
          success:function(result)  
          { 
            if(result.type == 'success'){ 
                $('#edit_edit_emp_model').modal('hide');       
                table.ajax.reload();
                swal('Info!!',result.msg,'success') ; 
            }
            else if(result.type == 'warning')
            {
                swal('Info!!',result.msg,'warning');
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

    $('#add_employee_btn').click(function(){
        $('#add_employee_master').modal('show');
        
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
                url:"<?php echo base_url(); ?>admin/Employee_management/get_emp_all_data", 
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
