<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/23/15
 * Time: 13:30
 */

class People_model extends CI_Model {
    /*
     * Get a person's information.
     */
    public function get_people($id) {
        $res = $this->db->where('deleted', false)->where('id', $id)->get('people');
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return NULL;
    }

    /*
     * Get a person's name.
     */
    public function get_name($id) {
        $res = $this->db->select('name')->where('id', $id)->get('people')->row_array();
        return $res['name'];
    }

    /*
     * Add a new person.
     */
    public function add_people($data, $school_id) {
        $data = array_merge($data, array('school_id' => $school_id));
        $this->db->insert('people', $data);
    }

    /*
     * Delete a person.
     */
    public function delete_people($id) {
        $this->db->where('id', $id)->update('people', array('deleted' => 1));
    }

    /*
     * Add a person to a specific team.
     */
    public function add_to_team($id, $team_id) {
        $this->db->where('id', $id)->update('people', array('team_id' => $team_id));
    }

    /*
     * Get all the people from a certain school.
     *
     * ====argument====
     * $school_id, the id of the school.
     *
     * =====return=====
     * $res, an 2d array containing all the people that are not deleted.
     *
     */
    public function get_people_from_school($school_id) {
        $query = $this->db->where('school_id', $school_id)->where('deleted', false)->get('people');
        return $query->result_array();
    }

    /*
     * Get all the male athlete from a certain school.
     *
     * ====argument====
     * $school_id, the id of the school.
     *
     * =====return=====
     * $res, an 2d array containing all the male athlete that are not deleted.
     *
     */
    public function get_male_athlete_from_school($school_id) {
        $query = $this->db->where('school_id', $school_id)->where('gender', 1)->where('race', 1)->where('deleted', false)->get('people');
        return $query->result_array();
    }

    /*
     * Get all the female athlete from a certain school.
     *
     * ====argument====
     * $school_id, the id of the school.
     *
     * =====return=====
     * $res, an 2d array containing all the female athlete that are not deleted.
     *
     */
    public function get_female_athlete_from_school($school_id) {
        $query = $this->db->where('school_id', $school_id)->where('gender', 2)->where('race', 1)->where('deleted', false)->get('people');
        return $query->result_array();
    }

    /*
     * Get information of all the people.
     *
     */
    public function get_all_people() {
        $query = $this->db->where('deleted', false)->get('people');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return NULL;
        }
    }

}

/* End of file people_model.php */
/* Location: ./application/models/people_model.php */
