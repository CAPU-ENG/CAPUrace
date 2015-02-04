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

    /*
     * Add a new team.
     *
     * ====argument====
     * $data, an assoc array with the information about the team.
     * $school_id, the id of the school from which the team is.
     */
    public function add_team($data, $school_id) {
        $data = array_merge($data, array('school_id', $school_id));
        $this->db->insert('team', $data);
    }

    /*
     * Get all teams from the certain school by id, without
     * interpreting the ids into names.
     *
     */
    public function get_team_by_school($school_id) {
        $query = $this->db->where('school_id', $school_id)->get('team');
        return $query->result_array();
    }

}

/* End of file team_model.php */
/* Location: ./application/models/team_model.php */