<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/style.css" rel="stylesheet">
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/jquery.md5.js"></script>
<script src="/assets/js/jquery.cookie.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/race.js"></script>
</head>
<body>
<div class="index-container">
  <div class="top">
      <div class="logo"></div>
      <div class="topr"> </div>
  </div>

  <nav class="navbar navbar-default" style="margin-top: 254px; width: 1000px">
    <div class="container-fluid">

      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">CAPURACE</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active" id="nav1"><a href="<?=base_url()?>">首页</a></li>
          <li id="nav2"><a href="<?=site_url('registration')?>">报名</a></li>
          <li id="nav3"><a href="<?=site_url('index/race_info')?>">赛事专题</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php if ($this->session->userdata('logged_in')): ?>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              欢迎你，<?=$this->session->userdata('school')?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">修改资料</a></li>
              <li class="divider"></li>
              <li><a href="<?=site_url('user/logout')?>">注销</a></li>
            </ul>
          </li>
          <?php else: ?>
          <li id="nav4"><a href="<?=site_url('user/login')?>">登录</a></li>
          <li id="nav5"><a href="<?=site_url('user/signup')?>">注册</a></li>
          <?php endif; ?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

