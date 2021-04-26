<?php
    class QuesPosts extends CI_Model{

        public function getInfo($email){
            $query = $this->db->query("SELECT * from questions where student='$email' or teacher='$email' order by id desc");
            $info = array();
            if($query->num_rows()>0){
                foreach ($query->result() as $key => $value) {
                  $x = array(
                    "id" => $value->id,
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

        public function getPublicInfo($id){
            $query = $this->db->query("SELECT p.id,p.question,p.description FROM public_questions as p, users as u WHERE p.user=u.id and p.user=$id order by date_time desc");
            $info = array();
            if($query->num_rows()>0){
                foreach ($query->result() as $key => $value) {
                  $query1 = $this->db->query("SELECT COUNT(a.id) as ansCount from public_answers as a, public_questions as q where a.question_id=q.id and a.question_id = $value->id");
                  $x = array(
                    "id" => $value->id,
                    "question" => $value->question,
                    "description" => $value->description,
                    "ansCount"    => $query1->result()[0]->ansCount
                  );
                  array_push($info,$x);
                }
            }
            return $info;

        }


        public function getPublicQuestions($id){
            $query = $this->db->query("SELECT q.id, q.question, q.date_time, q.anonymity, u.name from public_questions q, users u where q.user = u.id and q.user != $id  order by q.date_time desc;");
            $info = array();
            if($query->num_rows()>0){
                foreach ($query->result() as $key => $value) {
                  $query1 = $this->db->query("SELECT COUNT(a.id) as ansCount from public_answers as a, public_questions as q where a.question_id=q.id and a.question_id = $value->id");
                  $x = array(
                    "id" => $value->id,
                    "question" => $value->question,
                    "date" => $value->date_time,
                    "asked_by" => ($value->anonymity == 1)?"Anonymous":$value->name,
                    "ansCount" => $query1->result()[0]->ansCount
                  );
                  array_push($info,$x);
                }
            }
            return $info;

        }


        public function getPublicQuestionWithID($id){
            $query = $this->db->query("SELECT u.name, u.id ,q.question, q.date_time, q.anonymity, q.description from users u, public_questions q where q.user = u.id and q.id = $id;");
            if($query->num_rows()>0){
                foreach ($query->result() as $key => $value) {
                  $query1 = $this->db->query("SELECT COUNT(a.id) as ansCount from public_answers as a, public_questions as q where a.question_id=q.id and a.question_id = $id");
                  $x = array(
                    "id" => $value->id,
                    "question" => $value->question,
                    "description" => $value->description,
                    "date" => $value->date_time,
                    "asked_by" => ($value->anonymity == 1)?"Anonymous":$value->name,
                    "ansCount" => $query1->result()[0]->ansCount
                  );
                  return $x;
                }
            }
        }

        public function getPublicAnswersWithID($id)
        {
          $query = $this->db->query("SELECT u.name, u.id as userid ,a.id, a.answer, a.date_time from public_answers a, users u, public_questions q where q.id = a.question_id and q.id=$id and a.user_id = u.id");
          $info = array();
          if($query->num_rows()>0){
              foreach ($query->result() as $key => $value) {
                $x = array(
                  "answer" => $value->answer,
                  "date" => $value->date_time,
                  "answered_by" => $value->name,
                  "answerId" => $value->id,
                  "userId" => $value->userid
                );
                array_push($info,$x);
              }
          }
          return $info;
        }

        public function insertAnswer($arr)
        {
          $this->db->insert("public_answers",$arr);
        }
        public function deleteAnswer($id)
        {
          $this->db->where('id', $id);
          $this->db->delete('public_answers');
        }
        public function deleteQuestion($id)
        {
          $this->db->where('id', $id);
          $this->db->delete('public_questions');
        }

    }
?>
