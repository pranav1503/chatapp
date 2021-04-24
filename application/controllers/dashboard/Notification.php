<?php

/**
 *
 */
class Notification extends CI_Controller
{

  function getNoty()
  {
    $user = $this->input->post("user");
    $this->load->model("Noty");
    $noty = $this->Noty->getNoty($user);
    echo json_encode($noty);
  }

  function getNotyCount($value='')
  {
    $user = $this->input->post("user");
    $this->load->model("Noty");
    $noty = $this->Noty->getNotyCount($user);
    echo $noty;
  }
}


 ?>
