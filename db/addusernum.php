<?php 

	session_start();

	include_once 'connect.php';

	// params
	// for debug localhost/madnessh5160309/db/addusernum.php?openid=asdasd&numbers=W31P&outtradeno=&paystatus=0
	// $openid         =$_GET['openid'];
	// $numbers        =$_GET['numbers'];
	// $outtradeno     =$_GET['outtradeno'];
	// $paystatus      =$_GET['paystatus'];

	// params
	$openid         =$_POST['openid'];
	$numbers        =$_POST['numbers'];
	$outtradeno     =$_POST['outtradeno'];
	$paystatus      =$_POST['paystatus'];
	
	if ($stmt = $mysqli->prepare("SELECT phone FROM user WHERE openid=?")) {

            // Bind the variables to the parameter as strings.
            $stmt->bind_param("s", $openid);

            /* execute query */
            if($stmt->execute()){
	
			$stmt->bind_result($targetphone);

		    /* fetch values */
		    while ($stmt->fetch()) {
		        $targetphone+="";
		    }

	    	if(isset($targetphone))
	    	{
	            	if ($stmt1 = $mysqli->prepare("UPDATE user SET numbers=?, outtradeno=?, paystatus=? WHERE openid=?")) {
	
					    // Bind the variables to the parameter as strings.
					    $stmt1->bind_param("ssss", $numbers, $outtradeno, $paystatus, $openid);
			
					    // Execute the statement.
					    if($stmt1->execute()){
					    	echo json_encode(array('code'=>0,'lookingforshmadness'=>'Send Success'));
					    }else{
					    	echo json_encode(array('code'=>1,'lookingforshmadness'=>'Send Fail'));
					    }


					}else
						echo json_encode(array('code'=>2,'lookingforshmadness'=>'Send Fail'));
	            }else
					echo json_encode(array('code'=>3,'lookingforshmadness'=>'Send Fail'));
	        }else{
	        	echo json_encode(array('code'=>4,'lookingforshmadness'=>'Send Fail'));
	        }

            /* close statement */
            $stmt->close();

			/* close connection */
			$mysqli->close();
	}else
		echo json_encode(array('code'=>5,'lookingforshmadness'=>'Send Fail'));
	
?>