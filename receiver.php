<?php

    // Database
    include("config/config.php");


    // check
    {
        if (!isset($_GET['d']))
        {
            return;
        }
    }

    // split
    $devData = explode('•', $_GET['d']);


    $x = strtotime($dateResult) + 10;
    // save
    {
        $sql = "
            update device_tbl set
                dev_status = '" . $devData[1] . "',
                dev_lastupdate = '" . $x . "'
            where
                dev_id = '" . $devData[0] . "'
        ";
        $rsInsert = mysqli_query($connection, $sql);
    }
?>