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
 * Format a message with custon information.
 *
 * Note(huxuan): I failed to find built-in support for multiple key-value
 * placesholder formatting. Feel free to kick me if you know it.
 */
if (! function_exists('format_msg')) {
    function format_msg($msg, $info) {
        foreach ($info as $key => $value) {
            $msg = str_replace('{'.$key.'}', $value, $msg);
        }
        return $msg;
    }
}

/*
 * Translates the error code with custom information to a json response.
 */
if (! function_exists('err_custom_msg')) {
    function err_custom_msg($code, $info) {
        $response = array(
            'code' => $code,
            'msg' => format_msg($GLOBALS['ERR_MSG'][$code], $info),
        );
        return json_encode($response);
    }
}

/*
 * This function loads the individual data from cookie.
 */
if (! function_exists('load_cookie_individual')) {
    function load_cookie_individual() {
        $CI = get_instance();
        $data = $CI->input->cookie('individual');
        return json_decode($data, true);
    }
}

/*
 * This function loads the individual data from database.
 */
if (! function_exists('load_db_individual')) {
    function load_db_individual() {
        $CI = get_instance();
        $CI->load->model('people_model', 'people');
        $school_id = $CI->session->userdata('id');
        $data = $CI->people->get_people_from_school($school_id);
        return $data;
    }
}

/*
 * This function gets the cached individual data.
 * If cookie is deleted, get from the database.
 */
if (! function_exists('load_cached_individual')) {
    function load_cached_individual() {
        $data = load_db_individual();
        return $data;
    }
}

/*
 * This function loads the team data from cookie.
 */
if (! function_exists('load_cookie_team')) {
    function load_cookie_team() {
        $CI = get_instance();
        $data = $CI->input->cookie('team');
        return json_decode($data, true);
    }
}

/*
 * This function loads the individual data from database.
 */
if (! function_exists('load_db_team')) {
    function load_db_team() {
        $CI = get_instance();
        $CI->load->model('team_model', 'team');
        $school_id = $CI->session->userdata('id');
        $data = $CI->team->get_team_by_chool($school_id);
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

/*
 * This function encode an individual's information into a key for match.
 */
if (! function_exists('individual_encode')) {
    function individual_encode($ind) {
        return base64_encode(implode('&', array(
            'name=' . $ind['name'],
            'gender=' . $ind['gender'],
            'id_card=' . $ind['id_card'],
        )));
    }
}

/*
 * This function decode an individual's key to original information.
 */
if (! function_exists('individual_decode')) {
    function individual_decode($key) {
        parse_str(base64_decode($key), $arr);
        return $arr;
    }
}

/*
 * This function calculates an individual's fee.
 */
if (! function_exists('get_bill')) {
    function get_bill($data) {
        $fee = 35 * $data['ifrace'] + 20 * $data['meal16'] + 15 * $data['meal17'] + $GLOBALS['ACCO_FEE'][$data['accommodation']];
        return $fee;
    }
}
