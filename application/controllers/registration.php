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
            unset($ind_post['order']);
            $ind_db = $this->people->get_people_from_school($school_id);
            header('Content-Type: application/json');
            foreach ($ind_db as $item_db) {
                $flag = false;
                $i = 0;
                foreach ($ind_post as $item_post) {
                    if ($item_db['key'] == $item_post['key']) {
                        $flag = true;
                        //update
                        break;
                    }
                    $i++;
                }
                if (!$flag) {
                    $this->people->delete_people($item_db['id']);
                } else {
                    array_splice($ind_post, $i - 1, 1);
                }
                //unset($item['order']);
                //$this->people->add_people($item, $school_id);
            }
            foreach ($ind_post as $item_post) {
                $this->people->add_people($item_post, $school_id);
            }
            $err_code = '200';
            //This is only an example
            exit(err_msg($err_code));
        }
    }

    /*
     * This method let the users register teams.
     */
    public function team() {
        $school_id = $this->session->userdata('id');
        $data['male'] = $this->people->get_male_athlete_from_school($school_id);
        $data['female'] = $this->people->get_female_athlete_from_school($school_id);
        $this->load->view('header');
        $this->load->view('registration_team', $data);
        $this->load->view('footer');
    }

    /*
     * Show registration result for the user.
     */
    public function result() {
        $this->load->view('header');
        $this->load->view('registration_result');
        $this->load->view('footer');
    }
}
