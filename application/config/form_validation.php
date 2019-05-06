<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/26/15
 * Time: 19:38
 */
$config = array(
    'signup' => array(
        array(
            'field' => 'school',
            'label' => '学校',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'required|matches[passconf]|md5'
        ),
        array(
            'field' => 'passconf',
            'label' => '再次输入密码',
            'rules' => 'required|md5'
        ),
        array(
            'field' => 'mail',
            'label' => '电子邮箱',
            'rules' => 'trim|required|valid_email|is_unique[users.mail]|xss_clean'
        ),
        array(
            'field' => 'leader',
            'label' => '领队',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'tel',
            'label' => '联系电话',
            'rules' => 'required|exact_length[11]|xss_clean'
        ),
        array(
            'field' => 'association_name',
            'label' => '车协名称',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'province',
            'label' => '所在地区',
            'rules' => 'required|xss_clean'
        )
    ),
    'login' => array(
        array(
            'field' => 'mail',
            'label' => '电子邮箱',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'required|md5'
        )
    ),
    'forgetpw' => array(
        array(
            'field' => 'mail',
            'label' => '电子邮箱',
            'rules' => 'trim|required|valid_email|xss_clean'
        )
    ),
    'resetpw' => array(
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'required|matches[passconf]|md5'
        ),
        array(
            'field' => 'passconf',
            'label' => '再次输入密码',
            'rules' => 'required|md5'
        )
    )
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */
