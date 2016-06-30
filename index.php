<!--WeChat Autho
====================================================== -->
<?php
    session_start();

//     $_SESSION['url'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
//     if(!isset($_SESSION["openid"]) && !isset($_SESSION["headimgurl"]) && !isset($_SESSION["nickname"]))
//     {
//         include_once 'weChat/weChatAutho.php';
//     }else
//     {
//         // userinfo
//         // echo 'openid:'.$_SESSION['openid'] . '<br />';
//         // echo 'headimgurl:'.$_SESSION['headimgurl'] . '<br />';
//         // echo 'nickname:'.$_SESSION['nickname'] . '<br />';
//     }
    // for debug
    $_SESSION['openid'] = 'o1zitjlK5QY7rH113wDe2f96ThUtO';
    $_SESSION['headimgurl'] = 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLBUibh2dXOLU3DkiblnVLNCfOb6D6ViawSD8mtPSFl86lVg59cdSIZ7u40lBLPr3ibvVc1xynrpn2U2UQ/0';
    $_SESSION['nickname'] = 'coton_chen';

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
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="js/swiper/swiper.min.css">
    <link rel="stylesheet" href="js/swiper/animate.min.css">
</head>
<body>
<!-- loading -->
<div class="loader">
    <div class="l-7 ani"></div>
    <img class="l-6 ani" src="img/loading/e-1.jpg" alt="">
    <h1 class="l-5 in-1"></h1>
</div>
<!-- pagelist-->
<div class="swiper-container" id="swiper-container">
	<div id="mask" class="mask">
		<span id="jumpword">Send Success</span>
	</div> 
    <div class="swiper-wrapper">
        <div class="swiper-slide p1" id="swiper-slide">
            <img class="e1-bg" src="img/p1/bg.gif" alt="">
            <img class="e1-1 ani" src="img/transparent.png">
        </div>

        <div class="swiper-slide p2">
            <img class="e2-bg" src="img/p2/bg.png" alt="">
            <img class="e2-1" src="img/transparent.png" alt="">
            <div class="e2-3">
                <input name="name" type="text" class="in-1 e2-3-1" placeholder="">
            </div>
            <div class="e2-4">
                <input name="email" type="text" class="in-1 e2-3-2" placeholder="">
            </div>
            <div class="e2-5">
                <input name="phone" type="text" class="in-1 e2-3-3" placeholder="">
            </div>
            <select class="e2-6 in-1" id="whoyouare">
                <option value=""></option>
                <option value="1">Artist</option>
                <option value="2">Architect</option>
                <option value="3">Designer</option>
                <option value="4">Entrepreneur</option>
                <option value="5">Fashion Designer</option>
                <option value="6">Graphic Designer</option>
                <option value="7">Musician</option>
                <option value="8">Photographer</option>
                <option value="9">Other</option>
            </select>

            <select class="e2-7 in-1" id="lookingforshmadness">
                <option value=""></option>
                <option value="1">Find a creative agency</option>
                <option value="2">Find a creative job</option>
                <option value="3">Inspiring speakers</option>
                <option value="4">Just for fun</option>
                <option value="5">Other</option>
            </select>

            <select class="e2-8 in-1" id="payfor">
                <option value="1">pay for weichat</option>
                <option value="2">pay for off line</option>
            </select>
        </div>

        <div class="swiper-slide p3">
            <img class="e3-bg" src="img/p3/bg.png" alt="">
            <span class="e3-2 in-1" id="e3-2">123</span>
            <span class="e3-3 in-1" id="e3-3">123</span>
            <span class="e3-4 in-1" id="e3-4">123</span>
            <div class="e3-1" id="qrcode"></div>
        </div>


    </div>
</div>


<!--Script
====================================================== -->
<script src="js/zepto/zepto.min.js"></script>
<script src="js/motion/loader.min.js"></script>
<script src="js/swiper/swiper.min.js"></script>
<script src="js/swiper/swiper.animate1.0.2.min.js"></script>
<script src="js/fastclick/fastclick.js"></script>
<script src="js/motion/landscape.min.js"></script>
<!--<script src="js/motion/overlay.min.js"></script>-->
<script src="js/motion/film.min.js"></script>
<script src="js/qrcode/qrcode.min.js"></script>
<script src="js/app.js"></script>
<?php include_once 'weChat/weChatShareJS.php';?>
<script>
    var $OPENID = "<?php echo $_SESSION['openid'] ?>";
    var $NICKNAME = "<?php echo $_SESSION['nickname'] ?>";
    var $HEADIMGURL = "<?php echo $_SESSION['headimgurl'] ?>";
</script>
</body>
</html>