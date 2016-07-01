<?php
session_start();
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//打印输出数组信息
//function printf_info($data)
//{
//    foreach($data as $key=>$value){
//        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
//    }
//}

// for debug
// http://localhost/molirunh5160303/wxpay/pub/pay.php?grouptype=1&name=coton&cardnumber=420682199101090014&phone=13564137185&packagetype=0
 /*$jsApiParameters = '{"appId":"wxc6d26827fed8ccc6","nonceStr":"20kp5is34n5hsho45ewo8353yaekczwy","package":"prepay_id=wx20160304155852702e4032000011927921","signType":"MD5","timeStamp":"1457078332","paySign":"8F0E49A6C0641B4B1C46AEF920A359AC"}';*/


$openid     = $_SESSION['openid'];
$nickname   = $_SESSION['nickname'];
$name       = $_GET['name'];
$email      = $_GET['email'];
$phone      = $_GET["phone"];
// for debug
//$_SESSION['openid'] = 'o1zitjlK5QY7rH113wDe2f96ThUtO';
//    $_SESSION['headimgurl'] = 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLBUibh2dXOLU3DkiblnVLNCfOb6D6ViawSD8mtPSFl86lVg59cdSIZ7u40lBLPr3ibvVc1xynrpn2U2UQ/0';
//    $_SESSION['nickname'] = 'coton_chen';


//①、获取用户openid
$tools       = new JsApiPay();
$outtradeno  = WxPayConfig::MCHID.date("YmdHis");

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("Madness Entrance Fee");
$input->SetAttach($phone);
$input->SetOut_trade_no($outtradeno);
$input->SetTotal_fee("15000");
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("Madness Entrance Fee");
$input->SetNotify_url("https://pay.wechat.createcdigital.com/madnessh5160628/wxpay/pub/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openid);
$order = WxPayApi::unifiedOrder($input);
// echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
// printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);


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
    <title>Madness</title>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=640, user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="../../css/app.css">
    <link rel="stylesheet" href="../../js/swiper/swiper.min.css">
    <link rel="stylesheet" href="../../js/swiper/animate.min.css">

</head>
<body>

<!-- pagelist-->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide p4">
            <img class="e4-bg" src="../../img/p4/bg.jpg" alt="">
            <img class="e4-1 ani" src="../../img/transparent.png">
            <img class="e4-2 op" src="../../img/p4/e-1.png">
            <img class="e4-3 op" src="../../img/p4/e-1.png">
            <img class="e4-4 ani" src="../../img/transparent.png">
            <img class="e4-5 ani" src="../../img/transparent.png">
            <span class="e4-6 in-1" id="e4-6"><?php echo $_GET['name']; ?></span>
            <span class="e4-7 in-1" id="e4-7"><?php echo $_GET['email']; ?></span>
            <span class="e4-8 in-1" id="e4-8"><?php echo $_GET['phone']; ?></span>
            <!--效果html开始-->
            <main class="loaded1">
                <div>
                    <div class="pacman">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </main>
        </div>

        <div class="swiper-slide p5">
            <img class="e5-bg" src="../../img/p5/bg.jpg" alt="">
            <div class="e5-1" id="qrcode"></div>
            <!--效果html开始-->
            <main class="loaded">
                <div>
                    <div class="pacman">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<!--Script
====================================================== -->
<script src="../../js/zepto/zepto.min.js"></script>
<script src="../../js/motion/loader.min.js"></script>
<script src="../../js/swiper/swiper.min.js"></script>
<script src="../../js/swiper/swiper.animate1.0.2.min.js"></script>
<script src="../../js/swiper/swiper.min.js"></script>
<script src="../../js/fastclick/fastclick.js"></script>
<script src="../../js/motion/landscape.min.js"></script>
<script src="../../js/motion/overlay.min.js"></script>
<script src="../../js/qrcode/qrcode.min.js"></script>
<?php include_once '../../weChat/weChatShareJS.php';?>
<script type="text/javascript">
    $JSAPIPARAMETERS = <?php echo $jsApiParameters; ?>;
    var $OPENID = "<?php echo $openid; ?>";
    var $NICKNAME = "<?php echo $nickname; ?>";
    var $OUTTRADENO = "<?php echo $outtradeno; ?>";
    var $OPENID = "<?php echo $_SESSION['openid'] ?>";
</script>
<script src="../../js/pay.js"></script>
</body>
</html>
