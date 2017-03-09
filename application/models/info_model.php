<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 06/03/2017
 * Time: 18:52
 */

class Info_model extends CI_Model {
    /*
     * Get current version of information.
     */
    public function get_info($title) {
        $result = $this->db->select('text, isdraft')->where('title', $title)->get('info');
        if ($result->num_rows() > 0) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    /*
     * Update new version of information.
     */
    public function update_info($title, $text) {
        $this->db->where('title', $title)->update('info', array('text' => $text));
    }

    /*
     * Publish the information.
     */
    public function publish_info($title, $text) {
        $this->db->where('title', $title)->update('info', array('text' => $text, 'isdraft' => 0));
    }
}