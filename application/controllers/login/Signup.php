<?php
    class Signup extends CI_Controller{
        
        public function index()
        {            
            $this->load->view('login/signup');
        }

        public function form_val()
        {
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules("first_name", "First Name", "required");
            $this->form_validation->set_rules("last_name", "Last Name", "required");
            $this->form_validation->set_rules("email_id", "E-Mail", "required|is_unique[login.email_id]");
            $this->form_validation->set_rules("phone_no", "Phone Number", "required|is_unique[login.phone_no]");
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_message('is_unique', 'The %s is already taken');
            $this->form_validation->set_message('matches', 'The Password Does Not Match');
            if($this->form_validation->run())
            {
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email_id = $this->input->post('email_id');
                $phone_no = $this->input->post('phone_no');
                $password1 = $this->input->post('password');
                $this->load->library('encryption');
                $this->encryption->initialize(
                    array(
                        'cipher' => 'aes-256',
                        'mode' => 'ctr',
                    )
                );
                $password =  $this->encryption->encrypt($password1);
                
                $curl = curl_init();
                $data = array('first_name' => $first_name,'last_name' => $last_name,'email_id' => $email_id,'phone_no' => $phone_no,'password' => $password);
                $postData = "";
                foreach( $data as $key => $val ) {
                    $postData .=$key."=".$val."&";
                }
                $postData = rtrim($postData, "&");

                curl_setopt_array($curl, array(
                  CURLOPT_URL => base_url()."api/signup/signup",
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
                    "Cookie: ci_session=t2rniginpt5po3mj7hu19q5srhaleotl"
                  ),
                ));
                

            $response = curl_exec($curl);

            curl_close($curl);
            $response=json_decode($response,true);
            //print_r($response);
         //   $this->load->library('session');
//            $session_data = array(
//                "id" => $response['id'],
//            );
//            $this->session->set_userdata($session_data);
            redirect(base_url());
            //echo $response;
            }
            else
            {
                $this->index();
            }

            }
    }
?>