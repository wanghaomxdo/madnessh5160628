<?php

    session_start();

    include_once 'connect.php';

    // for debug use $_GET["param"]
    // http://localhost/madnessh5160309/db/getstatistical.php

    if ($stmt = $mysqli->prepare("SELECT count(*) FROM user")) {

        /* execute query */
        $stmt->execute();

        /* bind result variables */
        $stmt->bind_result($totalppl);

        /* fetch value */
        $stmt->fetch();

        // Display the data.
        printf("== registration/报名信息:<br>all register people /总报名人数: %s人", $totalppl);
        
        /* close statement */
        $stmt->close();
    }

    if ($stmt = $mysqli->prepare("SELECT count(*) FROM user WHERE paystatus=1")) {

        /* execute query */
        $stmt->execute();

        /* bind result variables */
        $stmt->bind_result($totalpplofonlinepaid);

        /* fetch value */
        $stmt->fetch();

        // Display the data.
        printf("<br>onlinepay/线上付: %s人", $totalpplofonlinepaid);

        /* close statement */
        $stmt->close();
    }

    if ($stmt = $mysqli->prepare("SELECT count(*) FROM user WHERE paystatus=3")) {

        /* execute query */
        $stmt->execute();

        /* bind result variables */
        $stmt->bind_result($totalpplofbelowlinepaid);

        /* fetch value */
        $stmt->fetch();

        // Display the data.
        printf("<br>offlinepay/线下付: %s人", $totalpplofbelowlinepaid);

        /* close statement */
        $stmt->close();
    }

    if ($stmt = $mysqli->prepare("SELECT count(*) FROM user WHERE paystatus=0")) {

        /* execute query */
        $stmt->execute();

        /* bind result variables */
        $stmt->bind_result($totalpplofnonpayment);

        /* fetch value */
        $stmt->fetch();

        // Display the data.
        printf("<br>nonpayment/未完成支付: %s人\n", $totalpplofnonpayment);

        /* close statement */
        $stmt->close();
    }
?>