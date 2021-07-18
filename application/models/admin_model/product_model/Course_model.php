<?php
class Course_model extends CI_Model{
public $column_order = array(null, 'course_id','course_title','course_status'); //set column field database for datatable orderable
	public $column_search = array('course_title'); //set column field database for datatable searchable 

	

	
	public function _get_datatables_query()
	{
		$this->db->select('course_master.*,atr1.value as course_main_category,atr2.value as course_class,atr3.value as course_subject_category,atr4.value as course_type')
				->from('course_master')
				->join('attribute_value_master as atr1','course_master.main_category = atr1.value_id')
				->join('attribute_value_master as atr2','course_master.class = atr2.value_id')
				->join('attribute_value_master as atr3','course_master.subject_category = atr3.value_id')
				->join('attribute_value_master as atr4','course_master.course_type_id = atr4.value_id')
				->order_by('course_status','asc');
			$i = 0;	
		foreach ($this->column_search as $item) // loop column 
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

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else
		{
			$order = array('course_id' => 'asc');
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}


		public function get_cat_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	public function count_all()
	{
		$this->db->from('course_master');
		return $this->db->count_all_results();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_particular_data($where,$table)
	{
		$distinct_course_type = $this->db->select('distinct(course_type_value_id)')
										 ->where($where)->get($table)->result_array();

	 	$result = array();

	 	$course_type = $this->get_part_detail_course($where,$table);
	 	foreach($distinct_course_type as $key=>$value){
 			foreach($course_type as $row){
 				if($row['course_type_value_id'] == $value['course_type_value_id']){
					$result[$key][] = $row;
 				}
 			}
	 	}
	 	return $result;
	}

	public function get_full_part_course_data($where,$table){
		$course_type = $this->get_part_detail_course($where,$table);
		return $course_type;
	}

	public function get_part_detail_course($where,$table){
		$course_type =	$this->db->select('course_price_master.*,atr1.course_type_value_name as course_validity,atr2.value as mode,atr3.course_view_value_name as value')
						    	 ->where($where)
						    	 ->join('course_type_value_master as atr1', 'atr1.course_type_value_id = course_price_master.course_type_value_id')
						    	 ->join('attribute_value_master as atr2', 'atr2.value_id = course_price_master.course_mode')
						    	 ->join('course_view_value_master as atr3', 'atr3.course_view_value_id = course_price_master.course_view')
						    	 ->order_by('course_validity')
						    	 ->order_by('atr3.course_view_value_id')
						    	 ->order_by('mode')
						    	 ->get($table)->result_array();

	 	return $course_type;
	}

	public function particular_course_value($where){
		return $this->db->select('course_master.*,atr1.value as course_main_category,atr2.value as course_class,atr3.value as course_subject_category,atr4.value as course_type')
						->from('course_master')
						->join('attribute_value_master as atr1','course_master.main_category = atr1.value_id')
						->join('attribute_value_master as atr2','course_master.class = atr2.value_id')
						->join('attribute_value_master as atr3','course_master.subject_category = atr3.value_id')
						->join('attribute_value_master as atr4','course_master.course_type_id = atr4.value_id')
						->where($where)
						->order_by('course_id')->get()->row_array();
	}

	public function get_particular_mode($where,$table){
		$distinct_course_mode = $this->db->select('distinct(course_view)')
										 ->where($where)->get($table)->result_array();
		return $distinct_course_mode;
	}
	
	public function get_last_id()
	{
		$last_id = $this->db->select('course_id')
			->from('course_master')
			->order_by('course_id','DESC')
			->limit(1)
			->get()->row_array();
	   return $last_id;

	}

	public function fetch_course_availibity_view($where,$distinct,$table){
		return $this->db->select('atr1.value')
						->from('(SELECT DISTINCT('.$distinct.') FROM `course_price_master` where course_id = '.$where["course_id"].') as tbl')
						->join('attribute_value_master as atr1','atr1.value_id = tbl.'.$distinct.'')
						->get()->result_array();
	}

}


 ?>