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
	
	$name            		= $_POST['name'];
	$email           		= $_POST['email'];
	$phone           		= $_POST['phone'];
	$whoyouare            	= $_POST['whoyouare'];
	$lookingforshmadness    = $_POST['lookingforshmadness'];
	
	// wechat user info from session
	$openid            		= $_POST['openid'];
	$nickname     			= $_POST['nickname'];
	$headimgurl   			= $_SESSION['headimgurl'];
	
	// operation time
	$adate          		= date("Y-m-d H:i:s",time());
	
	if ($stmt = $mysqli->prepare("SELECT phone FROM user WHERE openid=?")) {

            // Bind the variables to the parameter as strings.
            $stmt->bind_param("s", $openid);

            /* execute query */
            if($stmt->execute()){
            	/* bind result variables */
            	$stmt->bind_result($phones);
				
				/* fetch value */
	            $stmt->fetch();
	
	            // response json data
				
				if(isset($phones))
	            {
	            	echo json_encode(array('code'=>1,'lookingforshmadness'=>'Send Fail'));
	            }else{
					if ($stmt1 = $mysqli->prepare("INSERT INTO user (name, email, phone, whoyouare, lookingforshmadness, adate, openid, headimgurl, nickname) VALUES (?,?,?,?,?,?,?,?,?)")) {
	
					    // Bind the variables to the parameter as strings.
					    $stmt1->bind_param("sssssssss", $name, $email, $phone, $whoyouare, $lookingforshmadness, $adate, $openid, $headimgurl, $nickname);
			
					    // Execute the statement.
					    if($stmt1->execute()){
					    	echo json_encode(array('code'=>0,'lookingforshmadness'=>'Send Success'));
					    }else{
					    	echo json_encode(array('code'=>2,'lookingforshmadness'=>'Send Fail'));
					    }
					    // Close the prepared statement.
					    $stmt1->close();
					    
					}else{
						echo json_encode(array('code'=>3,'lookingforshmadness'=>'Send Fail'));
					}
				}
            }else{
            	echo json_encode(array('code'=>4,'lookingforshmadness'=>'Send Fail'));
            }
           /* close statement */
			$stmt->close(); 
	}
    else
    	echo json_encode(array('code'=>5,'lookingforshmadness'=>'Send Fail'));
    	
   	
       
?>
