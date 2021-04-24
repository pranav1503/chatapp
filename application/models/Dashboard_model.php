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

  function askQuestion($arr)
  {
    $this->db->insert("questions",$arr);
    $query = $this->db->query("SELECT * from questions order by id desc limit 1");
    if($query->num_rows()>0){
        $id = -1;
        foreach ($query->result() as $key => $value) {
          $id = $value->id;
        }
        return $id;
    }
  }

  function askPublicQuestion($arr)
  {
    $this->db->insert("public_questions",$arr);
    $query = $this->db->query("SELECT * from public_questions order by id desc limit 1");
    if($query->num_rows()>0){
        $id = -1;
        foreach ($query->result() as $key => $value) {
          $id = $value->id;
        }
        return $id;
    }
  }

  function showQuestion($qid)
  {
    $query = $this->db->query("SELECT * from questions where id=$qid");
    if($query->num_rows()>0){
        $question;
        foreach ($query->result() as $key => $value) {
          $question = array(
            "question" => $value->question,
            "teacher" => $value->teacher,
            "description" => $value->description,
            "student" => $value->student,
            "answer" => $value->answer,
            "answered" => $value->answered,
          );
        }
        return $question;

    }
  }

  function answer($arr,$where)
  {
    $this->db->update("questions",$arr,array("id"=>$where));
    $query = $this->db->query("SELECT * from questions where id=$where");
    if($query->num_rows()>0){
        $question;
        foreach ($query->result() as $key => $value) {
          $question = array(
            "question" => $value->question,
            "teacher" => $value->teacher,
            "description" => $value->description,
            "student" => $value->student,
            "answer" => $value->answer,
            "answered" => $value->answered,
          );
        }
        return $question;

    }
  }

  function askQuestionNoti($arr)
  {
    $this->db->insert("notification",$arr);
  }

  function deleteNoti($qid,$user)
  {
    $this->db->delete("notification",array("qid"=>$qid,"user"=>$user));
  }
}

 ?>
