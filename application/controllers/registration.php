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

        $this->load->helper(array('url'));

        if (! $this->session->userdata('logged_in')) {
            redirect(site_url('user/login'), 'refresh');
        }
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('registration_index');
        $this->load->view('footer');
    }

    /*
     * This method let the users register individuals.
     */
    public function individual() {
        $this->load->view('header');
        $this->load->view('registration_individual');
        $this->load->view('footer');
    }

    /*
     * This method let the users register teams.
     */
    public function team() {
        $this->load->view('header');
        $this->load->view('registration_team');
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
