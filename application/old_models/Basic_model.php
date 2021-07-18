<?php 
class Basic_model extends CI_Model{

	public function insert($data,$table)
	{
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function update_table($where,$data,$table)
	{
		return  $this->db->where($where)->update($table,$data);
	}

	public function exist_or_not($where,$table)
	{
		return $this->db->where($where)->get($table)->row();
	}

	public function get_all_data($where,$table)
	{
		if($where !=""){
			$this->db->where($where);
		}
		return $this->db->get($table)->result_array();
	}
	public function get_single_data($where,$table)
	{
		return $this->db->where($where)->get($table)->row_array();
	}
	public function delete($where,$table){
		return $this->db->where($where)->delete($table);
	}
	public function get_last_data($table,$data,$id,$order){
		return  $this->db->select($data)->from($table)->order_by($id,$order)->limit(1)->get()->row_array();
	}
	public function edit_exist_or_not($where,$where_in,$table){
		$this->db->where($where);
		if($where_in != ""){																//edit part data exist or not
			foreach($where_in as $key=>$value){
				$this->db->where(''.$key.' != '.$where_in[$key].'');
			}
		}
		return $this->db->get($table)->row();
	}
}
?>