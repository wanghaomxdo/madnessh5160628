<?php
    require_once "jssdk.php";
    $jssdk = new JSSDK($wAppid, $wKey);
    $signPackage = $jssdk->GetSignPackage();
 ?>