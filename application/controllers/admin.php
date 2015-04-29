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

    public function info() {
        $data['nschools'] = $this->db->query('select count(*) as nschools from users;')->result_array()[0]['nschools'];
        $data['nverified'] = $this->db->query('select count(*) as nverified from users where editable=0;')->result_array()[0]['nverified'];
        $data['npaid'] = $this->db->query('select count(*) as npaid from users where paid=1;')->result_array()[0]['npaid'];
        $data['nlook'] = $this->db->query('select count(*) as nlook from people where deleted=0 and ifrace=0;')->result_array()[0]['nlook'];
        $data['nrace'] = $this->db->query('select count(*) as nrace from people where deleted=0 and ifrace=1;')->result_array()[0]['nrace'];
        $data['nmale'] = $this->db->query('select count(*) as nmale from people where deleted=0 and ifrace=1 and race=1;')->result_array()[0]['nmale'];
        $data['nfemale'] = $this->db->query('select count(*) as nfemale from people where deleted=0 and ifrace=1 and race=2;')->result_array()[0]['nfemale'];
        $data['nteams'] = $this->db->query('select count(*) as nteams from team where deleted=0;')->result_array()[0]['nteams'];
        $accommodation = $this->db->query('select count(*) as live from people where deleted=0 group by accommodation;')->result_array();
        $data['hotel'] = $accommodation[1]['live'];
        $data['tent_rent'] = $accommodation[2]['live'];
        $data['tent_bring'] = $accommodation[3]['live'];
        $data['meal16'] = $this->db->query('select count(*) as meal16 from people where deleted=0 and meal16=1;')->result_array()[0]['meal16'];
        $data['meal17'] = $this->db->query('select count(*) as meal17 from people where deleted=0 and meal17=1;')->result_array()[0]['meal17'];

        $this->load->view('header_admin');
        $this->load->view('admin_info', $data);
        $this->load->view('footer_admin');
    }
}