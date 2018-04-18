<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/28/15
 * Time: 14:01
 */

class Registration extends CI_Controller {

    /*
     * Construction for Registration Controller.
     */
    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'lib'));
        $this->load->model('people_model', 'people');
        $this->load->model('team_model', 'team');
        $this->load->model('user_model', 'user');
        $this->load->model('info_model', 'info');

        if (! $this->session->userdata('logged_in')) {
            redirect(site_url('user/login'), 'refresh');
        }

        if (! $this->session->userdata('editable')) {
            redirect(site_url('user/result'));
        }
    }

    public function index() {
        $this->load->view('header_homepage');
        $this->load->view('add_hilight_nav2');
        $query = $this->info->get_info('register-readme');
        $data = array(
            'text' => $query['text'],
            'publish' => $query['isdraft']
        );
        $this->load->view('registration_index', $data);
        $this->load->view('footer');
    }

    /*
     * This method let the users register individuals.
     */
    public function individual() {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $quota_results = $this->people->get_race_quota();
            $this->load->view('header_homepage');
            $this->load->view('add_hilight_nav2');
            $this->load->view('registration_individual', $quota_results);
            $this->load->view('footer');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $school_id = $this->session->userdata('id');
            $data = $this->input->post();
            $ind_post = $data['data'];
            header('Content-Type: application/json');
            // There should be some validations here.
            $tel_set = array();
            $id_number_set = array();
            $key_set = array();
            if (!$ind_post) exit(err_msg('999'));

            $rdb_f_count = 0;
            $rdb_m_count = 0;
            $rdb_elite_count = 0;
            $race_m_count = 0;
            $race_f_count = 0;
            $race_elite_count = 0;
            $aud_count = 0;
            foreach ($ind_post as $item_post) {
                if ($item_post['ifrace'] == '0') {
                    $aud_count++;
                }
                if ($item_post['rdb'] == '1' and $item_post['gender'] == '1') {
                    $rdb_m_count++;
                }
                if ($item_post['rdb_f'] == '1' and $item_post['gender'] == '2') {
                    $rdb_f_count++;
                }
                if ($item_post['race'] == '1' and $item_post['gender'] == '1') {
                    $race_m_count++;
                }
                if ($item_post['race_f'] == '1' and $item_post['gender'] == '2') {
                    $race_f_count++;
                }
                if ($item_post['race_elite'] == '1' and $item_post['gender'] == '1') {
                    $race_elite_count++;
                }
                if ($item_post['rdb_elite'] == '1' and $item_post['gender'] == '1') {
                    $rdb_elite_count++;
                }
                // name
                if (!validate_name($item_post['name'])) {
                    exit(err_custom_msg('1000', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                // gender
                if (!array_key_exists($item_post['gender'], $GLOBALS['GENDER'])) {
                    exit(err_custom_msg('1010', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                // tel
                if (!validate_mobile($item_post['tel'])) {
                    exit(err_custom_msg('1020', array(
                        'order' => $item_post['order'] + 1,
                    )));
                } else if (array_key_exists($item_post['tel'], $tel_set)) {
                    exit(err_custom_msg('1021', array(
                        'order' => $item_post['order'] + 1,
                        'order1' => $tel_set[$item_post['tel']],
                    )));
                } else {
                    $tel_set[$item_post['tel']] = $item_post['order'] + 1;
                }
                // ifrace
                if (!array_key_exists($item_post['ifrace'], $GLOBALS['IFRACE'])) {
                    exit(err_custom_msg('1030', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                // islam
                if (!array_key_exists($item_post['islam'], $GLOBALS['JUDGE'])) {
                    exit(err_custom_msg('1040', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                // id_number
                if (!validate_id_number($item_post['id_number'], $item_post['id_type'], $item_post['gender'])) {
                    exit(err_custom_msg('1050', array(
                        'order' => $item_post['order'] + 1,
                    )));
                } else if (array_key_exists($item_post['id_number'], $id_number_set)) {
                    exit(err_custom_msg('1051', array(
                        'order' => $item_post['order'] + 1,
                        'order1' => $id_number_set[$item_post['id_number']],
                    )));
                } else {
                    $id_number_set[$item_post['id_number']] = $item_post['order'] + 1;
                }
                // dinner
                if (!array_key_exists($item_post['dinner'], $GLOBALS['JUDGE'])) {
                    exit(err_custom_msg('1070', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                // lunch
                if (!array_key_exists($item_post['lunch'], $GLOBALS['JUDGE'])) {
                    exit(err_custom_msg('1080', array(
                        'order' => $item_post['order'] + 1,
                    )));
                } else if ($item_post['ifrace'] == '1' and $item_post['lunch'] == '0') {
                    exit(err_custom_msg('1081', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                // race
                if (!array_key_exists($item_post['race'], $GLOBALS['CAPURACE_M'])) {
                    exit(err_custom_msg('1090', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                if (!array_key_exists($item_post['race_f'], $GLOBALS['CAPURACE_F'])) {
                    exit(err_custom_msg('1090', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                if (!array_key_exists($item_post['rdb'], $GLOBALS['CAPURDB_M'])) {
                    exit(err_custom_msg('1090', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                if (!array_key_exists($item_post['race'], $GLOBALS['CAPURDB_F'])) {
                    exit(err_custom_msg('1090', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                if (!array_key_exists($item_post['race_elite'], $GLOBALS['CAPURACE_M'])) {
                    exit(err_custom_msg('1090', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                if (!array_key_exists($item_post['rdb_elite'], $GLOBALS['CAPURDB_M'])) {
                    exit(err_custom_msg('1090', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }

                if ($item_post['ifrace'] == '0' and ($item_post['race'] != '0' or $item_post['race_elite'] != '0' or
                        $item_post['race_f'] != '0' or $item_post['rdb'] != '0' or $item_post['rdb_elite'] != '0' or
                        $item_post['rdb_f'] != '0' or $item_post['ifteam'] != '0')) {
                    exit(err_custom_msg('1091', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }

                if (($item_post['ifrace'] != '0') and ($item_post['race'] == '0') and
                        ($item_post['race_f'] == '0') and ($item_post['race_elite'] == '0') and ($item_post['ifteam'] == '0') and
                        ($item_post['rdb'] == '0') and ($item_post['rdb_f'] == '0') and ($item_post['rdb_elite'] == '0')) {
                    exit(err_custom_msg('1092', array(
                        'order' => $item_post['order'] + 1,
                    )));

                }
                if ($item_post['gender'] == '1' and
                    ($item_post['race_f'] != '0' or $item_post['rdb_f'] != '0')) {
                    exit(err_custom_msg('1093', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                if ($item_post['gender'] == '2' and
                    ($item_post['race'] != '0' or $item_post['race_elite'] != '0' or
                    $item_post['rdb'] != '0' or $item_post['rdb_elite'] != '0')) {
                    exit(err_custom_msg('1094', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                if (($item_post['race'] == '1' and $item_post['race_elite'] == '1') or
                    ($item_post['rdb'] == '1' and $item_post['rdb_elite'] == '1')) {
                    exit(err_custom_msg('1095', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
                // ifteam
                if (!array_key_exists($item_post['ifteam'], $GLOBALS['JUDGE'])) {
                    exit(err_custom_msg('1100', array(
                        'order' => $item_post['order'] + 1,
                    )));
                } else if ($item_post['ifrace'] == '0' and $item_post['ifteam'] == '1') {
                    exit(err_custom_msg('1101', array(
                        'order' => $item_post['order'] + 1,
                    )));
                }
            }

            if ($aud_count > $GLOBALS['AUD_QUOTA_PER_SCHOOL']) {
                exit(err_custom_msg('1099', array(
                    'quota' => $GLOBALS['AUD_QUOTA_PER_SCHOOL'],
                )));
            }
            $quota_results = $this->people->get_race_quota();
            if (!$quota_results['rdb_m_status'] and $rdb_m_count > 0) exit(err_msg('1104'));
            if (!$quota_results['rdb_f_status'] and $rdb_f_count > 0) exit(err_msg('1105'));
            if (!$quota_results['rdb_elite_status'] and $rdb_elite_count > 0) exit(err_msg('1106'));
            if (!$quota_results['race_m_status'] and $race_m_count > 0) exit(err_msg('1102'));
            if (!$quota_results['race_f_status'] and $race_f_count > 0) exit(err_msg('1103'));
            if (!$quota_results['race_elite_status'] and $race_elite_count > 0) exit(err_msg('1107'));

            $bill = 0;
            $ind_db = $this->people->get_people_from_school($school_id);
            foreach ($ind_db as $item_db) {
                $flag = false;
                $i = 0;
                foreach ($ind_post as $item_post) {
                    $item_post['team_key'] = individual_encode($item_post);
                    if (strcmp($item_db['team_key'], $item_post['team_key']) == 0) {
                        $flag = true;
                        unset($item_post['team_id']);
                        $fee = get_bill($item_post); // to do
                        $item_post['fee'] = $fee;
                        $this->people->update_individual($item_db['id'], $item_post);
                        $bill += $fee;
                        break;
                    }
                    $i++;
                }
                if (!$flag) {
                    $this->people->delete_people($item_db['id']);
                } else {
                    array_splice($ind_post, $i, 1);
                }
            }
            foreach ($ind_post as $item_post) {
                $item_post['team_key'] = individual_encode($item_post);
                $fee = get_bill($item_post);
                $item_post['fee'] = $fee;
                $bill += $fee;
                $this->people->add_people($item_post, $school_id);
            }
            $this->user->set_bill($school_id, $bill);
            $err_code = '200';
            exit(err_msg($err_code));
        }
    }

    /*
     * This method let the users register teams.
     */
    public function team() {
        $school_id = $this->session->userdata('id');
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $data['male'] = $this->people->get_male_athlete_from_school($school_id);
            $data['female'] = $this->people->get_female_athlete_from_school($school_id);
            $data['team'] = $this->team->get_team_from_school($school_id);
            $this->load->view('header_homepage');
            $this->load->view('add_hilight_nav2');
            $this->load->view('registration_team', $data);
            $this->load->view('footer');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
            header('Content-Type: application/json');
            $team_post = $data['data'];
            // Team Validation.
            $male_key_set = $this->people->get_male_athlete_keys_from_school($school_id);
            $female_key_set = $this->people->get_female_athlete_keys_from_school($school_id);
            $key_set = array();
            if (!$team_post) $team_post = array();
            if (sizeof($team_post) > 3) exit(err_custom_msg('2002', array()));
            $team_athletes_number = $this->people->get_team_athletes_number($school_id);
            if (sizeof($team_post) * 4 != $team_athletes_number) exit(err_msg('2003'));
            foreach ($team_post as $item_post) {
                // first
                if (!array_key_exists($item_post['first'], $male_key_set)) {
                    exit(err_custom_msg('2000', array(
                        'order' => $item_post['order'],
                        'order_ind' => 1,
                    )));
                } else if (array_key_exists($item_post['first'], $key_set)) {
                    exit(err_custom_msg('2001', array(
                        'order' => $item_post['order'],
                        'order_ind' => 1,
                        'order1' => $key_set[$item_post['first']]['order'],
                        'order1_ind' => $key_set[$item_post['first']]['order_ind'],
                    )));
                } else {
                    $key_set[$item_post['first']] = array(
                        'order' => $item_post['order'],
                        'order_ind' => 1,
                    );
                }
                // second
                if (!array_key_exists($item_post['second'], $male_key_set)) {
                    exit(err_custom_msg('2000', array(
                        'order' => $item_post['order'],
                        'order_ind' => 2,
                    )));
                } else if (array_key_exists($item_post['second'], $key_set)) {
                    exit(err_custom_msg('2001', array(
                        'order' => $item_post['order'],
                        'order_ind' => 2,
                        'order1' => $key_set[$item_post['second']]['order'],
                        'order1_ind' => $key_set[$item_post['second']]['order_ind'],
                    )));
                } else {
                    $key_set[$item_post['second']] = array(
                        'order' => $item_post['order'],
                        'order_ind' => 2,
                    );
                }
                // third
                if (!array_key_exists($item_post['third'], $female_key_set)) {
                    exit(err_custom_msg('2000', array(
                        'order' => $item_post['order'],
                        'order_ind' => 3,
                    )));
                } else if (array_key_exists($item_post['third'], $key_set)) {
                    exit(err_custom_msg('2001', array(
                        'order' => $item_post['order'],
                        'order_ind' => 3,
                        'order1' => $key_set[$item_post['third']]['order'],
                        'order1_ind' => $key_set[$item_post['third']]['order_ind'],
                    )));
                } else {
                    $key_set[$item_post['third']] = array(
                        'order' => $item_post['order'],
                        'order_ind' => 3,
                    );
                }
                // fourth
                if (!array_key_exists($item_post['fourth'], $male_key_set)) {
                    exit(err_custom_msg('2000', array(
                        'order' => $item_post['order'],
                        'order_ind' => 4,
                    )));
                } else if (array_key_exists($item_post['fourth'], $key_set)) {
                    exit(err_custom_msg('2001', array(
                        'order' => $item_post['order'],
                        'order_ind' => 4,
                        'order1' => $key_set[$item_post['fourth']]['order'],
                        'order1_ind' => $key_set[$item_post['fourth']]['order_ind'],
                    )));
                } else {
                    $key_set[$item_post['fourth']] = array(
                        'order' => $item_post['order'],
                        'order_ind' => 4,
                    );
                }
            }
            $team_db = $this->team->get_team_from_school($school_id);
            $n_post = count($team_post);
            $n_db = count($team_db);
            if ($n_post >= $n_db) {
                for ($i = 0; $i < $n_db; $i++) {
                    $this->team->update_team($team_post[$i], $school_id);
                }
                for ($i = $n_db; $i < $n_post; $i++) {
                    $this->team->add_team($team_post[$i], $school_id);
                }
            } else {
                for ($i = 0; $i < $n_post; $i++) {
                    $this->team->update_team($team_post[$i], $school_id);
                }
                for ($i = $n_post; $i < $n_db; $i++) {
                    $this->team->delete_team($team_db[$i]['id'], $school_id);
                }
            }
            $err_code = '200';
            exit(err_msg($err_code));
        }
    }
}
