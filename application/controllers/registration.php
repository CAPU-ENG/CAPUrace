<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/28/15
 * Time: 14:01
 */

class Registration extends CI_Controller {

    public function index() {
        $this->load->library('session');
        $this->load->view('individual_form');
    }
}