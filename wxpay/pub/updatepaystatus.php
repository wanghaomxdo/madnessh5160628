<?php

    // get POST parameters
    $phone         = $data['attach'];
    $openid        = $data['openid'];
    $outtradeno    = $data['out_trade_no']."|".$data['transaction_id'];
    $paystatus     = 1; // 已支付

    $errormsg = "";
    if(isset($phone) && isset($openid) && isset($outtradeno))
    {

        if ($stmt = $mysqli->prepare("SELECT id, outtradeno FROM user WHERE openid = ? and phone=?")) {

            /* bind parameters for markers */
            $stmt->bind_param("ss", $openid, $phone);

            /* execute query */
            $stmt->execute();

            $stmt->bind_result($source_id, $source_outtradeno);

            /* fetch values */
            while ($stmt->fetch()) {
                 $source_id = $source_id;
                 $source_outtradeno = $source_outtradeno;
             }

            if(!isset($source_outtradeno) || $source_outtradeno === "")
            {
                $numbers = 1;

                if ($stmt = $mysqli->prepare("UPDATE user SET paystatus=?, outtradeno=? , numbers=? WHERE openid=? and phone=?")) {

                    // Bind the variables to the parameter as strings.
                    $stmt->bind_param("sssss", $paystatus, $outtradeno, $numbers, $openid, $phone);

                    // Execute the statement.
                    if($stmt->execute())
                        Log::DEBUG("notify to db: success! openid:".$openid);
                    else
                    {
                        $errormsg = '准备预执行T-SQL脚本发生错误！';
                    }


                }else
                {
                    $errormsg = '准备预执行T-SQL脚本发生错误！';
                }
            }else
                {
                    $errormsg = 'Payment status has been updated！';
                }
        }else
        {
            $errormsg = '准备预执行T-SQL脚本发生错误！';
        }

        /* close statement */
        $stmt->close();

    }else
    {
        $errormsg = '请求参数phone&outtradeno不能为空!';
    }

    if($errormsg !== "")
        Log::DEBUG("notify to db: fail! openid:".$openid.", description:".$errormsg);

    /* close connection */
    $mysqli->close();
?>
