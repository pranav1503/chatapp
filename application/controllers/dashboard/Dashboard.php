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

      // echo $this->input->post("student");
    }
  }

 ?>
