<?php
/**
 *
 */
class VoteModel extends CI_Model
{

  function insertVote($arr)
  {
    $this->db->insert("votes",$arr);
  }

  function deleteVote($userId,$answerId)
  {
    $this->db->query("DELETE from votes where userId=$userId and answerId=$answerId");
  }

  function diffVotes($answerId)
  {
    $query = $this->db->query("SELECT
	      (
        SELECT count(*) FROM `votes` v, public_answers a WHERE v.answerid = a.id and v.vote=1 and v.answerid = $answerId
        )
        -
        (
         SELECT count(*) FROM `votes` v, public_answers a WHERE v.answerid = a.id and v.vote=0 and v.answerid = $answerId
         )
         as diffVotes");
    return $query->result()[0]->diffVotes;
  }

}

?>
