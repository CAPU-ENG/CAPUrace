<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/28/15
 * Time: 11:15
 */

class User extends CI_Controller {

    /*
     * The login page for users.
     */
    public function login() {

        $this->load->helper(array('form', 'url', 'html'));
        $this->load->model('user_model', 'user');
        $this->load->library('form_validation');
        $this->load->library('session');
        if ($this->form_validation->run('login') == false) {
            $this->load->view('login_form');
        } else {
            $login_info = $this->input->post();
            $user_info = $this->user->get_user_by_email($login_info['mail']);
            if ($login_info['password'] == $user_info['password']) {
                if ($user_info['confirmed']) {
                    $this->session->set_userdata('logged_in', true);
                    $this->session->set_userdata('school_id', $user_info['school_id']);
                    redirect(site_url('registration/index'));
                } else {
                    echo '用户尚未通过审核';
                    $this->load->view('login_form');
                }
            } else {
                echo '密码错误';
                $this->load->view('login_form');
            }
        }
    }

    public function signup() {
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
        $this->load->model('user_model', 'user');

        if ($this->form_validation->run('signup') == false) {
            $this->load->view('signup_form');
        } else {
            $this->load->view('signup_success');
            $data = $this->input->post();
            unset($data['passconf']);
            $this->user->sign_up($data);
        }
    }
}