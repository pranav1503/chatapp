<?php

class Noty extends CI_Model
{
  function getNoty($user)
  {
    $query = $this->db->query("SELECT * from notification where user='$user' order by id desc limit 3");
    $notification = array();
    if($query->num_rows()>0){
        foreach ($query->result() as $key => $value) {
          $x = array(
            "message" => $value->message,
            "qid" => $value->qid,
            "time" => $value->time,
          );
          array_push($notification,$x);
        }
    }
    return $notification;
  }

  function getNotyCount($user)
  {
    $query = $this->db->query("SELECT * from notification where user='$user'");
    return $query->num_rows();
  }
}


 ?>
