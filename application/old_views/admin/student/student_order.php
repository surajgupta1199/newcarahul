            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <label class="switch_txt fixed_position">
                                    <input type="checkbox" id="togBtn" data_attr="off">
                                    <div class="slider_round"></div>
                                </label>
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
                                            <th>View Order</th>
                                            <th>Student Email</th>                                         
                                            <th>Mobile Number</th>                                         
                                            <th>Grand Total</th>
                                            <th>Coupon Code</th>
                                            <th>Tracking Item</th>
                                            <th>Cancelled Reason</th>
                                            <th>Coupon DIscount</th>
                                            <th>Sub Total</th>
                                            <th>Date</th>
                                            <th>Load PDF</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                      </thead>
                                    
                                    <tbody></tbody>                                      
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="show_student_order" class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Course Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                          
                                <div class="form-group form-float table-responsive">
                                    <div class="row">
                                        <div class="col-md-12 view-details">
                                            <table class="table table-striped table-bordered text-center m-t-10 " id="show_data_table">
                                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>

                <div id="extend_date_course" class="modal fade bs-example-modal-xl" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-view">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Course Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                          
                                <div class="form-group form-float table-responsive">
                                    <div class="row">
                                        <div class="col-md-12 view-details">
                                            <table class="table table-striped table-bordered text-center m-t-10 " id="show_course_table">
                                                                
                                            </table>
                                        </div>
                                    </div>
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
      load_table(filter,from_date,to_date);
  })


  function cancel_prod(order_id,item_link) {
        swal({
            title: "Are You Sure?",
            text: "The Product Was Cancel!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            content: {
                element: "input",
                attributes: {
                placeholder: "Short Brief to Cancle The Product",
                id:"cancel_reason",
                type: "url",
                value:item_link,
              }
            },
            buttons: {
                confirm: {
                  text: "OK",
                  value: true,
                  visible: true,
                  className: "",
                  closeModal: true
                }
            },
        }).then((willDelete) => {
        if (willDelete) {  
        var cancel_reason = $('#cancel_reason').val();          
        $.ajax({
              url:'<?php echo base_url('admin/student_management/cancelled_prod')?>',
              type: "POST",  
              data: {'id':order_id,'cancel_reason':cancel_reason},
                success:function (response) {
                    if(response==1)
                    {
                         swal("your Product has been canceled.", {
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
                    alert(error);
                }
            }); 
        } else {
          swal("unable to cancel the product");
          location.reload();
        }
    });
}

function delivered(order_id,item_link) {
    if(item_link !=""){
        swal({
            title: "Are You Sure?",
            text: "The Product Was Delivered!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {          
            $.ajax({
                  url:'<?php echo base_url('admin/student_management/prod_delivered')?>',
                  type: "POST",
                  data: {'id':order_id,'item_track_link':item_link},
                  dataType:"JSON",
                    success:function (response) {
                        if(response.msg=="success")
                        {
                             swal("Product delivered successfully.", {
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
                        alert(error);
                    }
                }); 
            } else {
              swal("Product has been safe!");
              location.reload();
            }
        });
    }else{  
        swal({
            title: "Are You Sure?",
            text: "The Product Was Delivered!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            content: {
                element: "input",
                attributes: {
                placeholder: "Type your tracking link",
                id:"fetch_trail_link",
                type: "url",
                value:item_link,
              }
            },
            buttons: {
                confirm: {
                  text: "OK",
                  value: true,
                  visible: true,
                  className: "",
                  closeModal: true
                }
            },
        }).then(function(willDelete){
          if ($('#fetch_trail_link').val() != "") { 

              var value = $('#fetch_trail_link').val();    
              var check_url = isValidURL(value);

              if(check_url == false){
                  alert('Enter tracking link is not valid');
                  location.reload();
                  return false;
              }

              $.ajax({
                  url:'<?php echo base_url('admin/student_management/prod_delivered')?>',
                  type: "POST",  
                  data: {'id':order_id,'item_track_link':value},
                  dataType:"JSON",
                    success:function (response) {
                        if(response.msg=="success")
                        {
                             swal("Product delivered successfully.", {
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
                        alert(error);
                    }
                });
            } else {
              swal("Product was not delivered yet Please Enter tracking Link");
              location.reload();
            }
        });
    }
}

function update_delivered(order_id,item_link,num){
    var load_fnc = $('#select_element_'+num+' option:selected').attr('data_attr');
    window[load_fnc](order_id,item_link);   
}

function on_deliver(order_id,item_link) {
    swal({
        title: "Are You Sure?",
        text: "The Product Was On Delivery!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: false,
        content: {
            element: "input",
            attributes: {
            placeholder: "Type your tracking link",
            id:"fetch_link",
            type: "url",
            value:item_link,
          }
        },
        buttons: {
            confirm: {
              text: "OK",
              value: true,
              visible: true,
              className: "",
              closeModal: true
            }
        },
    }).then(function(willDelete){
      if ($('#fetch_link').val() != "") { 

          var value = $('#fetch_link').val();    
          var check_url = isValidURL(value);

          if(check_url == false){
              alert('Enter tracking link is not valid');
              location.reload();
              return false;
          }

          $.ajax({
                  url:'<?php echo base_url('admin/student_management/prod_on_way')?>',
                  type: "POST",  
                  data: {'id':order_id,'item_track_link':value},
                  dataType:"JSON",
                    success:function (response) {
                        if(response.msg=="success")
                        {
                             swal("Product is on way.", {
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
                        alert(error);
                    }
                }); 
        } else {
          swal("Product was not delivered yet Please Enter tracking Link");
          location.reload();
        }
    });
}

  function extend_course(order_id){
      $.ajax({
          url:'<?php echo base_url('admin/student_management/extend_order')?>',
          type: "POST",  
          data: {'order_id':order_id},
          success:function (response) {
              console.log(response);
              $('#show_course_table').html(response);
              $('#extend_date_course').modal('show');
          },
          error:function (error) {
              alert(error);
          }
      }); 
  }


  function isValidURL(string) {
      var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
      return (res !== null)
  };

  function view_order(order_id){
    $.ajax({
      url:'<?php echo base_url('admin/student_management/view_orders')?>',
      type: "POST",  
      data: {'order_id':order_id},
        success:function (response) {
            $('#show_data_table').html(response);
            $('#show_student_order').modal('show');
        },
        error:function (error) {
            alert(error);
        }
    }); 
  }

  // function renewed_order(course_id,order_id){
  //   $('#extend_date').modal('show');
  // }

  load_table("all","","");
      
  function load_table(coupon_code,from_date,to_date){
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
                  url:"<?php echo base_url(); ?>admin/student_management/student_order_detail", 
                  type: "POST",
                  data:{'coupon_code':coupon_code,'from_date':from_date,'to_date':to_date},
                  error: function(response){
                      console.log(response);
                  }
              }
          });
      });
  }
</script>
   
