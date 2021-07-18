<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_50" data-parallax-bg-image="<?php echo base_url(); ?>assets/images/about_bg.jpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h1>Our Courses</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Courses</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->

<!-- START SECTION COURSES -->
<section class="small_pt">
    <div class="course-container"> 
        <div class="row">
            <div class="col-md-3">
           </div>
                
            <div class="col-md-9">
                <ul class="list_none grid_filter">
                    <li><a href="#" class="select_type current" value="all" data-filter=".combo">All</a></li>
                    <?php foreach($course_type as $row){
                        echo '<li><a href="#" value="'.$row["value_id"].'" class="select_type" data-filter=".rg">'.$row["value"].'</a></li>';
                    }?>
                </ul>
                <input type="text" class="pull-right search_title" name="search_title" placeholder="Search..">
            </div>
        </div>
        <div class="row">
             <div class="col-md-3 swiper-container">
                <div class="filter-card">  
                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Type </h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                            <?php foreach ($main_category as $row) {?>
                            <label class="course-content">
                              <input class="form-check-input" type="radio" data_attr="type" name="type" value="<?php echo $row['value_id']; ?>">
                              <span class="form-check-label">
                               <?php echo $row['value']; ?>
                              </span>
                            </label>
                            <?php }?>
                            </div> <!-- card-body.// -->
                        </div>
                    </article> 
                </div>
                <div class="filter-card mt-3">  
                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Class </h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                            <?php foreach ($class as $row) {?>
                            <label class="course-content">
                              <input class="form-check-input" type="radio" data_attr="class" name="class" value="<?php echo $row['value_id']; ?>">
                              <span class="form-check-label">
                               <?php echo $row['value']; ?>
                              </span>
                            </label>
                            <?php }?>
                            </div> <!-- card-body.// -->
                        </div>
                    </article> 
                </div>
                <div class="filter-card mt-3">  
                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">CATEGORIES </h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                                <label class="course-content">
                                    <input class="form-check-input" type="radio" data_attr="sub_cat" name="sub_cat" checked value="all">
                                    <span class="form-check-label">
                                    All
                                    </span>
                                </label>
                                <?php foreach ($sub_category as $row) {?>
                                <label class="course-content">
                                  <input class="form-check-input" type="radio" data_attr="sub_cat" name="sub_cat" value="<?php echo $row['value_id']; ?>">
                                  <span class="form-check-label">
                                   <?php echo $row['value']; ?>
                                  </span>
                                </label>
                                <?php }?>
                            <label class="course-content">
                              <input class="form-check-input" type="radio" name="sub_cat" value="combo">
                              <span class="form-check-label">
                                COMBO
                              </span>
                            </label>
                            </div> <!-- card-body.// -->
                        </div>
                    </article> 
                </div>
             </div>
            <div class="col-md-9" id="all_cat_product"></div>
        </div>
        <div class="text-center" id="pagination_link"></div>
      
    </div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="rating-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Review And Rating</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="rating">
                                <span class="rating_count" onclick="my_id_value(1)" data-value="1"><i class="ion-android-star-outline"></i></span>
                                <span class="rating_count" onclick="my_id_value(2)"  data-value="2"><i class="ion-android-star-outline"></i></span> 
                                <span class="rating_count" onclick="my_id_value(3)" data-value="3"><i class="ion-android-star-outline"></i></span>
                                <span class="rating_count" onclick="my_id_value(4)" data-value="4"><i class="ion-android-star-outline"></i></span>
                                <span class="rating_count" onclick="my_id_value(5)" data-value="5"><i class="ion-android-star-outline"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <textarea required="required" id="review_desc" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                            <input type="hidden" id="product_details" product_id="" product_type="" readonly>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-default" id="btn_AddReview" name="submit" value="Submit">Submit Review</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- END SECTION COURSES -->
<script type="text/javascript">
    
    function writeReview(product_id,product_type)
    {
         <?php
          if($this->session->userdata('student_id') != '')
          {?>
              
            $('#product_details').attr('product_id',product_id);                                                              
            $('#product_details').attr('product_type',product_type);                                                              
                                                                
            $("#rating-modal").show();

      <?php }
          else
          {?>
              $('#Login').modal('show');

      <?php }?>
    }



    
    $(".close").on('click', function(){
            $("#rating-modal").hide();
        });
    $(document).ready(function(){

        load_course_data(0,"","","all","all","");
        var cat_id="all";
        var main_cat="";
        var course_class="";
        var course_type_filter="all";
        var search_title="";

        $('.search_title').keyup(function(e){
            e.preventDefault();
            search_title = $(this).val();
            load_course_data(0,main_cat,course_class,cat_id,course_type_filter,search_title);
        })

        $('.form-check-input').change(function(e){
            e.preventDefault();

            // cat_id = $(this).attr('data_attr').val();
            cat_id = $(':radio[class=form-check-input][name=sub_cat]:checked').val();
            course_class = $(':radio[class=form-check-input][name=class]:checked').val();
            main_cat = $(':radio[class=form-check-input][name=type]:checked').val();
            
            course_class = typeof course_class !== 'undefined'?course_class:"";
            main_cat = typeof main_cat !== 'undefined'?main_cat:"";
            cat_id = typeof cat_id !== 'undefined'?cat_id:"";

            load_course_data(0,main_cat,course_class,cat_id,course_type_filter,search_title);
        }); 

        $('.select_type').click(function(e){
            e.preventDefault();

            course_class = typeof course_class !== 'undefined'?course_class:"";
            main_cat = typeof main_cat !== 'undefined'?main_cat:"";
            cat_id = typeof cat_id !== 'undefined'?cat_id:"";
            course_type_filter = $(this).attr('value');
            load_course_data(0,main_cat,course_class,cat_id,course_type_filter,search_title);
        });

        function load_course_data(page,type,course_class,cat_id,filter,search_title){
                         
            $.ajax({
                url:"<?php echo base_url(); ?>home/fetch_course/"+page,
                method:"GET",
                data:{subject_category:cat_id,class:course_class,main_category:type,filter:filter,search_title:search_title},
                dataType:"json",
                success:function(data){
                    
                    if(data.all_cat_product==1){
                        $('#all_cat_product').html('<div class="text-center"><label >Sorry,Dont have product.</label></div>');
                        $('#pagination_link').html("");  
                    }
                    else{    
                        $('#all_cat_product').html(data.all_cat_product);
                        $('#pagination_link').html(data.pagination_link);
                    }
                },
                error:function(data){
                    console.log(data+"unsuccess");
                }
            });
        }
    });


</script>