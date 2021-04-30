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
            $query = $this->db->query("SELECT q.id, q.question, q.date_time, q.anonymity, q.tag, u.name from public_questions q, users u where q.user = u.id and q.user != $id  order by q.date_time desc;");
            $info = array();
            if($query->num_rows()>0){
                foreach ($query->result() as $key => $value) {
                  $query1 = $this->db->query("SELECT COUNT(a.id) as ansCount from public_answers as a, public_questions as q where a.question_id=q.id and a.question_id = $value->id");
                  $x = array(
                    "id" => $value->id,
                    "question" => $value->question,
                    "date" => $value->date_time,
                    "tag" => $value->tag,
                    "asked_by" => ($value->anonymity == 1)?"Anonymous":$value->name,
                    "ansCount" => $query1->result()[0]->ansCount
                  );
                  array_push($info,$x);
                }
            }
            return $info;

        }


        public function getPublicQuestionWithID($id){
            $query = $this->db->query("SELECT u.name, u.id ,q.question, q.date_time, q.anonymity, q.description, q.tag from users u, public_questions q where q.user = u.id and q.id = $id;");
            if($query->num_rows()>0){
                foreach ($query->result() as $key => $value) {
                  $query1 = $this->db->query("SELECT COUNT(a.id) as ansCount from public_answers as a, public_questions as q where a.question_id=q.id and a.question_id = $id");
                  $x = array(
                    "id" => $value->id,
                    "question" => $value->question,
                    "description" => $value->description,
                    "date" => $value->date_time,
                    "tag" => $value->tag,
                    "asked_by" => ($value->anonymity == 1)?"Anonymous":$value->name,
                    "ansCount" => $query1->result()[0]->ansCount
                  );
                  return $x;
                }
            }
        }

        public function getPublicAnswersWithID($id)
        {
          $this->load->library('session');
          $user = $this->session->all_userdata()['id'];
          $query = $this->db->query("(SELECT u.name, u.id as userId, a.id as answerId, a.answer, a.date_time,
              sum(case when v.vote=1 then 1 else 0 end) as upvote_count,
              sum(case when v.vote=0 then 1 else 0 end) as downvote_count,
              sum(case when v.vote=1 then 1 else 0 end) - sum(case when v.vote=0 then 1 else 0 end) as differenceVote
              from users u, public_answers a, public_questions q, votes v where u.id = a.user_id and q.id = a.question_id and q.id=$id and a.id = v.answerId
              group by u.name, u.id, a.id, a.answer, a.date_time
              UNION
              SELECT u.name, u.id as userid ,a.id, a.answer, a.date_time, 0, 0, 0 from public_answers a, users u, public_questions q where q.id = a.question_id and q.id=$id and a.user_id = u.id
              and NOT EXISTS(select answerId from votes where answerId=a.id)) order by differenceVote DESC;");
          $info = array();
          if($query->num_rows()>0){
              foreach ($query->result() as $key => $value) {
                $query1 = $this->db->query("SELECT vote from votes where userId=$user and answerId=$value->answerId");
                $x = array(
                  "answer" => $value->answer,
                  "date" => $value->date_time,
                  "answered_by" => $value->name,
                  "answerId" => $value->answerId,
                  "userId" => $value->userId,
                  "voteStatus" => ($query1->num_rows()>0)?$query1->result()[0]->vote:-1
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

        public function getPublicQuestionsSearch($pattern,$tagPattern,$id){
            $query = $this->db->query("SELECT q.id, q.question, q.date_time, q.anonymity, q.tag, u.name from public_questions q, users u where q.user = u.id and q.user != $id and q.question like '%$pattern%' and q.tag like '%$tagPattern%'  order by q.date_time desc;");
            $info = array();
            if($query->num_rows()>0){
                foreach ($query->result() as $key => $value) {
                  $query1 = $this->db->query("SELECT COUNT(a.id) as ansCount from public_answers as a, public_questions as q where a.question_id=q.id and a.question_id = $value->id");
                  $x = array(
                    "id" => $value->id,
                    "question" => $value->question,
                    "date" => $value->date_time,
                    "tag" => $value->tag,
                    "asked_by" => ($value->anonymity == 1)?"Anonymous":$value->name,
                    "ansCount" => $query1->result()[0]->ansCount
                  );
                  array_push($info,$x);
                }
            }
            return $info;

        }

    }
?>
