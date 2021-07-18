<?php 
class Student_model extends CI_Model{

	function otp_create($otp,$type){
		$data = array(
			'otp' => $otp,
			'is_expired' => 0,
			'type'=>$type
		);
		return $this->db->insert('otp_pass_reset',$data);
	}

	function otp_verification($otp,$type){
		$otp_check = $this->db->select('otp')
						->from('otp_pass_reset')
						->where($type)
						->order_by('otp_id','DESC')
						->limit(1)
						->get()->row_array();
		$where = array(
			$otp_check['otp'] => $otp);
		return $this->db->select('*')->from('otp_pass_reset')->where($where)->get()->row_array();
	}
	
	public function delete($where,$table)
	{
		 $this->db->where($where);
    	 return $this->db->delete($table);
	}
	public function get_min_prod_price($where_price,$table){
      $query = $this->db->query('SELECT * FROM '.$table.' WHERE course_id = '.$where_price["course_id"].' AND course_discount_price =   ( SELECT MIN(course_discount_price) FROM '.$table.' WHERE course_id = '.$where_price["course_id"].' AND course_type = '.$where_price["course_type"].' GROUP BY course_id) ');
      return $query->row_array();
    }
	public function get_data_by_multiple_id($where_in_array,$where,$coloumn_name,$table)
	{
		$this->db->select('*');
		$this->db->where_in($coloumn_name,$where_in_array);
		$this->db->where($where);
		return $this->db->from($table)->get()->result_array();

	}	
	public function get_starwise_count($where,$table)
	{
		$query_res=$this->db->query('SELECT count(rating_count) as star_count,rating_count as stars FROM '.$table.' WHERE  product_id='.$where["product_id"].' AND product_type='.$where["product_type"].'  GROUP BY `rating_count`');
		return $query_res->result_array();
	}
	public function get_all_data($modal_data,$join_data)
	{
		$this->db->select($modal_data['select_coloumns']);
		$this->db->where($modal_data['where_condition1']);
		if($modal_data['where_condition2']!= '' && $modal_data['where_condition2']!= null)
		{
			$this->db->where($modal_data['where_condition2']);
		}
		if($modal_data['where_condition3']!= '' && $modal_data['where_condition3']!= null)
		{
			$this->db->where($modal_data['where_condition3']);
		}
		if($modal_data['where_condition4']!= '' && $modal_data['where_condition4']!= null)
		{
			$this->db->where($modal_data['where_condition4']);
		}
		if($modal_data['where_condition5']!= '' && $modal_data['where_condition5']!= null)
		{
			$this->db->where($modal_data['where_condition5']);
		}
		if($join_data['join_table2']!= '' && $join_data['join_condition2']!= null)
		{
			$this->db->join($join_data['join_table2'],$join_data['join_condition2']);
		}
		if($join_data['join_table3']!= '' && $join_data['join_condition3']!= null)
		{
			$this->db->join($join_data['join_table3'],$join_data['join_condition3']);
		}
		if($join_data['join_table4']!= '' && $join_data['join_condition4']!= null)
		{
			$this->db->join($join_data['join_table4'],$join_data['join_condition4']);
		}
		return $this->db->from($modal_data['table'])
		->join($join_data['join_table'],$join_data['join_condition'])
		->get()->result_array();
	}
	function count_total_rows($coloumn_name,$where,$table)
	{
		$q=$this->db->select($coloumn_name)
	 			->where($where)
				->get($table);
				
	  	  $count=$q->result();
		  return count($count);
	}
	public function update_table_with_limit($where,$data,$limit,$table)
	{
		return  $this->db->where($where)->limit($limit)->update($table,$data);
	}
	public function fetch_course_availibity_view($where,$distinct,$table){
		return $this->db->select('atr1.value')
						->from('(SELECT DISTINCT('.$distinct.') FROM `course_price_master` where course_id = '.$where["course_id"].') as tbl')
						->join('attribute_value_master as atr1','atr1.value_id = tbl.'.$distinct.'')
						->get()->result_array();
	}

	public function distinct_type($distinct_value,$where,$table){
		return $this->db->select($distinct_value)
						->where($where)
						->get($table)->result_array();
	}
	
}
?>