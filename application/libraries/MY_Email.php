<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Email extends CI_Email
{

    var $from_mail;

    /*
     * Construction function for My_Email.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci =& get_instance();

        $this->ci->config->load('email');
        $this->from_mail = $this->ci->config->item('smtp_user');
        $this->mail_host = $this->ci->config->item('smtp_host');
        $this->mail_pass = $this->ci->config->item('smtp_pass');
        $this->ci->load->helper(array('url'));
        $this->ci->load->model('user_model', 'user');
    }

    /*
     * This is the base function for all mail sending actions.
     */
    public function send_mail(
        $to_mail,
        $subject,
        $message,
        $customOptions = array()
    ) {
        date_default_timezone_set('PRC');
        $defaultOptions = array(
            'from_mail' => $this->from_mail,
            'from_name' => '北京大学自行车协会'
        );
        $mail_config = array(
            'protocol' => 'smtp',
            'smtp_user' => $this->from_mail,
            'smtp_host' => $this->mail_host,
            'smtp_pass' => $this->mail_pass
        );
        $options = array_merge($defaultOptions, $customOptions);
        $from_mail = $options['from_mail'];
        $from_name = $options['from_name'];
        
        $this->initialize($mail_config);
        $this->set_mailtype('html');
        $this->from($from_mail, $from_name);
        $this->reply_to('beidachexie@126.com', $from_name);
        $this->to($to_mail);
        $this->subject($subject);
        $this->message($message);
        $this->send();
    }

    /*
     * Send account confirmation email.
     */
    public function send_account_confirm_mail($mail) {
        $subject = '第十六届全国高校自行车交流赛帐户确认（含ID）';
        $token = $this->ci->user->get_token($mail);
        $link = site_url('user/activate') . '/' . $token;
        $id = $this->ci->user->get_id($mail);
        $id_message='<br><br>贵高校本次比赛的ID是<b>' . $id . '</b>，请领队同学务必牢记，并在比赛签到时出示。<br><br>祝好！<br><br>北京大学自行车协会';
        $message = '请点击以下链接激活帐户' . $link . $id_message;
        $this->send_mail($mail, $subject, $message);
    }

    /*
     * Send mail after money is received.
     */
    public function send_fee_received_mail($mail, $school, $fee) {
        $subject = '第十六届全国高校自行车交流赛缴费确认';
        $id = $this->ci->user->get_id($mail);
        $id_message='<br><br>贵高校本次比赛的ID是<b>' . $id . '</b>，请领队同学务必牢记，并在比赛签到时出示。<br><br>祝好！<br><br>北京大学自行车协会';
        $message = $school . '，<br><br>贵校车协交来的' . $fee . '元参赛费用已经收到，感谢你们对北大赛的大力支持！如有任何问题，请直接与各地区负责联系。' . $id_message;
        $this->send_mail($mail, $subject, $message);
    }
}
