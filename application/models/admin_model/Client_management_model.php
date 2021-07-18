<?php
class Client_management_model extends CI_Model{ 
	public function _get_datatables_query($data)
	{
		if($data == 'student_detail'){
				$this->db->select('student_master.*,student_billing_address.*')
						->where('user_role',2)
						 ->from('student_master')
						 ->join('student_billing_address','student_billing_address.stu_id = student_master.student_id','left');
			 	$column_order = array(null, 'student_id','student_first_name','student_status'); //set column field database for datatable orderable
			 	$column_search = array('student_first_name'); //set column field database for datatable searchable 
		}else{
			$this->db->select('student_master.* , orders.*')
					->where('user_role',2)
					 ->from('orders')
					 ->join('student_master','orders.student_id = student_master.student_id');
		 	$column_order = array(null,'student_first_name','coupon_code','student_last_name','student_phone','student_email');
		 	$column_search = array('student_first_name','coupon_code','student_last_name','student_phone','student_email');

		}
			$i = 0;	
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else
		{
			$order = array('student_id' => 'asc');
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}


		public function get_stud_datatables($data)
	{
		$this->_get_datatables_query($data);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	public function count_all()
	{
		$this->db->from('student_master');
		return $this->db->count_all_results();
	}

	public function count_filtered($data)
	{
		$this->_get_datatables_query($data);
		$query = $this->db->get();
		return $query->num_rows();
	}	
}


 ?>