<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    /*
     * Contrunction for Index Controller.
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Index page for Index Controller.
     */
    public function index() {
        $this->load->view('header');
        $this->load->view('index');
        $this->load->view('footer');
    }
}
