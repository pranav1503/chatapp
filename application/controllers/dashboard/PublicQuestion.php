<?php
  /**
   *
   */
  class PublicQuestion extends CI_Controller
  {

    function index($id)
    {
      $this->load->library('session');
      $user = $this->session->all_userdata();
      if(empty($user['name'])){
        redirect(base_url());
      }
      $data["id"] = $id;
      $this->load->model("QuesPosts");
      $var = $this->QuesPosts->getPublicQuestionWithID($id);
      $var1 = $this->QuesPosts->getPublicAnswersWithID($id);
      $data["questionDetails"] = $var;
      $data["answers"] = $var1;
      // print_r($var1);
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

    function delete()
    {
      $this->load->model("QuesPosts");
      $id = $this->input->post("id");
      $this->QuesPosts->deleteAnswer($id);
      echo $id;
    }

    function deleteQuestion()
    {
      $this->load->model("QuesPosts");
      $id = $this->input->post("id");
      $this->QuesPosts->deleteQuestion($id);
      echo $id;
    }

  }

 ?>
