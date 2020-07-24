<?php
    class Signups extends CI_Model{
        
        public function check($email_id,$phone_no)
        {
            $query1 = $this->db->query("SELECT * from login WHERE email_id='{$email_id}' OR phone_no={$phone_no}");
            if($query1->num_rows()>0){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        
        public function signup_details($first_name,$last_name,$email_id,$password,$phone_no)
        {
            $this->db->insert('login',[
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email_id' => $email_id,
                'password' => $password,
                'phone_no' => $phone_no,
            ]);
        }
        
        public function login_check($email_id)
        {
            $query1 = $this->db->query("SELECT * from login WHERE email_id='{$email_id}'");
            return $query1;
        }
    }
?>