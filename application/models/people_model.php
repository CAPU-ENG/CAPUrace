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
    public function get_name($key) {
        $res = $this->db->select('name')->where('team_key', $key)->get('people')->row_array();
        if ($res and array_key_exists('name', $res)) {
            return $res['name'];
        } else {
            return null;
        }
    }

    /*
     * Add a new person.
     */
    public function add_people($data, $school_id) {
        $this->load->helper(array('lib'));
        $data = array_merge($data, array('school_id' => $school_id, 'team_key' => individual_encode($data)));
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
            $res[$item['team_key']] = true;
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
            $res[$item['team_key']] = true;
        }
        return $res;
    }

    /*
     * Check the person with a certain key is deleted or not.
     */
    public function is_exist($key) {
        $query = $this->db->where('team_key', $key)->where('ifteam', true)->where('deleted', false)->get('people');
        return ($query->num_rows() > 0);
    }

    /*
     * Get the number of all the people who attend team race.
     */
    public function get_team_athletes_number($id) {
        $query = $this->db->where('school_id', $id)->where('ifteam', true)->where('deleted', false)->get('people');
        return $query->num_rows();
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

    /*
     * Get remained quota of RDB
     */
    public function get_rdb_quota($id) {
        $query = $this->db->where('deleted', false)->where('rdb', true)->get('people');
        $query_school = $this->db->where('deleted', false)->where('rdb', true)->where('school_id', $id)->get('people');
        return $GLOBALS['RDB_QUOTA'] - $query->num_rows() + $query_school->num_rows();
    }

    /*
     * Get remained quota of Audience
     */
    public function get_audience_quota($id) {
        $query = $this->db->where('deleted', false)->where('ifrace', false)->get('people');
        $query_school = $this->db->where('deleted', false)->where('ifrace', false)->where('school_id', $id)->get('people');
        return $GLOBALS['AUDIENCE_QUOTA'] - $query->num_rows() + $query_school->num_rows();
    }

    /*
     * Get the number of people of each race
     */
    public function get_race_number_by_school($school_id) {
        $query = $this->db->where('deleted', false)->where('school_id', $school_id)->get('people');
        $race_results = array(
            'team_num' => 0,
            'rdb_m_num' => 0,
            'rdb_f_num' => 0,
            'rdb_elite_num' => 0,
            'race_m_num' => 0,
            'race_f_num' => 0,
            'race_elite_num' => 0
         );
        foreach ($query->result() as $row)
        {
          $race_results['team_num'] +=  $row->ifteam;
          $race_results['rdb_m_num'] += $row->rdb;
          $race_results['rdb_f_num'] += $row->rdb_f;
          $race_results['rdb_elite_num'] += $row->rdb_elite;
          $race_results['race_m_num'] += $row->race;
          $race_results['race_f_num'] += $row->race_f;
          $race_results['race_elite_num'] += $row->race_elite;
        }
        return $race_results;
    }
    /*
     * Get which race is above quota
     */
    public function get_race_quota() {
        $query = $this->db->query('select people.id,people.school_id,users.id,users.editable,people.ifteam,people.rdb,people.rdb_elite,
            people.rdb_f,people.race,people.race_elite,people.race_f from people inner join users on people.school_id=users.id
            where people.deleted=0 and people.ifrace=1 and users.deleted=0 and users.editable=0;');
        $team_num = 0;
        $rdb_m_num = 0;
        $rdb_f_num = 0;
        $rdb_elite_num = 0;
        $race_m_num = 0;
        $race_f_num = 0;
        $race_elite_num = 0;

        $quota_results = array(
            'team_status' => 0,
            'rdb_m_status' => 0,
            'rdb_f_status' => 0,
            'rdb_elite_status' => 0,
            'race_m_status' => 0,
            'race_f_status' => 0,
            'race_elite_status' => 0
         );
        foreach ($query->result() as $row)
        {
            $team_num   +=  $row->ifteam;
            $rdb_m_num  += $row->rdb;
            $rdb_f_num  += $row->rdb_f;
            $rdb_elite_num  += $row->rdb_elite;
            $race_m_num += $row->race;
            $race_f_num += $row->race_f;
            $race_elite_num += $row->race_elite;

        }
        $quota_results['team_status'] = $GLOBALS['RACE_TEAM_QUOTA'] - $team_num;
        $quota_results['rdb_m_status'] = $GLOBALS['RDB_M_QUOTA'] - $rdb_m_num;
        $quota_results['rdb_f_status'] = $GLOBALS['RDB_F_QUOTA'] - $rdb_f_num;
        $quota_results['rdb_elite_status'] = $GLOBALS['RDB_ELITE_QUOTA'] - $rdb_elite_num;
        $quota_results['race_m_status'] = $GLOBALS['RACE_M_QUOTA'] - $race_m_num;
        $quota_results['race_f_status'] = $GLOBALS['RACE_F_QUOTA'] - $race_f_num;
        $quota_results['race_elite_status'] = $GLOBALS['RACE_ELITE_QUOTA'] - $race_elite_num;

        $quota_results['team_status'] = $quota_results['team_status'] > 0 ? $quota_results['team_status'] : 0;
        $quota_results['rdb_m_status'] = $quota_results['rdb_m_status'] > 0 ? $quota_results['rdb_m_status'] : 0;
        $quota_results['rdb_f_status'] = $quota_results['rdb_f_status'] > 0 ? $quota_results['rdb_f_status'] : 0;
        $quota_results['rdb_elite_status'] = $quota_results['rdb_elite_status'] > 0 ? $quota_results['rdb_elite_status'] : 0;
        $quota_results['race_m_status'] = $quota_results['race_m_status'] > 0 ? $quota_results['race_m_status'] : 0;
        $quota_results['race_f_status'] = $quota_results['race_f_status'] > 0 ? $quota_results['race_f_status'] : 0;
        $quota_results['race_elite_status'] = $quota_results['race_elite_status'] > 0 ? $quota_results['race_elite_status'] : 0;

        return $quota_results;
    }

}

/* End of file people_model.php */
/* Location: ./application/models/people_model.php */
