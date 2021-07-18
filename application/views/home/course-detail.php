<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_50" data-parallax-bg-image="<?php echo base_url(); ?>assets/images/about_bg.jpg">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<div class="page-title">
					<h1>Course Detail</h1>
				</div>
			</div>
			<div class="col-sm-6">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb justify-content-sm-end">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php print_r($product_details['product_title']); ?></li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</section>
<!-- END SECTION BANNER -->

<!-- START SECTION COURSE DETAIL -->
<section>
	<div class="container">
			<div class="row p-3 border rounded shadow-sm mb-5">
				
					<div class="col-lg-6 " style="margin: auto;">
						<div class="single_course">
							<div class="course_img">
								<a href="#">
									<?php $imageURL = !empty($product_details["product_image"])? $product_details['product_image']:base_url('assets/images/courses/course-1.png'); ?>
									<img src="<?php echo $imageURL; ?>" alt="course_img_big">
								</a>
								
							</div>
							
							<?php 
									if(!empty($combo_course_list))
									{
							?>
									<div class="combo-list" style="padding-top: 57px;">
										<div class="container">
										<ul>
											<li style="list-style: none;"><h1 class="content_title">Courses Included : </h1></li>
								<?php 
										foreach ($combo_course_list as $combo_course_row) {
								?>
											<li>
												<div class="combo_course_box animation" data-animation="fadeInUp" data-animation-delay="0.01s">
					                                <!-- <div class="content_img radius_ltrt_10 col-md-2 col-sm-4 mb-3">
					                                    <a href="<?php echo base_url("/home/product_detail/course/" .$combo_course_row["course_id"]."") ?>"><img src="<?php echo base_url('assets/admin/assets/images/course_images/'.$combo_course_row['course_banner_img']); ?>" alt="course_img1"/></a>
					                                </div> -->
					                                <div class="col-md-8 col-sm-4">
														<h4 class="content_title"><a href="<?php echo base_url("/home/product_detail/course/" .$combo_course_row["course_id"]."") ?>"><?php print_r($combo_course_row['course_title']) ?></a></h4>
					                                </div>
					                                <!-- <div class="content_img radius_ltrt_10 col-md-2 col-sm-4 mb-3 mt-3">
					                                	<label for="price">
					                                	<?php
					                                		for($i=1;$i<=5;$i++)
												 			{
												 				if($combo_course_row['average_count']>=1)
												 				{ ?>
																	<i class="ion-android-star"></i>

												 				<?php 
												 				$combo_course_row['average_count']--;
												 				}
												 				else
												 				{ 
												 					if($combo_course_row['average_count'] >= 0.5)
												 					{
												 				?>
																	<i class="ion-android-star-half"></i> 		

												 			  <?php	
												 					$combo_course_row['average_count'] -= 0.5;	
												 					}
												 				else
												 				{ ?>
												 					<i class="icon ion-android-star-outline"></i>
												 					
												 				<?php }

												 				}
												 			}
												 		?>

					                                	</label>
					                                </div> -->
	                            				</div>		
	                            			</li>	
								<?php		}
								?>
										</ul>
				                            
				                            <!-- <div class="content_box radius_all_10 box_shadow1 animation row pt-3" data-animation="fadeInUp" data-animation-delay="0.01s">
				                                <div class="content_img radius_ltrt_10 col-md-2 col-sm-4 mb-3">
				                                    <a href="<?php echo base_url(); ?>student/product_details"><img src="<?php echo base_url(); ?>assets/images/courses/course-1.png" alt="course_img1"/></a>
				                                </div>
				                                <div class="content_desc col-md-8 col-sm-4 mb-3">
				                                    <h4 class="content_title"><a href="<?php echo base_url(); ?>student/product_details"> FM ECO REGULAR (CA INTER)</a></h4>
				                                </div>
				                                <div class="content_img radius_ltrt_10 col-md-2 col-sm-4 mb-3 mt-3">
				                                	<label for="price2">
				                                		<input type="checkbox" class="combo_price" id="price2" name="" value="8500" checked> ₹ 8,500/-
				                                	</label>
				                                </div>
				                            </div>
				                            <div class="content_box radius_all_10 box_shadow1 animation row pt-3" data-animation="fadeInUp" data-animation-delay="0.01s">
				                                <div class="content_img radius_ltrt_10 col-md-2 col-sm-4 mb-3">
				                                    <a href="<?php echo base_url(); ?>student/product_details"><img src="<?php echo base_url(); ?>assets/images/courses/course-1.png" alt="course_img1"/></a>
				                                </div>
				                                <div class="content_desc col-md-8 col-sm-4 mb-3">
				                                    <h4 class="content_title"><a href="<?php echo base_url(); ?>student/product_details"> Adv. ACCOUNTS REGULAR (CA INTER)</a></h4>
				                                </div>
				                                <div class="content_img radius_ltrt_10 col-md-2 col-sm-4 mb-3 mt-3">
				                                	<label for="price3">
				                                		<input type="checkbox" class="combo_price" id="price3" name="" value="8500" checked> ₹ 8,500/-
				                                	</label>
				                                </div>
				                            </div>
				                            <div class="content_box radius_all_10 box_shadow1 animation row pt-3" data-animation="fadeInUp" data-animation-delay="0.01s">
				                                <div class="content_img radius_ltrt_10 col-md-2 col-sm-4 mb-3"></div>
				                                <div class="content_desc col-md-6 col-sm-4 mb-3"></div>
				                                <div class="content_img radius_ltrt_10 col-md-4 col-sm-4 mb-3 mt-3 text-right">
				                                	<label for="final_price"> Total : ₹ <span id="final_price">25,000</span>.00/- </label>
				                                </div>
				                            </div> -->
				                        </div>
									</div>	
							<?php	}
							?>
							
							
							
						</div>
					</div>
					<div class="col-lg-6 mt-lg-0 mt-4 pt-3 pt-lg-0">
						<div class="sidebar">
							<div class="course_detail ">
								<div class="course_title bg-light pill py-4 px-3">
									<h2><?php print_r($product_details['product_title']); ?></h2>
								</div>
								<div class="countent_detail_meta">
									<ul>
										<!-- <li>
											<div class="instructor">	
												<img src="<?php echo base_url(); ?>assets/images/user1.jpg" alt="user1">
												<div class="instructor_info">
													<label>Teacher:</label>
													<a href="#">Alia Noor</a>
												</div>
											</div>
										</li> -->
										<li>
											<div class="course_cat">
												<label>Categories: </label>
												<a href="#"><?php echo $product_details['product_category']; ?></a>
											</div>
										</li>
										<!-- <li>
											<div class="course_student">
												<label>Students: </label>
												<span> 352</span>
											</div>
										</li> -->
										<li>
											<div class="course_categories">
												<label>Review: </label>
												<div class="rating_stars">
													<?php 
														$average_count_view=$average_count;
												 			for($i=1;$i<=5;$i++)
												 			{
												 				if($average_count_view>=1)
												 				{ ?>
																	<i class="ion-android-star"></i>

												 				<?php 
												 				$average_count_view--;
												 				}
												 				else
												 				{ 
												 					if($average_count_view >= 0.5)
												 					{
												 				?>
																	<i class="ion-android-star-half"></i> 		

												 			  <?php	
												 					$average_count_view -= 0.5;	
												 					}
												 				else
												 				{ ?>
												 					<i class="icon ion-android-star-outline"></i>
												 					
												 				<?php }

												 				}
												 			}
													?> 
												</div>
											</div>
										</li>
										<!-- <li>
											<div class="course_student">
												<label>Type: </label>
												<span><?php $type=$product_details['type'] == 1 ? 'Regular' : 'Fast Track'; echo $type; ?></span>
											</div>
										</li> -->
									</ul>
								</div>
								<div class="row mt-3">
									<div class="col-md-6 col-sm-12 mt-3">
										<label class="drp_lbl">Mode</label>
										<div class="custom_select">
											<select id="course_price_mode" class="form-control">
												
												<?php 
													foreach($mode_drp_data as $modes){
												?>
													<option <?php if($min_price_prod['course_mode'] == $modes['value_id']){echo 'selected';} ?> value="<?php echo $modes['value_id']; ?>"><?php echo $modes['value'] ?></option>

												<?php	
												 	}
												?>
												
											</select>
										</div>
									</div>
									<div class="col-md-6 col-sm-12 mt-3">
										<label class="drp_lbl">Validity</label>
										<div class="custom_select">
											<select id="course_plan_drp" name="course_type_value" class="form-control change_config" >
												
												<?php 
													foreach($plan_drp_data as $plans){
												?>
													<option value="<?php echo $plans['course_type_value_id']; ?>"><?php echo $plans['course_type_value_name'] ?> months</option>

												<?php	
													}
												?>
											</select>
										</div>
										<input type="hidden" id="course_id" course_id="<?php print_r($product_details['product_id']); ?>" course_type="<?php print_r($product_details['product_type']); ?>"> 
									</div>
						 		</div>
						 		<div class="row mt-3">
									<div class="col-md-6 col-sm-12 mt-3">
										<label class="drp_lbl">Views</label>
										<div class="custom_select">
											<select id="course_price_view" class="form-control change_config">
												
												<?php 
													foreach($views_drp_data as $views){
												?>
													<option value="<?php echo $views['course_view_value_id']; ?>"><?php echo $views['course_view_value_name'] ?></option>

												<?php	
												 	}
												?>
												
											</select>
										</div>
									</div>
									<div class="col-md-6 col-sm-12 mt-3">
										<label class="drp_lbl">Quantity</label>
										<div class="custom_select">
											<select id="course_qty" class="form-control change_config" name="course_qty">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row mt-2">
										<div class="col-md-4 col-sm-12 mt-3 text-center">
											<div class="alert-success py-2 px-2 rounded-pill">
												<span class="price-tag "><strong> ₹<span id="discounted_price">00</span>.00 /-</strong></span>
											</div>
										</div>
										<div class="col-md-4 col-sm-12 mt-3 text-center">
											<div class="alert-danger py-2 px-2 rounded-pill">
										  		<span class="price-tag "><s> ₹<span id="main_price">00</span>.00 /-</s></span>
											</div>
									  	</div>
									  	<div class="col-md-4 col-sm-12 mt-3 text-center">
									  		<div class="alert-warning py-2 px-2 rounded-pill">
												<span class="price-tag ">[<span id="save_price">00</span> % OFF]</span>
									  		</div>
										</div>
								</div>
								<div class="row mt-3 ">
									<div class="col-md-12 col-sm-12 mt-3">
										<a href="#" id="btn_addCart" class="btn btn-block btn-default btn-xl">Add To Cart</a>
									</div>
									<!-- <div class="col-md-6 col-sm-12 mt-3">
										<a href="#" id="btn_buyNow" class="btn btn-block btn-warning btn-xl">Buy Now</a>
									</div> -->
								</div>
								<div class="row mt-2" >
									<div class="col-md-12 col-sm-12">
										<label class="hide" id="error_note"><small>Note: Change Mode, Validity and Quantity to check availability</small></label>
									</div>	
								</div>
							</div>
							<!-- <div class="widget widget_search">
								<form class="search_form"> 
									<input required="" class="form-control" placeholder="Search..." type="text">
									<button type="submit" title="Subscribe" name="submit" value="Submit">
										<span class="ti-search"></span>
									</button>
								</form>
							</div> -->
							<!-- <div class="widget widget_recent_course">
								<h5 class="widget_title">Latest Course</h5>
								<ul class="recent_post border_bottom_dash list_none">
									<li>
										<div class="post_footer">
											<div class="post_img">
												<a href="#"><img src="<?php echo base_url(); ?>assets/images/courses/course-2.png" alt="letest_course1"></a>
											</div>
											<div class="post_content">
												<h6><a href="#">COMBO (COST + FM ECO + ADV ACC) REGULAR (CA INTER)</a></h6>
												<span class="text-success small">₹25,790.00</span>
											</div>
										</div>
									</li>
									<li>
										<div class="post_footer">
											<div class="post_img">
												<a href="#"><img src="<?php echo base_url(); ?>assets/images/courses/course-3.png" alt="letest_course2"></a>
											</div>
											<div class="post_content">
												<h6><a href="#">COMBO (COST + ACCOUNTS + ADV ACCOUNTS) REGULAR (CA INTER)</a></h6>
												<span class="text-success small">₹33,690.00</span>
											</div>
										</div>
									</li>
									<li>
										<div class="post_footer">
											<div class="post_img">
												<a href="#"><img src="<?php echo base_url(); ?>assets/images/courses/course-4.png" alt="letest_course3"></a>
											</div>
											<div class="post_content">
												<h6><a href="#">COMBO (COST + ACCOUNTS + FM ECO) REGULAR (CA INTER)</a></h6>
												<span class="text-success small">₹17,090.00</span>
											</div>
										</div>
									</li>
								</ul>
							</div> -->
							<!-- <div class="widget widget_categories">
								<h5 class="widget_title">Course Categories</h5>
								<ul>
									<?php foreach ($category_course_count as $row) {?>
									<li><a href="#"><span class="categories_name"><?php echo $row['cat_name']; ?></span><span class="categories_num">(<?php echo $row['course_count']; ?>)</span></a></li>
									<?php }?>
									
								</ul>
							</div> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="course_tabs">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="overview-tab1" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="overview-tab1" data-toggle="tab" href="#description" role="tab" aria-controls="overview" aria-selected="true">Additional Description</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="detail-policy-tab1" data-toggle="tab" href="#detail-policy" role="tab" aria-controls="detail-policy" aria-selected="false">Detail Policy</a>
								</li>
								<!-- <li class="nav-item">
									<a class="nav-link" id="instructor-tab1" data-toggle="tab" href="#instructor" role="tab" aria-controls="instructor" aria-selected="false">instructor</a>
								</li> -->
								<li class="nav-item">
									<a class="nav-link" id="reviews-tab1" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">reviews</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab1">
									<div class="border radius_all_5 tab_box">
										<p><?php print_r($product_details['product_description']); ?></p>
										
									</div>
								</div>
								<div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab1">
									<div class="border radius_all_5 tab_box">
										<p>
											<table class="table">
												<tr>
													<td>Duration: </td><td><?php echo $product_details['product_duration'].' hours(approx)'; ?></td>
												</tr>
												<tr>
													<td>No. of Questions: </td><td><?php echo $product_details['number_of_questions'].' Questions'; ?></td>
												</tr>
												<tr>
													<td>Question Coverage: </td>
													<td>
													  <p>
														<?php echo $product_details['question_coverage']; ?>
													  </p>
													</td>
												</tr>
												<tr>
													<td>Theory Coverage: </td>
													<td>
														<p>
														<?php print_r($product_details['theory_coverage']); ?>
													    </p>
													</td>
												</tr>
												<tr>
													<td>Suitable for: </td>
													<td>
														<p>
														<?php print_r($product_details['suitable_for']); ?>
														
													    </p>
													</td>
												</tr>
												<tr>
													<td>Availability: </td>
													<td>
														<ul>
															<?php
																	foreach ($availability as $item) {
															?>
																	<li><?php echo $item['value']; ?></li>
																		
															<?php	}
															?>
															
														</ul>
													</td>
												</tr>
												<!-- <tr>
													<td>Validity: </td><td><?php print_r($product_details['course_type_value_name']); ?></td>
												</tr> -->
												<tr>
													<td>Views: </td>
													<td>
														<ul>
															<?php
																	foreach ($view as $item) {
															?>
																	<li><?php echo $item['value']; ?></li>
																		
															<?php	}
															?>
														</ul>
													</td>
												</tr>
												
												<tr>
													<td>Demo Lecture Link: </td><td><a href="<?php print_r($product_details['demo_lecture_link']); ?>">Click Here</a></td>
												</tr>
												
											</table>
										</p>
									</div>
								</div>
								<div class="tab-pane fade" id="detail-policy" role="tabpanel" aria-labelledby="detail-policy-tab1">
									<div id="accordion" class="accordion">
										<div class="card">
											<div class="card-header" id="heading-1-One">
												<h6 class="mb-0"><a data-toggle="collapse" href="#collapse-1-One" aria-expanded="true" aria-controls="collapse-1-One">Difference between Pen Drive and Google Link</a></h6>
											</div>
											<div id="collapse-1-One" class="collapse show" aria-labelledby="heading-1-One" data-parent="#accordion">
												<div class="card-body">
													<p>
														On purchase of Lectures via Google Link, Internet Connection will be required to download each and every lecture. Once lecture is downloaded, it can be viewed multiple times (Maximum 2 Times in case of Regular Lectures and
														Maximum 1.7 Times in case of Fast Track Lectures) just like a normal video without downloading again.
													</p>
													<p>On purchase of Lectures via Pen Drive, there is no need of Internet Connection as the lectures are sent in Pen Drive by us. (It is to be noted that Internet connection will be required to activate the key only once).</p>
													<p>
														The quality and content of lectures in both the cases shall be absolutely same. Google link is cheaper as compared to pen drive as the cost of pen drive is not to be incurred. Also, once the lectures are complete, student
														can format the pen drive and use as a storage media.
													</p>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="heading-1-Two">
												<h6 class="mb-0"><a class="collapsed" data-toggle="collapse" href="#collapse-1-Two" aria-expanded="false" aria-controls="collapse-1-Two">Terms & Conditions</a></h6>
											</div>
											<div id="collapse-1-Two" class="collapse" aria-labelledby="heading-1-Two" data-parent="#accordion">
												<div class="card-body">
													<h6>Important Points</h6>
													<ul class="check">
														<li>Lectures can be played in LAPTOP ONLY and not in Desktop or Mobile.</li>
														<li>Content of RSA is COPYRIGHTED.</li>
														<li>Video Class is for Single User and Single Laptop only.</li>
														<li>Any kind of Projection, Multiple Screening, Unauthorized Recording or Broadcasting of video class is strictly prohibited and is a PUNISHABLE OFFENCE. Hacking or Reverse Engineering of RSA Software is a big OFFENCE.</li>
														<li>If any of above is found, we will COMPLETELY BLOCK the video classes and person doing unauthorized act (as mentioned above) shall be levied a penalty upto Rs. 50,00,000.</li>
														<li>
															In case of system update/ crash/ format / any other reason requiring reactivation of lectures, there shall be a charge of Rs. 500. Also, if a new Activation Key is to be generated. it shall be charged at its cost.
															However, it is to be noted that if the reason of system crash or format seems suspicious to RSA Management, it may decide not to reactivate the lectures, for which its decision shall be final and binding.
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="heading-1-Three">
												<h6 class="mb-0"><a class="collapsed" data-toggle="collapse" href="#collapse-1-Three" aria-expanded="false" aria-controls="collapse-1-Three">Counting of Views</a></h6>
											</div>
											<div id="collapse-1-Three" class="collapse" aria-labelledby="heading-1-Three" data-parent="#accordion">
												<div class="card-body">
													<p>
														REGULAR LECTURE : Student will get 2 views for each lecture. For Example, if a lecture is of 2 hrs (120 minutes), it can be viewed for 4 hrs (240 minutes). You may close the window in between the lecture, view shall not be
														counted.
													</p>
													<p>
														FAST TRACK LECTURE : Student will get 1.7 views for each lecture. For Example, if a lecture is of 2 hrs (120 minutes), it can be viewed for 3.40 hrs (204 minutes). You may close the window in between the lecture, view shall
														not be counted.
													</p>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="heading-1-Four">
												<h6 class="mb-0"><a class="collapsed" data-toggle="collapse" href="#collapse-1-Four" aria-expanded="false" aria-controls="collapse-1-Four">System Requirements</a></h6>
											</div>
											<div id="collapse-1-Four" class="collapse" aria-labelledby="heading-1-Four" data-parent="#accordion">
												<div class="card-body">
													<ul class="check">
														<li>OS Compatible with – Windows 7 Home Premium, Windows 7 Ultimate, Windows 8, 8.1, Windows 10.</li>
														<li>OS NOT Compatible with – Windows XP,Â Windows Vista, Windows 7 Starter, Windows 7 Basic, Windows 7 N Edition, Windows 7 KN Edition</li>
														<li>RAM 2 GB (Minimum)</li>
														<li>Processor – Core 2 Duo 1.5 GHz and above, Celeron Dual Core 1.5 GHZ and above, Intel Atom Quad Core 1.5 GHZ and above.</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="heading-1-Five">
												<h6 class="mb-0"><a class="collapsed" data-toggle="collapse" href="#collapse-1-Five" aria-expanded="false" aria-controls="collapse-1-Five">For Lectures Installation</a></h6>
											</div>
											<div id="collapse-1-Five" class="collapse" aria-labelledby="heading-1-Five" data-parent="#accordion">
												<div class="card-body">
													<ul class="check">
														<li>Watch the video HOW TO START VIDEO SOFTWARE given in the pen drive or Google Drive.</li>
														<li>You may be required to disable or uninstall the antivirus to play the lectures</li>
														<li>After activating the key, system cannot be changed due to any reason</li>
														<li>Lectures can’t be shifted to another laptop.</li>
														<li>Laptop should not be formatted after activation of key. If formatted, it will be the decision of RSA Management whether to renew the lectures or not.</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="heading-1-Six">
												<h6 class="mb-0"><a class="collapsed" data-toggle="collapse" href="#collapse-1-Six" aria-expanded="false" aria-controls="collapse-1-Six">Extension Policy</a></h6>
											</div>
											<div id="collapse-1-Six" class="collapse" aria-labelledby="heading-1-Six" data-parent="#accordion">
												<div class="card-body">
													<ul class="check">
														<li>
															<b>REGULAR Lectures –</b> If the validity of 6 months has expired but the student has not viewed the full lectures, the validity (not the views) can be extended by another 2 months on payment of Extension Charges of Rs.
															1900 (per subject). Please note that Extension Period of 2 months shall start from the date of Expiry of Lectures.
														</li>
														<li>
															<b>FAST TRACK Lectures –</b> If the validity of 3 months has expired but the student has not viewed the full lectures, the validity (not the views) can be extended by another 1 month on payment of Extension Charges of
															Rs. 1100 (per subject). Please note that Extension Period of 1 month shall start from the date of Expiry of Lectures.
														</li>
														<li>To avail extension, you need to send an email mentioning your URN No. with a request for Extension to the RSA Official email id (the same email id from which you received your activation key).</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="card pr-2 pl-2 pb-2 pt-2">
										<b><p>Delivery Time 7 – 8 Days (approximately as promised by courier facility). However, it may take longer in exceptional circumstances.</p>
										<p>If the area is remote, parcel will be sent by speed post.</p></b>
									</div>
								</div>
								<!-- <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab1">
									<div class="course_author">
										<div class="author_img">
											<img class="radius_all_5" src="<?php echo base_url(); ?>assets/images/client_img1.jpg" alt="client_img1"/>
										</div>
										<div class="author_meta">
											<div class="author_intro">
												<h6>Alia Noor</h6>
												<span class="text_default">Co-Founder</span>
											</div>
											<div class="author_desc">
												<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, quaeillo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
											</div>
										</div>
									</div>
								</div> -->
								<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab1">
									<div class="border radius_all_5 tab_box">
										<div class="course_rating">
											<div class="rating_review">
												<p><span class="review_number"><?php echo $average_count; ?></span><?php echo $total_user_review_count == 0 ? 'No One Reviewed Yet' : 'average based on ' .$total_user_review_count. ' ratings' ; ?> </p>
												<div class="rating_stars">
													<?php 

												 			for($i=1;$i<=5;$i++)
												 			{
												 				if($average_count>=1)
												 				{ ?>
																	<i class="ion-android-star"></i>

												 				<?php 
												 				$average_count--;
												 				}
												 				else
												 				{ 
												 					if($average_count >= 0.5)
												 					{
												 				?>
																	<i class="ion-android-star-half"></i> 		

												 			  <?php	
												 					$average_count -= 0.5;	
												 					}
												 				else
												 				{ ?>
												 					<i class="icon ion-android-star-outline"></i>
												 					
												 				<?php }

												 				}
												 			}
													?>
													
												</div>
											</div>
											<div class="rating_box">
												<?php
														if(!empty($final_stars_count))
														{
															for($i=5;$i>=1;$i--)
															{
													?>
																<div class="course_rate">
																	<span><?php echo $i.' Star'?></span>
																	<div class="review_bar">
																		<div class="rating" style="width:<?php echo $final_stars_count[$i]['in_percent']; ?>% ; background-color: #00C3CB"></div>
																	</div>
																	<span><?php echo $final_stars_count[$i]['total_rating']; ?></span>
																</div>
												<?php		}
														}
												?>
											</div>
										</div>
										<div class="heading_s1">
											<?php
													if(!empty($review_results))
													{
											?>
														<h5>Reviews</h5>
											<?php	}
											?>
										</div>
										<ul class="list_none comment_list">
											<?php

												foreach ($review_results as $review_row) { ?>
													<li class="comment_info">
														<div class="d-flex">
															<div class="user_img">
																<?php $imageURL = !empty($review_row["student_profile"])?base_url('./images/user_profile/'.$review_row['student_profile']):base_url('assets/images/client_img1.jpg'); ?>
																<img class="radius_all_5" src="<?php echo $imageURL; ?>" alt="client_img1">
															</div>
															<div class="comment_content">
																<div class="d-sm-flex align-items-center">
																	<div class="meta_data">
																		<h6><a href="#"><?php print_r($review_row['student_first_name']);echo ' '; print_r($review_row['student_last_name']); ?></a></h6>
																		<div class="comment-time"><?php $date=date_create($review_row['rated_on']); echo date_format($date,"M d , Y, g:i A"); ?></div>
																	</div>
																	<div class="ml-auto mb-2">
																		<div class="rating_stars">
																			<?php
																				for($i=1;$i<=$review_row['rating_count'];$i++)
																				{ ?>

																					<i class="ion-android-star"></i>

																			<?php }

																			 ?>
																			
																		</div>
																	</div>
																</div>
																<p><?php print_r($review_row['rating_review']); ?></p>
															</div>
														</div>
													</li>
													
											<?php	}

											 ?>
										</ul>
										<hr>
						              	<div class="review_form field_form">
											<h5>Add a review</h5>
											<form>
												<div class="row">
													<div class="form-group col-12">
														<div class="rating">
															<span class="rating_count" onclick="my_id_value(1)" data-value="1"><i class="ion-android-star-outline"></i></span>
							                                <span class="rating_count" onclick="my_id_value(2)"  data-value="2"><i class="ion-android-star-outline"></i></span> 
							                                <span class="rating_count" onclick="my_id_value(3)" data-value="3"><i class="ion-android-star-outline"></i></span>
							                                <span class="rating_count" onclick="my_id_value(4)" data-value="4.5"><i class="ion-android-star-outline"></i></span>
							                                <span class="rating_count" onclick="my_id_value(5)" data-value="5"><i class="ion-android-star-outline"></i></span>
														</div>
													</div>
													<div class="form-group col-12">
														<textarea required="required" id="review_desc" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
														<input type="hidden" id="product_details" product_id="<?php echo ($this->uri->segment(4)); ?>" product_type="<?php $type=$this->uri->segment(3) == 'course' ? 1 : 2; echo $type; ?>" readonly>
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
						</div>
				</div>
			</div>
	</div>
</section>
<!-- END SECTION COURSE DETAIL -->
<script type="text/javascript">
	$('.change_config').change(function(e)
	{
		var availability_status = fetch_prices();
		load_cart_btn(availability_status);
	});

	function load_cart_btn(availability_status){
		<?php
          if($this->session->userdata('student_id') != '')
          {?>
          		if(availability_status == "available"){
					set_cart_btn();
          		}
		<?php
			}
		?>
	}

	$('#course_price_mode').on('change',function(e){
		e.preventDefault();
		load_page_change_conf();
	})

	function load_page_change_conf(){
		var course_mode = $('#course_price_mode').val();
		var course_id=$('#course_id').attr('course_id');
		var course_type=$('#course_id').attr('course_type');
		var result_plan="";
		var result_view="";
		$.ajax({
		      url:"<?php echo base_url(); ?>Home/set_product_validity_with_mode", 
		      method:"POST",
		      data:{'course_id': course_id,'course_type':course_type,'course_mode':course_mode},     
		      dataType: 'json',     
		      success:function(result)
		      { 
		      	var plan_replace = $('#course_plan_drp');
		      	var view_replace = $('#course_price_view');
		      	plan_replace.empty();
		      	view_replace.empty();
		      	for(var j=0;j<result.plan_drp_data.length;j++){
		      		result_plan+= '<option value="'+result.plan_drp_data[j].course_type_value_id+'">'+result.plan_drp_data[j].course_type_value_name+'</option>';
		      	}
		      	for(var j=0;j<result.views_drp_data.length;j++){
		      		result_view+= '<option value="'+result.views_drp_data[j].course_view_value_id+'">'+result.views_drp_data[j].course_view_value_name+'</option>';
		      	}
		      	plan_replace.html(result_plan);
		      	view_replace.html(result_view);
		      	if(result.min_prod_price !=""){
		      		view_replace.val(result.min_prod_price.course_view);
		      		plan_replace.val(result.min_prod_price.course_type_value_id);
		      	}
		      },
		      error: function(response){
		        console.log(response);
		      }
   		 });
		 setTimeout(function(){ 
   		 	var availability_status = fetch_prices();
   		 	load_cart_btn(availability_status);
   		 },500);
	}

    function fetch_prices()
	{
		var availability_status = "";
		var course_type_value_id=$('#course_plan_drp').val();
		var course_mode=$('#course_price_mode').val();
		var course_view=$('#course_price_view').val();
		var course_id=$('#course_id').attr('course_id');
		var course_type=$('#course_id').attr('course_type');
		var product_quantity=$('#course_qty').val();
		$.ajax({
		      url:"<?php echo base_url(); ?>Home/set_prices", 
		      method:"POST",
		      data:{'course_id': course_id,'course_type':course_type,'course_type_value_id':course_type_value_id,'course_mode':course_mode,'course_view':course_view,'product_quantity':product_quantity},     
		      dataType: 'json', 
		      async:false,    
		      success:function(result)
		      { 
		      	$('#main_price').text(result.course_price);
		      	$('#discounted_price').text(result.course_dicounted_price);
		      	$('#save_price').text(result.course_save_price);
		      	if(result.msg == 'success')
		      	{ 
		      		availability_status = "available";
		      		$('#error_note').attr('class','hide');
			      	$('#btn_addCart').css("cursor","pointer");
		      		$('#btn_addCart').text("Add To Cart");
		      		$("#btn_addCart").removeClass('btn-danger');
    		      	$("#btn_addCart").addClass('btn-default');
		      	}
		      	else if(result.msg == "not available")
		      	{
		      		availability_status = "unavailable";
		      		$('#error_note').attr('class','alert-danger');
		      		$('#btn_addCart').css("cursor","not-allowed");
		      		$('#btn_addCart').text("Out Of Stock");
		      		$("#btn_addCart").removeClass('btn-default');
		      		$("#btn_addCart").addClass('btn-danger');
		      	}
		      	

		      },
		      error: function(response){
	      		availability_status = "error";
		        console.log(response);
		      }
   		 });
		return availability_status;
	}

    $('#btn_addCart').click(function(e)
    {
    		e.preventDefault();


    	 <?php
          if($this->session->userdata('student_id') != '')
          {?>
          		if($('#btn_addCart').text() ==  'Add To Cart')
          		{
          			add_to_cart();
          		}
          		else if($('#btn_addCart').text() ==  'Out Of Stock')
          		{
          			return false;
          		}
          		else{
          			window.location.replace("<?php echo base_url('/Cart'); ?>");
		      		// swal('Info!','Sorry!! Product Already Added to cart','warning').then((willDelete) => {
	         //          if (willDelete) {
	                  		
	    		   //     		window.location.replace("<?php echo base_url('/Cart'); ?>");
		        //         }
		        //       });
          		}
    			
    	 <?php }
    	 else
              {?>
                  $('#Login').modal('show');
    
          <?php }?>
    		
    });

	function add_to_cart()
	{
		var product_validity=$('#course_plan_drp').val();
		var product_price_mode=$('#course_price_mode').val();
		var course_view=$('#course_price_view').val();
		var product_id=$('#course_id').attr('course_id');
		var product_type=$('#course_id').attr('course_type');
		var product_quantity=$('#course_qty').val();
		$.ajax({
		      url:"<?php echo base_url(); ?>Home/addToCart", 
		      method:"POST",
		      data:{'product_id': product_id,'product_type':product_type,'product_validity':product_validity,'product_price_mode':product_price_mode,'product_views':course_view,'product_type':product_type,'product_quantity':product_quantity},     
		      dataType: 'json',     
		      success:function(result)
		      {  
		      	if(result.msg == 'success')
		      	{
		      		$('#btn_addCart').text("Go To Cart");
		      		$('#btn_addCart').css("cursor","pointer");
		      		$("#btn_addCart").removeClass('btn-danger');
		      		$("#btn_addCart").addClass('btn-primary');
    		       	swal(product_quantity+' Product is added to cart');
    		       	var update_cart_count=parseInt($('#cart_count').text()) + parseInt(product_quantity);
    		       	$('#cart_count').text(update_cart_count);
		      	}
		      	else 
		      	{
		      		$('#btn_addCart').css("cursor","not-allowed");
		      		$('#btn_addCart').text("Out Of Stock");
		      		$("#btn_addCart").removeClass('btn-default');
		      		$("#btn_addCart").addClass('btn-danger');
		      		
		      	}

		      },
		      error: function(response){
		        console.log(response);
		      }
   		 });
	}
	function set_cart_btn()
	{
		var product_id=$('#course_id').attr('course_id');
		var product_type=$('#course_id').attr('course_type');
		var product_validity=$('#course_plan_drp').val();
		var product_price_mode=$('#course_price_mode').val();
		var product_views=$('#course_price_view').val();
		
		$.ajax({
			url : "<?php echo base_url() ?>Home/get_cart_btn_status",
			method : 'POST',
			data : {'product_id':product_id,'product_type':product_type,'product_validity':product_validity,'product_price_mode':product_price_mode,'product_views':product_views},
			dataType : 'json',
			success:function(result){
				if(result.msg == 'success')
		      	{ 
		      		$('#btn_addCart').text("Add To Cart");
		      		
		      	}
		      	else
		      	{
		      		$('#btn_addCart').text("Go To Cart");
		      		
		      	}
			},
			error:function(result){

			}

		});
	}

	$(document).ready(function(){

		load_page_change_conf();

	});
</script>