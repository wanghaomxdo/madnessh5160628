<!--WeChat Autho
====================================================== -->
<?php
session_start();

$_SESSION['url'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
     if(!isset($_SESSION["openid"]) && !isset($_SESSION["headimgurl"]) && !isset($_SESSION["nickname"]))
     {
         include_once 'weChat/weChatAutho.php';
     }else
     {
         // userinfo
         // echo 'openid:'.$_SESSION['openid'] . '<br />';
         // echo 'headimgurl:'.$_SESSION['headimgurl'] . '<br />';
         // echo 'nickname:'.$_SESSION['nickname'] . '<br />';
     }
// for debug
//$_SESSION['openid'] = 'o1zitjlK5QY7rH113wDe2f96ThUtO';
//$_SESSION['headimgurl'] = 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLBUibh2dXOLU3DkiblnVLNCfOb6D6ViawSD8mtPSFl86lVg59cdSIZ7u40lBLPr3ibvVc1xynrpn2U2UQ/0';
//$_SESSION['nickname'] = 'coton_chen';

?>
<!DOCTYPE html>
<html lang="en">
<!-- <html lang="en" manifest="app.appcache"> -->
<head>
    <meta charset="UTF-8">
    <title>Madness</title>

    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=640, user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no">
</head>
<body>
<input name="button" type="button" value="add admin" style="width: 300px;height: 300px;font-size: 50px;" onclick="javascript:addadmin()">
<script src="js/zepto/zepto.min.js"></script>
<script src="js/admin.js"></script>
<script>
    var $OPENID = "<?php echo $_SESSION['openid'] ?>";
    var $NICKNAME = "<?php echo $_SESSION['nickname'] ?>";
    var $HEADIMGURL = "<?php echo $_SESSION['headimgurl'] ?>";
</script>
</body>
</html>