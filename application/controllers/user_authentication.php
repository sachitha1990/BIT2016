<?php
/**
 * Created by PhpStorm.
 * User: Sachitha Perera
 * Date: 6/18/2016
 * Time: 2:13 PM
 */

/*
 *  load session and validation libraries
 */

session_start();

class User_Authentication extends CI_Controller{

    public function  __construct()
    {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');

        //Load form validation library
        $this->load->library('form_validation');

        //Load session library
        $this->load->library('session');

        //Load database
        $this->load->model('login_database');

        //Show login page
        public function index()
        {
            $this->load->view('login_form');
        }

        //Show registration page
        public function user_registration_show()
        {
            $this->load->view('registration_form');
        }

        //Validate and store registration data in database
        public function new_user_registration()
        {

            //Check validation for user input in SignUp form
            $this->form_validation->set_rules('username','Username','trim|required|xss_clean');
            $this->form_validation->set_rules('email_value','Email','trim|required|xss_clean');
            $this->form_validation->set_rules('password','Password','trim|required|xss_clean');
            if($this->form_validation->run()==FALSE){
                $this->load->view('registration_form');
            }else{
                $data = array(
                'user_name' => $this->input->post('username'),
                'user_email' => &this->input->post('email_value'),
                'user_password' => $this->input->post('password')
                );
            $result = $this->login_database->registration_insert($data);
            if ($result == TRUE ){
                $data['message_display'] = 'Registration Successfully !';
                $this->load->view('login_form',$data);
            }else{
                $data['message_display'] = 'Username already exist!';
                $this->load->view('registration_form', $data);
            }
            }
        }

        //Check for user login process
    }
}
