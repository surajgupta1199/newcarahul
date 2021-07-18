

        <!-- ============================================================== -->
        <
                        <div class="card">
                            <div class="card-body">
                                Course Manage Key
                                <div class="table-responsive m-t-40">
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Course ID</th>                                          
                                            <th>Course Name</th>                                         
                                            <th>Course Key</th>                                         
                                            <th>Course View</th>                                         
                                            <th>Duration</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody></tbody>                                      
                                       
                                    </table>
                                </div>
                            </div>
                        </div>

  <div id="show_student_order" class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-view">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Course Details</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                            
                  <div class="form-group form-float">
                      <div class="row">
                          <div class="col-md-12 view-details row">
                              <div class="form-group col-md-6">
                                  <h6>Student ID</h6>
                                  <input class="form-control" id="student_id" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <h6>Student Name</h6>
                                  <input class="form-control" id="student_name" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <h6>Student Contact</h6>
                                  <input class="form-control" id="student_contact" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <h6>Course Assigned Date</h6>
                                  <input class="form-control" id="student_assigned" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <h6>Course Expired Date</h6>
                                  <input class="form-control" id="student_expired_course" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <h6>Course Extended Date</h6>
                                  <input class="form-control" id="student_extended" readonly>
                              </div>
                          </div>
                      </div>
                  </div>  
              </div>
          </div>
      </div>
  </div>

<script type="text/javascript">

  function view_assign_key(student_id,assigned_date,expired_date,extended_date){
        $.ajax({
          url:'<?php echo base_url('admin/course_key/view_student_detail')?>',
          type: "POST",  
          data: {'student_id':student_id},
          dataType:"JSON",
            success:function (response) {
                console.log(response);
                $('#student_id').val(student_id);
                $('#student_name').val(response.student_first_name + ' '+response.student_last_name);
                $('#student_contact').val(response.student_phone);
                $('#student_assigned').val(assigned_date);
                $('#student_expired_course').val(expired_date);
                $('#student_extended').val(extended_date);
                $('#show_student_order').modal('show');
            },
            error:function (error) {
                alert(error);
            }
        }); 
  }

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
         url:"<?php echo base_url(); ?>admin/Course_key/fetch_all_course_key", 
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
