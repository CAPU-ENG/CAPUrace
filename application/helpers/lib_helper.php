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