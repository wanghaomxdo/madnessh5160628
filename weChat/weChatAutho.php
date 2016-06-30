<?php
    /*
     * 注意：
     * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
     * 2. 获取微信用户基本信息，用户在网页授权页同意授权给公众号后，微信会将授权数据传给一个回调页面，回调页面需在此域名下，以确保安全可靠。回调页面域名不支持IP地址。公众号开发者需要先登录微信公众平台进入“开发者中心”的“网页服务”下的“网页账号（网页授权获取用户基本信息）”里填写“授权回调页面域名”。
     * 3. 网页授权获取用户基本信息完整 JS-SDK 文档地址: http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html
     * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
     *
     * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
     * 邮箱地址：weixin-open@qq.com
     * 邮件主题：【微信JS-SDK反馈】具体问题
     * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
     */

    session_start();

    require_once "weChatId.php";
    
    if(!isset($_COOKIE["openid"]) && !isset($_SESSION["openid"]))
    {
        header("Location:weChat/autho.php"); 
    }else
    {
        $_SESSION['img'] =$_COOKIE['img'];
        $_SESSION['nickname'] =$_COOKIE['nickname'];
        $_SESSION['openid'] = $_COOKIE['openid'];
    }
?>