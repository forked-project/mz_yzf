<?php
/**
 * Created by PhpStorm.
 * User: cghang
 * Date: 2018/7/27
 * Time: 9:10 PM
 */

include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='绑定商户';
include './head.php';
if($merchant){
    echo '<div id="content" class="app-content" role="main">
    <div class="app-content-body "><div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">商户管理</h1>
  <small class="text-muted">欢迎使用'.$conf['web_name'].'</small>
</div>
<div class="wrapper-md control"><div class="row">';
    showmsg('您已经绑定过商户了');
    echo '</div></div></div></div></div>';exit;
}
if($_POST['submit_bding'] && $_GET['act'] == 'bding'){
    $appid = $_POST['appid'];
    $appkey = $_POST['appkey'];
    $row = $DB->query("SELECT * FROM mzf_merchant WHERE id='{$appid}' limit 1")->fetch();
    //print_r($DB->errorInfo());exit;

    if(!$row){
        echo '<div id="content" class="app-content" role="main">
    <div class="app-content-body "><div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">商户管理</h1>
  <small class="text-muted">欢迎使用'.$conf['web_name'].'</small>
</div>
<div class="wrapper-md control"><div class="row">';
        showmsg('您的输入有误,请重试!',2);
        echo '</div></div></div></div></div>';exit;
    }
    if(!empty($row['uid'])){
        echo '<div id="content" class="app-content" role="main">
    <div class="app-content-body "><div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">商户管理</h1>
  <small class="text-muted">欢迎使用'.$conf['web_name'].'</small>
</div>
<div class="wrapper-md control"><div class="row">';
        showmsg('该商户号已经被他人绑定,请联系管理员!',2);
        echo '</div></div></div></div></div>';exit;
    }
    if($row['key'] != $appkey){
        echo '<div id="content" class="app-content" role="main">
    <div class="app-content-body "><div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">商户管理</h1>
  <small class="text-muted">欢迎使用'.$conf['web_name'].'</small>
</div>
<div class="wrapper-md control"><div class="row">';
        showmsg('您的输入有误,请重试!',2);
        echo '</div></div></div></div></div>';exit;
    }
    $sds = $DB->exec("update `mzf_merchant` set `uid` ='{$userrow['id']}' where `id`='$appid'");
    if($sds){
        echo '<div id="content" class="app-content" role="main">
    <div class="app-content-body "><div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">商户管理</h1>
  <small class="text-muted">欢迎使用'.$conf['web_name'].'</small>
</div>
<div class="wrapper-md control"><div class="row">';
        showmsg('恭喜您,绑定商户成功',2);
        echo '</div></div></div></div></div>';exit;
    }
}
echo '<div id="content" class="app-content" role="main">
    <div class="app-content-body "><div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">商户管理</h1>
  <small class="text-muted">欢迎使用'.$conf['web_name'].'</small>
</div>
<div class="wrapper-md control">
<!-- stats -->

      <div class="row"><div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">绑定已有商户</h3></div>';
echo '<div class="panel-body">';
echo '<form action="?act=bding" method="POST">
<div class="form-group">
<label>APPID:</label><br>
<input type="text" class="form-control" name="appid" value="" required>
</div>
<div class="form-group">
<label>APPKEY:</label><br>
<input type="text" class="form-control" name="appkey" value="" required>
</div>
<input type="submit" name="submit_bding" class="btn btn-primary btn-block"
value="确定绑定"></form>';
echo '</div></div></div></div></div></div>';

include "./foot.php";