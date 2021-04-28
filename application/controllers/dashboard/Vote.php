<?php
  /**
   *
   */
  class Vote extends CI_Controller
  {
    function insertVote()
    {
      $this->load->model("VoteModel");
      $arr = array(
        "userId" => $this->input->post("userId"),
        "answerId" => $this->input->post("answerId"),
        "vote" => $this->input->post("vote")
      );
      $this->VoteModel->insertVote($arr);
      echo "success";
    }

    function deleteVote()
    {
      $this->load->model("VoteModel");
      $this->VoteModel->deleteVote($this->input->post("userId"),$this->input->post("answerId"));
      echo "success";
    }

    function diffVotes()
    {
      $answerId = $this->input->post("answerId");
      $this->load->model("VoteModel");
      echo $this->VoteModel->diffVotes($answerId);
    }

  }

 ?>
