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

        if (! $this->session->userdata('logged_in')) {
            redirect(site_url('user/login'), 'refresh');
        }
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('add_hilight_nav2');
        $this->load->view('registration_index');
        $this->load->view('footer');
    }

    /*
     * This method let the users register individuals.
     */
    public function individual() {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $data['individual'] = load_cached_individual();
            $this->load->view('header');
            $this->load->view('registration_individual', $data);
            $this->load->view('footer');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $school_id = $this->session->userdata('id');
            $data = $this->input->post();
            $ind_post = $data['data'];
            $ind_db = $this->people->get_people_from_school($school_id);
            //There should be some validations here.
            header('Content-Type: application/json');
            $bill = 0;
            foreach ($ind_db as $item_db) {
                $flag = false;
                $i = 0;
                foreach ($ind_post as $item_post) {
                    $item_post['key'] = individual_encode($item_post);
                    if (strcmp($item_db['key'], $item_post['key']) == 0) {
                        $flag = true;
                        unset($item_post['team_id']);
                        $fee = get_bill($item_post);
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
                $item_post['key'] = individual_encode($item_post);
                unset($item_post['order']);
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
            $this->load->view('header');
            $this->load->view('registration_team', $data);
            $this->load->view('footer');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
            header('Content-Type: application/json');
            $team_post = $data['data'];
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
