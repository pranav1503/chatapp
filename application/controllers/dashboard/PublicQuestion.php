<?php
  /**
   *
   */
  class PublicQuestion extends CI_Controller
  {

    function index($id)
    {
      $data["id"] = $id;
      $this->load->model("QuesPosts");
      $var = $this->QuesPosts->getPublicQuestionWithID($id);
      $var1 = $this->QuesPosts->getPublicAnswersWithID($id);
      $data["questionDetails"] = $var;
      $data["answers"] = $var1;
      $this->load->view("dashboard/publicAnswer",$data);
    }

    function answer()
    {
      date_default_timezone_set('Asia/Kolkata');
      $var = array(
        "question_id" => $this->input->post("question_id") ,
        "user_id" => $this->input->post("user_id"),
        "answer"  => $this->input->post("answer"),
        "date_time" => date("Y-m-d H:i:s"),
      );
      $this->load->model("QuesPosts");
      $this->QuesPosts->insertAnswer($var);
      echo "Your answer has been posted.";
    }


  }

 ?>
