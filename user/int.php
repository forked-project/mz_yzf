<?php
/**
 * Created by PhpStorm.
 * User: cghang
 * Date: 2018/7/16
 * Time: 1:40 AM
 */
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='初始化商户';
include './head.php';
if($merchant){
    echo '<div id="content" class="app-content" role="main">
    <div class="app-content-body "><div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">商户管理</h1>
  <small class="text-muted">欢迎使用'.$conf['web_name'].'</small>
</div>
<div class="wrapper-md control"><div class="row">';
    showmsg('您已经初始化过商户了');
    echo '</div></div></div></div></div>';
}
if($_POST['submit_int'] && $_GET['act'] == 'int'){
    $key = random(32);
    $account = $_POST['account'];
    $url=$_POST['url'];
    $username = $_POST['username'];
    $settle_id = $_POST['settle_id'];
    $sds=$DB->exec("INSERT INTO `mzf_merchant` (`key`, `account`, `username`, `money`, `url`, `addtime`, `type`, `active`, `settle_id`,`uid`) VALUES ('{$key}', '{$account}', '{$username}', '0', '{$url}', '{$date}', '0', '1', '{$settle_id}','{$userrow['id']}')");
    $pid=$DB->lastInsertId();
    if($sds){
        echo '<div id="content" class="app-content" role="main">
    <div class="app-content-body "><div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">商户管理</h1>
  <small class="text-muted">欢迎使用'.$conf['web_name'].'</small>
</div>
<div class="wrapper-md control"><div class="row">';
        showmsg('恭喜您,初始化商户数据成功',2);
        echo '</div></div></div></div></div>';
    }
}

echo '<div id="content" class="app-content" role="main">
    <div class="app-content-body "><div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">商户管理</h1>
  <small class="text-muted">欢迎使用'.$conf['web_name'].'</small>
</div>
<div class="wrapper-md control">
<!-- stats -->
<div class="alert alert-info alert-dismissable">
        <a class="alert-link" href="./merchant_bding.php"> 系统升级,已有商户请点击这里绑定</a></div>
      <div class="row"><div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">初始化商户</h3></div>';
echo '<div class="panel-body">';
echo '<form action="?act=int" method="POST">
<div class="form-group">
<label>结算方式:</label><br><select class="form-control" name="settle_id">
'.($conf['stype_1']?'<option value="1">支付宝</option>':null).'
'.($conf['stype_2']?'<option value="2">微信</option>':null).'
'.($conf['stype_3']?'<option value="3">QQ钱包</option>':null).'
'.($conf['stype_4']?'<option value="4">银行卡</option>':null).'
</select>
</div>
<div class="form-group">
<label>结算账号:</label><br>
<input type="text" class="form-control" name="account" value="" required>
</div>
<div class="form-group">
<label>结算账号姓名:</label><br>
<input type="text" class="form-control" name="username" value="" required>
</div>
<div class="form-group">
<label>网站域名:</label><br>
<input type="text" class="form-control" name="url" value="" placeholder="可留空">
</div>
<input type="submit" name="submit_int" class="btn btn-primary btn-block"
value="确定添加"></form>';
echo '</div></div></div></div></div></div>';

include "./foot.php";