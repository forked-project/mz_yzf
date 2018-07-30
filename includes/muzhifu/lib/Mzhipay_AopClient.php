<?php
/**
 * Created by PhpStorm.
 * User: cghang
 * Date: 2018/7/17
 * Time: 3:20 PM
 */
class AopClient {
    //提交数组
    public $bizcontent;
    //网关
    public $gatewayUrl;
    //返回数据格式
    public $format = "json";
    //api版本
    public $apiVersion = "1.0";

    /**
     * @param string $gatewayUrl
     */
    public function setGatewayUrl($gatewayUrl)
    {
        $this->gatewayUrl = $gatewayUrl;
    }

    /**
     * @param mixed $bizcontent
     */
    public function setBizcontent($bizcontent = array())
    {
        $this->bizcontent = $bizcontent;
    }
    protected  function http($url, $post = 0, $referer = 0, $cookie = 0, $header = 0, $ua = 0, $nobaody = 0)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $klsf[] = "Accept:*";
        $klsf[] = "Accept-Encoding:gzip,deflate,sdch";
        $klsf[] = "Accept-Language:zh-CN,zh;q=0.8";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $klsf);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if ($header) {
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
        }
        if ($cookie) {
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }
        if ($referer) {
            if ($referer == 1) {
                curl_setopt($ch, CURLOPT_REFERER, "http://m.qzone.com/infocenter?g_f=");
            } else {
                curl_setopt($ch, CURLOPT_REFERER, $referer);
            }
        }
        if ($ua) {
            curl_setopt($ch, CURLOPT_pidAGENT, $ua);
        } else {
            curl_setopt($ch, CURLOPT_pidAGENT, ' Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36');
        }
        if ($nobaody) {
            curl_setopt($ch, CURLOPT_NOBODY, 1);//主要头部
            //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);//跟随重定向
        }
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret;

    }

    /**
     * @return string
     */
    public function begin()
    {
       //$data = array("appid"=>$appid,"appkey"=>$appkey,"access_token"=>$access_token,"skzh"=>$skzh,"skname"=>$skname,"money"=>$money);
       $url = $this->gatewayUrl;
       $http = $this->http($url,http_build_query($this->bizcontent));
       return $http;
    }
}