<?php
class Student_management_model extends CI_Model{ 

	

	
	public function _get_datatables_query($data,$check)
	{
		if($data == 'student_detail'){
		    if($check['where2'] != "" && $check['where2'] != null){
		        $this->db->where($check['where2']);
		    }
				$this->db->select('student_master.*,student_billing_address.*')
						 ->from('student_master')
						 ->where($check['where'])
						 ->join('student_billing_address','student_billing_address.stu_id = student_master.student_id','left');
			 	$column_order = array(null, 'student_id','student_first_name','student_status'); //set column field database for datatable orderable
			 	$column_search = array('student_first_name'); //set column field database for datatable searchable 
		}else if($data == 'student_transaction'){

				if($check['from_date'] != "" || $check['to_date'] != ""){
					$from_date = DateTime::createFromFormat('d/m/Y', $check['from_date']);
					$to_date = DateTime::createFromFormat('d/m/Y', $check['to_date']);
					$this->db->where('transaction_master.created_at >=', $from_date->format('Y-m-d'));
					$this->db->where('transaction_master.created_at <=', $to_date->format('Y-m-d'));
		 		}

				$this->db->select('student_master.*,transaction_master.*')
						 ->from('transaction_master')
						 ->join('student_master','student_master.student_id = transaction_master.student_id')
						 ->order_by('transaction_status','DESC');
			 	$column_order = array(null, 'order_id','student_first_name','transaction_number','student_status'); //set column field database for datatable orderable
			 	$column_search = array('student_first_name','transaction_number'); //set column field database for datatable searchable 

		}else{

				if($check['from_date'] != "" || $check['to_date'] != ""){

					$from_date = DateTime::createFromFormat('d/m/Y', $check['from_date']);
					$to_date = DateTime::createFromFormat('d/m/Y', $check['to_date']);
					$this->db->where('orders.created >=', $from_date->format('Y-m-d'));
					$this->db->where('orders.created <=', $to_date->format('Y-m-d'));
		 		}

				$this->db->select('student_master.* , orders.*')
						 ->from('orders')
						 ->where($check['where'])
						 ->join('student_master','orders.student_id = student_master.student_id')
						 ->order_by('created');

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


	public function get_stud_datatables($data,$check)
	{
		$this->_get_datatables_query($data,$check);
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

	public function count_filtered($data,$check)
	{
		$this->_get_datatables_query($data,$check);
		$query = $this->db->get();
		return $query->num_rows();
	}	
	
	
	public function student_detail($stu_id){
		return $this->db->select('student_master.* , student_billing_address.*')
						->where('student_master.student_id',$stu_id)
					 	->from('student_billing_address')
					 	->join('student_master','student_billing_address.stu_id = student_master.student_id')
					 	->get()->row_array();
	}
	
	public function order_detail($where){
		return $this->db->select('order_items.* , orders.*')
						->where($where)
					 	->from('order_items')
					 	->join('orders','orders.id = order_items.order_id')
					 	->get()->result_array();
	}

	public function get_all_ordered_key($where,$table){
		return $this->db->select(''.$table.'.*,atr1.value as mode,atr2.value as view,atr3.course_type_value_name as month')->from($table)
									 ->where($where)
									 ->join('attribute_value_master as atr1',''.$table.'.course_mode = atr1.value_id')
									 ->join('attribute_value_master as atr2',''.$table.'.course_view = atr2.value_id')
									 ->join('course_type_value_master as atr3',''.$table.'.course_duration = atr3.course_type_value_id')
									 ->get()->result_array();
	}
}


 ?>