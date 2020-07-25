<?php
    class Signups extends CI_Model{
        
        public function check($email_id,$phone_no)
        {
            $query1 = $this->db->query("SELECT * from users WHERE email='{$email_id}' OR phone={$phone_no}");
            if($query1->num_rows()>0){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        
        public function signup_details($first_name,$email_id,$password,$phone_no,$dept,$type)
        {
            $this->db->insert('users',[
                'name' => $first_name,
                'email' => $email_id,
                'phone' => $phone_no,
                'password' => $password,
                'dept' => $dept,
                'type' => $type,
                'photo' => 'default.png',
            ]);
        }
        
        public function login_check($email_id)
        {
            $query1 = $this->db->query("SELECT * from users WHERE email='{$email_id}'");
            return $query1;
        }
    }
?>