<?php
    class Login extends CI_Controller{

        public function index()        
        {            
            $data["success"]='';
            $this->load->view('login/login',$data);
        }
        
        public function form_val()
        {
            
            $email_id = $this->input->post('email_id');
            $password = $this->input->post('password');
            
            $curl = curl_init();
            $data = array('email_id' => $email_id,'password' => $password);
            $postData = "";
            foreach( $data as $key => $val ) {
                $postData .=$key."=".$val."&";
            }
            $postData = rtrim($postData, "&");

            curl_setopt_array($curl, array(
              CURLOPT_URL => base_url()."api/login/login",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $postData,
              CURLOPT_HTTPHEADER => array(
                "x-api-key: webdeveloper1510",
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic cHJhbmF2OnByYW5hdjE1MDM=",
                "Cookie: ci_session=2gdcv78ap63bncmq2h2akghbe6694m63"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response=json_decode($response,true);
            //print_r($response);
            if($response['status']==1){
                $this->load->library('session');
                $session_data = array(
                    "id" => $response['id'],
                    "name" => $response['name'],
                );
                $this->session->set_userdata($session_data);
                redirect(base_url()."todo/home");    
            }
            else if($response['status']==0){
                $this->session->set_flashdata("login_msg","Please Enter Correct Email-id and Password.");
                redirect(base_url());
            }
            else{
                echo "hello";
            }
            
        }

    }
?>