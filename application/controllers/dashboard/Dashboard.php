<?php
  /**
   *
   */
  class Dashboard extends CI_Controller
  {

    function index()
    {
      $this->load->model("Dashboard_model");
      $var = $this->Dashboard_model->getTeachers();
      $data["teachers"] = json_encode($var);
      $this->load->view("dashboard/dashboard",$data);
    }

    function ask()
    {
      $arr = array(
        "question" => $this->input->post("question"),
        "teacher" => $this->input->post("teacher"),
        "description" => $this->input->post("description"),
        "student" => $this->input->post("student")
      );
      $this->load->model("Dashboard_model");
      $id = $this->Dashboard_model->askQuestion($arr);
      echo $id;
    }

    function question($qid)
    {
      $this->load->model("Dashboard_model");
      $data["qid"] = $qid;
      $question = $this->Dashboard_model->showQuestion($qid);
      $data["question"] = ($question);
      $this->load->view("dashboard/question",$data);
    }

    function answer()
    {
      $id = $this->input->post("id");
      $arr = array(
        "answer" => $this->input->post("answer"),
        "answered" => 1
      );
      $this->load->model("Dashboard_model");
      $question = $this->Dashboard_model->answer($arr,$id);
      echo  $this->input->post("answer");
    }

  }

 ?>
