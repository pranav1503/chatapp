<?php
  /**
   *
   */
  class QuesPost extends CI_Controller
  {

    function index()
    {
      $this->load->helper('url');
      $this->load->library('session');
      $user = $this->session->all_userdata();
      $email = $user['email_id'];
      $this->load->model("QuesPosts");
      $var = $this->QuesPosts->getInfo($email);
      $data["info"] = json_encode($var);
      $this->load->view("dashboard/quesPost",$data);
    }
  }

 ?>
