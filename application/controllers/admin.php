<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'lib'));
        $this->load->model('people_model', 'people');
        $this->load->model('team_model', 'team');
        $this->load->model('user_model', 'user');

        if (! $this->session->userdata('admin_in')) {
            redirect(site_url('user/admin'));
        }
    }

    public function index() {
        $this->load->view('header_admin');
        $this->load->view('footer_admin');
    }
    
    public function registering() {
        $this->load->view('header_admin');
        $data['registering'] = $this->user->get_registering();
        $this->load->view('admin_registering', $data);
        $this->load->view('footer_admin');
    }

    public function unactivated() {
        $this->load->view('header_admin');
        $data['unactivated'] = $this->user->get_unactivated();
        $this->load->view('admin_unactivated', $data);
        $this->load->view('footer_admin');
    }
    
    public function pay() {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $data['payment'] = $this->user->get_verified();
            $this->load->view('header_admin');
            $this->load->view('admin_pay', $data);
            $this->load->view('footer_admin');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            header('Content-Type: application/json');
            if ($this->session->userdata('admin_pass') != $GLOBALS['ACCOUNTANT_PASS']) {
                $response = array(
                    'code' => '1',
                    'msg' => '您没有操作权限!'
                );
            } else {
                $data = $this->input->post();
                $this->user->set_paid($data['id']);
                $response = array(
                    'code' => '0',
                    'msg' => '操作成功!'
                );
            }
            exit(json_encode($response));
        }
    }

    public function confirm() {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $data['unconfirmed'] = $this->user->get_unconfirmed();
            $this->load->view('header_admin');
            $this->load->view('admin_confirm', $data);
            $this->load->view('footer_admin');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
            $this->user->confirm($data['id']);
            echo 0;
        }
    }

    public function lookup() {
        $school_id = $this->uri->segment(3);
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
        $this->load->view('header_admin');
        $this->load->view('admin_lookup', $data);
        $this->load->view('footer_admin');
    }

    public function logout() {
        $this->session->unset_userdata('admin_in');
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_pass');
        redirect(site_url('user/admin'));
    }

    public function info() {
        $data['nschools'] = $this->db->query('select count(*) as nschools from users where activated=1 and confirmed=1;')->result_array()[0]['nschools'];
        $data['nverified'] = $this->db->query('select count(*) as nverified from users where editable=0 and activated=1 and confirmed=1;')->result_array()[0]['nverified'];
        $data['npaid'] = $this->db->query('select count(*) as npaid from users where paid=1;')->result_array()[0]['npaid'];
        $data['nlook'] = $this->db->query('select count(*) as nlook from people where deleted=0 and ifrace=0;')->result_array()[0]['nlook'];
        $data['nrace'] = $this->db->query('select count(*) as nrace from people where deleted=0 and ifrace=1;')->result_array()[0]['nrace'];
        $data['nmale'] = $this->db->query('select count(*) as nmale from people where deleted=0 and ifrace=1 and race=1;')->result_array()[0]['nmale'];
        $data['nmale_expert'] = $this->db->query('select count(*) as nmale_expert from people where deleted=0 and ifrace=1 and race=2;')->result_array()[0]['nmale_expert'];
        $data['nfemale'] = $this->db->query('select count(*) as nfemale from people where deleted=0 and ifrace=1 and race=3;')->result_array()[0]['nfemale'];
        $data['nteams'] = $this->db->query('select count(*) as nteams from team where deleted=0;')->result_array()[0]['nteams'];
        $accommodation = $this->db->query('select count(*) as live from people where deleted=0 group by accommodation;')->result_array();
        if (empty($accommodation[1])) {
            $data['hotel'] = 0;
        } else {
            $data['hotel'] = $accommodation[1]['live'];
        }
        if (empty($accommodation[2])) {
            $data['tent'] = 0;
        } else {
            $data['tent'] = $accommodation[2]['live'];
        }
        $data['dinner'] = $this->db->query('select count(*) as dinner from people where deleted=0 and dinner=1;')->result_array()[0]['dinner'];
        $data['lunch'] = $this->db->query('select count(*) as lunch from people where deleted=0 and lunch=1;')->result_array()[0]['lunch'];

        $this->load->view('header_admin');
        $this->load->view('admin_info', $data);
        $this->load->view('footer_admin');
    }

    public function _fill_individual($excel, $data) {
        $excel->getActiveSheet()
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '性别')
            ->setCellValue('D1', '身份证号')
            ->setCellValue('E1', '组别')
            ->setCellValue('F1', '协会名称')
            ->setCellValue('G1', '学校')
            ->setCellValue('H1', '地区')
            ->setCellValue('I1', '邮政编码')
            ->setCellValue('J1', '手机号');
        $race = $GLOBALS['CAPURACE'];
        $i = 2;
        foreach ($data as $key => $item) {
            $school = $this->user->get_user_by_id($item['school_id']);
            if (! $school['paid']) {
                continue;
            }
            $excel->getActiveSheet()
                ->setCellValue('A' . $i, $i - 1)
                ->setCellValue('B' . $i, $item['name'])
                ->setCellValue('C' . $i, $GLOBALS['GENDER'][$item['gender']])
                ->setCellValue('D' . $i, "'" . $item['id_card'])
                ->setCellValue('E' . $i, $race[$item['race']])
                ->setCellValue('F' . $i, $school['association_name'])
                ->setCellValue('G' . $i, $school['school'])
                ->setCellValue('H' . $i, $GLOBALS['PROVINCES_SHORT'][$school['province']])
                ->setCellValue('I' . $i, $school['zipcode'])
                ->setCellValue('J' . $i, "'" . $item['tel']);
            $i++;
        }
    }

    /*
     * Export an excel including all the information.
     */
    public function export() {

        date_default_timezone_set('PRC');
        if (! $this->session->userdata('admin_in')) {
            redirect(site_url('user/admin'));
        }
        require_once(dirname('__FILE__') . '/Classes/PHPExcel.php');
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('北京大学自行车协会');
        $excel->getDefaultStyle()
            ->getNumberFormat()
            ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $filename = '第十四届全国高校山地车交流赛总表' . '.xlsx';

        // Sheet 1: the information of all paid users.
        $excel->setActiveSheetIndex(0)->setTitle('高校信息');
        $excel->getActiveSheet()
            ->setCellValue('A1', '学校名称')
            ->setCellValue('B1', '车协名称')
            ->setCellValue('C1', '领队姓名')
            ->setCellValue('D1', '电子邮箱')
            ->setCellValue('E1', '手机号')
            ->setCellValue('F1', '邮寄地址')
            ->setCellValue('G1', '邮政编码')
            ->setCellValue('H1', '费用合计');

        $users = $this->user->get_paid();
        foreach ($users as $key => $item) {
            $i = $key + 2;
            $excel->getActiveSheet()
                ->setCellValue('A' . $i, $item['school'])
                ->setCellValue('B' . $i, $item['association_name'])
                ->setCellValue('C' . $i, $item['leader'])
                ->setCellValue('D' . $i, $item['mail'])
                ->setCellValue('E' . $i, "'" . $item['tel'])
                ->setCellValue('F' . $i, $item['address'])
                ->setCellValue('G' . $i, $item['zipcode'])
                ->setCellValue('H' . $i, $item['bill']);
        }

        // Sheet 2: 男子大众组
        $excel->createSheet(1);
        $excel->setActiveSheetIndex(1)->setTitle('男子大众组');
        $male = $this->db->where('deleted', 0)->where('race', 1)->get('people')->result_array();
        $this->_fill_individual($excel, $male);


        // Sheet 3: 男子精英组
        $excel->createSheet(2);
        $excel->setActiveSheetIndex(2)->setTitle('男子精英组');
        $male_expert = $this->db->where('deleted', 0)->where('race', 2)->get('people')->result_array();
        $this->_fill_individual($excel, $male_expert);
        
        // Sheet 4: 女子组
        $excel->createSheet(3);
        $excel->setActiveSheetIndex(3)->setTitle('女子组');
        $female = $this->db->where('deleted', 0)->where('race', 3)->get('people')->result_array();
        $this->_fill_individual($excel, $female);


        // Sheet 5: 住宿表
        $excel->createSheet(4);
        $excel->setActiveSheetIndex(4)->setTitle('住宿总表');
        $live = $this->db->where('deleted', 0)->where('accommodation != 0')
            ->order_by('gender', 'asc')->order_by('accommodation', 'asc')
            ->order_by('school_id', 'asc')->get('people')->result_array();
        $excel->getActiveSheet()
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '性别')
            ->setCellValue('D1', '身份证号')
            ->setCellValue('E1', '学校')
            ->setCellValue('F1', '手机号')
            ->setCellValue('G1', '住宿类型');
        $i = 2;
        foreach ($live as $key => $item) {
            $school = $this->user->get_user_by_id($item['school_id']);
            if (! $school['paid']) {
                continue;
            }
            $excel->getActiveSheet()
                ->setCellValue('A' . $i, $i - 1)
                ->setCellValue('B' . $i, $item['name'])
                ->setCellValue('C' . $i, $GLOBALS['GENDER'][$item['gender']])
                ->setCellValue('D' . $i, "'" . $item['id_card'])
                ->setCellValue('E' . $i, $school['school'])
                ->setCellValue('F' . $i, $item['tel'])
                ->setCellValue('G' . $i, $GLOBALS['ACCOMMODATION'][$item['accommodation']]);
            $i++;
        }

        // Sheet 6: 晚餐表
        $excel->createSheet(5);
        $excel->setActiveSheetIndex(5)->setTitle('第一天晚餐表');
        $dinner = $this->db->where('deleted', 0)->where('dinner', 1)->order_by('school_id', 'asc')->get('people')->result_array();
        $excel->getActiveSheet()
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '学校')
            ->setCellValue('D1', '手机号')
            ->setCellValue('E1', '清真');
        $i = 2;
        foreach ($dinner as $key => $item) {
            $school = $this->user->get_user_by_id($item['school_id']);
            if (! $school['paid']) {
                continue;
            }
            $excel->getActiveSheet()
                ->setCellValue('A' . $i, $i - 1)
                ->setCellValue('B' . $i, $item['name'])
                ->setCellValue('C' . $i, $school['school'])
                ->setCellValue('D' . $i, $item['tel'])
                ->setCellValue('E' . $i, $GLOBALS['JUDGE'][$item['islam']]);
            $i++;
        }



        // Sheet 7: 午餐表
        $excel->createSheet(6);
        $excel->setActiveSheetIndex(6)->setTitle('第二天午餐表');
        $lunch = $this->db->where('deleted', 0)->where('lunch', 1)->order_by('school_id', 'asc')->get('people')->result_array();
        $excel->getActiveSheet()
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '学校')
            ->setCellValue('D1', '手机号')
            ->setCellValue('E1', '清真');
        $i = 2;
        foreach ($lunch as $key => $item) {
            $school = $this->user->get_user_by_id($item['school_id']);
            if (! $school['paid']) {
                continue;
            }
            $excel->getActiveSheet()
                ->setCellValue('A' . $i, $i - 1)
                ->setCellValue('B' . $i, $item['name'])
                ->setCellValue('C' . $i, $school['school'])
                ->setCellValue('D' . $i, $item['tel'])
                ->setCellValue('E' . $i, $GLOBALS['JUDGE'][$item['islam']]);
            $i++;
        }


        // Sheet 8: 团体赛表
        $excel->createSheet(7);
        $excel->setActiveSheetIndex(7)->setTitle('团体赛表');
        $teams = $this->db->where('deleted', 0)->get('team')->result_array();
        $excel->getActiveSheet()
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '性别')
            ->setCellValue('D1', '身份证号')
            ->setCellValue('E1', '组别')
            ->setCellValue('F1', '协会名称')
            ->setCellValue('G1', '学校')
            ->setCellValue('H1', '地区')
            ->setCellValue('I1', '邮政编码')
            ->setCellValue('J1', '手机号');
        $i = 2;
        foreach ($teams as $key => $item) {
            $school = $this->user->get_user_by_id($item['school_id']);
            if (! $school['paid']) {
                continue;
            }
            $excel->getActiveSheet()->mergeCells('A' . $i . ':A' . ($i + 3));
            $excel->getActiveSheet()->setCellValue('A' . $i, $key + 1);
            $this->_fill_ind_in_team($excel, $item['first'], $i, $school);
            $this->_fill_ind_in_team($excel, $item['second'], $i + 1, $school);
            $this->_fill_ind_in_team($excel, $item['third'], $i + 2, $school);
            $this->_fill_ind_in_team($excel, $item['fourth'], $i + 3, $school);
            $i += 4;
        }

        // ============================================================
        // Wrap up the file.

        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('php://output');
        redirect(site_url('admin'));
    }

    public function _fill_ind_in_team($excel, $key, $i, $school) {
        $ind = $this->db->where('team_key', $key)->where('deleted', 0)->get('people')->row_array();
        $excel->getActiveSheet()
            ->setCellValue('B' . $i, $ind['name'])
            ->setCellValue('C' . $i, $GLOBALS['GENDER'][$ind['gender']])
            ->setCellValue('D' . $i, "'" . $ind['id_card'])
            ->setCellValue('E' . $i, '团体赛')
            ->setCellValue('F' . $i, $school['association_name'])
            ->setCellValue('G' . $i, $school['school'])
            ->setCellValue('H' . $i, $GLOBALS['PROVINCES'][$school['province']])
            ->setCellValue('I' . $i, $school['zipcode'])
            ->setCellValue('J' . $i, $ind['tel']);
    }

    public function shutdown() {
        header('Content-Type: application/json');
        if ($this->session->userdata('admin_pass') != $GLOBALS['PRESIDENT_PASS']) {
            $response = array(
                'code' => '1',
                'msg' => '您没有操作权限!'
            );
        } else {
            $this->user->freeze_all();
            $response = array(
                'code' => '0',
                'msg' => '报名系统已经成功关闭！'
            );
        }
        exit(json_encode($response));
    }
}
