<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require  APPPATH . 'libraries\REST_Controller.php';

use Restserver\Libraries\REST_Controller;
class Label extends REST_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->model('todo_model');
    }

    public function label_get($user = 0)// signup_post
    {
        $labels = $this->todo_model->fetch_label($user);
        if(!empty($labels)){
            $this->response([
                "status" => true,
                "data" => $labels
            ],REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'No Labels Found'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }

    
}

?>