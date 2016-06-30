<?php

session_start();

include_once 'connect.php';

// params
$openid     =$_POST['openid'];
$numbers    =3;
if ($stmt = $mysqli->prepare("UPDATE user SET numbers=? WHERE openid=?")) {
// Bind the variables to the parameter as strings.
  $stmt->bind_param("ss", $numbers, $openid);

  // Execute the statement.
  if($stmt->execute()){
      echo json_encode(array('code'=>0,'lookingforshmadness'=>'Send Success'));
  }else{
      echo json_encode(array('code'=>1,'lookingforshmadness'=>'Send Fail'));
  }
}else
    echo json_encode(array('code'=>2,'lookingforshmadness'=>'Send Fail'));
/* close statement */
$stmt->close();
/* close connection */
$mysqli->close();

?>