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
//    // for debug
    $_SESSION['openid'] = 'o1zitjlK5QY7rH113wDe2f96ThUtO';
    $_SESSION['headimgurl'] = 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLBUibh2dXOLU3DkiblnVLNCfOb6D6ViawSD8mtPSFl86lVg59cdSIZ7u40lBLPr3ibvVc1xynrpn2U2UQ/0';
    $_SESSION['nickname'] = 'coton_chen';


//ini_set('date.timezone','Asia/Shanghai');
////error_reporting(E_ERROR);
//require_once "wxpay/lib/WxPay.Api.php";
//require_once "wxpay/pub/WxPay.JsApiPay.php";
//require_once 'wxpay/pub/log.php';
////打印输出数组信息
////function printf_info($data)
////{
////    foreach($data as $key=>$value){
////        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
////    }
////}
//
//// for debug
//// http://localhost/molirunh5160303/wxpay/pub/pay.php?grouptype=1&name=coton&cardnumber=420682199101090014&phone=13564137185&packagetype=0
///*$jsApiParameters = '{"appId":"wxc6d26827fed8ccc6","nonceStr":"20kp5is34n5hsho45ewo8353yaekczwy","package":"prepay_id=wx20160304155852702e4032000011927921","signType":"MD5","timeStamp":"1457078332","paySign":"8F0E49A6C0641B4B1C46AEF920A359AC"}';*/
//
//
//$openid     = $_SESSION['openid'];
//$nickname   = $_SESSION['nickname'];
//
//// for debug
////$_SESSION['openid'] = 'o1zitjlK5QY7rH113wDe2f96ThUtO';
////    $_SESSION['headimgurl'] = 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLBUibh2dXOLU3DkiblnVLNCfOb6D6ViawSD8mtPSFl86lVg59cdSIZ7u40lBLPr3ibvVc1xynrpn2U2UQ/0';
////    $_SESSION['nickname'] = 'coton_chen';
//
//
////①、获取用户openid
//$tools       = new JsApiPay();
//$outtradeno  = WxPayConfig::MCHID.date("YmdHis");
//
////②、统一下单
//$input = new WxPayUnifiedOrder();
//$input->SetBody("Madness Entrance Fee");
//$input->SetAttach($nickname);
//$input->SetOut_trade_no($outtradeno);
//$input->SetTotal_fee("1");
//$input->SetTime_start(date("YmdHis"));
//$input->SetTime_expire(date("YmdHis", time() + 600));
//$input->SetGoods_tag("Madness Entrance Fee");
//$input->SetNotify_url("https://pay.wechat.createcdigital.com/madnessh5160628/wxpay/pub/notify.php");
//$input->SetTrade_type("JSAPI");
//$input->SetOpenid($openid);
//$order = WxPayApi::unifiedOrder($input);
//// echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
//// printf_info($order);
//$jsApiParameters = $tools->GetJsApiParameters($order);


//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
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
    <img class="l-6 ani" src="img/loading/e-1.png" alt="">
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
                <option value="1">WeChat Pay RSVP</option>
                <option value="2">Online RSVP, Pay Onsite</option>
            </select>
        </div>

        <div class="swiper-slide p3">
            <img class="e3-bg" src="img/p3/bg.png" alt="">
            <span class="e3-2 in-2" id="e3-2">123</span>
            <span class="e3-3 in-2" id="e3-3">123</span>
            <span class="e3-4 in-2" id="e3-4">123</span>
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
//    var $JSAPIPARAMETERS = <?php //echo $jsApiParameters; ?>//;
//    var $OUTTRADENO = "<?php //echo $outtradeno; ?>//";
</script>
</body>
</html>