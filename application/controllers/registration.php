<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/28/15
 * Time: 14:01
 */

class Registration extends CI_Controller {

    public function index() {
        $this->load->view('header');
        $this->load->view('registration_individual');
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
}
