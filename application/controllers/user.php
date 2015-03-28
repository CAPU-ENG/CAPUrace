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
                $data = array(
                    'code' => $err_code,
                    'msg' => $GLOBALS['ERR_MSG'][$err_code]
                );
                echo json_encode($data);
                exit;
            }

            $user_info = $this->user->get_user_by_email($login_info['mail']);
            $err_code = '200';

            if (!$user_info['confirmed']) {
                $err_code = '202';
            }
            if ($login_info['password'] != $user_info['password']) {
                $err_code = '401';
            }
            if ($user_info == NULL) {
                $err_code = '204';
            }

            $data = array(
                'code' => $err_code,
                'msg' => $GLOBALS['ERR_MSG'][$err_code]
            );
            echo json_encode($data);
        }
    }

    public function signup() {
        date_default_timezone_set('PRC');
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('user_model', 'user');

        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $this->load->view('header');
            $this->load->view('signup_form');
            $this->load->view('footer');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
            header('Content-Type: application/json');
            $err_code = '200';


            if ($this->form_validation->run('signup') == false) {
                $err_code = '400';
                $response = array(
                    'code' => $err_code,
                    'msg' => $GLOBALS['ERR_MSG'][$err_code]
                );
                echo json_encode($response);
                exit;
            }
            $response = array(
                'code' => $err_code,
                'msg' => $GLOBALS['ERR_MSG'][$err_code]
            );
            echo json_encode($response);

            unset($data['passconf']);
            $this->user->sign_up($data);
/*            $token = $this->user->set_token($data['mail']);
            $link = site_url('user/activate') . '/' . $token;
            $this->email->from('beidachexie@126.com', '北京大学自行车协会');
            $this->email->to($data['mail']);
            $this->email->subject('第十三届全国高校山地车交流赛帐户确认');
            $this->email->message('请点击以下链接激活帐户' . $link);
            $this->email->send();*/
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