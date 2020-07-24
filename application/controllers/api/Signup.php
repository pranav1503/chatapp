<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require  APPPATH . 'libraries\REST_Controller.php';
// echo APPPATH . 'libraries\REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Signup extends REST_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->model('signups');
    }


    public function signup_post()
    {
        //$user = $this->input->post('id');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email_id = $this->input->post('email_id');
        $password = $this->input->post('password');
        $phone_no = $this->input->post('phone_no');
        //$abc = "hello";
        if($this->signups->check($email_id,$phone_no)){
            $this->response([
            'message' => 'Exsists.',
        ],REST_Controller::HTTP_OK);    
        }
        else{
            $this->signups->signup_details($first_name,$last_name,$email_id,$password,$phone_no);   
            $this->response([
                'first_name' => $first_name, 
                'last_name' => $last_name, 
                'email_id' => $email_id, 
                'phone_no' => $phone_no,
               'message' => 'Added Successfully.',
            ],REST_Controller::HTTP_OK);     
    
        }
    }
}

?>