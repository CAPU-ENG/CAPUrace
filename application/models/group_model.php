<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/29/15
 * Time: 10:21
 */

class Group_model extends CI_Model {
    /*
     * Add a new group to the group list.
     *
     * ====argument====
     * $group_name, the name of the new group.
     *
     */
    public function new_group($group_name) {
        $data = array('group_name' => $group_name);
        $this->db->insert('group', $data);
    }

    public function insert($data) {
        return $this->db->insert('group', $data);
    }

    /*
     * Get a group by id.
     *
     * ====argument====
     * $id, the id of the group.
     *
     * =====return=====
     * $by_id, the group.
     */
    public function by_id($group_id) {
        $query = $this->db->where('id', $group_id)->get('group');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        else {
            return NULL;
        }
    }

    /*
     * Get the name of the group.
     *
     * ====argument====
     * $id, the id of the group.
     *
     * =====return=====
     * $group_name, the name of the group.
     */
    public function group_name($group_id) {
        $query = $this->db->where('id', $group_id)->get('group');
        $res = $query->row_array();
        return $res['group_name'];
    }


    /*
     * Get all groups
     *
     * ====argument====
     *
     * =====return=====
     * $all, all groups
     */
    public function all() {
        return $this->db->get('group')->result_array();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('group', $data);
    }
}

/* End of file group_model.php */
/* Location: ./application/models/group_model.php */
