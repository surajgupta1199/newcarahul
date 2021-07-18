

        <!-- ============================================================== -->
                        
                        <div class="card-body">
                             <button type="button" id="add_cat_btn" data-target=".bs-example-modal-lg" class="btn btn-primary pull-right">Add Banner Image</button>
                            <div class="table-responsive m-t-40">
                            </div>
                        </div>

                        <div class="container banner_img" id="banner_img">
                            <div class="row">
                                <?php foreach($banner_image as $row){?>
                                <div class="col-md-4 column">
                                    <img src="<?php echo base_url('images/front_banner_image/'.$row["image_name"].'') ?>" value="<?php echo $row['image_name'] ?>" alt="Los Angeles" width="350px" height="350px">
                                    <button onclick="myFunction(<?php echo $row['image_id']; ?>)" id="btn_delete" class="btn btn-danger btn-xs banner_image_size">Delete</button>
                                </div>
                                <?php }?>
                            </div>
                        </div>


  <div id="add_cat_master" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Add Banner Image</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form autocomplete="off" id="add_banner_img" method="POST">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="col-md-12">
                                  <input type="file" name="front_banner[]" multiple accept=" .jpg, .jpeg, .png, .gif">
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
      </div>
  </div>

<script type="text/javascript">

    $('#add_cat_btn').click(function(){
        $('#add_cat_master').modal('show')
    })


    $('#add_banner_img').submit(function(e){ 
        e.preventDefault();
        var formData=new FormData(this);
                $.ajax({  
                url:"<?php echo base_url(); ?>admin/front_banner_master/add_banner_img",  
                method:"POST",  
                data:formData,  
                contentType: false,  
                cache: false,  
                processData:false,  
                dataType:"JSON",
                success:function(result) 
                { 
                    if(result.type == "success"){
                        $('#add_banner_img').trigger('reset');
                        $('#add_cat_master').modal('hide');
                        swal('success',result.message,'success');
                        location.reload();
                    }else{
                        swal('error',result.message,'error');
                    }                     
                },
                error:function(result){
                    alert(result);
                }
            });  
         
     return false;
        
    });

    function myFunction(image_id){
        swal({
            title: "Are You Sure?",
            text: "You Want To Delete",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {          
                $.ajax({
                    url:'<?php echo base_url('admin/front_banner_master/delete_banner_image')?>',
                    type: "POST",  
                    data: {'image_id':image_id},
                    success:function (response) {
                        if(response==1)
                        {
                            swal("Image Has Been Deleted.", {
                                icon: "success",
                            });
                            location.reload();
                        }
                        else
                        {
                            swal("Unable To Delete Image");
                        }     
                    },
                    error:function (error) {
                    alert(response);
                    }
                }); 
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    }

    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
   
</body>

</html>
