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
<section class="small_pt combo">
	<div class="container">
        <div class="row">
            <div class="col-lg-3 mt-lg-0 mt-4 pt-3 pt-lg-0">
                <div class="sidebar">
                    <div class="widget widget_search">
                        <form class="search_form"> 
                            <input required="" class="form-control" placeholder="Search..." type="text">
                            <button type="submit" title="Subscribe" name="submit" value="Submit">
                                <span class="ti-search"></span>
                            </button>
                        </form>
                    </div>
                    <?php echo $this->load->view('home/categories_side',  '', true); ?>
                </div>
            </div>
            <div class="col-lg-9">
            <table>
                <tr>
                    
                </tr>
            </table>
                <div class="row">
                	<div class="col-lg-12 col-sm-12">
                    	<div class="content_box radius_all_10 box_shadow1 animation row" data-animation="fadeInUp" data-animation-delay="0.01s">
                        	<div class="content_img radius_ltrt_10 col-md-4 col-sm-12">
                            </div>
                            <div class="content_desc radius_ltrt_10 col-md-4 col-sm-12">
                            	<h4 class="content_title"> Course Title </h4>
                            </div>
                            <div class="content_footer col-md-4 col-sm-12 text-center">
                                <div class="teacher text-center">
                                    <lable>Fast Track</lable>
                                </div>
                                <div class="price text-center">
                                	<lable>Regular</lable>
                                </div>
                            </div>
                        </div>
                    </div>
                	<div class="col-lg-12 col-sm-12">
                    	<div class="content_box radius_all_10 box_shadow1 animation row" data-animation="fadeInUp" data-animation-delay="0.01s">
                        	<div class="content_img radius_ltrt_10 col-md-4 col-sm-12">
                            	<a href="<?php echo base_url(); ?>/home/course_detail"><img src="<?php echo base_url(); ?>assets/images/courses/course-1.png" alt="course_img1"/></a>
                            </div>
                            <div class="content_desc col-md-4 col-sm-12">
                            	<h4 class="content_title"><a href="<?php echo base_url(); ?>/home/course_detail"> COMBO (ACCOUNTS + FM ECO + ADV ACC) REGULAR (CA INTER)</a></h4>
                                <div class="courses_info">
                                	<div class="rating_stars">
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star-half"></i> 
                                    </div>
                                    <ul class="list_none content_meta">
                                        <li><a href="#" ><i class="ti-user"></i>31</a></li>
                                        <li><a href="#"><i class="ti-heart"></i>10</a></li>
                                        <li><a class="rating-modal" data-id="1" data-toggle="tooltip" data-placement="top" title="Add Review"><i class="ti-comment-alt"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content_footer col-md-4 col-sm-12 text-center">
                                <div class="teacher text-center">
                                    <input id="r1" type="radio" name="course1" value="1">
                                        <label for="r1">Rs. 14000</label>
                                </div>
                                <div class="price text-center">
                                    <input id="r2" type="radio" name="course1" value="2" checked>
                                        <label for="r2">Rs. 19600</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                	<div class="col-lg-12 col-sm-12">
                    	<div class="content_box radius_all_10 box_shadow1 animation row" data-animation="fadeInUp" data-animation-delay="0.01s">
                        	<div class="content_img radius_ltrt_10 col-md-4 col-sm-12">
                            	<a href="<?php echo base_url(); ?>/home/course_detail"><img src="<?php echo base_url(); ?>assets/images/courses/course-1.png" alt="course_img1"/></a>
                            </div>
                            <div class="content_desc col-md-4 col-sm-12">
                            	<h4 class="content_title"><a href="<?php echo base_url(); ?>/home/course_detail"> COMBO (ACCOUNTS + FM ECO + ADV ACC) REGULAR (CA INTER)</a></h4>
                                <div class="courses_info">
                                	<div class="rating_stars">
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star-half"></i> 
                                    </div>
                                    <ul class="list_none content_meta">
                                        <li><a href="#" ><i class="ti-user"></i>31</a></li>
                                        <li><a href="#"><i class="ti-heart"></i>10</a></li>
                                        <li><a class="rating-modal" data-id="1" data-toggle="tooltip" data-placement="top" title="Add Review"><i class="ti-comment-alt"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content_footer col-md-4 col-sm-12 text-center">
                                <div class="teacher text-center">
                                    <input id="r1" type="radio" name="course2" value="1">
                                        <label for="r1">Rs. 14000</label>
                                </div>
                                <div class="price text-center">
                                	<input id="r2" type="radio" name="course2" value="2" checked>
                                        <label for="r2">Rs. 19600</label>
                                </div>
                            </div>
                        </div>
                    </div>
                	<div class="col-lg-12 col-sm-12">
                    	<div class="content_box radius_all_10 box_shadow1 animation row" data-animation="fadeInUp" data-animation-delay="0.01s">
                        	<div class="content_img radius_ltrt_10 col-md-4 col-sm-12">
                            	<a href="<?php echo base_url(); ?>/home/course_detail"><img src="<?php echo base_url(); ?>assets/images/courses/course-1.png" alt="course_img1"/></a>
                            </div>
                            <div class="content_desc col-md-4 col-sm-12">
                            	<h4 class="content_title"><a href="<?php echo base_url(); ?>/home/course_detail"> COMBO (ACCOUNTS + FM ECO + ADV ACC) REGULAR (CA INTER)</a></h4>
                                <div class="courses_info">
                                	<div class="rating_stars">
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star-half"></i> 
                                    </div>
                                    <ul class="list_none content_meta">
                                        <li><a href="#" ><i class="ti-user"></i>31</a></li>
                                        <li><a href="#"><i class="ti-heart"></i>10</a></li>
                                        <li><a class="rating-modal" data-id="1" data-toggle="tooltip" data-placement="top" title="Add Review"><i class="ti-comment-alt"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content_footer col-md-4 col-sm-12 text-center">
                                <div class="teacher text-center">
                                    <input type="radio" name ="course3" value="14000" data-type='fast'> <lable>Rs. 14000</lable>
                                </div>
                                <div class="price text-center">
                                	<input type="radio" name ="course3" value="19600" data-type='regular'> <lable>Rs. 19600</lable>
                                </div>
                            </div>
                        </div>
                    </div>
                	<div class="col-lg-12 col-sm-12">
                    	<div class="content_box radius_all_10 box_shadow1 animation row" data-animation="fadeInUp" data-animation-delay="0.01s">
                        	<div class="content_img radius_ltrt_10 col-md-4 col-sm-12">
                            	<a href="<?php echo base_url(); ?>/home/course_detail"><img src="<?php echo base_url(); ?>assets/images/courses/course-1.png" alt="course_img1"/></a>
                            </div>
                            <div class="content_desc col-md-4 col-sm-12">
                            	<h4 class="content_title"><a href="<?php echo base_url(); ?>/home/course_detail"> COMBO (ACCOUNTS + FM ECO + ADV ACC) REGULAR (CA INTER)</a></h4>
                                <div class="courses_info">
                                	<div class="rating_stars">
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star-half"></i> 
                                    </div>
                                    <ul class="list_none content_meta">
                                        <li><a href="#" ><i class="ti-user"></i>31</a></li>
                                        <li><a href="#"><i class="ti-heart"></i>10</a></li>
                                        <li><a class="rating-modal" data-id="1" data-toggle="tooltip" data-placement="top" title="Add Review"><i class="ti-comment-alt"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content_footer col-md-4 col-sm-12 text-center">
                                <div class="teacher text-center">
                                    <input type="radio" name ="course4" value="14000" data-type='fast'> <lable>Rs. 14000</lable>
                                </div>
                                <div class="price text-center">
                                	<input type="radio" name ="course4" value="19600" data-type='regular'> <lable>Rs. 19600</lable>
                                </div>
                            </div>
                        </div>
                    </div>
                	<div class="col-lg-12 col-sm-12">
                    	<div class="content_box radius_all_10 box_shadow1 animation row" data-animation="fadeInUp" data-animation-delay="0.01s">
                        	<div class="content_img radius_ltrt_10 col-md-4 col-sm-12">
                            	<a href="<?php echo base_url(); ?>/home/course_detail"><img src="<?php echo base_url(); ?>assets/images/courses/course-1.png" alt="course_img1"/></a>
                            </div>
                            <div class="content_desc col-md-4 col-sm-12">
                            	<h4 class="content_title"><a href="<?php echo base_url(); ?>/home/course_detail"> COMBO (ACCOUNTS + FM ECO + ADV ACC) REGULAR (CA INTER)</a></h4>
                                <div class="courses_info">
                                	<div class="rating_stars">
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star-half"></i> 
                                    </div>
                                    <ul class="list_none content_meta">
                                        <li><a href="#" ><i class="ti-user"></i>31</a></li>
                                        <li><a href="#"><i class="ti-heart"></i>10</a></li>
                                        <li><a class="rating-modal" data-id="1" data-toggle="tooltip" data-placement="top" title="Add Review"><i class="ti-comment-alt"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content_footer col-md-4 col-sm-12 text-center">
                                <div class="teacher text-center">
                                    <input type="radio" name ="course5" value="14000" data-type='fast'> <lable>Rs. 14000</lable>
                                </div>
                                <div class="price text-center">
                                	<input type="radio" name ="course5" value="19600" data-type='regular'> <lable>Rs. 19600</lable>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="medium_divider"></div>
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="ion-ios-arrow-thin-left"></i></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="ion-ios-arrow-thin-right"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
        	<div class="col-12 text-right mt-3">
                <a href="#" class="btn btn-default btn-sm">Add To Cart</a>
            </div>
        </div>
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
                                <span data-value="1"><i class="ion-android-star-outline"></i></span>
                                <span data-value="2"><i class="ion-android-star-outline"></i></span> 
                                <span data-value="3"><i class="ion-android-star-outline"></i></span>
                                <span data-value="4"><i class="ion-android-star-outline"></i></span>
                                <span data-value="5"><i class="ion-android-star-outline"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-default" name="submit" value="Submit">Submit Review</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- END SECTION COURSES -->
<script type="text/javascript">
    $(document).ready(function(){
        $(".rating-modal").on('click', function(){
            $("#rating-modal").show();
        });
        $(".close").on('click', function(){
            $("#rating-modal").hide();
        });
    });
</script>