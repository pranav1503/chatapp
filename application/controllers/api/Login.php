<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require  APPPATH . 'libraries\REST_Controller.php';
// echo APPPATH . 'libraries\REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Login extends REST_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->model('signups');        
       // $this->load->library('session');
    }


    public function login_post()
    {
        $email_id = $this->input->post('email_id');
        $password = $this->input->post('password');
        $query = $this->signups->login_check($email_id); 
        if($query->num_rows()>0){
            foreach ($query->result() as $row)
                continue;
            $id = $row->id;
            $name = $row->first_name;
            $email_id = $row->email_id;
            $pass = $row->password;
            $phone_no = $row->phone_no;
            $this->load->library('encryption');
            $this->encryption->initialize(
                array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                )
            );
            $pass =  $this->encryption->decrypt($pass);
            if($password==$pass){
                $session_data = array(
                'id' => $id,
                'name' => $name,
                'email_id' => $email_id,
                'phone_no' => $phone_no,                
            );
            $this->session->set_userdata($session_data);
            $this->response([
                'status' => true,
                'id' => $id,
                'name' => $name,
                'password' =>$pass,
           'message' => 'Logged In Successfully.',
            ],REST_Controller::HTTP_OK);
            
            }
            else{
                $this->response([
                'status' => false,
                'password' =>$pass,
           'message' => 'Failed.',
        ],REST_Controller::HTTP_OK); 
                
            }
            
            
                
        }   
        else{
//            $this->session->set_flashdata('error','Invalid USer Name and Password');
            $this->response([
                'status' => false,
           'message' => 'Failed.',
        ],REST_Controller::HTTP_OK); 
        }
             
    }

   
    
}

?>