<?php
class Combo_model extends CI_Model{
	public $column_order = array(null, 'combo_id','combo_title','combo_status'); //set column field database for datatable orderable
	public $column_search = array('combo_title'); //set column field database for datatable searchable 

	public function get_part_data($table,$where,$status){
       	return $this->db->select('com.*,sub_cat.value')
						->from('course_master as com')
						->JOIN('attribute_value_master as sub_cat','com.subject_category = sub_cat.value_id')
						->where($status)
						->where_in('com.main_category',explode(',',$where['main_cat']))
						->where_in('com.class',explode(',',$where['class']))
						->where_in('com.subject_category',explode(',',$where['sub_cat_id']))->get()->result_array();
	}

	public function get_last_data($table,$data,$id,$order){
		return  $this->db->select($data)->from($table)->order_by($id,$order)->limit(1)->get()->row_array();
	}

	public function _get_datatables_query()
	{
		$this->db->select('combo_id,combo_title,attribute_value_master.value as course_type,combo_status,course_type_id,date_format(combo_date_time, "%d %b %Y %r") as combo_date_time')
				 ->from('combo_master')
				 ->join('attribute_value_master','attribute_value_master.value_id = combo_master.course_type_id')
				 ->order_by('combo_status','desc');

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
			$order = array('cat_id' => 'asc');
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
		$this->db->from('combo_master');
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
	 	return $this->db->select('combo_master.*,attribute_value_master.value as course_type')
				 ->from('combo_master')
				 ->join('attribute_value_master','attribute_value_master.value_id = combo_master.course_type_id')
				 ->where($where)->get()->row_array();
	}

	public function get_attr_name($table,$where,$check_data,$implode){
		$main_cat = $implode !="" ? implode(',',$where):$where;
		return  $this->db->select('*')
					 	 ->from($table)
					 	 ->where_in($check_data,explode(',',$main_cat))
					 	 ->get()->result_array();
	}

	public function get_particular_courses_data($where,$table)
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

	public function get_particular_mode($where,$table){
		$distinct_course_mode = $this->db->select('distinct(course_view)')
										 ->where($where)->get($table)->result_array();
		return $distinct_course_mode;
	}
	
	public function fetch_combo_availibity_view($where,$distinct,$table){
		return $this->db->select('atr1.value')
						->from('(SELECT DISTINCT('.$distinct.') FROM `course_price_master` where course_id = '.$where["course_id"].') as tbl')
						->join('attribute_value_master as atr1','atr1.value_id = tbl.'.$distinct.'')
						->get()->result_array();
	}
}

?>