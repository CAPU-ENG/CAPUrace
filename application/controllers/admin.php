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
            $this->output->set_output('{"stat": "shiBaiLe", "msg": "daKaiFangShiBuDui"}');
            return;
        }
        if ($this->session->userdata('yiDengLu') == true) {
            $this->output->set_output('{"stat": "chengGongLe"}');
            return;
        }
        $kouLing = $this->input->post('kouLing');
        if ($kouLing != '19951025') {
            $this->output->set_status_header('403');
            $this->output->set_output('{"stat": "shiBaiLe", "msg": "kouLingBuDui"}');
            return;
        }
        $this->session->set_userdata('yiDengLu', true);
        $this->output->set_output('{"stat": "chengGongLe"}');
    }

    private function dengLuMeiYou() {
        return $this->session->userdata('yiDengLu') == true;
    }

    public function suoYouShuJu() {
        if ($this->input->server('REQUEST_METHOD') != 'GET') {
            $this->output->set_status_header('405');
            $this->output->set_output('{"stat": "shiBaiLe", "msg": "daKaiFangShiBuDui"}');
            return;
        }
        if (!$this->dengLuMeiYou()) {
            $this->output->set_status_header('403');
            $this->output->set_output('{"stat": "shiBaiLe", "shiBaiYuanYin": "meiDengLu"}');
            return;
        }
        $shuZu = array();
        $jieGuo = $this->user->all();
        foreach ($jieGuo as $hang) {
            $shuZu[] = sprintf('{"id":%d, "xueXiao":"%s", "lingDui":"%s", "dianHua":"%s", "huiMing":"%s", "youXiang":"%s", "diZhi":"%s", "youBian":"%s", "queRen":%d, "jiaoQian":%d}', $hang['id'], $hang['school'], $hang['leader'], $hang['tel'], $hang['association_name'], $hang['mail'], $hang['address'], $hang['zipcode'], $hang['confirmed'], $hang['paid']);
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output('{"stat": "chengGongLe", "shuJü": [' . join(",\n", $shuZu) . ']}');
    }

    public function setXxxed() {
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            $this->output->set_status_header('405');
            $this->output->set_output('{"stat": "shiBaiLe", "msg": "daKaiFangShiBuDui"}');
            return;
        }
        if (!$this->dengLuMeiYou()) {
            show_error('{"stat": "shiBaiLe", "shiBaiYuanYin": "meiDengLu"}', 403);
            return;
        }
        $id = $this->input->post('id');
        $what = $this->input->post('what');
        if ($what != 'confirmed' and $what != 'paid') {
            $this->output->set_status_header('404');
            $this->output->set_output('{"stat": "shiBaiLe", "msg": "buNengSetZheGe"}');
            return;
        }
        $str = 'set_' . $what;
        $this->user->$str($id);
        $this->output->set_output('{"stat": "chengGongLe"}');
    }
}
