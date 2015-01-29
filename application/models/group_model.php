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
        $data = array('group_name', $group_name);
        $this->db->insert('users', $data);
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
    public function get_group($group_id) {
        $query = $this->db->where('id', $group_id)->get('group');
        $res = $query->row_array();
        return $res['group_name'];
    }
}

/* End of file group_model.php */
/* Location: ./application/models/group_model.php */