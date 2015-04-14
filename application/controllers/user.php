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
        $this->load->helper(array('form', 'url', 'html', 'lib'));
        $this->load->library(array('email', 'form_validation', 'session'));
        $this->load->model('user_model', 'user');
        $this->load->model('people_model', 'people');
        $this->load->model('team_model', 'team');
    }

    /*
     * The login page for users.
     */
    public function login() {

        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            if ($this->session->userdata('logged_in')) {
                redirect(base_url(), 'refresh');
            }

            $this->load->view('header');
            $this->load->view('add_hilight_nav4');
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
                $this->session->set_userdata('id', $user_info['id']);
                $this->session->set_userdata('school', $user_info['school']);
            }

            exit(err_msg($err_code));
        }
    }

    /*
     * Account logout.
     */
    public function logout() {
        $this->load->helper(array('cookie'));
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('school');
        delete_cookie('individual');
        delete_cookie('team');
        redirect(base_url(), 'refresh');
    }

    public function signup() {

        date_default_timezone_set('PRC');

        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $this->load->view('header');
            $this->load->view('add_hilight_nav5'); 
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
                $token = $this->user->generate_token($data['mail']);
                $data = array_merge($data, array('token' => $token));
                $this->user->sign_up($data);
                $this->email->send_account_confirm_mail($data['mail']);
            }

            exit(err_msg($err_code));
        }
    }

    /*
     * Show registration result for the user.
     */
    public function result() {
        $school_id = $this->session->userdata('id');
        $data['individual'] = $this->people->get_people_from_school($school_id);
        $team = $this->team->get_team_from_school($school_id);
        foreach ($team as $key => $item) {
            $team[$key]['first'] = $this->people->get_name($item['first']);
            $team[$key]['second'] = $this->people->get_name($item['second']);
            $team[$key]['third'] = $this->people->get_name($item['third']);
            $team[$key]['fourth'] = $this->people->get_name($item['fourth']);
        }
        $data['team'] = $team;
        $this->load->view('header');
        $this->load->view('user_result', $data);
        $this->load->view('footer');
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
