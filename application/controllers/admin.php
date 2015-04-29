<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'lib'));
        $this->load->model('people_model', 'people');
        $this->load->model('team_model', 'team');
        $this->load->model('user_model', 'user');

        if (! $this->session->userdata('admin_in')) {
            redirect(site_url('user/admin'));
        }
    }

    public function index() {
        $this->load->view('header_admin');
        $this->load->view('footer_admin');
    }

    public function pay() {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $data['payment'] = $this->user->get_verified();
            $this->load->view('header_admin');
            $this->load->view('admin_pay', $data);
            $this->load->view('footer_admin');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
            $this->user->set_paid($data['id']);
            echo 0;
        }
    }

    public function lookup() {
        $school_id = $this->uri->segment(3);
        $data['individual'] = $this->people->get_people_from_school($school_id);
        $team = $this->team->get_team_from_school($school_id);
        foreach ($team as $key => $item) {
            $team[$key]['first'] = $this->people->get_name($item['first']);
            $team[$key]['second'] = $this->people->get_name($item['second']);
            $team[$key]['third'] = $this->people->get_name($item['third']);
            $team[$key]['fourth'] = $this->people->get_name($item['fourth']);
        }
        $data['team'] = $team;
        $data['userinfo'] = $this->user->get_user_by_id($school_id);
        $this->load->view('header_admin');
        $this->load->view('admin_lookup', $data);
        $this->load->view('footer_admin');
    }

    public function logout() {
        $this->session->unset_userdata('admin_in');
        redirect(site_url('user/admin'));
    }
}