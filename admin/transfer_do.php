<?php

include("../includes/common.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");


if(isset($_SESSION['access_token'])){}else exit('{"code":-1,"msg":"access_token未定义"}');

$id = isset($_POST['id'])?intval($_POST['id']):exit('{"code":-1,"msg":"ID不能为空"}');

$row=$DB->query("SELECT * FROM pay_settle WHERE id='{$id}' limit 1")->fetch();

if(!$row)exit('{"code":-1,"msg":"记录不存在"}');

if($row['type']!=1)exit('{"code":-1,"msg":"该记录不是支付宝结算"}');

if($row['transfer_status']==1)exit('{"code":0,"ret":2,"result":"支付宝转账单据号:'.$row['transfer_result'].' 支付时间:'.$row['transfer_date'].'"}');

$out_biz_no = date("Ymd").'111'.$id;

$BizContent = array(
    "out_biz_no" => $out_biz_no, //商户转账唯一订单号
    "appid" => $conf['appid'],  //拇指付appid
    "appkey" => $conf['appkey'],  //拇指付appkey
    "access_token" => $_SESSION['access_token'],  //拇指付用户access_token
    "skzh" => $row['account'], //收款方账户
    "skname" => $row['username'], //收款方真实姓名
    "money" => $row['money']    //转账金额
);
include("../includes/muzhifu/lib/Mzhipay_AopClient.php");
$aop = new AopClient();
$aop->setGatewayUrl("http://source.muzhifu.cc/Api/Ajax/transfer");
$aop->setBizcontent($BizContent);
$result = $aop->begin();
$result = json_decode($result,true);
//print_r($result);
if($result['code'] == 0){
$data['code']=0;
$data['ret']=$result['ret'];
$data['msg']=$result['msg'];
$data['result']=$result['result'];
$DB->exec("update `pay_settle` set `transfer_status`='1',`transfer_result`='".$data['result']."',`transfer_date`='".$date."' where `id`='$id'");
} elseif($result['code'] == 40004) {
$data['code']=0;
$data['ret']=$result['ret'];
$data['msg']=$result['msg'];
$data['result'] = $result['result'];
$DB->exec("update `pay_settle` set `transfer_status`='2',`transfer_result`='".$data['result']."' where `id`='$id'");
} elseif($result['code'] == -1) {
    $data['code']=-1;
    $data['ret']=$result['ret'];
    $data['msg']=$result['msg'];
    $data['result'] = $result['result'];
    $DB->exec("update `pay_settle` set `transfer_status`='2',`transfer_result`='".$data['result']."' where `id`='$id'");
} else {
$data['code']=-1;
    $data['ret']=$result['ret'];
    $data['msg']=$result['msg'];
    $data['result'] = $result['result'];
    $DB->exec("update `pay_settle` set `transfer_status`='2',`transfer_result`='".$data['result']."' where `id`='$id'");
}
echo json_encode($data);
