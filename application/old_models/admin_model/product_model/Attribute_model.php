<?php
class Attribute_model extends CI_Model{
public $column_order = array(null, 'value_id','value','status'); //set column field database for datatable orderable
	public $column_search = array('value'); //set column field database for datatable searchable 

	

	
	public function _get_datatables_query($data_ajax)
	{
		$this->db->select('value,value_id,status,attr_type_id,date_format(created_at, "%d %b %Y %r") as created_at')
				->from('attribute_value_master')
				->where('attr_type_id',$data_ajax);
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


		public function get_cat_datatables($data_ajax)
	{
		$this->_get_datatables_query($data_ajax);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	public function count_all()
	{
		$this->db->from('categorise_master');
		return $this->db->count_all_results();
	}

	public function count_filtered($data_ajax)
	{
		$this->_get_datatables_query($data_ajax);
		$query = $this->db->get();
		return $query->num_rows();
	}
	

}


 ?>