<?php
$clientip=real_ip();

if(isset($_COOKIE["admin_token"]))
{
	$token=authcode(daddslashes($_COOKIE['admin_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session=md5($conf['admin_user'].$conf['admin_pwd'].$password_hash);
	if($session==$sid) {
		$islogin=1;
	}
}
if(isset($_COOKIE["user_token"]))
{
	$token=authcode(daddslashes($_COOKIE['user_token']), 'DECODE', SYS_KEY);
	list($user, $sid, $expiretime) = explode("\t", $token);
	$userrow=$DB->query("SELECT * FROM mzf_user WHERE user='{$user}' limit 1")->fetch();
	$merchant=$DB->query("SELECT * FROM mzf_merchant WHERE uid='{$userrow['id']}' limit 1")->fetch();
	$pid = $merchant['id'];
	$session=md5($userrow['user'].$userrow['pwd'].$password_hash);
	if($session==$sid && $expiretime>time()) {
		$islogin2=1;
	}
}
?>