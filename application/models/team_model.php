<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/23/15
 * Time: 13:49
 */

class Team_model extends CI_Model {

    /*
     * Get the information of a team by its id.
     *
     * ====argument====
     * $id, the id of the team.
     *
     * =====return=====
     * $relays, with the ids replaced by names.
     * Or NULL if the id is not valid.
     *
     */
    public function get_team($id) {
        $this->load->model('people_model', 'people');
        $this->load->model('user_model', 'user');
        $res = $this->db->where('id', $id)->get('team');
        if ($res->num_rows() > 0) {
            $relays = $res->row_array();
            $relays['first'] = $this->people->get_name($relays['first']);
            $relays['second'] = $this->people->get_name($relays['second']);
            $relays['third'] = $this->people->get_name($relays['third']);
            $relays['school_id'] = $this->user->get_school($relays['school_id']);
            return $relays;
        } else
            return NULL;
    }

    public function by_id($id) {
        return $this->get_team($id);
    }

    /*
     * Add a new team.
     *
     * ====argument====
     * $data, an assoc array with the information about the team.
     * $school_id, the id of the school from which the team is.
     */
    public function add_team($data, $school_id) {
        $data = array_merge($data, array('school_id' => $school_id));
        $this->db->insert('team', $data);
    }

    public function insert($data) {
        return $this->db->insert('team', $data);
    }

    /*
     * Update an existing team.
     */
    public function update_team($data, $school_id) {
        $data = array_merge($data, array('school_id' => $school_id));
        $this->db->where('school_id', $school_id)->where('order', $data['order'])->update('team', $data);
    }

    /*
     * Delete a team.
     */
    public function delete_team($id) {
        $this->db->where('id', $id)->update('team', array('deleted' => true));
    }

    /*
     * Get all teams from the certain school by id, without
     * interpreting the ids into names.
     *
     */
    public function get_team_from_school($school_id) {
        $this->load->model('people_model', 'people');
        $query = $this->db->where('school_id', $school_id)->where('deleted', false)->get('team');
        $teams = $query->result_array();
        foreach ($teams as $key => $item) {
            if (!$this->people->is_exist($item['first'])) {
                $teams[$key]['first'] = '0';
            }
            if (!$this->people->is_exist($item['second'])) {
                $teams[$key]['second'] = '0';
            }
            if (!$this->people->is_exist($item['third'])) {
                $teams[$key]['third'] = '0';
            }
            if (!$this->people->is_exist($item['fourth'])) {
                $teams[$key]['fourth'] = '0';
            }
        }
        return $teams;
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('team', $data);
    }

    public function get_where($where) {
        $where['team.deleted'] = false;
        $query = $this->db->select('team.*, first.name, second.name, third.name, users.school')->from('team')->where($where)->join('people as first', 'first.id = team.first')->join('people as second', 'second.id = team.second')->join('people as third', 'third.id = team.third')->join('users', 'users.id = team.school_id')->get();
        if ($query) {
            return $query->result_array();
        }
        else {
            return null;
        }
    }

    public function all() {
        return $this->get_where(array());
    }
}

/* End of file team_model.php */
/* Location: ./application/models/team_model.php */
