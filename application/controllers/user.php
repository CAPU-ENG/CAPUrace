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
        date_default_timezone_set('PRC');
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('user_model', 'user');

        if ($this->form_validation->run('signup') == false) {
            $this->load->view('signup_form');
        } else {
            $this->load->view('signup_success');
            $data = $this->input->post();
            unset($data['passconf']);
            $this->user->sign_up($data);
            $token = $this->user->set_token($data['mail']);
            $link = site_url('user/activate') . '/' . $token;
            $this->email->from('beidachexie@126.com', '北京大学自行车协会');
            $this->email->to($data['mail']);
            $this->email->subject('第十三届全国高校山地车交流赛帐户确认');
            $this->email->message('请点击以下链接激活帐户' . $link);
            $this->email->send();
        }
    }

    /*
     * Activate the account.
     */
    public function activate() {
        $this->load->model('user_model', 'user');
        $token = $this->uri->segment(3);
        if (!$token) {
            echo '激活码不存在。';
        } else {
            echo $this->user->activate($token);
        }
    }
}