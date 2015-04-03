<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 3/31/15
 * Time: 13:53
 */

/*
 * This function translates the error code to a json response.
 */
if (! function_exists('errmsg')) {
    function err_msg($code) {
        $response = array(
            'code' => $code,
            'msg' => $GLOBALS['ERR_MSG'][$code]
        );
        return json_encode($response);
    }
}

/*
 * This function loads the individual data from cookie.
 */
if (! function_exists('load_cookie_individual')) {
    function load_cookie_individual() {
        $data = $this->input->cookie('individual');
        return $data;
    }
}

/*
 * This function loads the individual data from database.
 */
if (! function_exists('load_db_individual')) {
    function load_db_individual() {
        $this->load->model('people_model', 'people');
        $school_id = $this->session->userdata('id');
        $data = $this->user->get_people_from_school($school_id);
        return $data;
    }
}

/*
 * This function gets the cached individual data.
 * If cookie is deleted, get from the database.
 */
if (! function_exists('load_cached_individual')) {
    function load_cached_individual() {
        $data = load_cookie_individual();
        if (! $data) {
            $data = load_db_individual();
        }
        return $data;
    }
}

/*
 * This function loads the team data from cookie.
 */
if (! function_exists('load_cookie_team')) {
    function load_cookie_team() {
        $data = $this->input->cookie('team');
        return $data;
    }
}

/*
 * This function loads the individual data from database.
 */
if (! function_exists('load_db_team')) {
    function load_db_team() {
        $this->load->model('team_model', 'team');
        $school_id = $this->session->userdata('id');
        $data = $this->team->get_team_by_chool($school_id);
        return $data;
    }
}

/*
 * This function gets the cached team data.
 * If cookie is deleted, get from the database.
 */
if (! function_exists('load_cached_team')) {
    function load_cached_team() {
        $data = load_cookie_team();
        if (! $data) {
            $data = load_db_team();
        }
        return $data;
    }
}
