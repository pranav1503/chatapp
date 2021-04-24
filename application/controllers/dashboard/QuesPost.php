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
      $id = $user['id'];
      $this->load->model("QuesPosts");
      $var = $this->QuesPosts->getInfo($email);
      $var1 = $this->QuesPosts->getPublicInfo($id);
      $data["info"] = json_encode($var);
      $data["publicInfo"] = json_encode($var1);
      $this->load->view("dashboard/quesPost",$data);
    }
  }

 ?>
