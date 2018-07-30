<?php
include ("./includes/common.php");
$http_to = $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>开发文档 - <?=$conf['web_name']?> </title>
    <meta name="keywords" content="开发文档 - <?=$conf['web_name']?>">
    <meta name="description" content="开发文档 - <?=$conf['web_name']?>">
    <link rel="stylesheet" href="https://www.mzhipay.com/Public/qqlogin/Public/Welcome/css/app.css" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://www.mzhipay.com/Public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="https://www.mzhipay.com/Public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="https://www.mzhipay.com/Public/css/animate.min.css" rel="stylesheet">
    <link href="https://www.mzhipay.com/Public/css/style.min862f.css?v=4.1.0" rel="stylesheet">

</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="container">

        <!-- Docs nav
        ================================================== -->
        <div class="row">
            <div class="col-md-3 ">
                <div id="toc" class="bc-sidebar">
                    <ul class="nav">
                        <li class="toc-h2 toc-active"><a href="#toc0">支付接口介绍</a></li>
                        <li class="toc-h2"><a href="#toc1">接口申请方式</a></li>
                        <li class="toc-h2"><a href="#toc2">协议规则</a></li>
                        <hr/>
                        <li class="toc-h2"><a href="#api1">[API]查询商户信息</a></li>
                        <li class="toc-h2"><a href="#api2">[API]修改结算账号</a></li>
                        <li class="toc-h2"><a href="#api3">[API]查询结算记录</a></li>
                        <li class="toc-h2"><a href="#api4">[API]查询单个订单</a></li>
                        <li class="toc-h2"><a href="#api5">[API]批量查询订单</a></li>
                        <hr/>
                        <li class="toc-h2"><a href="#pay0">发起支付请求</a></li>
                        <li class="toc-h2"><a href="#pay1">支付结果通知</a></li>
                        <hr/>
                        <li class="toc-h2"><a href="#sdk0">SDK下载</a></li>
                        <hr/>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <article class="post page">
                    <section class="post-content">
                        <h2 id="toc0">支付接口介绍</h2>
                        <blockquote><p>使用此接口可以实现支付宝、QQ钱包、微信支付与财付通的即时到账，免签约，无需企业认证。</p></blockquote>
                        <p>本文阅读对象：商户系统（在线购物平台、人工收银系统、自动化智能收银系统或其他）集成支付涉及的技术架构师，研发工程师，测试工程师，系统运维工程师。</p>
                        <h2 id="toc1">接口申请方式</h2>
                        <p>共有两种接口模式：</p>
                        <p>（一）普通支付商户<br/>可以获得一个支付商户，在本站注册再去商户管理初始化商户即可！</p>
                        <p>（二）合作支付商户<br/>获得一个合作者身份TOKEN，可以集成到你开发的程序里面，通过接口无限申请普通支付商户，并且每个普通支付商户单独结算，相对独立</p>
                        <h2 id="toc2">协议规则</h2>
                        <p>传输方式：HTTP</p>
                        <p>数据格式：JSON</p>
                        <p>签名算法：MD5</p>
                        <p>字符编码：UTF-8</p>


                        <h2 id="api1">[API]查询商户信息与结算规则</h2>
                        <p>URL地址：<?=$http_to.$conf['local_domain']?>/api.php?act=query&pid={商户ID}&key={商户密钥}</p>
                        <p>请求参数说明：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>query</td><td>此API固定值</td></tr>
                            <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
                            <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
                            </tbody>
                        </table>
                        <p>返回结果：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
                            <tr><td>商户ID</td><td>pid</td><td>Int</td><td>1001</td><td>所创建的商户ID</td></tr>
                            <tr><td>商户密钥</td><td>key</td><td>String(32)</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td>所创建的商户密钥</td></tr>
                            <tr><td>商户类型</td><td>type</td><td>Int</td><td>1</td><td>此值暂无用</td></tr>
                            <tr><td>商户状态</td><td>active</td><td>Int</td><td>1</td><td>1为正常，0为封禁</td></tr>
                            <tr><td>商户余额</td><td>money</td><td>String</td><td>0.00</td><td>商户所拥有的余额</td></tr>
                            <tr><td>结算账号</td><td>account</td><td>String</td><td>pay@muzhifu.cc</td><td>结算的支付宝账号</td></tr>
                            <tr><td>结算姓名</td><td>username</td><td>String</td><td>张三</td><td>结算的支付宝姓名</td></tr>
                            <tr><td>满多少自动结算</td><td>settle_money</td><td>String</td><td>30</td><td>此值为系统预定义</td></tr>
                            <tr><td>手动结算手续费</td><td>settle_fee</td><td>String</td><td>1</td><td>此值为系统预定义</td></tr>
                            <tr><td>每笔订单分成比例</td><td>money_rate</td><td>String</td><td>98</td><td>此值为系统预定义</td></tr>
                            </tbody>
                        </table>

                        <h2 id="api2">[API]修改结算账号</h2>
                        <p>URL地址：<?=$http_to.$conf['local_domain']?>/api.php?act=change&pid={商户ID}&key={商户密钥}&skname={收款姓名}&skzh={收款账号}</p>
                        <p>请求参数说明：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>change</td><td>此API固定值</td></tr>
                            <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
                            <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
                            <tr><td>结算账号</td><td>account</td><td>是</td><td>String</td><td>pay@muzhifu.cc</td><td>结算的支付宝账号</td></tr>
                            <tr><td>结算姓名</td><td>username</td><td>是</td><td>String</td><td>张三</td><td>结算的支付宝姓名</td></tr>
                            </tbody>
                        </table>
                        <p>返回结果：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
                            <tr><td>返回信息</td><td>msg</td><td>String</td><td>修改收款账号成功！</td><td></td></tr>
                            </tbody>
                        </table>

                        <h2 id="api3">[API]查询结算记录</h2>
                        <p>URL地址：<?=$http_to.$conf['local_domain']?>/api.php?act=settle&pid={商户ID}&key={商户密钥}</p>
                        <p>请求参数说明：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>settle</td><td>此API固定值</td></tr>
                            <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
                            <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
                            </tbody>
                        </table>
                        <p>返回结果：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
                            <tr><td>返回信息</td><td>msg</td><td>String</td><td>查询结算记录成功！</td><td></td></tr>
                            <tr><td>结算记录</td><td>data</td><td>Array</td><td>结算记录列表</td><td></td></tr>
                            </tbody>
                        </table>

                        <h2 id="api4">[API]查询单个订单</h2>
                        <p>URL地址：<?=$http_to.$conf['local_domain']?>/api.php?act=order&pid={商户ID}&key={商户密钥}&out_trade_no={商户订单号}</p>
                        <p>请求参数说明：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>order</td><td>此API固定值</td></tr>
                            <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
                            <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
                            <tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td><td></td></tr>
                            </tbody>
                        </table>
                        <p>返回结果：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
                            <tr><td>返回信息</td><td>msg</td><td>String</td><td>查询订单号成功！</td><td></td></tr>
                            <tr><td>易支付订单号</td><td>trade_no</td><td>String</td><td>2016080622555342651</td><td>拇指付订单号</td></tr>
                            <tr><td>商户订单号</td><td>out_trade_no</td><td>String</td><td>20160806151343349</td><td>商户系统内部的订单号</td></tr>
                            <tr><td>支付方式</td><td>type</td><td>String</td><td>alipay</td><td>alipay:支付宝,tenpay:财付通,<br/>qqpay:QQ钱包,wxpay:微信支付</td></tr>
                            <tr><td>商户ID</td><td>pid</td><td>Int</td><td>1001</td><td>发起支付的商户ID</td></tr>
                            <tr><td>创建订单时间</td><td>addtime</td><td>String</td><td>2016-08-06 22:55:52</td><td></td></tr>
                            <tr><td>完成交易时间</td><td>endtime</td><td>String</td><td>2016-08-06 22:55:52</td><td></td></tr>
                            <tr><td>商品名称</td><td>name</td><td>String</td><td>VIP会员</td><td></td></tr>
                            <tr><td>商品金额</td><td>money</td><td>String</td><td>1.00</td><td></td></tr>
                            <tr><td>支付状态</td><td>status</td><td>Int</td><td>0</td><td>1为支付成功，0为未支付</td></tr>
                            </tbody>
                        </table>

                        <h2 id="api5">[API]批量查询订单</h2>
                        <p>URL地址：<?=$http_to.$conf['local_domain']?>/api.php?act=orders&pid={商户ID}&key={商户密钥}</p>
                        <p>请求参数说明：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>orders</td><td>此API固定值</td></tr>
                            <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
                            <tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr>
                            <tr><td>查询订单数量</td><td>limit</td><td>否</td><td>Int</td><td>20</td><td>返回的订单数量，最大50</td></tr>
                            </tbody>
                        </table>
                        <p>返回结果：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr>
                            <tr><td>返回信息</td><td>msg</td><td>String</td><td>查询结算记录成功！</td><td></td></tr>
                            <tr><td>订单列表</td><td>data</td><td>Array</td><td></td><td>订单列表</td></tr>
                            </tbody>
                        </table>
                        <hr/>

                        <h2 id="pay0">发起支付请求</h2>
                        <p>URL地址：<?=$http_to.$conf['local_domain']?>/submit.php?&pid={商户ID}&amp;type={支付方式}&amp;out_trade_no={商户订单号}&amp;notify_url={服务器异步通知地址}&amp;return_url={页面跳转通知地址}&amp;name={商品名称}&amp;money={金额}&amp;sitename={网站名称}&amp;sign={签名字符串}&amp;sign_type=MD5</p>
                        <p>请求参数说明：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
                            <tr><td>支付方式</td><td>type</td><td>是</td><td>String</td><td>alipay</td><td>alipay:支付宝,tenpay:财付通,<br/>qqpay:QQ钱包,wxpay:微信支付</td></tr>
                            <tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td><td></td></tr>
                            <tr><td>异步通知地址</td><td>notify_url</td><td>是</td><td>String</td><td>http://muzhifu.cc/notify_url.php</td><td>服务器异步通知地址</td></tr>
                            <tr><td>跳转通知地址</td><td>return_url</td><td>是</td><td>String</td><td>http://muzhifu.cc/return_url.php</td><td>页面跳转通知地址</td></tr>
                            <tr><td>商品名称</td><td>name</td><td>是</td><td>String</td><td>VIP会员</td><td></td></tr>
                            <tr><td>商品金额</td><td>money</td><td>是</td><td>String</td><td>1.00</td><td></td></tr>
                            <tr><td>网站名称</td><td>sitename</td><td>否</td><td>String</td><td>拇指付</td><td></td></tr>
                            <tr><td>签名字符串</td><td>sign</td><td>是</td><td>String</td><td>202cb962ac59075b964b07152d234b70</td><td>签名算法与<a href="https://doc.open.alipay.com/docs/doc.htm?treeId=62&articleId=104741&docType=1" target="_blank">支付宝签名算法</a>相同</td></tr>
                            <tr><td>签名类型</td><td>sign_type</td><td>是</td><td>String</td><td>MD5</td><td>默认为MD5</td></tr>
                            </tbody>
                        </table>

                        <h2 id="pay1">支付结果通知</h2>
                        <p>通知类型：服务器异步通知（notify_url）、页面跳转通知（return_url）</p>
                        <p>请求方式：GET</p>
                        <p>请求参数说明：</p>
                        <table class="table table-bordered table-hover">
                            <thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead>
                            <tbody>
                            <tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>1001</td><td></td></tr>
                            <tr><td>易支付订单号</td><td>trade_no</td><td>是</td><td>String</td><td>20160806151343349021</td><td>拇指付订单号</td></tr>
                            <tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td><td>商户系统内部的订单号</td></tr>
                            <tr><td>支付方式</td><td>type</td><td>是</td><td>String</td><td>alipay</td><td>alipay:支付宝,tenpay:财付通,<br/>qqpay:QQ钱包,wxpay:微信支付</td></tr>
                            <tr><td>商品名称</td><td>name</td><td>是</td><td>String</td><td>VIP会员</td><td></td></tr>
                            <tr><td>商品金额</td><td>money</td><td>是</td><td>String</td><td>1.00</td><td></td></tr>
                            <tr><td>支付状态</td><td>trade_status</td><td>是</td><td>String</td><td>TRADE_SUCCESS</td><td></td></tr>
                            <tr><td>签名字符串</td><td>sign</td><td>是</td><td>String</td><td>202cb962ac59075b964b07152d234b70</td><td>签名算法与<a href="https://doc.open.alipay.com/docs/doc.htm?treeId=62&articleId=104741&docType=1" target="_blank">支付宝签名算法</a>相同</td></tr>
                            <tr><td>签名类型</td><td>sign_type</td><td>是</td><td>String</td><td>MD5</td><td>默认为MD5</td></tr>
                            </tbody>
                        </table>
                        <hr/>
                        <h2 id="sdk0">SDK下载</h2>
                        <blockquote>
                            <a href="/download/SDK.zip" style="color:blue">Sdk.zip</a><br/>
                            SDK版本：V1.2
                        </blockquote>
                        <blockquote>
                            <a href="/download/Thinkphp_SDK.zip" style="color:blue">Thinkphp_SDK.zip</a><br/>
                            Thinkphp3.2.x版本-SDK版本：V1.0
                        </blockquote>
                    </section>
                </article>
            </div>
        </div>

    </div>
</div>
<script src="https://www.mzhipay.com/Public/js/jquery.min.js?v=2.1.4"></script>
<script src="https://www.mzhipay.com/Public/js/bootstrap.min.js?v=3.3.6"></script>
</body>


<!-- Mirrored from www.zi-han.net/theme/hplus/form_validate.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:16 GMT -->
</html>
