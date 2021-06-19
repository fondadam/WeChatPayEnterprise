<?php
/**
 *作者：誓言
 *日期：2020-12-21
 */
/**
 * 关于微信企业付款的说明
 * 1.微信企业付款要求必传证书，需要到https://pay.weixin.qq.com 账户中心->账户设置->API安全->下载证书，证书路径在第204行和207行修改
 * 2.错误码参照 ：https://pay.weixin.qq.com/wiki/doc/api/tools/mch_pay.php?chapter=14_2
 */
header('Content-type:text/html; Charset=utf-8');
require_once 'WeChatPayEnterprise.php';
$mchid = 'xxxxx';          //微信支付商户号 PartnerID 通过微信支付商户资料审核后邮件发送
$appid = 'xxxxx';  //微信支付申请对应的公众号的APPID
$appKey = 'xxxxx';   //微信支付申请对应的公众号的APP Key
$apiKey = 'xxxxx';   //https://pay.weixin.qq.com 帐户设置-安全设置-API安全-API密钥-设置API密钥
//①、获取当前访问页面的用户openid（如果给指定用户转账，则直接填写指定用户的openid)
$wxPay = new WeChatPayEnterprise($mchid,$appid,$appKey,$apiKey);
$openId = $wxPay->GetOpenid();      //获取openid
if(!$openId) exit('获取openid失败');
//②、付款
$outTradeNo = uniqid();     //订单号
$payAmount = 1;             //转账金额，单位:元。转账最小金额为1元
$trueName = '张三';         //收款人真实姓名
$result = $wxPay->createJsBizPackage($openId,$payAmount,$outTradeNo,$trueName);
echo 'success';