<?php
/**
 *
 */
class Dashboard_model extends CI_Model
{
  function getTeachers()
  {
    $query = $this->db->query("SELECT * from users where type='teacher'");
    $teachers = array();
    if($query->num_rows()>0){
        foreach ($query->result() as $key => $value) {
          $x = array(
            "name" => $value->name,
            "email" => $value->email,
            "phone" => $value->phone,
            "dept" => $value->dept,
            "photo" => $value->photo,
          );
          array_push($teachers,$x);
        }
    }
    return $teachers;
  }
}

 ?>
