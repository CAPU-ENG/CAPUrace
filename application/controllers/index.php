<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    /*
     * Construction for Index Controller.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('info_model', 'info');
        $this->load->helper(array('url'));
    }

    /*
     * Index page for Index Controller.
     */
    public function index() {
        $this->load->view('header_homepage');
        $this->load->view('index');
        $this->load->view('footer');
    }

    public function race_info() {
        $title = $this->uri->segment(3);
        if ($title != "") {
            $title = 'race-info-' . $title;
        } else {
            $title = 'race-info';
        }
        $this->load->view('header_homepage');
        $this->load->view('add_hilight_nav3');
        $this->load->view('race_info_navi');
        $res= $this->info->get_info($title);
        $data = array(
            'text' => $res['text'],
            'publish' => $res['isdraft']
        );
        $this->load->view('race_info_content', $data);
        $this->load->view('footer');
    }

    public function activity() {
        $this->load->view('header_homepage');
        $this->load->view('add_hilight_nav4');
        $res= $this->info->get_info('activity');
        $data = array(
            'text' => $res['text'],
            'publish' => $res['isdraft']
        );
        $this->load->view('activity_notification', $data);
        $this->load->view('footer');
    }
    public function competition_info() {
        $title = $this->uri->segment(3);
        if ($title != "") {
            $title = 'competition-info-' . $title;
        } else {
            $title = 'competition-info';
        }
        $this->load->view('header_homepage');
        $this->load->view('add_hilight_nav5');
        $this->load->view('competition_info_navi');
        $res= $this->info->get_info($title);
        $data = array(
            'text' => $res['text'],
            'publish' => $res['isdraft']
        );
        $this->load->view('competition_info_content', $data);
        $this->load->view('footer');
    }

}

