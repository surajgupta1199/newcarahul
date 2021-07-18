<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_50" data-parallax-bg-image="<?php echo base_url(); ?>assets/images/about_bg.jpg">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-6">
            	<div class="page-title">
            		<h1>Transactions</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->

<!-- START SECTION COURSES -->
<section class="small_pt">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <a href="<?php echo base_url('student/profile/profile'); ?>" class="btn btn-primary sm mb-3">Go Back To Profile</a>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Sr. No</td>
                            <td>Transaction ID</td>
                            <td>Date</td>
                            <td>Transaction Details</td>
                            <td>Coupon Code</td>
                            <td>Discount</td>
                            <td>Discount Amount</td>
                            <td>Gross Amount</td>
                            <td>Paid Amount</td>
                            <td>Print</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sno=0; 
                            foreach ($transactions as $transaction_row) { 
                               $coupan_code=$transaction_row['coupon_code']== ''? 'Not Applied': $transaction_row['coupon_code'];
                                $sno++;
                              ?>
                                <tr>
                                    <td><?php echo $sno; ?></td>
                                    <td><?php echo $transaction_row['id'] ?></td>
                                    <td><?php echo $transaction_row['created'] ?></td>
                                    <td>
                                        <table class="table">
                                            <?php
                                                foreach ($transaction_row['transaction_items'] as $items) { ?>
                                                    <tr>
                                                        <td><?php echo $items['course_title'] ?></td>
                                                        <td><?php echo $items['sub_total'] ?></td>
                                                    </tr>
                                                  
                                            <?php    }
                                            ?>
                                            
                                        </table>
                                    </td>
                                    <td><?php echo $coupan_code ?></td>
                                    <td><?php echo $transaction_row['coupon_discount'] ?></td>
                                    <td><?php echo $transaction_row['grand_total']?></td>
                                    <td><?php echo ((int)$transaction_row['grand_total'] + (int)$transaction_row['coupon_discount'] ) ?></td>
                                    <td><?php echo $transaction_row['grand_total']?></td>
                                    <td><button type="button" class="btn btn-success"><i class="fa fa-print"></i></button></td>
                                </tr>
                               
                        <?php    }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Sr. No</td>
                            <td>Transaction ID</td>
                            <td>Date</td>
                            <td>Transaction Details</td>
                            <td>Coupon Code</td>
                            <td>Discount</td>
                            <td>Discount Amount</td>
                            <td>Gross Amount</td>
                            <td>Paid Amount</td>
                            <td>Print</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>