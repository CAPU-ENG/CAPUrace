<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/22/15
 * Time: 19:27
 *
 * When using this model, please add
 * '$this->load->model('user_model', 'user');'
 * in the controller, and use
 * '$this->user->__method__($arguments)'
 * to call the functions in this class.
 *
 */

class User_model extends CI_Model {
    /*
     * Sign up a new user.
     *
     * ====argument====
     * $data, an associate array containing complete
     * 'fields' => 'values' for signing up a new user.
     * =====return=====
     * A boolean value indicates if the insertion
     * is successful. The insertion will fail if there
     * are duplicate 'mail' and 'school'.
     *
    */
    public function sign_up($data) {
        $this->db->insert('users', $data);
    }

    public function insert($data) {
        $this->sign_up($data);
    }

    /*
     * Check if an email address belongs to a valid user
     * in the database.
     */
    private function valid_user($email) {
        $res = $this->db->where('mail', $email)->get('users');
        return !($res->num_rows() == 0);
    }

    /*
     * Get users' data by some conditions.
     *
     * ====argument====
     * $where, the conditions.
     *
     * =====return=====
     * An array containing the user's information if
     * the $data is a valid user's information, or it
     * will return NULL.
     *
     */
    public function get_users_where($where) {
        $res = $this->db->select('users.*, group.group_name')->from('users')->where($where)->join('group', 'users.group_id = group.id')->get();
        if ($res->num_rows() === 0)
            return NULL;
        else
            return $res->result_array();
    }

    /*
     * Get a user's data by email address.
     *
     * ====argument====
     * $email, the user's email.
     *
     * =====return=====
     * An array containing the user's information if
     * the $data is a valid user's information, or it
     * will return NULL.
     *
     */
    public function get_user_by_email($email) {
        $res = $this->get_users_where(array('email' => $email));
        if ($res === NULL)
            return NULL;
        else
            return $res[0];
    }

    /*
     * Get a user's data by id.
     *
     * ====argument====
     * $id, the user's id.
     *
     * =====return=====
     * An array containing the user's information if
     * the $data is a valid user's information, or it
     * will return NULL.
     *
     */
    public function get_user_by_id($id) {
        $res = $this->get_users_where(array('users.id' => $id));
        if ($res === NULL)
            return NULL;
        else
            return $res[0];
    }

    public function by_id($id) {
        return $this->get_user_by_id($id);
    }

    /*
     * Get school name.
     */
    public function get_school($id) {
        $res = $this->db->select('school')->where('id', $id)->get('users');
        if ($res->num_rows() === 0)
            return NULL;
        else
            return $res->row_array()['school'];
    }

    /*
     * Update a user's information.
     *
     * ====argument====
     * $id, the user's id.
     * $new_data, the data to be updated.
     *
     * =====return=====
     * A boolean value indicating if the
     * update is successful.
     *
     */
    public function update($id, $new_data) {
        return $this->db->where('id', $id)->update('users', $new_data);
    }

    /*
	 * Get all users' information.
	 *
	 * ====argument====
	 * $order, valid column name in the users table. Default is school.
	 *
	 * =====return=====
	 * An array of associate arrays containing all
	 * the users' information. Designed for administrator.
	 *
	 */
    public function get_all($order = 'school') {
        $res = $this->db->order_by($order, 'asc')->get('users');
        return $res->result_array();
    }

    public function all() {
        return $this->db->select('users.*, group.group_name')->from('users')->join('group', 'users.group_id = group.id')->get()->result_array();
    }

    /*
     * Confirm a new user.
     *
     * ====argument====
     * $id, the id of the user to be confirmed.
     *
     */
    public function confirm($id) {
        $confirm = array('confirmed' => TRUE);
        $this->update($id, $confirm);
    }

    /*
     * Set the user to be paid.
     * ====argument====
     * $id, the id of the user to be confirmed.
     */
    public function set_paid($id) {
        $paid = array('paid' => TRUE);
        $this->update($id, $paid);
    }

    /*
     * Add the user to a group.
     *
     * ====argument====
     * $id, the user's id.
     * $group_name, the name of the group in which the user is to be added.
     */
    public function add_to_group($id, $group_name) {
        $query = $this->db->where('group_name', $group_name)->get('group');
        $group_info = $query->row_array();
        $group_id = $group_info['id'];
        $group = array('group_id' => $group_id);
        $this->db->where('id', $id)->update('users', $group);
    }

    /*
     * Get the unconfirmed users.
     *
     */
    public function get_unconfirmed() {
        $query = $this->db->where('confirmed', false)->where('activated', true)->get('users');
        return $query->result_array();
    }

    /*
     * Generate a token for the user.
     */
    public function generate_token($mail) {
        $user_info = $this->get_user_by_email($mail);
        $token = md5($user_info['mail'] . $user_info['password'] . time());
        return $token;
    }

    /*
     * Get the token of the user.
     */
    public function get_token($mail) {
        $query = $this->get_user_by_email($mail);
        return $query['token'];
    }
    /*
     * Set a token for a new user.
     */
    public function set_token($mail) {
        $token = $this->generate_token($mail);
        $this->db->where('mail', $mail)->update('users', array('token' => $token));
    }

    /*
     * Activate a user and clear the token after activating.
     * ====argument====
     * $token, the token in the link.
     *
     * =====return=====
     * A string indicating the status of the activation.
     */
    public function activate($token) {
        if (!$token) {
            return '激活码不存在。';
        } else {
            $query = $this->db->where('token', $token)->get('users');
            if ($query->num_rows() == 0) {
                return '激活码无效或已失效。';
            } else {
                $this->db->where('token', $token)->update('users', array('activated' => true));
                $this->db->where('token', $token)->update('users', array('token' => '0'));
                return '激活成功！';
            }
        }
    }
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */
