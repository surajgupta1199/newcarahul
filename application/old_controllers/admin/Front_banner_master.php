<?php
class Front_banner_master extends CI_Controller{
	public $current_date='';
	 function __construct()
	 {
	 	
	 	parent::__construct();	
	 	if($this->session->userdata('employee_id') == null)
		{
			redirect(base_url('admin/userDashboard'));
			return ;
		}	
	 	$this->load->model('admin_model/product_model/combo_model','combo_model'); 	
		$this->current_date=date('Y-m-d H:i:s');
		$this->admin_id=$this->session->userdata('admin_id');
	 }

	 public function index()
	 {
	 	$result['banner_image'] = $this->basic_mol->get_all_data(array('status'=>0),'front_img_banner_master');
	 	$this->load->view('admin/header');
	 	$this->load->view('admin/product/front_banner_master',$result);
	 	$this->load->view('admin/footer');
	 }

	public function add_banner_img(){
		if(!empty($_FILES['front_banner']['name'])){
			$filesCount = count($_FILES['front_banner']['name']);

			$last_id = $this->combo_model->get_last_data('front_img_banner_master','image_id','image_id','DESC');
			if(empty($last_id)){
				$last_id['image_id'] = 0;
			}

			for($i = 0; $i < $filesCount; $i++){
				$_FILES['file']['name']     = $_FILES['front_banner']['name'][$i];
				$_FILES['file']['type']     = $_FILES['front_banner']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['front_banner']['tmp_name'][$i];
				$_FILES['file']['error']     = $_FILES['front_banner']['error'][$i];
				$_FILES['file']['size']     = $_FILES['front_banner']['size'][$i];

				
				$config['upload_path'] = 'images/front_banner_image';
				

				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['file_name'] = ($last_id['image_id']+1+$i).'_banner_image.jpg';
				$config['overwrite'] = TRUE;

				// Load and initialize upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				// Upload file to server
				if($this->upload->do_upload('file')){
					// Uploaded file data
					$fileData = $this->upload->data();
					$result = $this->basic_mol->insert(array('image_name'=>$fileData['file_name']),'front_img_banner_master');
					if($i == ($filesCount-1)){
						$output['type']= "success";
						$output['message']= 'successfully uploaded banner image';
					}
				}else{
					$error = array('error' => $this->upload->display_errors());
					$output['type']= "error";
					$output['message']= $error;
				}
			}
		}
		echo json_encode($output);
	}

	public function delete_banner_image(){
		$where = $this->input->post();
		$delete = $this->basic_mol->update_table($where,array('status'=>1),'front_img_banner_master');
		unlink('images/front_banner_image/'.$where['image_id'].'_banner_image.jpg');
		echo $delete;
	}
}
?>
