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
    public function get_people_where($where) {
        $res = $this->db->select('people.*, users.school')->from('people')->where('people.deleted', false)->where($where)->join('users', 'people.school_id = users.id')->get();
        return $res;
    }

    /*
     * Get a person's information.
     */
    public function get_people($id) {
        $res = $this->get_people_where(array('people.id' => $id));
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return NULL;
    }

    public function by_id($id) {
        return $this->get_people($id);
    }

    /*
     * Get a person's name.
     */
    public function get_name($key) {
        $res = $this->db->select('name')->where('key', $key)->get('people')->row_array();
        if ($res and array_key_exists('name', $res)) {
            return $res['name'];
        } else {
            return null;
        }
    }

    /*
     * Add a new person.
     */
    public function add_people($data) {
        var_dump($data);
        return $this->db->insert('people', $data);
    }

    public function insert($data) {
        return $this->add_people($data);
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
        $query = $this->get_people_where(array('school_id', $school_id));
        return $query->result_array();
    }

    /*
     * Update an individual's information.
     *
     * ====argument====
     * $id, the id of the person.
     * $data, the new information.
     *
     */
    public function update_individual($id, $data) {
        $this->db->where('id', $id)->update('people', $data);
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
        $query = $this->db->where('school_id', $school_id)->where('gender', 1)->where('ifteam', 1)->where('deleted', false)->get('people');
        return $query->result_array();
    }

    /*
     * Get keys for all the male athlete from a certain school.
     */
    public function get_male_athlete_keys_from_school($school_id) {
        $res = array();
        foreach ($this->get_male_athlete_from_school($school_id) as $item) {
            $res[$item['key']] = true;
        }
        return $res;
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
        $query = $this->db->where('school_id', $school_id)->where('gender', 2)->where('ifteam', 1)->where('deleted', false)->get('people');
        return $query->result_array();
    }

    /*
     * Get keys for all the female athlete from a certain school.
     */
    public function get_female_athlete_keys_from_school($school_id) {
        $res = array();
        foreach ($this->get_female_athlete_from_school($school_id) as $item) {
            $res[$item['key']] = true;
        }
        return $res;
    }

    /*
     * Check the person with a certain key is deleted or not.
     */
    public function is_exist($key) {
        $query = $this->db->where('key', $key)->where('ifteam', true)->where('deleted', false)->get('people');
        return ($query->num_rows() > 0);
    }

    /*
     * Get information of all the people.
     *
     */
    public function get_all_people() {
        $query = $this->get_people_where(array());
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function all() {
        return $this->get_all_people();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('people', $data);
    }
}

/* End of file people_model.php */
/* Location: ./application/models/people_model.php */
