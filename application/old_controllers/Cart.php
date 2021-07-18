<?php
class Cart extends CI_Controller{
    
    public function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
        
       $this->load->model('Student_model','student_modl');
       $this->cart_tbl = "cart_master";
       $this->course = "course_master";
        if($this->session->userdata('student_id') != ''){
            $this->user_id =  $this->session->userdata('student_id');
        }
    }
    
    function index(){
        $data = array();
        if($this->session->userdata('student_id') != ''){
          $where2='ct.product_price_mode = cp.course_mode';
          $where3='ct.product_validity = cp.course_type_value_id';
          $where4='ct.product_views = cp.course_view';
          $where = array('student_id' => $this->user_id,);
          $fetch_data='cp.course_discount_price,ct.*,avm1.value as mode_val,avm2.value as views_val,ctvm.course_type_value_name as validity_val';
          $modal_data=array(
                            'select_coloumns' =>  $fetch_data,
                            'where_condition1' => $where,
                            'where_condition2' => $where2,
                            'where_condition3' => $where3,
                            'where_condition4' => $where4,
                            'table' => $this->cart_tbl .' as ct',
                            );
          $join_data=array(
                      'join_table'   => 'course_price_master as cp',
                      'join_condition' =>  'cp.course_id = ct.product_id ',
                      'join_table2'        => 'attribute_value_master as avm1',
                      'join_condition2'    => 'avm1.value_id = ct.product_price_mode',
                      'join_table3'        => 'attribute_value_master as avm2',
                      'join_condition3'    => 'avm2.value_id = ct.product_views',
                      'join_table4'        => 'course_type_value_master as ctvm',
                      'join_condition4'    => 'ctvm.course_type_value_id = ct.product_validity',
                      );
          $cart_res = $this->student_modl->get_all_data($modal_data,$join_data);
         
          $cart_data=array();
          $checkout_total=0;
            
          for($i=0;$i<count($cart_res);$i++){
            $product_type= $cart_res[$i]['product_type'] == 1 ? 'course' :'combo';
            $where = array($product_type.'_id' => $cart_res[$i]['product_id'] );
            $product_data = $this->basic_mol->get_all_data($where,$product_type.'_master');
            for($j=0;$j<count($product_data);$j++){
               $cart_data[] = array(
                    'rowid'    => $cart_res[$i]['product_id'],  
                    'qty'    => $cart_res[$i]['product_quantity'],
                    'price'    => $cart_res[$i]['course_discount_price'],
                    'name'    => $product_data[$j][$product_type.'_title'],
                    'product_type' => $cart_res[$i]['product_type'],
                    'product_validity'    => $cart_res[$i]['product_validity'],
                    'product_price_mode'    => $cart_res[$i]['product_price_mode'],
                    'product_views'    => $cart_res[$i]['product_views'],
                    'validity_val'    => $cart_res[$i]['validity_val'].' months',
                    'mode_val'    => $cart_res[$i]['mode_val'],
                    'views_val'    => $cart_res[$i]['views_val'],
                    'image' => base_url('images/'.$product_type.'_banner/'.$product_data[$j][$product_type.'_banner_img']),
                    'subtotal'=>$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price']
                );
              }
            $subtotal=$cart_res[$i]['product_quantity'] * $cart_res[$i]['course_discount_price'];
            $checkout_total += $subtotal;
          
          }
          $data['cartItems']=$cart_data;
          $data['checkout_subtotal']=$checkout_total;
        }
        else
        {
           // Retrieve cart data from the session
           $data['cartItems'] = $this->cart->contents();
           $data['checkout_subtotal']=$this->cart->total();

        }
      
        // Load the cart view
        $this->load->view('home/header');
        $this->load->view('student/cart',$data);
        $this->load->view('home/footer');
    }
    
    function updateItemQty(){
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->post('product_id');
        $row_prod_type = $this->input->post('product_type');
        $qty = $this->input->post('product_quantity');
         if($this->session->userdata('student_id') != ''){
             
             $data=$this->input->post();
             $where=array(
                        'product_id'         => $data['product_id'],
                        'product_type'       => $data['product_type'],
                        'product_price_mode' => $data['product_price_mode'],
                        'product_validity'   =>  $data['product_validity'],
                        'product_views'      =>  $data['product_views'],
                        'student_id'         => $this->user_id, );
             $duplicate_cart_item=(array)$this->basic_mol->exist_or_not($where,$this->cart_tbl);
            if(!empty($this->basic_mol->exist_or_not($where,$this->cart_tbl))){
                
                
                $update_data=array('product_quantity' => $data['product_quantity']);
                $update=$this->basic_mol->update_table($where,$update_data,$this->cart_tbl);

                
                $where = array(
                'student_id' => $this->user_id);
                $cart_items_res=$this->basic_mol->get_all_data($where,$this->cart_tbl);
                $quantity=0;
                for($i=0;$i<count($cart_items_res);$i++){
                    $quantity += $cart_items_res[$i]['product_quantity'];
                }
                $count_item=array('cart_item_count' =>  $quantity);
                $this->session->set_userdata($count_item);
        }
           
                
         }
         else{

             // Update item in the cart
                if(!empty($rowid) && !empty($qty)){
                    $data = array(
                        'rowid' => $rowid,
                        'qty'   => $qty
                    );
                    $update = $this->cart->update($data);
                }
        
         }

        
       
        // Return response
        echo $update?'ok':'err';
    }
    
    function removeItem($rowid,$row_prod_type,$row_prod_validity,$row_prod_mode,$row_prod_view){
        // Remove item from cart
        if($this->session->userdata('student_id') != ''){
                
                 $where=array(
                        'product_id'         => $rowid,
                        'product_type'       => $row_prod_type,
                        'product_price_mode' => $row_prod_mode,
                        'product_validity'   =>  $row_prod_validity,
                        'product_views'      =>  $row_prod_view,
                        'student_id'         => $this->user_id, );
                $remove = $this->student_modl->delete($where,$this->cart_tbl);
                
                $where = array(
                'student_id' => $this->user_id);
                $cart_items_res=$this->basic_mol->get_all_data($where,$this->cart_tbl);
                $quantity=0;
                for($i=0;$i<count($cart_items_res);$i++){
                    $quantity += $cart_items_res[$i]['product_quantity'];
                }
                $count_item=array('cart_item_count' =>  $quantity);
                $this->session->set_userdata($count_item);
        }
        else{

             $remove = $this->cart->remove($rowid);
        }
        
        // Redirect to the cart page
        redirect('cart/');
    }

    
    
}