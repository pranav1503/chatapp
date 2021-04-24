<?php
  /**
   *
   */
  class Dashboard extends CI_Controller
  {

    function index()
    {
      $this->load->helper('url');
      $this->load->library('session');
      $user = $this->session->all_userdata();
      $this->load->model("QuesPosts");
      $var = $this->QuesPosts->getPublicQuestions($user["id"]);
      $data["public_questions"] = json_encode($var);
      $this->load->view("dashboard/dashboard",$data);
    }

    function askQuestionView()
    {
      $this->load->model("Dashboard_model");
      $var = $this->Dashboard_model->getTeachers();
      $data["teachers"] = json_encode($var);
      $this->load->view("dashboard/askQuestion",$data);
    }

    function ask()
    {
      $isPrivate = $this->input->post("isPrivate");
      $isAnonymous = $this->input->post("isAnonymous");
      $this->load->model("Dashboard_model");
      date_default_timezone_set('Asia/Kolkata');
      if($isPrivate == 'true'){
        $arr = array(
          "question" => $this->input->post("question"),
          "teacher" => $this->input->post("teacher"),
          "description" => $this->input->post("description"),
          "student" => $this->input->post("student"),
        );
        $id = $this->Dashboard_model->askQuestion($arr);
        // Send notification to the teacher
        $arr1 = array(
          "message" => $this->input->post("question"),
          "user" => $this->input->post("teacher"),
          "qid" => $id,
          "time" => date("Y-m-d H:i:s"),
        );
        $this->Dashboard_model->askQuestionNoti($arr1);
        echo $id;
      }else{
        $arr = array(
          "question" => $this->input->post("question"),
          "description" => $this->input->post("description"),
          "user" => $this->input->post("studentID"),
          "anonymity" => ($isAnonymous == 'true')?true:false,
          "date_time" => date("Y-m-d H:i:s")
        );
        $idPublic = $this->Dashboard_model->askPublicQuestion($arr);
        echo $idPublic;
      }
    }

    function question($qid)
    {
      $this->load->model("Dashboard_model");
      $data["qid"] = $qid;
      $question = $this->Dashboard_model->showQuestion($qid);

      $data["question"] = ($question);
      $this->Dashboard_model->deleteNoti($qid,$this->session->userdata("email_id"));
      // echo $this->session->userdata("email_id");
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
      date_default_timezone_set('Asia/Kolkata');
      $arr1 = array(
        "message" => $question["question"],
        "user" => $question["student"],
        "qid" => $id,
        "time" => date("Y-m-d H:i:s"),
      );
      $this->Dashboard_model->askQuestionNoti($arr1);
      echo  $this->input->post("answer");
    }

  }

 ?>
