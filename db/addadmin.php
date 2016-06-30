<?php

session_start();

// for debug use $_GET["param"]
// http://localhost/madness-app-html5/db/adduse.php?name=Dayang&email=969196087@qq.com&phone=13564137185&whoyouare=1&lookingforshmadness=1&targetdate=0101
//$openid            = $_GET['openid'];
// $name           = $_GET['name'];
// $email           = $_GET['email'];
// $phone          = $_GET['phone'];
// $whoyouare          = $_GET['whoyouare'];
// $lookingforshmadness       = $_GET['lookingforshmadness'];
// $adate          = $_GET['adate'];



include_once 'connect.php';

// get POST parameters
// wechat user info from session
$openid            		= $_POST['openid'];
$nickname     			= $_POST['nickname'];
$headimgurl   			= $_SESSION['headimgurl'];

// operation time
$adate          		= date("Y-m-d H:i:s",time());

if ($stmt1 = $mysqli->prepare("INSERT INTO admin (openid, headimgurl, nickname) VALUES (?,?,?)")) {
    // Bind the variables to the parameter as strings.
    $stmt1->bind_param("sss", $openid, $headimgurl, $nickname);

    // Execute the statement.
    if($stmt1->execute()){
        //添加成功
        echo json_encode(array('code'=>0));
    }else{
        //添加失败
        echo json_encode(array('code'=>2));
    }
    // Close the prepared statement.
    $stmt1->close();

}else {
    echo json_encode(array('code' => 3));
}
?>
