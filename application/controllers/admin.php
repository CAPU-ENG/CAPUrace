<?php

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user');
        $this->load->model('people_model', 'people');
        $this->load->model('team_model', 'team');
    }

    public function index() {
        $this->load->view('guanLiYuanJieMian');
    }

    public function dengLu() {
        $this->output->set_content_type('application/json');
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            $this->output->set_status_header('405');
            $this->output->set_output('{"状态": "失败了", "消息": "打开方式不对"}');
            return;
        }
        if ($this->session->userdata('已登陆') == true) {
            $this->output->set_output('{"状态": "成功了"}');
            return;
        }
        $kouLing = $this->input->post('kouLing');
        if ($kouLing != '19951025') {
            $this->output->set_status_header('403');
            $this->output->set_output('{"状态": "失败了", "消息": "口令不对"}');
            return;
        }
        $this->session->set_userdata('已登陆', true);
        $this->output->set_output('{"状态": "成功了"}');
    }

    private function dengLuMeiYou() {
        return $this->session->userdata('已登陆') == true;
    }

    public function suoYouShuJu() {
        if ($this->input->server('REQUEST_METHOD') != 'GET') {
            $this->output->set_status_header('405');
            $this->output->set_output('{"状态": "失败了", "消息": "打开方式不对"}');
            return;
        }
        if (!$this->dengLuMeiYou()) {
            $this->output->set_status_header('403');
            $this->output->set_output('{"状态": "失败了", "消息": "没登陆"}');
            return;
        }
        $shuZu = array();
        $jieGuo = $this->user->all();
        foreach ($jieGuo as $hang) {
            $shuZu[] = sprintf('{"id":%d, "学校":"%s", "领队":"%s", "电话":"%s", "会名":"%s", "邮箱":"%s", "地址":"%s", "邮编":"%s", "激活":%d, "审核":%d, "确认":%d, "交钱":%d}', $hang['id'], $hang['school'], $hang['leader'], $hang['tel'], $hang['association_name'], $hang['mail'], $hang['address'], $hang['zipcode'], $hang['activated'], $hang['confirmed'], $hang['editable'], $hang['paid']);
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output('{"状态": "成功了", "数据": [' . join(",\n", $shuZu) . ']}');
    }

    public function setXxxed() {
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            $this->output->set_status_header('405');
            $this->output->set_output('{"状态": "失败了", "消息": "打开方式不对"}');
            return;
        }
        if (!$this->dengLuMeiYou()) {
            $this->output->set_status_header('403');
            $this->output->set_output('{"状态": "失败了", "消息": "没登陆"}');
            return;
        }
        $id = $this->input->post('id');
        $what = $this->input->post('what');
        if ($what != 'confirmed' and $what != 'paid') {
            $this->output->set_status_header('404');
            $this->output->set_output('{"状态": "失败了", "消息": "不能设置这个"}');
            return;
        }
        $str = 'set_' . $what;
        $this->user->$str($id);
        $this->output->set_output('{"状态": "成功了"}');
    }

    public function shanChu() {
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            $this->output->set_status_header('405');
            $this->output->set_output('{"状态": "失败了", "消息": "打开方式不对"}');
            return;
        }
        if (!$this->dengLuMeiYou()) {
            $this->output->set_status_header('403');
            $this->output->set_output('{"状态": "失败了", "消息": "没登陆"}');
            return;
        }
        $id = $this->input->post('id');
        if ($this->user->delete($id)) {
            $this->output->set_output('{"状态": "成功了"}');
        }
        else {
            $this->output->set_status_header('500');
            $this->output->set_output('{"状态": "失败了", "消息": "不知道"}');
        }
    }
}
