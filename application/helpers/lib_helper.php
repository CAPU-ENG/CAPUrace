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
            'id_number=' . $ind['id_number'],
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
        if ($data['ifrace'] && $data['dinner']) {
            $dinner_fee = 40;
        } else if (! $data['dinner']) {
            $dinner_fee = 0;
        } else {
            $dinner_fee = 40;
        }
        if ($data['ifrace'] || !$data['lunch']) {
            $lunch_fee = 0;
        } else {
            $lunch_fee = 20;
        }
        $race_num = $data['race'] + $data['race_f'] + $data['race_elite'] + $data['ifteam'] + $data['rdb'] + $data['rdb_f'] + $data['rdb_elite'];
        switch ($race_num) {
            case 0:
                $race_fee = 0;
                break;
            case 1:
                $race_fee = 80;
                break;
            case 2:
                $race_fee = 100;
                break;
            case 3:
                $race_fee = 120;
                break;
        }
        $fee = $race_fee + $dinner_fee + $lunch_fee;
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
 * Validation for id number.
 */
if (! function_exists('validate_id_number')) {
    function validate_id_number($id_number, $id_type, $gender) {
        if ($id_type == "passport") return true;
        if ($id_type == "identity") {
            if (strlen($id_number) == 15){
                if (substr($id_number, 14, 1) % 2 == (2 - $gender)) {
                    return true;
                }
            }
            if (strlen($id_number) == 18) {
                $map = array(1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2);
                $sum = 0;
                for ($i = 17; $i > 0; $i--) {
                    $s = pow(2, $i) % 11;
                    $sum += $s * substr($id_number, (17 - $i), 1);
                }
                if ($map[$sum % 11] == substr($id_number, 17, 1)) {
                    if (substr($id_number, 16, 1) % 2 == (2 - $gender)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
