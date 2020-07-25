<?php
    class QuesPosts extends CI_Model{
        
        public function getInfo($email){
            $query = $this->db->query("SELECT * from questions where student='$email'");
            $info = array();
            if($query->num_rows()>0){
                foreach ($query->result() as $key => $value) {
                  $x = array(
                    "question" => $value->question,
                    "teacher" => $value->teacher,
                    "description" => $value->description,
                    "student" => $value->student,
                    "answered" => $value->answered,
                  );
                  array_push($info,$x);
                }
            }
            return $info;
            
        }
    }
?>