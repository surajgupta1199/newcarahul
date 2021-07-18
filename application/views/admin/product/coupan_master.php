

        <!-- ============================================================== -->
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                 Coupan Master
                                 <?php
                                         if($this->session->userdata('employee_roll') != 0){
                                            $coupan_tab_permissions=$this->session->userdata('coupan_tab_permissions');
                                             if($coupan_tab_permissions[1] == 1){
                                ?>
                                                <button type="button" id="add_coupan_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Coupan</button>

                                <?php        }

                                }
                                else{

                                ?>
                                                <button type="button" id="add_coupan_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Coupan</button>
                                <?php
                                }
                                ?>
                                <div class="table-responsive m-t-40">
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Coupan Name</th>                                         
                                            <th>Coupan Code</th>                                         
                                            <th>Coupan Description</th>                                         
                                            <th>Minimum Amount</th>                                         
                                            <th>Coupan Discount</th> 
                                            <th>Coupan Discount Type</th>                                         
                                            <th>Coupan Start Date</th>                                         
                                            <th>Coupan End Date</th>                                         
                                            <th>Status</th>
                                             <?php
                                                  if($this->session->userdata('employee_roll') != 0){
                                                      $coupan_tab_permissions=$this->session->userdata('coupan_tab_permissions');
                                                          if($coupan_tab_permissions[2] == 1){
                                             ?>                                         
                                                        <th>Action</th>
                                             <?php
                                                  }
                                              }
                                              else
                                              {
                                              ?>
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
                       
                        
                    </div>
                </div>

   <div id="add_coupan_master" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">Add Coupan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            <form autocomplete="off" id="add_coupan_form" method="POST">
              <div class="row">
                   <div class="col-md-6">
                    <h5 class="m-t-30 m-b-10">Type</h5>
                    <select class="form-control" name="coupan_type" id="coupan_type" required> 
                        <option value="">-- Please select coupan type --</option>
                        <option value="1">Normal</option>
                        <option value="2">Category Wise</option>
                     </select>
                  </div>
                 <div class="col-md-6" id="category_drp" >
                       <h5 class="m-t-30 m-b-10">Category</h5>
                       <select class="form-control" name="cat_id" id="cat_id">
                          <option value="">-- Please select category --</option>
                          
                       </select>
                    </div>
              </div>
               <div class="row">
                  <div class="col-md-6">
                     <h5 class="m-t-30 m-b-10">Coupan Title</h5>
                     <input type="text" spellcheck="true" class="form-control"  name="coup_title" required>
                     
                  </div>
                 
                  <div class="col-md-6">
                     <h5 class="m-t-30 m-b-10">Coupan Code</h5>
                     <input type="text" spellcheck="true" class="form-control"  name="coup_code" required>
                  </div>
                  <div class="col-md-6">
                     <h5 class="m-t-30 m-b-10">Coupan Description</h5>
                     <input type="text" spellcheck="true" class="form-control" name="coup_description" required>
                  </div>
                   <div class="col-md-6">
                     <h5 class="m-t-30 m-b-10">Discount Type</h5>
                     <select class="form-control" name="coup_discount_type" id="coup_discount_type" required> 
                        <option value="">-- Please select type --</option>
                        <option value="1">In Percentage</option>
                        <option value="2">In Amount</option>
                       
                     </select>
                  </div>
                  <div class="col-md-6">
                     <h5 class="m-t-30 m-b-10" id="discount_change"> Discount</h5>
                     <input type="text" spellcheck="true" class="form-control only_number" name="coup_discount"  id="coup_discount"  required>
                  </div>
                  <div class="col-md-6">
                     <h5 class="m-t-30 m-b-10">Minimum Amount</h5>
                     <input type="text" spellcheck="true" class="form-control only_number" name="coup_min_amount"  id="coup_min_amount"  required>
                    
                  </div>
                 
                  <div class="col-md-6">
                     <h5 class="m-t-30 m-b-10">From Date</h5>
                     <input type="text" id="coup_start_date" class="datepicker form-control" name="coup_start_date" required>
                  </div>
                  <div class="col-md-6">
                     <h5 class="m-t-30 m-b-10">To Date</h5>
                     <input type="text" id="coup_end_date" class="datepicker form-control" name="coup_end_date" required> 
                  </div>
               
               </div>
              <br/>
               <button class="btn btn-primary waves-effect" type="submit">Save</button>
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




<div id="edit_coupan_model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Coupan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                      <div class="modal-body">
                          <form autocomplete="off" id="edit_coupan_form"   method="POST">
                                  <div class="form-group form-float">
                                     <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="m-t-30 m-b-10">Type</h5>
                                            <select class="form-control" name="coupan_type" id="edit_coupan_type"  required> 
                                                <option value="">-- Please select coupan type --</option>
                                                <option value="1">Normal</option>
                                                <option value="2">Category Wise</option>
                                             </select>
                                          </div>
                                         <div class="col-md-6" id="edit_category_drp" >
                                               <h5 class="m-t-30 m-b-10">Category</h5>
                                               <select class="form-control" name="cat_id" id="edit_cat_id">
                                                  <option value="">-- Please select category --</option>
                                                  
                                                  
                                               </select>
                                            </div>
                                      </div>
                                      <div class="row">
                                    <div class="col-md-6">
                                       <h5 class="m-t-30 m-b-10">Coupan Title</h5>
                                       <input type="text" spellcheck="true" class="form-control"  name="coup_title" id="edit_coupan_title" required>
                                       
                                    </div>
                                   
                                    <div class="col-md-6">
                                       <h5 class="m-t-30 m-b-10">Coupan Code</h5>
                                       <input type="text" spellcheck="true" class="form-control"  name="coup_code" id="edit_coup_code" required>
                                    </div>
                                    <div class="col-md-6">
                                       <h5 class="m-t-30 m-b-10">Coupan Description</h5>
                                       <input type="text" spellcheck="true" class="form-control" name="coup_description"  id="edit_coup_description" required>
                                    </div>
                                     <div class="col-md-6">
                                       <h5 class="m-t-30 m-b-10">Discount Type</h5>
                                       <select class="form-control" name="coup_discount_type" id="edit_coup_discount_type" required> 
                                          <option value="">-- Please select type --</option>
                                          <option value="1">In Percentage</option>
                                          <option value="2">In Amount</option>
                                         
                                       </select>
                                    </div>
                                    <div class="col-md-6">
                                       <h5 class="m-t-30 m-b-10"> Discount</h5>
                                       <input type="text" spellcheck="true" class="form-control only_number" name="coup_discount"  id="edit_coup_discount"  required>
                                    </div>
                                    <div class="col-md-6">
                                       <h5 class="m-t-30 m-b-10">Minimum Amount</h5>
                                       <input type="text" spellcheck="true" class="form-control only_number" name="coup_min_amount"  id="edit_coup_min_amount"  required>
                                      
                                    </div>
                                   
                                    <div class="col-md-6">
                                       <h5 class="m-t-30 m-b-10">From Date</h5>
                                       <input type="text"  class="datepicker form-control" name="coup_start_date" value="" id="edit_coup_start_date" required>
                                    </div>
                                    <div class="col-md-6">
                                       <h5 class="m-t-30 m-b-10">To Date</h5>
                                       <input type="text"  class="datepicker form-control" name="coup_end_date" value="" id="edit_coup_end_date" required> 
                                    </div>
                                 
                                 </div>
                      
                                  <input type="text" spellcheck="true"  name="coup_id" hidden="hidden" readonly="readonly" id="coup_id" required>
                                  </div>
                                  <div class="form-group form-float">
                                      <button class="btn btn-primary waves-effect" type="submit">Update</button>
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


$('#coupan_type').change(function(e)
    {

      var type=$('#coupan_type').val();
      
      if(type==2)
      {
         $.ajax({
          url:"<?php echo base_url(); ?>admin/coupan_master/get_drp_data", 
          method:"POST",
          dataType: 'json',     
          success:function(result)
          { 
            $('#cat_id').html(result);
          },
          error: function(response){
            console.log(response);
          }
        });
          
      }
      else
      {
          $('#cat_id').html('<option value="">No Categories Available</option>');
      }


    });
$('#edit_coupan_type').change(function(e)
    {

      var type=$('#edit_coupan_type').val();
      if(type==2)
      {
        $.ajax({
          url:"<?php echo base_url(); ?>admin/coupan_master/get_drp_data", 
          method:"POST",
          dataType: 'json',     
          success:function(result)
          { 
            $('#edit_cat_id').html(result);
          },
          error: function(response){
            console.log(response);
          }
        });
        
      }
      else
      {

          $('#edit_cat_id').html(' <option value="0">No Categories Available</option>');
       
      }


    });
$('#coup_discount_type').change(function(e)
{
   var type=$('#coup_discount_type').val();
   if(type==1)
   {

      $('#discount_change').text('Discount in %');
   }
   else
   {
     $('#discount_change').text('Discount in ₹');
   }

})


function update_status(coup_id,coupon_status) {
    var status_data={'coup_id':coup_id,'coupon_status':coupon_status};
    var msg='';
    if(status==0){
        msg="You Want To De-activate Coupan!";
    }
    else{
        msg="You Want To Activate Coupan!";
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
                url:'<?php echo base_url('admin/coupan_master/update_coupan_status')?>',
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


function edit_coupan(coup_id) {
 $('#coup_id').val(coup_id); 
    $.ajax({
          url:"<?php echo base_url(); ?>admin/coupan_master/get_coupan_particular_data", 
          method:"POST",
          data:{coup_id:coup_id},     
          dataType: 'json',     
          success:function(result)
          {  
            console.log(result);

            // return false;
            $('#edit_coupan_title').val(result.coup_title);
            $('#edit_coup_code').val(result.coup_code);
            $('#edit_coup_description').val(result.coup_description);
            $('#edit_coup_discount_type').val(result.coup_discount_type).change();
            $('#edit_coupan_type').val(result.coupan_type).change();
             setTimeout(function () {
            $('#edit_cat_id').val(result.cat_id).change();        
              }, 1000);

            $('#edit_coup_discount').val(result.coup_discount);
            $('#edit_coup_min_amount').val(result.coup_min_amount);
            $('#edit_coup_start_date').val(result.coup_start_date);
            $('#edit_coup_end_date').val(result.coup_end_date);
            
            $('#edit_coupan_model').modal('show');
            
          },
          error: function(response){
            console.log(response);
          }
        });
    

    }


    $('#edit_coupan_form').submit(function(){  

    var form = $(this);
      $.ajax({  
     url:"<?php echo base_url(); ?>admin/coupan_master/edit_coupan",   
      //base_url() = http://localhost/tutorial/codeigniter  
     type: "POST",  
     data: new FormData(this), // <--- THIS IS THE CHANGE
        contentType:false,
     cache:false,
     processData:false,
        dataType: "json",   
       beforeSend: function(){
                    $("#fp_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
                },
      success:function(result)  
      { 
        if(result==1){ 
        $('#edit_course_model').modal('hide');       
        table.ajax.reload();
         location.reload();
        swal("Course Updated Successfully") ;     
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


 

$('#add_coupan_form').submit(function(e){    
   
   e.preventDefault();
   
      $.ajax({  
     url:"<?php echo base_url('admin/coupan_master/add_coupan'); ?>",   
      //base_url() = http://localhost/tutorial/codeigniter  
     type: "POST",  
     data: new FormData(this), // <--- THIS IS THE CHANGE
     contentType:false,
     cache:false,
     processData:false,
        dataType: "json",  
       beforeSend: function(){
                    $("#fp_response").html("<div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'> Proccessing.. </div></div>");
                },
      success:function(result)  
      {      
        if(result==1){        
        $('#add_coupan_form').trigger("reset");
        table.ajax.reload();
        
        $('#fp_response').html("<br><div class='alert alert-success col-md-12'> <div class='container col-md-12'> </button> <b> New Coupan Added Successfully.</b></div></div>");         
        }

        else{
          $('#fp_response').html("<br><div class='alert alert-danger col-md-12'> <div class='container col-md-12'></button> <b>Coupan Already Exists.</b></div></div>");
         
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


 $('#add_coupan_btn').click(function(){

    $('#add_coupan_master').modal('show');
   
})

 $('#coup_discount').focus(function()
 {
    if($('#coup_discount_type').val()=='')
      {
        alert('please select discount type ');
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
      $('.datepicker').datepicker({
        format: 'yyyy/m/d'
      });
     table = $('#table').DataTable({
         "aLengthMenu": [[10, 25, 50, 100, 500, 1000, 2000, 5000], [10, 25, 50, 100, 500, 1000, 2000, 5000]],
         dom: 'lBfrtip',
        scrollY: '60vh',
        scrollCollapse:true,
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
                      columns: [ 0, 1, 2, 3, 4,5 ,6 ,7 ,8]
                  },
              },
              {
                  extend: 'csv',
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4,5 ,6 ,7 ,8]
                  }
              },
           
        ],
        "ajax":{
           url:"<?php echo base_url(); ?>admin/coupan_master/get_coupan_all_data", 
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
