<?php

    // Database
    include("../config/config.php");

    // check
    if (!isset($_GET['mode'])) {
        echo json_encode(array("status" => "error", "message" => "Mode Error"));
        exit();
    }


    /*
        $last_id = mysqli_insert_id($connection);
    */




    /*
        ======================================
        MODES
        ======================================
    */
    // 10 - Cabinet Add
    // ---------------------------------------
    if ($_GET['mode'] == '10')
    {
        // check inputs
        {
            if (!isset($_POST['cName']) || ctype_space($_POST['cName']) || strlen($_POST['cName']) < 4)
            {
                // result
                ResultJSON("error", "Check your input1.");
                exit();
            }

            if (!isset($_POST['cOwner']) || ctype_space($_POST['cOwner']) || strlen($_POST['cOwner']) < 4)
            {
                // result
                ResultJSON("error", "Check your input2.");
                exit();
            }

            if (!isset($_POST['cArea']))
            {
                // result
                ResultJSON("error", "Check your input3.");
                exit();
            }

            if (!isset($_POST['cDevice']) || ctype_space($_POST['cDevice']) || strlen($_POST['cDevice']) < 4)
            {
                // result
                ResultJSON("error", "Check your input4.");
                exit();
            }

            if (!isset($_POST['cTriggerTemp']) || ctype_space($_POST['cTriggerTemp']) || !is_numeric($_POST['cTriggerTemp']) || $_POST['cTriggerTemp'] < 1 || $_POST['cTriggerTemp'] > 100)
            {
                // result
                ResultJSON("error", "Check your input1.");
                exit();
            }

            if (!isset($_POST['cTriggerHumi']) || ctype_space($_POST['cTriggerHumi']) || !is_numeric($_POST['cTriggerHumi']) || $_POST['cTriggerHumi'] < 1 || $_POST['cTriggerHumi'] > 100)
            {
                // result
                ResultJSON("error", "Check your input2.");
                exit();
            }

            if (!isset($_POST['cTriggerVibX']) || ctype_space($_POST['cTriggerVibX']) || !is_numeric($_POST['cTriggerVibX']) || $_POST['cTriggerVibX'] < 1 || $_POST['cTriggerVibX'] > 100)
            {
                // result
                ResultJSON("error", "Check your input6.");
                exit();
            }

            if (!isset($_POST['cTriggerVibY']) || ctype_space($_POST['cTriggerVibY']) || !is_numeric($_POST['cTriggerVibY']) || $_POST['cTriggerVibY'] < 1 || $_POST['cTriggerVibY'] > 100)
            {
                // result
                ResultJSON("error", "Check your input7.");
                exit();
            }

            if (!isset($_POST['cTriggerVibZ']) || ctype_space($_POST['cTriggerVibZ']) || !is_numeric($_POST['cTriggerVibZ']) || $_POST['cTriggerVibZ'] < 1 || $_POST['cTriggerVibZ'] > 100)
            {
                // result
                ResultJSON("error", "Check your input8.");
                exit();
            }

            if (!isset($_POST['cTriggerCurrent1']) || ctype_space($_POST['cTriggerCurrent1']) || !is_numeric($_POST['cTriggerCurrent1']) || $_POST['cTriggerCurrent1'] < 1 || $_POST['cTriggerCurrent1'] > 100)
            {
                // result
                ResultJSON("error", "Check your input9.");
                exit();
            }

            if (!isset($_POST['cTriggerCurrent2']) || ctype_space($_POST['cTriggerCurrent2']) || !is_numeric($_POST['cTriggerCurrent2']) || $_POST['cTriggerCurrent2'] < 1 || $_POST['cTriggerCurrent2'] > 100)
            {
                // result
                ResultJSON("error", "Check your input9.");
                exit();
            }

            if (!isset($_POST['cTriggerCurrent3']) || ctype_space($_POST['cTriggerCurrent3']) || !is_numeric($_POST['cTriggerCurrent3']) || $_POST['cTriggerCurrent3'] < 1 || $_POST['cTriggerCurrent3'] > 100)
            {
                // result
                ResultJSON("error", "Check your input9.");
                exit();
            }
        }

        // save
        {
            $sql = "
                insert into cabinet_tbl
                    (
                        cabinet_name,
                        cabinet_area,
                        cabinet_oic,
                        cabinet_deviceid,
                        cabinet_trigger_temp,
                        cabinet_trigger_humi,
                        cabinet_trigger_vibx,
                        cabinet_trigger_viby,
                        cabinet_trigger_vibz,
                        cabinet_trigger_current,
                        cabinet_trigger_current2,
                        cabinet_trigger_current3
                    )
                values
                    (
                        '" . $_POST['cName'] . "',
                        '" . $_POST['cArea'] . "', 
                        '" . $_POST['cOwner'] . "', 
                        '" . $_POST['cDevice'] . "', 
                        '" . $_POST['cTriggerTemp'] . "',
                        '" . $_POST['cTriggerHumi'] . "',
                        '" . $_POST['cTriggerVibX'] . "',
                        '" . $_POST['cTriggerVibY'] . "',
                        '" . $_POST['cTriggerVibZ'] . "',
                        '" . $_POST['cTriggerCurrent1'] . "',
                        '" . $_POST['cTriggerCurrent2'] . "',
                        '" . $_POST['cTriggerCurrent3'] . "'
                    )
            ";
            $rsInsert = mysqli_query($connection, $sql);
        }
        
        // result
        ResultJSON("ok", "New Machine details and device successfully added.");
    }

    // 11 - Cabinet Update
    // ---------------------------------------
    if ($_GET['mode'] == '11')
    {
        // check inputs
        {
            if (!isset($_GET['id']) || ctype_space($_GET['id']))
            {
                // result
                ResultJSON("error", "Motor id is invalid.");
                exit();
            }

            if (!isset($_POST['cName']) || ctype_space($_POST['cName']) || strlen($_POST['cName']) < 4)
            {
                // result
                ResultJSON("error", "Check your input.");
                exit();
            }

            if (!isset($_POST['cOwner']) || ctype_space($_POST['cOwner']) || strlen($_POST['cOwner']) < 4)
            {
                // result
                ResultJSON("error", "Check your input.");
                exit();
            }

            if (!isset($_POST['cArea']))
            {
                // result
                ResultJSON("error", "Check your input.");
                exit();
            }

            if (!isset($_POST['cDevice']) || ctype_space($_POST['cDevice']) || strlen($_POST['cDevice']) < 4)
            {
                // result
                ResultJSON("error", "Check your input.");
                exit();
            }

            if (!isset($_POST['cTriggerTemp']) || ctype_space($_POST['cTriggerTemp']) || !is_numeric($_POST['cTriggerTemp']) || $_POST['cTriggerTemp'] < 1 || $_POST['cTriggerTemp'] > 100)
            {
                // result
                ResultJSON("error", "Check your input1.");
                exit();
            }

            if (!isset($_POST['cTriggerHumi']) || ctype_space($_POST['cTriggerHumi']) || !is_numeric($_POST['cTriggerHumi']) || $_POST['cTriggerHumi'] < 1 || $_POST['cTriggerHumi'] > 100)
            {
                // result
                ResultJSON("error", "Check your input2.");
                exit();
            }

            if (!isset($_POST['cTriggerVibX']) || ctype_space($_POST['cTriggerVibX']) || !is_numeric($_POST['cTriggerVibX']) || $_POST['cTriggerVibX'] < 1 || $_POST['cTriggerVibX'] > 100)
            {
                // result
                ResultJSON("error", "Check your input6.");
                exit();
            }

            if (!isset($_POST['cTriggerVibY']) || ctype_space($_POST['cTriggerVibY']) || !is_numeric($_POST['cTriggerVibY']) || $_POST['cTriggerVibY'] < 1 || $_POST['cTriggerVibY'] > 100)
            {
                // result
                ResultJSON("error", "Check your input7.");
                exit();
            }

            if (!isset($_POST['cTriggerVibZ']) || ctype_space($_POST['cTriggerVibZ']) || !is_numeric($_POST['cTriggerVibZ']) || $_POST['cTriggerVibZ'] < 1 || $_POST['cTriggerVibZ'] > 100)
            {
                // result
                ResultJSON("error", "Check your input8.");
                exit();
            }

            if (!isset($_POST['cTriggerCurrent1']) || ctype_space($_POST['cTriggerCurrent1']) || !is_numeric($_POST['cTriggerCurrent1']) || $_POST['cTriggerCurrent1'] < 1 || $_POST['cTriggerCurrent1'] > 100)
            {
                // result
                ResultJSON("error", "Check your input9.");
                exit();
            }

            if (!isset($_POST['cTriggerCurrent2']) || ctype_space($_POST['cTriggerCurrent2']) || !is_numeric($_POST['cTriggerCurrent2']) || $_POST['cTriggerCurrent2'] < 1 || $_POST['cTriggerCurrent2'] > 100)
            {
                // result
                ResultJSON("error", "Check your input10.");
                exit();
            }

            if (!isset($_POST['cTriggerCurrent3']) || ctype_space($_POST['cTriggerCurrent3']) || !is_numeric($_POST['cTriggerCurrent3']) || $_POST['cTriggerCurrent3'] < 1 || $_POST['cTriggerCurrent3'] > 100)
            {
                // result
                ResultJSON("error", "Check your input11.");
                exit();
            }
        }

        // save
        {
            $sql = "
                update cabinet_tbl set
                    cabinet_name = '" . $_POST['cName'] . "',
                    cabinet_area = '" . $_POST['cArea'] . "',
                    cabinet_oic = '" . $_POST['cOwner'] . "',
                    cabinet_deviceid = '" . $_POST['cDevice'] . "',
                    cabinet_trigger_temp = '" . $_POST['cTriggerTemp'] . "',
                    cabinet_trigger_humi = '" . $_POST['cTriggerHumi'] . "',
                    cabinet_trigger_vibx = '" . $_POST['cTriggerVibX'] . "',
                    cabinet_trigger_viby = '" . $_POST['cTriggerVibY'] . "',
                    cabinet_trigger_vibz = '" . $_POST['cTriggerVibZ'] . "',
                    cabinet_trigger_current = '" . $_POST['cTriggerCurrent1'] . "',
                    cabinet_trigger_current2 = '" . $_POST['cTriggerCurrent2'] . "',
                    cabinet_trigger_current3 = '" . $_POST['cTriggerCurrent3'] . "'
                where id = '" . $_GET['id'] . "'
            ";
            $rsUpdate = mysqli_query($connection, $sql);
        }
        
        // result
        ResultJSON("ok", "Machine details and device successfully updated.");
    }

    // 12 - Cabinet Delete
    // ---------------------------------------
    if ($_GET['mode'] == '12')
    {
        // check inputs
        {
            if (!isset($_GET['id']) || ctype_space($_GET['id']))
            {
                // result
                ResultJSON("error", "Motor id is invalid.");
                exit();
            }
        }

        // save
        {
            $sql = "
                delete from cabinet_tbl
                where id = '" . $_GET['id'] . "'
            ";
            $rsDelete = mysqli_query($connection, $sql);
        }

        // result
        ResultJSON("ok", "Motor details and device successfully removed.");
    }


    // 20 - Cabinet Info - All
    // ---------------------------------------
    if ($_GET['mode'] == '20')
    {
        // Search Mode $_GET['a']
        // 0 - all
        // # - area id

        // Search Mode
        if ($_GET['a'] == "0")
        {
            $sql = "select * from device_tbl";
        }
        else
        {
            $sql = "select * from device_tbl where area_id = '" . $_GET['a'] . "'";
        }

        // fetch cabinet
        {
            $rowCabinet = array();
            $rsCabinet = mysqli_query($connection, $sql);
            $rsCabinetRowCount = mysqli_num_rows($rsCabinet);
            if ($rsCabinetRowCount > 0)
            {
                while ($rowsCabinet = mysqli_fetch_object($rsCabinet))
                {
                    $rowsCabinet->timeNow = strtotime($dateResult);
                    $rowCabinet['cabinet_info'][] = $rowsCabinet;
                }
            }
            else
            {
                // result
                ResultJSON("error", "N2 Cabinet data is invalid.");
                exit();
            }
        }

        // result
        ResultJSON("ok", "success", $rowCabinet);
        exit();
    }

    // 21 - Cabinet Info - Specific by ID
    // ---------------------------------------
    if ($_GET['mode'] == '21')
    {
        // check inputs
        {
            if (!isset($_GET['id']) || ctype_space($_GET['id']))
            {
                // result
                ResultJSON("error", "N2 Cabinet id is invalid.");
                exit();
            }
        }

        // fetch cabinet
        {
            $rowCabinet = array();
            $sql = "select * from cabinet_tbl where id = '" . $_GET['id'] . "'";
            $rsCabinet = mysqli_query($connection, $sql);
            $rsCabinetRowCount = mysqli_num_rows($rsCabinet);
            if ($rsCabinetRowCount > 0)
            {
                while ($rowsCabinet = mysqli_fetch_object($rsCabinet))
                {
                    $rowCabinet['cabinet_info'][] = $rowsCabinet;
                }
            }
            else
            {
                // result
                ResultJSON("error", "N2 Cabinet data is invalid.");
                exit();
            }
        }

        // fetch data
        {
            $sql = "select * from data_tbl where cabinet_id = '" . $_GET['id'] . "' limit 20";
            $rsCabinetData = mysqli_query($connection, $sql);
            $rsCabinetDataRowCount = mysqli_num_rows($rsCabinetData);
            if ($rsCabinetDataRowCount > 0)
            {
                while ($rowsCabinetData = mysqli_fetch_object($rsCabinetData))
                {
                    $newData = ["date" => explode(' ', $rowsCabinetData->data_date)[1], "value1" => (float)$rowsCabinetData->data_current, "value2" => (float)$rowsCabinetData->data_current2, "value3" => (float)$rowsCabinetData->data_current3];
                    $rowCabinet['cabinet_data'][] = $newData;
                }
            }
            else
            {
                $rowCabinet['cabinet_data'] = new stdClass();
            }
        }

        // result
        ResultJSON("ok", "success", $rowCabinet);
        exit();
    }

    // 22 - Cabinet Info - Update Data
    // ---------------------------------------
    if ($_GET['mode'] == '22')
    {
        // check inputs
        {
            // device
            if (!isset($_GET['did']) || ctype_space($_GET['did']))
            {
                // result
                ResultJSON("error", "Device id is missing.");
                exit();
            }

            // current 1
            if (!isset($_GET['dCur1']) || ctype_space($_GET['dCur1']))
            {
                // result
                ResultJSON("error", "Device Current is invalid. reading 1: " . $_GET['dCur1']);
                exit();
            }

            // current 2 
            if (!isset($_GET['dCur2']) || ctype_space($_GET['dCur2']))
            {
                // result
                ResultJSON("error", "Device Current is invalid. reading 2: " . $_GET['dCur2']);
                exit();
            }

            // current 3
            if (!isset($_GET['dCur3']) || ctype_space($_GET['dCur3']))
            {
                // result
                ResultJSON("error", "Device Current is invalid. reading 3: " . $_GET['dCur3']);
                exit();
            }

            /*
            // vib x
            if (!isset($_GET['svx']) || ctype_space($_GET['svx']))
            {
                // result
                ResultJSON("error", "Device Vibration X is invalid.");
                exit();
            }

            // vib y
            if (!isset($_GET['svy']) || ctype_space($_GET['svy']))
            {
                // result
                ResultJSON("error", "Device Vibration Y is invalid.");
                exit();
            }

            // vib z
            if (!isset($_GET['svz']) || ctype_space($_GET['svz']))
            {
                // result
                ResultJSON("error", "Device Vibration Z is invalid.");
                exit();
            }

            // temp
            if (!isset($_GET['st']) || ctype_space($_GET['st']))
            {
                // result
                ResultJSON("error", "Device Temp is invalid.");
                exit();
            }

            // current
            if (!isset($_GET['sc']) || ctype_space($_GET['sc']))
            {
                // result
                ResultJSON("error", "Device Current is invalid.");
                exit();
            }

            // battery
            if (!isset($_GET['sbat']) || ctype_space($_GET['sbat']))
            {
                // result
                ResultJSON("error", "Device Current is invalid.");
                exit();
            }
            */
        }

        /*
        // update vibration
        {
            $status = 0;
            $rowCabinet = array();
            $sql = "select * from cabinet_tbl where cabinet_deviceid = '" . $_GET['did'] . "'";
            $rsCabinet = mysqli_query($connection, $sql);
            $rsCabinetRowCount = mysqli_num_rows($rsCabinet);
            if ($rsCabinetRowCount > 0)
            {
                // Fetch
                $cabinetId = "";
                $vibTriggerX = 0;
                $vibTriggerY = 0;
                $vibTriggerZ = 0;
                while ($rowsCabinet = mysqli_fetch_object($rsCabinet))
                {
                    $cabinetId = $rowsCabinet->id;
                    $vibTriggerX = $rowsCabinet->cabinet_trigger_vibx;
                    $vibTriggerY = $rowsCabinet->cabinet_trigger_viby;
                    $vibTriggerZ = $rowsCabinet->cabinet_trigger_vibz;
                }

                $valX = abs($_GET['svx']);
                $valY = abs($_GET['svy']);
                $valZ = abs($_GET['svz']);

                // status
                if ((float)$valX >= (float)$vibTriggerX)
                {
                    $status = 1;
                }
                if ((float)$valY >= (float)$vibTriggerY)
                {
                    $status = 1;
                }
                if ((float)$valZ >= (float)$vibTriggerZ)
                {
                    $status = 1;
                }

                // update cabinet
                {
                    $sql = "
                        update cabinet_tbl set
                            cabinet_status = '" . $status . "',
                            cabinet_vibx = '" . abs($_GET['svx']) . "',
                            cabinet_viby = '" . abs($_GET['svy']) . "',
                            cabinet_vibz = '" . abs($_GET['svz']) . "',
                            cabinet_temp = '" . $_GET['st'] . "',
                            cabinet_current = '" . $_GET['sc'] . "',
                            cabinet_battery = '" . $_GET['sbat'] . "',
                            cabinet_onlinetime = cabinet_onlinetime + 600,
                            cabinet_lastupdate = '" . strtotime($dateResult) . "'
                        where id = '" . $cabinetId . "'
                    ";
                    $rsUpdate = mysqli_query($connection, $sql);
                }
            
                // insert history
                {
                    $sql = "
                        insert into data_tbl
                            (
                                cabinet_id,
                                data_date,
                                data_status,
                                data_vibx,
                                data_viby,
                                data_vibz,
                                data_temp,
                                data_current,
                                data_battery
                            )
                        values
                            (
                                '" . $cabinetId . "',
                                '" . $dateResult . "', 
                                '" . $status . "', 
                                '" . abs($_GET['svx']) . "', 
                                '" . abs($_GET['svy']) . "', 
                                '" . abs($_GET['svz']) . "', 
                                '" . $_GET['st'] . "',
                                '" . $_GET['sc'] . "',
                                '" . $_GET['sbat'] . "' 
                            )
                    ";
                    $rsInsert = mysqli_query($connection, $sql);
                }

                // result
                ResultJSON("ok", "New device data successfully added.");
            }
            else
            {
                // result
                ResultJSON("error", "Device id is invalid." . $_GET['did']);
                exit();
            }
        }
        */

        // update vibration
        {
            $status = 0;
            $rowCabinet = array();
            $sql = "select * from cabinet_tbl where cabinet_deviceid = '" . $_GET['did'] . "'";
            $rsCabinet = mysqli_query($connection, $sql);
            $rsCabinetRowCount = mysqli_num_rows($rsCabinet);
            if ($rsCabinetRowCount > 0)
            {
                // Fetch
                $cabinetId = "";
                $cabinetDataFetched = array();
                while ($rowsCabinet = mysqli_fetch_object($rsCabinet))
                {
                    $cabinetDataFetched = $rowsCabinet;
                }

                $val1 = abs($_GET['dCur1']);
                $val2 = abs($_GET['dCur2']);
                $val3 = abs($_GET['dCur3']);

                // filtering
                {
                    if ((float)$val1 <= 0.01)
                    {
                        $val1 = 0;
                    }

                    if ((float)$val2 <= 0.01)
                    {
                        $val2 = 0;
                    }

                    if ((float)$val3 <= 0.01)
                    {
                        $val3 = 0;
                    }
                }

                // cal

                // status
                if ((float)$val1 >= (float)$cabinetDataFetched->cabinet_trigger_current)
                {
                    $status = 1;
                }
                if ((float)$val2 >= (float)$cabinetDataFetched->cabinet_trigger_current2)
                {
                    $status = 1;
                }
                if ((float)$val3 >= (float)$cabinetDataFetched->cabinet_trigger_current3)
                {
                    $status = 1;
                }

                // Get Power
                $valPower = (((float)$val1 + (float)$val2 + (float)$val3) * 220) / 1000;

                // update cabinet
                {
                    $sql = "
                        update cabinet_tbl set
                            cabinet_status = '" . $status . "',
                            cabinet_current = '" . $val1 . "',
                            cabinet_current2 = '" . $val2 . "',
                            cabinet_current3 = '" . $val3 . "',
                            cabinet_power = '" . $valPower . "',
                            cabinet_onlinetime = cabinet_onlinetime + 3,
                            cabinet_lastupdate = '" . strtotime($dateResult) . "'
                        where id = '" . $cabinetDataFetched->id . "'
                    ";
                    $rsUpdate = mysqli_query($connection, $sql);
                }
            
                // insert history
                {
                    $sql = "
                        insert into data_tbl
                            (
                                cabinet_id,
                                data_date,
                                data_status,
                                data_current,
                                data_current2,
                                data_current3,
                                data_power
                            )
                        values
                            (
                                '" . $cabinetDataFetched->id . "',
                                '" . $dateResult . "', 
                                '" . $status . "', 
                                '" . $val1 . "',
                                '" . $val2 . "',
                                '" . $val3 . "',
                                '" . $valPower . "'
                            )
                    ";
                    $rsInsert = mysqli_query($connection, $sql);
                }

                // result
                ResultJSON("ok", "New device data successfully added.");
            }
            else
            {
                // result
                ResultJSON("error", "Device id is invalid." . $_GET['did']);
                exit();
            }
        }
    }

    // 23 - Cabinet Info - Get Trigger [Arduino]
    // ---------------------------------------
    if ($_GET['mode'] == '23')
    {
        // check inputs
        {
            if (!isset($_GET['did']) || ctype_space($_GET['did']))
            {
                // result
                echo "Error: Device ID not valid.";
                exit();
            }
        }

        // fetch cabinet
        {
            $sql = "select * from cabinet_tbl where cabinet_deviceid = '" . $_GET['did'] . "'";
            $rsCabinet = mysqli_query($connection, $sql);
            $rsCabinetRowCount = mysqli_num_rows($rsCabinet);
            if ($rsCabinetRowCount > 0)
            {
                while ($rowsCabinet = mysqli_fetch_object($rsCabinet))
                {
                    echo $rowsCabinet->cabinet_humi_trigger;
                }
            }
            else
            {
                // result
                echo "Error: Device ID not found.";
                exit();
            }
        }
    }


    // 30 - Area Add
    // ---------------------------------------
    if ($_GET['mode'] == '30')
    {
        // check inputs
        {
            if (!isset($_POST['aName']) || ctype_space($_POST['aName']) || strlen($_POST['aName']) < 4)
            {
                // result
                ResultJSON("error", "Check your input1.");
                exit();
            }

            if (!isset($_POST['aOwner']) || ctype_space($_POST['aOwner']) || strlen($_POST['aOwner']) < 4)
            {
                // result
                ResultJSON("error", "Check your input2.");
                exit();
            }
        }

        // save
        {
            $sql = "
                insert into area_tbl
                    (
                        area_name,
                        area_oic
                    )
                values
                    (
                        '" . $_POST['aName'] . "',
                        '" . $_POST['aOwner'] . "'
                    )
            ";
            $rsInsert = mysqli_query($connection, $sql);
        }
        
        // result
        ResultJSON("ok", "New Area detail successfully added.");
    }

    // 31 - Area Update
    // ---------------------------------------
    if ($_GET['mode'] == '31')
    {
        // check inputs
        {
            if (!isset($_GET['id']) || ctype_space($_GET['id']))
            {
                // result
                ResultJSON("error", "Area id is invalid.");
                exit();
            }

            if (!isset($_POST['aName']) || ctype_space($_POST['aName']) || strlen($_POST['aName']) < 4)
            {
                // result
                ResultJSON("error", "Check your input.");
                exit();
            }

            if (!isset($_POST['aOwner']) || ctype_space($_POST['aOwner']) || strlen($_POST['aOwner']) < 4)
            {
                // result
                ResultJSON("error", "Check your input.");
                exit();
            }
        }

        // save
        {
            $sql = "
                update area_tbl set
                    area_name = '" . $_POST['aName'] . "',
                    area_oic = '" . $_POST['aOwner'] . "'
                where id = '" . $_GET['id'] . "'
            ";
            $rsUpdate = mysqli_query($connection, $sql);
        }
        
        // result
        ResultJSON("ok", "Selected Area successfully updated.");
    }

    // 32 - Area Delete
    // ---------------------------------------
    if ($_GET['mode'] == '32')
    {
        // check inputs
        {
            if (!isset($_GET['id']) || ctype_space($_GET['id']))
            {
                // result
                ResultJSON("error", "Area id is invalid.");
                exit();
            }
        }

        // save
        {
            $sql = "
                delete from area_tbl
                where id = '" . $_GET['id'] . "'
            ";
            $rsDelete = mysqli_query($connection, $sql);
        }

        // result
        ResultJSON("ok", "Selected Area successfully removed.");
    }


    // 41 - Power



    /*
        ======================================
        FUNCTIONS
        ======================================
    */
    // Result Handler
    // ---------------------------------------
    function ResultJSON($resStatus, $resMsg, $resData = "")
    {
        /*
            status:
                ok      - success
                error   - error

            message:
                return any notif
            
            data:
                return any result
        */
        echo json_encode(array("status" => $resStatus, "message" => $resMsg, "data" => $resData));
        exit();
    }
?>