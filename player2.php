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


include_once 'db/connect.php';

// params
$userid      = $_GET["id"];
if($stmt1 = $mysqli->prepare("SELECT id FROM admin WHERE openid=?")) {

    // Bind the variables to the parameter as strings.
    $stmt1->bind_param("s", $_SESSION['openid']);
    /* execute query */
    if ($stmt1->execute()) {
        /* bind result variables */
        $stmt1->bind_result($id);

        /* fetch value */
        $stmt1->fetch();
        $stmt1->close();
        // response json data
        if ($id == null || $id == 0) {
            $topurl='http://'.$_SERVER['SERVER_NAME'].'/madnessh5160628/';
            header("Location:".$topurl);
            exit();
        }else{
            if ($stmt = $mysqli->prepare("SELECT name, email, phone, id, numbers, paystatus FROM user WHERE openid=?")) {

                // Bind the variables to the parameter as strings.
                $stmt->bind_param("s", $userid);

                /* execute query */
                if($stmt->execute()){
                    /* bind result variables */
                    $stmt->bind_result($name,$email,$phone,$id,$numbers,$paystatus);

                    /* fetch value */
                    $stmt->fetch();

                    /* close statement */
                    $stmt->close();
                    // response json data
                }

            }
        }
    }
}
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
<span style="font-size: 50px;">
    <p>姓名：<?php echo $name ?></p>
    <p>电话：<?php echo $phone ?></p>
    <p>支付方式：<?php if($paystatus == 1){echo "微信已支付";}else{echo "线下未支付";} ?></p>
    <p>是否核销：<span id="ver"><?php if($numbers != 3){echo "未核销";}else {echo "已核销";}?></span></p>
</span>

<input name="button" type="button" value="核销" style="width: 200px;height: 100px;font-size: 50px;" onclick="javascript:findId()">
<script src="js/zepto/zepto.min.js"></script>
<script src="js/admin.js"></script>
<script>
    var $OPENID = "<?php echo $_SESSION['openid'] ?>";
    var $NICKNAME = "<?php echo $_SESSION['nickname'] ?>";
    var $HEADIMGURL = "<?php echo $_SESSION['headimgurl'] ?>";
    var $ID = "<?php echo $userid ?>";
</script>
</body>
</html>
