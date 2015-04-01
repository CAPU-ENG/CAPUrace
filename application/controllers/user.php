<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/28/15
 * Time: 11:15
 */

class User extends CI_Controller {

    /*
     * Contrunction for User Controller.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user');
        $this->load->helper(array('form', 'url', 'html', 'lib'));
        $this->load->library(array('form_validation'));
    }

    /*
     * The login page for users.
     */
    public function login() {

        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $this->load->view('header');
            $this->load->view('login_form');
            $this->load->view('footer');
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $login_info = $this->input->post();
            header('Content-Type: application/json');

            if ($this->form_validation->run('login') == false) {
                $err_code = '400';
                exit(err_msg($err_code));
            }

            $user_info = $this->user->get_user_by_email($login_info['mail']);

            if ($user_info == NULL) {
                $err_code = '204';
            } elseif ($login_info['password'] != $user_info['password']) {
                $err_code = '401';
            } elseif (!$user_info['confirmed']) {
                $err_code = '202';
            } else {
                $err_code = '200';
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata('school_id', $user_info['id']);
            }

            exit(err_msg($err_code));
        }
    }

    public function signup() {
        date_default_timezone_set('PRC');
        $this->load->library(array('email'));

        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $this->load->view('header');
            $this->load->view('signup_form');
            $this->load->view('footer');
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
            header('Content-Type: application/json');

            if ($this->form_validation->run('signup') == false) {
                $err_code = '400';
            } else {
                $err_code = '200';
                unset($data['passconf']);
                $this->user->sign_up($data);
                $this->email->send_account_confirm_mail($data['mail']);
            }

            exit(err_msg($err_code));
        }
    }

    /*
     * Activate the account.
     */
    public function activate() {
        $this->load->model('user_model', 'user');
        $token = $this->uri->segment(3);
        echo $this->user->activate($token);
    }
}
