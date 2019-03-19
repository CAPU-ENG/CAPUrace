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
     * Send mail of confirmation and invitation after money is received.
     * $subject and $invitation needs to be updated.
     */
    public function send_fee_received_and_invitation_mail($mail, $school, $fee, $association_name) {
        $subject = '第十六届全国高校自行车交流赛缴费确认及邀请函';
        $id = $this->ci->user->get_id($mail);
        $id_message='<br><br>贵高校本次比赛的ID是<b>' . $id . '</b>，请领队同学务必牢记，并在比赛签到时出示。<br><br>祝好！<br><br>北京大学自行车协会';
        $invitation_message = '
    <div style="background-image: url(\'https://s2.ax1x.com/2019/03/09/ASQKuF.md.jpg\'); background-size:100% 100%; width: 900px; height: 600px; z-index: -1; display: inline-block;">
     </div>
    <br><br><br>

    <div style="background-image: url(\'https://s2.ax1x.com/2019/03/09/ASQ4Ej.md.jpg\'); background-size:100% 100%; width: 900px; height: 600px; z-index: -1; display: inline-block;">
        <div style="position: relative; width: 600px; height: 400px; left: 300px; top: 100px;">
            <p style="font-size: 25px; font-weight: bold;">
                致 ' . $school . ' ' . $association_name . '：
            </p>
            <p style="font-size: 25px;">
                北京大学自行车协会将于5月4日、5日和6日分别在北京大学和河北廊坊市固安县永定河自行车公园举办“北大车协 · 第十六届全国高校自行车交流赛”。本届比赛由xxx举办，并得到了xxx的大力支持。<br>
                贵协作为全国知名的高校自行车运动社团，协会会员自行车运动水平优秀，学生素质高尚优良。我们诚挚邀请贵协参加“北大车协 · 第十六届全国高校自行车交流赛”， 以车会友，交流学习。
            </p>

            <p style="text-align: center; position: relative; left: 350px; width: 250px; font-size: 25px; font-weight: bold;">
                北京大学自行车协会<br>
                2018年4月
            </p>
            <img src="https://s2.ax1x.com/2019/03/09/ASQI5n.png" style="width: 150px; height: 50px;  position: relative; left: 400px; top: 0px;">
        </div>
    </div>
        ';
        $message = $school . '，<br><br>贵校车协交来的' . $fee . '元参赛费用已经收到，感谢你们对北大赛的大力支持！如有任何问题，请直接与各地区负责联系。' . $id_message.'<br><br><br>以下是第十六届全国高校自行车交流赛邀请函，可截图保存：<br><br>'.$invitation_message;
        $this->send_mail($mail, $subject, $message);
    }    
}
