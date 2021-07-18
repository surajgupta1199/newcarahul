            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <label class="switch_txt fixed_position">
                                    <input type="checkbox" id="togBtn" data_attr="off">
                                    <div class="slider_round"></div>
                                </label> -->
                                <form id="filter_transc_date">
                                    <div class="row">
                                        <div class="col-md-4">
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <div class="input-group-text">
                                                From Date:
                                              </div>
                                            </div>
                                            <input type="text" class="form-control fc-datepicker" id="from_date" name="from_date" placeholder="DD/MM/YYYY" required value="" >
                                          </div><!-- input-group -->
                                        </div><!-- col-4 -->

                                        <div class="col-md-4">
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <div class="input-group-text">
                                               To Date:
                                              </div>
                                            </div>
                                             <input type="text" class="form-control fc-datepicker" id="to_date" name="to_date" placeholder="DD/MM/YYYY" required value="">
                                          </div><!-- input-group -->
                                        </div><!-- col-4 -->
                                        <div class="col-md-4">
                                            <button class="btn btn-primary btn-block" type="submit">Serach</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive m-t-40">
                                    <table id="table" data-toggle="table" data-mobile-responsive="true" data-sort-order="desc" class="display table table-hover table-striped table-bordered no-footer dataTable"  width="100%" role="grid" aria-describedby="log_master_table_info">
                                       <thead>
                                        <tr>
                                            <th>No</th>                                          
                                            <th>Order Id</th>                                          
                                            <th>Student Name</th> 
                                            <th>Student Phone</th>
                                            <th>Transaction Number</th>                                         
                                            <th>Additional Discription</th>                                         
                                            <th>Transaction Status</th>
                                            <th>Transaction Date</th>
                                        </tr>
                                      </thead>
                                    
                                    <tbody></tbody>                                      
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<style>
  .swal-modal .swal-text {
    text-align: center;
  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script type="text/javascript">

  var from_date="";
  var to_date="";
  var filter="all";

  $('#togBtn').click(function(){
      var data_attr = $(this).attr('data_attr');
      $('#table').DataTable().destroy();
      if(data_attr == "off"){
          filter = "Ranker";
          load_table(filter,from_date,to_date);
          data_attr = $(this).attr('data_attr','on');
      }else{
          filter = "all";
          load_table(filter,from_date,to_date);
          data_attr = $(this).attr('data_attr','off');
      }
  })


  $('#filter_transc_date').submit(function(e){
      e.preventDefault();
      from_date = $('#from_date').val();
      to_date = $('#to_date').val();
      $('#table').DataTable().destroy();
      load_table(from_date,to_date);
  })

  load_table("","");
      
  function load_table(from_date,to_date){
      $( document ).ready(function() {

          $('.fc-datepicker').datepicker({
              showOtherMonths: true,
              selectOtherMonths: true,
              format: 'dd/mm/yyyy' ,
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
                          columns: [ 0, 1, 2, 3, 4,5 ,6 ,7 ,8 ]
                      },
                  },
                  {
                      extend: 'csv',
                      exportOptions: {
                          columns: [ 0, 1, 2, 3, 4,5 ,6 ,7 ,8 ]
                      }
                  },
                 
              ],
              "ajax":{
                  url:"<?php echo base_url(); ?>admin/student_management/student_transaction_detail", 
                  type: "POST",
                  data:{'from_date':from_date,'to_date':to_date},
                  error: function(response){
                      console.log(response);
                  }
              }
          });
      });
  }
</script>
   
