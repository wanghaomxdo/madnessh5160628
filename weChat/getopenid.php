<?php
    require_once "weChatId.php";

    session_start();
    $appid = $wAppid;  
    $secret = $wKey;  
    $code = $_GET["code"];  
    $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';

    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$get_token_url);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $res = curl_exec($ch);  
    curl_close($ch);  
    $json_obj = json_decode($res,true);  
      
    //根据openid和access_token查询用户信息  
    $access_token = $json_obj['access_token'];  
    $openid = $json_obj['openid'];  
    $get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';  
     
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$get_user_info_url);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $res = curl_exec($ch);  
    curl_close($ch);  
      
    $user_obj = json_decode($res,true);  

    //$_COOKIE["user"] = $openid;  
    $img = $user_obj['headimgurl'];
    $nickname = $user_obj['nickname'];
    $_SESSION['headimgurl'] =$user_obj['headimgurl'];
    $_SESSION['nickname'] =$user_obj['nickname'];
    $_SESSION['openid'] = $openid;
    
    setcookie("openid", $openid);
    setcookie("img", $user_obj['headimgurl']);
    setcookie("nickname", $user_obj['nickname']);
    
    $baseurl = str_replace('weChat/getopenid.php','index.php','http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]);
    header("Location:".$baseurl); 
?>
