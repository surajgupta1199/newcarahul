

        <!-- ============================================================== -->
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               
                                <h4 class="card-title m-b-0"> Key Generation Master</h4>
                              </div>
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-md-12"> 
                                   <p class="pull-left">
                                    <b>Instructions: </b> <br/>
                                    1. For <b>course-id</b> please refer courses under course management tab (hint: Enter Course ID).<br/>
                                    <!-- 2. For <b>Course View</b> please refer Attributes under course management tab (hint: Enter Attribute ID).<br/> -->
                                    2. For <b> Course Key </b> dont duplicate key.<br/>
                                     <a class="btn btn-primary" href="assets/Demo_Doc/key_generation.csv" download>Download Sample File </a>

                                  </p>                                
                                </div>
                              </div>

                              <div class="table-responsive">
                                    Example:
                                   <table class="color-bordered-table info-bordered-table table table">
                                     <thead>
                                        <tr>
                                           <th>course_id</th>  
                                           <th>course_duration</th>  
                                           <th>course_view</th>  
                                           <th>course_key</th>  
                                        </tr>
                                      </thead>
                                       <tbody>
                                         <tr>
                                          <td>1</td>
                                          <td>3,4,6,9</td>
                                          <td>1.8,2,3</td>
                                          <td>Couser key</td>
                                         </tr>
                                       </tbody>  
                                   </table>
                                </div>


                                <form enctype="multipart/form-data" id="upload_csv_form" role="form" >
                                  <div class="row">
                                    <div class="col-md-4">                                
                                     <input type="file" name="file" id="file" class="form-control" accept=".csv"  required>
                                </div>
                                <div class="col-md-4">   
                                  <button type="submit" id="btn_UploadCsv" class="btn btn-success" name="submit" value="submit">Upload</button>
                                </div>
                                   
                                  <div id=fp_response> </div> 
                                  </div>
                                </form> 


                                
                                <div class="table-responsive m-t-40" id="error_msg_table">
                                   
                                </div>
                            </div>
                        </div>
                       
                        
                    </div>
                </div>



<script type="text/javascript">

$(function () {
    $('input[type=file]').change(function () {
        var val = $(this).val().toLowerCase(),
            regex = new RegExp("(.*?)\.(csv|xls)$");

        if (!(regex.test(val))) {
            $(this).val('');
            swal('Info!','Please select correct file format','warning');
        }
    });
});

  $('#upload_csv_form').submit(function(){

          $.ajax({  
                   url:"<?php echo base_url(); ?>admin/Course_key/import_csv",   
                   type: "POST",  
                   data: new FormData(this), 
                   dataType: "json",
                   processData: false,
                   cache:false,
                   contentType: false,  
                     
                    success:function(result)  
                    {      
                      if(result.type=="success"){        
                      
                        swal("Info!",result.message,"success");
                        $('#error_msg_table').html('');
                            
                      }
                      else if(result.type=="upload_error")
                      {
                        swal("Info!",result.message,"danger");
                      }

                      else{
                          swal("Info!",result.message,"warning");
                          $('#error_msg_table').html(result.error_log_tbl);
                       
                      }
                     
                      
                    },
                    error:function(result){
                      alert(result);
                      
                    }

                });  
       
     return false;
    });

</script>
   
   
</body>

</html>