<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_50" data-parallax-bg-image="<?php echo base_url(); ?>assets/images/about_bg.jpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->

<!-- START SECTION FEATURE -->
<section class="bg_gray">
  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Quantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Subtotal</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Remove</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if(empty($cartItems))
                  {
                  ?>
                        <tr><td colspan="5"><label class="alert alert-danger">Your Cart is empty!!.....</label></td></tr>
                  <?php
                  }

                  foreach ($cartItems as $row) {?>
                  <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="<?php echo $row['image']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?php print_r($row['name']); ?></a></h5><span class="text-muted font-weight-normal font-italic d-block">Validity: <?php print_r($row['validity_val']) ?> , Mode: <?php print_r($row['mode_val']) ?> , Views: <?php print_r($row['views_val']) ?></span>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong><?php print_r($row['price']) ?></strong></td>
                  <td class="border-0 align-middle">
                    <select id="course_qty" class="alert alert-success sm product_qty" name="course_qty" onchange="updateCartItem(this, '<?php echo $row["rowid"]; ?>','<?php echo $row["product_type"]; ?>','<?php echo $row["product_validity"]; ?>','<?php echo $row["product_price_mode"]; ?>','<?php echo $row["product_views"]; ?>')">
                      <?php 
                      for($i=1;$i<=5;$i++)
                      {
                        if($i==$row['qty'])
                        echo "<option selected='".$i."' value='".$i."'>".$i."</option>";
                      else
                         echo "<option value='".$i."'>".$i."</option>";
                      }
                    ?>
                    </select>
                  <td class="border-0 align-middle" id="subtotal"><strong><?php print_r($row['subtotal']) ?></strong></td>
                  <td class="border-0 align-middle"><a  class="text-dark" onclick="return confirm('Are you sure to delete item?')?window.location.href='<?php echo base_url('cart/removeItem/'.$row["rowid"].'/' .$row["product_type"]). '/' .$row['product_validity']. '/' .$row['product_price_mode']. '/' .$row['product_views']; ?>':false;"><i class="fa fa-trash"></i></a></td>
                </tr>
                   
                 <?php }
                ?>
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>

      <div class="row py-5 p-4 bg-white rounded shadow-sm">
        <div class="col-lg-12">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
          <div class="p-4">
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong><?php echo '₹'.$checkout_subtotal; ?></strong></li>
              <!-- <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>500.00</strong></li> -->
              <!-- <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>18%</strong></li> -->
              <li class="hide" id="discount_li" ><strong class="text-muted">Discount</strong><strong>₹<span id="discount_amount">18%</span></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                <h5 class="font-weight-bold">₹<span id="grandtotal"><?php echo $checkout_subtotal; ?></span></h5>
              </li>
            </ul><a id="btnCheckout" class="btn btn-default rounded-pill py-2 btn-block">Procceed to checkout</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</section>
 
<script>

// Update item quantity
function updateCartItem(obj, rowid , row_prod_type , row_prod_validity , row_prod_mode , row_prod_views){
    $.post("<?php echo base_url('cart/updateItemQty/'); ?>", {product_id:rowid, product_type:row_prod_type,product_validity:row_prod_validity,product_price_mode:row_prod_mode,product_views:row_prod_views, product_quantity:obj.value}, function(resp){
        if(resp == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}

//Proceed to checkout

$('#btnCheckout').click(function(){
      <?php
          if($this->session->userdata('student_id') != '')
          {?>
            $.ajax({
          type: 'POST',
          url: '<?php echo base_url('checkout/checkAddress'); ?>',
          data: {},
          dataType: 'json',
          encode: true
          }).done(function(data) {
            if(data.msg == "Success") {
              
              window.location.replace("<?php echo base_url('/Checkout'); ?>");
            }
            
            else
            {
              swal('Info!',"Shipping Address Not Listed With Your Account","warning").then((willDelete) => {
                  if (willDelete) {
                  window.location.replace("<?php echo base_url('student/profile/address'); ?>");
                }
              });
              
            }
      });
   

      <?php }
          else
          {?>
              $('#Login').modal('show');

      <?php }?>
      event.preventDefault();
    })



</script>