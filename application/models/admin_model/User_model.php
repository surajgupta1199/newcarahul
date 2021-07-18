<?php 
class User_model extends CI_Model{

 function get_user($user_name, $user_pass)
    {
  
       $query = $this->db->select('*')
                ->from('employee_master')
                 ->where(array("employee_email_id"=>$user_name, "employee_password"=>md5($user_pass),'employee_status'=>0))
                // ->where(array("username"=>$user_name, "password"=>($user_pass),"image_path"=>($image_path),'status'=>0))
               // ->where(array("username"=>$user_name, "password"=>($user_pass),'status'=>0))
                ->get();
        return  $query->row_array();
    }
  function checkmail($email)
    {     
      $query = $this->db->select('id,email')->from('employees_master')
                ->where("email",$email)->get();
         return $query->row_array();
    }

  function insert_in_reset($data)
  {
    return $this->db->insert('password_reset',$data);
  }

  function get_reset_data($id){
    return $this->db->select('user_id')->from('password_reset')->where(array('key_token'=>$id,'status'=>1))->get()->row_array();
  }

  function change_password($id,$pwd){

    return $this->db->where('id',$id)->update('employees_master',array('password'=>$pwd));
  }

  function change_status($id){
    return $this->db->where('user_id',$id)->update('password_reset',array('status'=>0));
  }

  public function get_all_data_search($where,$table,$table_colm,$search_title)
  {
      if($search_title !=""){
          $this->db->where("".$table_colm." LIKE '%".$search_title."%'");
      }
      return $this->db->where($where)->get($table)->result_array();
  }

  public function get_courses($limit, $start, $where,$table,$table_colm,$search_title) {

        if($search_title !=""){
            $this->db->where("".$table_colm." LIKE '%".$search_title."%'");
        }
         
        $this->db->limit($limit, $start);

        $query = $this->db->where($where)->get($table);

        return $query->result_array();
    }
    public function get_combos($limit, $start, $where) {
         
        $this->db->limit($limit, $start);

        $query = $this->db->where($where)->get('combo_master');

        return $query->result_array();
    }
}

?>