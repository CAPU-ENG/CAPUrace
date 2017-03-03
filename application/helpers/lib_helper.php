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
 * This function loads the team data from database.
 */
if (! function_exists('load_db_team')) {
    function load_db_team() {
        $CI = get_instance();
        $CI->load->model('team_model', 'team');
        $school_id = $CI->session->userdata('id');
        $data = $CI->team->get_team_from_school($school_id);
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
        if ($data['race'] && $data['ifteam']) {
            $race_fee = 50;
        } else if (! $data['ifrace']) {
            $race_fee = 0;
        } else {
            $race_fee = 30;
        }
        $fee = $race_fee + 20 * $data['dinner'] + 20 * $data['lunch'] + $GLOBALS['ACCO_FEE'][$data['accommodation']];
        return $fee;
    }
}

/*
 * Validation for name.
 */
if (! function_exists('validate_name')) {
    function validate_name($name) {
        if (strlen($name) < 6) return false; // The length of two Chinese characters is 6.
        // NOTE(huxuan): We may add more validation here in the future.
        return true;
    }
}

/*
 * Validation for mobile number.
 */
if (! function_exists('validate_mobile')) {
    function validate_mobile($tel) {
        if (strlen($tel) != 11) return false;
        // NOTE(huxuan): We may add more validation here in the future.
        return true;
    }
}

/*
 * Validation for id card.
 */
if (! function_exists('validate_id_card')) {
    function validate_id_card($id_card) {
        if (!in_array(strlen($id_card), array(15, 18))) return false;
        // NOTE(huxuan): We may add more validation here in the future.
        return true;
    }
}
