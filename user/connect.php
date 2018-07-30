<?php
/**
 * QQ互联
**/
include("../includes/common.php");
exit('暂停此操作');
require_once(SYSTEM_ROOT."QC.conf.php");
require_once(SYSTEM_ROOT."QC.class.php");


$QC=new QC($QC_config);

if($_GET['code']){
	$access_token=$QC->qq_callback();
	$openid=$QC->get_openid($access_token);

	$userrow=$DB->query("SELECT * FROM mzf_user WHERE qq_uid='{$openid}' limit 1")->fetch();
	if($userrow){
		$pid=$user;
		$key=$userrow['pwd'];
		if($islogin2==1){
			@header('Content-Type: text/html; charset=UTF-8');
			exit("<script language='javascript'>alert('当前QQ已绑定用户名:{$user}，请勿重复绑定！');window.location.href='./';</script>");
		}
		$session=md5($user.$pass.$password_hash);
		$expiretime=time()+604800;
		$token=authcode("{$user}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
		setcookie("user_token", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>window.location.href='./';</script>");
	}elseif($islogin2==1){
		$sds=$DB->exec("update `mzf_user` set `qq_uid` ='$openid' where `id`='$pid'");
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('已成功绑定QQ！');window.location.href='./';</script>");
	}else{
		$_SESSION['Oauth_qq_uid']=$openid;
		exit("<script language='javascript'>alert('请输入您要绑定的账号密码');window.location.href='./login.php?connect=true';</script>");
	}
}elseif($islogin2==1 && isset($_GET['unbind'])){
	$DB->exec("update `mzf_user` set `qq_uid` =NULL where `user`='$user'");
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功解绑QQ！');window.location.href='./';</script>");
}elseif($islogin2==1 && !isset($_GET['bind'])){
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}else{
	$QC->qq_login();
}
