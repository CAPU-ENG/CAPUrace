<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/28/15
 * Time: 11:15
 */

class User extends CI_Controller {

    /*
     * Construction for User Controller.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('cookie', 'form', 'url', 'html', 'lib'));
        $this->load->library(array('email', 'form_validation', 'session'));
        $this->load->model('user_model', 'user');
        $this->load->model('people_model', 'people');
        $this->load->model('team_model', 'team');
    }

    /*
     * The login page for users.
     */
    public function login() {

        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            if ($this->session->userdata('logged_in')) {
                redirect(base_url(), 'refresh');
            }

            $this->load->view('header_homepage');
            $this->load->view('add_hilight_nav2');
            $this->load->view('login_form');
            $this->load->view('footer');
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $login_info = $this->input->post();
            header('Content-Type: application/json');

            if ($this->form_validation->run('login') == false) {
                $err_code = '400';
                exit(err_msg($err_code));
            }

            $user_info = $this->user->get_user_by_email($login_info['mail']);

            if ($user_info == NULL) {
                $err_code = '204';
            } elseif (!$user_info['activated']) {
                $err_code = '201';
            } elseif (!$user_info['confirmed']) {
                $err_code = '202';
            } elseif ($login_info['password'] != $user_info['password']) {
                $err_code = '401';
            } else {
                $err_code = '200';
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata('id', $user_info['id']);
                $this->session->set_userdata('school', $user_info['school']);
                $this->session->set_userdata('editable', $user_info['editable']);
            }

            exit(err_msg($err_code));
        }
    }

    /*
     * Account logout.
     */
    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('school');
        redirect(base_url(), 'refresh');
    }

     public function signup() {

         date_default_timezone_set('PRC');

         if ($this->input->server('REQUEST_METHOD') == 'GET') {
             $this->load->view('header_homepage');
             $this->load->view('add_hilight_nav2');
             $this->load->view('signup_form');
             $this->load->view('footer');
         }

         if ($this->input->server('REQUEST_METHOD') == 'POST') {
             $data = $this->input->post();
             header('Content-Type: application/json');

             $signUpDeadline = strtotime($GLOBALS['SIGN_UP_DEADLINE']);
             if (time() > $signUpDeadline) exit(err_msg('205'));

             if ($this->form_validation->run('signup') == false) {
                 $err_code = '400';
             } else {
                 $err_code = '200';
                 unset($data['passconf']);
                 $token = $this->user->generate_token($data['mail']);
                 $data = array_merge($data, array('token' => $token));
                 $this->user->sign_up($data);
                 $this->email->send_account_confirm_mail($data['mail']);
             }

             exit(err_msg($err_code));
         }
     }

    /*
     * Show registration result for the user.
     */
    public function result() {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $school_id = $this->session->userdata('id');
            $data['editable'] = $this->session->userdata('editable');
            if ($school_id == "") {
                redirect(site_url('user/login'));
            }
            $data['individual'] = $this->people->get_people_from_school($school_id);
            $team = $this->team->get_team_from_school($school_id);
            foreach ($team as $key => $item) {
                $team[$key]['first'] = $this->people->get_name($item['first']);
                $team[$key]['second'] = $this->people->get_name($item['second']);
                $team[$key]['third'] = $this->people->get_name($item['third']);
                $team[$key]['fourth'] = $this->people->get_name($item['fourth']);
            }
            $data['team'] = $team;
            $data['userinfo'] = $this->user->get_user_by_id($school_id);
            $data['people_num'] = $this->user->campus_race_verify($school_id);
            $this->load->view('header_homepage');
            $this->load->view('user_result', $data);
            $this->load->view('footer');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $school_id = $this->session->userdata('id');
            $quota_results = $this->people->get_race_quota();
            $race_number = $this->people->get_race_number_by_school($school_id);

            if (!$quota_results['rdb_m_status'] && $race_number['rdb_m_num']) exit(err_msg('1104'));
            if (!$quota_results['rdb_f_status'] && $race_number['rdb_f_num']) exit(err_msg('1105'));
            if (!$quota_results['rdb_elite_status'] && $race_number['rdb_elite_num']) exit(err_msg('1106'));
            if (!$quota_results['race_m_status'] && $race_number['race_m_num']) exit(err_msg('1102'));
            if (!$quota_results['race_f_status'] && $race_number['race_f_num']) exit(err_msg('1103'));
            if (!$quota_results['race_elite_status'] && $race_number['race_elite_num']) exit(err_msg('1107'));
            $err_code = '200';
            exit(err_msg($err_code));
        }
    }

    public function freeze() {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
        $school_id = $this->session->userdata('id');
        $this->user->campus_race_verify($school_id);
        $this->user->freeze($school_id);
        $this->session->set_userdata('editable', 0);
        redirect(site_url('user/payment'));
        }
    }

    public function payment() {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            if ($this->session->userdata('editable')) {
                redirect(site_url('index'));
            }
            $school_id = $this->session->userdata('id');
            $userinfo = $this->user->get_user_by_id($school_id);
            $data['bill'] = $userinfo['bill'];
            $data['association_name'] = $userinfo['association_name'];
            $data['campusrace'] = $userinfo['campusrace'];
            $this->load->view('header_homepage');
            $this->load->view('user_payment', $data);
            $this->load->view('footer');
        }
    }

    /*
     * Activate the account.
     */
    public function activate() {
        $this->load->model('user_model', 'user');
        $token = $this->uri->segment(3);
        $this->load->view('activate_header');
        $status = $this->user->activate($token);
        $data = array('info' => '');
        if ($status == 0)
            $data['info'] = '激活成功！请等待北大车协同学线下联系，我们将于 24 小时内完成您的注册审核，审核通过之后车协同学将通知您。谢谢！';
        elseif ($status == 1)
            $data['info'] = '激活码无效或您已成功激活。';
        elseif ($status == 2)
            $data['info'] = '激活码不存在。';
        $this->load->view('activate_info', $data);
        $this->load->view('activate_footer');
    }

    /*
     * Export an Excel file containing all the information.
     */
    public function export() {
        date_default_timezone_set('PRC');
        if (! $this->session->userdata('logged_in')) {
            redirect(site_url('user/login'));
        }
        if ($this->session->userdata('editable')) {
            redirect(site_url('user/result'));
        }
        $school_id = $this->session->userdata('id');

        require_once(dirname('__FILE__') . '/Classes/PHPExcel.php');
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('北京大学自行车协会');
        $excel->getDefaultStyle()
            ->getNumberFormat()
            ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

        // There are 3 sheets in this file. Sheet 1 for school info, 2 for individuals, and 3 for team info.

        // Here comes sheet 1;
        $userinfo = $this->user->get_user_by_id($school_id);
        $filename = $userinfo['school'] . '.xlsx';
        $excel->setActiveSheetIndex(0)->setTitle('高校信息');
        $excel->getActiveSheet()
            ->setCellValue('A1', '学校ID')
            ->setCellValue('B1', '学校名称')
            ->setCellValue('C1', '车协名称')
            ->setCellValue('D1', '领队姓名')
            ->setCellValue('E1', '电子邮箱')
            ->setCellValue('F1', '手机号')
            ->setCellValue('G1', '邮寄地址')
            ->setCellValue('H1', '邮政编码')
            ->setCellValue('I1', '费用合计');
        $excel->getActiveSheet()
            ->setCellValue('A2', $userinfo['id'])
            ->setCellValue('B2', $userinfo['school'])
            ->setCellValue('C2', $userinfo['association_name'])
            ->setCellValue('D2', $userinfo['leader'])
            ->setCellValue('E2', $userinfo['mail'])
            ->setCellValue('F2', $userinfo['tel'])
            ->setCellValue('G2', $userinfo['address'])
            ->setCellValue('H2', $userinfo['zipcode'])
            ->setCellValue('I2', $userinfo['bill']);

        // Here comes sheet 2;
        $excel->createSheet(1);
        $excel->setActiveSheetIndex(1);
        $excel->getActiveSheet()->setTitle('人员信息');
        $individual_info = $this->people->get_people_from_school($school_id);
        $excel->getActiveSheet()
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '性别')
            ->setCellValue('D1', '手机号')
            ->setCellValue('E1', '证件类型')
            ->setCellValue('F1', '证件编号')
            ->setCellValue('G1', '男子山地大众')
            ->setCellValue('H1', '男子山地精英')
            ->setCellValue('I1', '女子山地')
            ->setCellValue('J1', '男子公路大众')
            ->setCellValue('K1', '男子公路精英')
            ->setCellValue('L1', '女子公路')
            ->setCellValue('M1', '团体赛')
            ->setCellValue('N1', '5.5午餐+晚餐')
            ->setCellValue('O1', '5.6午餐')
            ->setCellValue('P1', '清真')
            ->setCellValue('Q1', '费用');

        foreach ($individual_info as $key => $item) {
            $i = $key + 2;
            $excel->getActiveSheet()
                ->setCellValue('A' . $i, $item['order'] + 1)
                ->setCellValue('B' . $i, $item['name'])
                ->setCellValue('C' . $i, $GLOBALS['GENDER'][$item['gender']])
                ->setCellValue('D' . $i, $item['tel'])
                ->setCellValue('E' . $i, $GLOBALS['ID_TYPE'][$item['id_type']])
                ->setCellValue('F' . $i, $item['id_number'])
                ->setCellValue('G' . $i, $GLOBALS['JUDGE'][$item['race']])
                ->setCellValue('H' . $i, $GLOBALS['JUDGE'][$item['race_elite']])
                ->setCellValue('I' . $i, $GLOBALS['JUDGE'][$item['race_f']])
                ->setCellValue('J' . $i, $GLOBALS['JUDGE'][$item['rdb']])
                ->setCellValue('K' . $i, $GLOBALS['JUDGE'][$item['rdb_elite']])
                ->setCellValue('L' . $i, $GLOBALS['JUDGE'][$item['rdb_f']])
                ->setCellValue('M' . $i, $GLOBALS['JUDGE'][$item['ifteam']])
                ->setCellValue('N' . $i, $GLOBALS['JUDGE'][$item['dinner']])
                ->setCellValue('O' . $i, $GLOBALS['JUDGE'][$item['lunch']])
                ->setCellValue('P' . $i, $GLOBALS['JUDGE'][$item['islam']])
                ->setCellValue('Q' . $i, $item['fee']);
        }


        // Here comes sheet 3;
        $excel->createSheet(2);
        $excel->setActiveSheetIndex(2);
        $excel->getActiveSheet()->setTitle('团体赛信息');
        $excel->getActiveSheet()
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '第一棒')
            ->setCellValue('C1', '第二棒')
            ->setCellValue('D1', '第三棒')
            ->setCellValue('E1', '第四棒');

        $team_info = $this->team->get_team_from_school($school_id);

        foreach ($team_info as $key => $item) {
            $i = $key + 2;
            $excel->getActiveSheet()
                ->setCellValue('A' . $i, $item['order'])
                ->setCellValue('B' . $i, $this->people->get_name($item['first']))
                ->setCellValue('C' . $i, $this->people->get_name($item['second']))
                ->setCellValue('D' . $i, $this->people->get_name($item['third']))
                ->setCellValue('E' . $i, $this->people->get_name($item['fourth']));
        }


        // Wrap up the file.

        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    public function admin() {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $this->load->view('header_admin');
            $this->load->view('admin_auth');
            $this->load->view('footer_admin');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
            $username = $data['username'];
            $pass = $data['pass'];
            if ($GLOBALS['ADMIN'][$username] == $pass) {
                $this->session->set_userdata('admin_in', true);
                $this->session->set_userdata('admin_pass', $pass);
                $this->session->set_userdata('admin_id', $username);
                echo 0;
            } else {
                echo 1;
            }
        }
    }
}
