<?php 

	session_start();

	include_once 'connect.php';

	// params
	$openid         = $_POST['openid'];
	$data = array();
	
	if ($stmt = $mysqli->prepare("SELECT name, email, phone, id, numbers, paystatus FROM user WHERE openid=?")) {

            // Bind the variables to the parameter as strings.
            $stmt->bind_param("s", $openid);

            /* execute query */
            if($stmt->execute()){
            	/* bind result variables */
	            $stmt->bind_result($name,$email,$phone,$id,$numbers,$paystatus);
	
	            /* fetch value */
	            $stmt->fetch();
	
	            /* close statement */
	            $stmt->close();
	            // response json data
	            if(isset($phone)){
	            	$data                = array();
			        $data["code"]        = "0";
			        $data["numbers"]     = $numbers;
			        $data["name"]        = $name;
			        $data["email"]       = $email;
			        $data["phone"]       = $phone;
			        $data["Id"]          = $id;
					$data["paystatus"]   = $paystatus;
			        $json_data           = json_encode($data);
			        echo $json_data;
	            }else
					echo json_encode(array('code'=>2));
	            }else{
	            	echo json_encode(array('code'=>3));
            }
            
	}else
		echo json_encode(array('code'=>1));
?>