<?php
class Admin extends CI_Controller{
	function _constructor(){

	}

	function index(){
		$this->load->view('admin/header');
		$this->load->view('admin/index');
		$this->load->view('admin/footer');
	}

	/* Categories Section Start */
		function categories(){
			$this->load->view('admin/header');
			$this->load->view('admin/categories');
			$this->load->view('admin/footer');
		}

		function get_categories($id = ''){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function add_categories(){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function update_categories(){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function delete_categories($id){
			//Manage this with Ajax
			print_r($this->input->post());
		}
	/* Categories Section End */

	/* Course Section Start */
		function courses(){
			$this->load->view('admin/header');
			$this->load->view('admin/courses');
			$this->load->view('admin/footer');
		}

		function get_course($id = ''){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function add_course(){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function update_course(){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function delete_course($id){
			//Manage this with Ajax
			print_r($this->input->post());
		}
	/* Course Section End */

	/* CouponCode Section Start */
		function couponCode(){
			$this->load->view('admin/header');
			$this->load->view('admin/couponsCode');
			$this->load->view('admin/footer');
		}

		function get_couponCode($id = ''){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function add_couponCode(){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function update_couponCode(){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function delete_couponCode($id){
			//Manage this with Ajax
			print_r($this->input->post());
		}
	/* CouponCode Section End */

	/* Student Section Start */
		function student(){
			$this->load->view('admin/header');
			$this->load->view('admin/couponsCode');
			$this->load->view('admin/footer');
		}

		function get_student($id = ''){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		//Add SStudent Not Available

		function update_student(){
			//Manage this with Ajax
			print_r($this->input->post());
		}

		function delete_student($id){
			//Manage this with Ajax
			print_r($this->input->post());
		}
	/* Student Section End */

}