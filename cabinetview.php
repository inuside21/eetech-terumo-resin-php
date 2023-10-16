<?php

    // Database
    include("config/config.php");


    // Check
    // =============================
    {
        // ID
        // --------------------------
        if (!isset($_GET['id']))
        {
            // redirect
            //header("Location: areaadd.php?info");
            //exit();
        }
    }

    // Fetch
    // =============================
    {
        // Fetch Cabinet
        // --------------------------
        {
            $rowCabinet = array();
            $sql = "select * from cabinet_tbl where id = '" . $_GET['id'] . "'";
            $rsCabinet = mysqli_query($connection, $sql);
            $rsCabinetRowCount = mysqli_num_rows($rsCabinet);
            if ($rsCabinetRowCount > 0)
            {
                while ($rowsCabinet = mysqli_fetch_object($rsCabinet))
                {
                    $rowCabinet[] = $rowsCabinet;
                }
            }
            else
            {
                // redirect
                header("Location: cabinetlist.php");
                exit();
            }
        }

        // Fetch Area
        // --------------------------
        {
            $rowArea = array();
            $sql = "select * from area_tbl";
            $rsArea = mysqli_query($connection, $sql);
            $rsAreaRowCount = mysqli_num_rows($rsArea);
            if ($rsAreaRowCount > 0)
            {
                while ($rowsArea = mysqli_fetch_object($rsArea))
                {
                    $rowArea[] = $rowsArea;
                }
            }
            else
            {
                // redirect
                //header("Location: areaadd.php?info");
                //exit();
            }
        }

        // Fetch Device Data [Non Error]
        // --------------------------
        {
            $rowDeviceDataOK = array();
            $sql = "select * from data_tbl where cabinet_id = '" . $_GET['id'] . "' and data_status = '0' order by id desc limit 100";
            $rsData = mysqli_query($connection, $sql);
            $rsDataRowCount = mysqli_num_rows($rsData);
            if ($rsDataRowCount > 0)
            {
                while ($rowsData = mysqli_fetch_object($rsData))
                {
                    $rowDeviceDataOK[] = $rowsData;
                }
            }
            else
            {
                // redirect
                //header("Location: cabinetlist.php");
                //exit();
            }
        }

        // Fetch Device Data [Error Logs]
        // --------------------------
        {
            $rowData = array();
            $sql = "select * from data_tbl where cabinet_id = '" . $_GET['id'] . "' and data_status = '1' order by id desc limit 100";
            $rsData = mysqli_query($connection, $sql);
            $rsDataRowCount = mysqli_num_rows($rsData);
            if ($rsDataRowCount > 0)
            {
                while ($rowsData = mysqli_fetch_object($rsData))
                {
                    $rowData[] = $rowsData;
                }
            }
            else
            {
                // redirect
                //header("Location: cabinetlist.php");
                //exit();
            }
        }
    }
?>


<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset=utf-8>
        <meta http-equiv=X-UA-Compatible content="IE=edge">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <meta name=description content="">
        <meta name=author content="">
        <title><?php echo $contentPageTitle; ?></title>
        <?php
            // ================
            // CSS
            // ================ 
            echo $contentPageCSS; 
        ?>
    </head>
    <body>
        <div id=wrapper class="wrapper animsition">

            <!-- Menu Header -->
            <nav class="navbar navbar-fixed-top" role=navigation>
                <div class=navbar-header>
                    <button type=button class=navbar-toggle data-toggle=collapse data-target=.navbar-collapse>
                        <span class=sr-only>Toggle navigation</span>
                        <i class=material-icons>apps</i>
                    </button>
                    <a class=navbar-brand href=index.html>
                        <img class=main-logo src="assets/images/logo2.png" alt="">
                    </a>
                </div>
                <div class=nav-container>

                    <!-- Menu Header [Left] -->
                    <ul class="nav navbar-nav hidden-xs">
                        <li><a id=fullscreen href="#"><i class=material-icons>fullscreen</i> </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle material-ripple" data-toggle=dropdown>Welcome Back! EETech Innovation</a>
                        </li>
                    </ul>

                    <!-- Menu Header [Right] -->
                    <ul class="nav navbar-top-links navbar-right">
                        <li class=dropdown>
                            <a class=dropdown-toggle data-toggle=dropdown href="#">
                                <i class=material-icons>person_add</i>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li><a href=userprofile.php><i class=ti-user></i>&nbsp; Profile</a></li>
                                <li><a href=userinbox.php><i class=ti-email></i>&nbsp; My Messages</a></li>
                                <li><a href=usersettings.php><i class=ti-settings></i>&nbsp; Settings</a></li>
                                <li><a href=server/logout.php><i class=ti-layout-sidebar-left></i>&nbsp; Logout</a></li>
                            </ul>
                        </li>
                        <li class=dropdown>
                            <a class=dropdown-toggle href="asdasdasd.html">
                                <i class=material-icons>add_alert</i>
                                <div class=notify> <span class=heartbit></span> <span class=point></span> </div>
                            </a>
                        </li>
                        <li class=log_out>
                            <a href=server/logout.php>
                                <i class=material-icons>power_settings_new</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Menu Side -->
            <div class=sidebar role=navigation>
                <div class="sidebar-nav navbar-collapse">
                    <ul class=nav id=side-menu>
                        <li class="nav-heading "> <span>Main Navigation</span></li>
                        <li><a href=index.php class=material-ripple><i class=material-icons>home</i> Dashboard</a></li>
                        <li class=active>
                            <a href="#" class="material-ripple"><i class="material-icons">storage</i> Motor Manager<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="cabinetadd.php">Add Motor Info</a></li>
                                <li class=active><a href="cabinetlist.php">Motor Info List</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="material-ripple"><i class="material-icons">domain</i> Area Manager<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="areaadd.php">Add Area</a></li>
                                <li><a href="arealist.php">Area List</a></li>
                            </ul>
                        </li>

                        <li class="nav-heading "> <span>Area Navigation</span></li>
                        <?php

                            // Fetch Area
                            foreach ($rowArea as $value)
                            {
                                echo '<li><a href=area.php?id=' . $value->id . ' class=material-ripple><i class=material-icons>domain</i> ' . $value->area_name . '</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class=control-sidebar-bg></div>

            <!-- Main Content -->
            <div id=page-wrapper>
                <div class=content>
                    <div class=content-header style="margin-bottom: -30px;">
                        
                    </div>



                    <div class="row">
                        <!-- Current Data -->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display: none;">
                                <div class="weather-widget">
                                    <div class="weather-city">
                                        <div class="city-name">
                                            Humidity
                                        </div>
                                        <div class="time">Total N2 Off-Time: <b><span id="cUpdate"><?php echo round((float)$rowCabinet[0]->cabinet_save / 60, 2); ?></span> Minutes</b></div>
                                    </div>
                                    <div class="temp">
                                        <img class="iconSet" src="assets/dist/img/n2-humi.png" alt="">
                                        <span class="iconSetValue" id="cHumi"><?php echo $rowCabinet[0]->cabinet_humi; ?></span>
                                        <span class="iconSetValue2">%</span>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="display: none;">
                                        <div class="weather-widget">
                                            <div class="weather-city">
                                                <div class="city-name">
                                                    Temperature
                                                </div>
                                                <div class="time">Last Update: <br> <?php echo date("Y-m-d H:i:s", $rowCabinet[0]->cabinet_lastupdate); ?></div>
                                            </div>
                                            <div class="temp">
                                                <img class="iconSet" src="assets/dist/img/n2-temp.png" alt="" style="margin-left: -10px;">
                                                <span class="value" id="cTemp" style="font-size: 38px !important;"><?php echo $rowCabinet[0]->cabinet_temp; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="weather-widget">
                                            <div class="weather-city">
                                                <div class="city-name">
                                                    Current 1
                                                </div>
                                                <div class="time">Max Amps: <br> 100 A </div>
                                            </div>
                                            <div class="temp">
                                                <img class="iconSet" src="assets/dist/img/n2-amp.png" alt="">
                                                <span class="iconSetValue" id="cCur"><?php echo $rowCabinet[0]->cabinet_current; ?></span>
                                                <span class="iconSetValue2">A</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="weather-widget">
                                            <div class="weather-city">
                                                <div class="city-name">
                                                    Current 2
                                                </div>
                                                <div class="time">Max Amps: <br> 100 A </div>
                                            </div>
                                            <div class="temp">
                                                <img class="iconSet" src="assets/dist/img/n2-amp.png" alt="">
                                                <span class="iconSetValue" id="cCur2"><?php echo $rowCabinet[0]->cabinet_current2; ?></span>
                                                <span class="iconSetValue2">A</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="weather-widget">
                                            <div class="weather-city">
                                                <div class="city-name">
                                                    Current 3
                                                </div>
                                                <div class="time">Max Amps: <br> 100 A </div>
                                            </div>
                                            <div class="temp">
                                                <img class="iconSet" src="assets/dist/img/n2-amp.png" alt="">
                                                <span class="iconSetValue" id="cCur3"><?php echo $rowCabinet[0]->cabinet_current3; ?></span>
                                                <span class="iconSetValue2">A</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="weather-widget">
                                            <div class="weather-city">
                                                <div class="city-name">
                                                    Power Rating
                                                </div>
                                                <div class="time"> <Br><br> </div>
                                            </div>
                                            <div class="temp">
                                                <img class="iconSet" src="assets/dist/img/n2-amp.png" alt="">
                                                <span class="iconSetValue" id="cPower"><?php echo $rowCabinet[0]->cabinet_power; ?></span>
                                                <span class="iconSetValue2">KW</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="display: none;">
                                        <div class="weather-widget">
                                            <div class="weather-city">
                                                <div class="city-name">
                                                    Battery
                                                </div>
                                                <div class="time">Online Time: <br> <span id="cOnline"><?php echo round((float)$rowCabinet[0]->cabinet_onlinetime / 60, 2); ?></span> Minutes </div>
                                            </div>
                                            <div class="temp">
                                                <img class="iconSet" src="assets/dist/img/n2-battery.png" alt="" style="margin-right: 0px !important;">
                                                <span class="iconSetValue" id="cBat" style="font-size: 38px !important;"><?php echo $rowCabinet[0]->cabinet_battery; ?></span>
                                                <span class="iconSetValue2">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Chart -->
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="panel panel-bd" style="min-height: 493px;">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        Power Monitoring Chart
                                    </div>
                                    <div class=n2Status>
                                        
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div id="chartN2"></div>
                                </div>
                            </div>
                        </div>
                    </div>




                    

                    <div class=row>
                         <!-- Vibration Error -->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="display: none;">
                            

                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Detected Alarm Logs</h4>
                                    </div>
                                    <div class=n2Status>
                                        <div id="fButton">
                                            <a href="#" onclick='location.reload(true); return false;'><span class="ti-reload"></span> Refresh</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date/Time</th>
                                                    <th>X Axis</th>
                                                    <th>Y Axis</th>
                                                    <th>Z Axis</th>
                                                    <th>Temperature</th>
                                                    <th>Current</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    // 
                                                    foreach($rowData as $value) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $value->data_date; ?></td>
                                                        <td><?php echo $value->data_vibx; ?> G</td>
                                                        <td><?php echo $value->data_viby; ?> G</td>
                                                        <td><?php echo $value->data_vibz; ?> G</td>
                                                        <td><?php echo $value->data_temp; ?> c</td>
                                                        <td><?php echo $value->data_current; ?> A</td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Vibration OK -->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="display: none;">
                            

                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Device Logs</h4>
                                    </div>
                                    <div class=n2Status>
                                        <div id="fButton">
                                            <a href="#" onclick='location.reload(true); return false;'><span class="ti-reload"></span> Refresh</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date/Time</th>
                                                    <th>X Axis</th>
                                                    <th>Y Axis</th>
                                                    <th>Z Axis</th>
                                                    <th>Temperature</th>
                                                    <th>Current</th>
                                                    <th>Battery Level</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    // 
                                                    foreach($rowDeviceDataOK as $value) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $value->data_date; ?></td>
                                                        <td><?php echo $value->data_vibx; ?> G</td>
                                                        <td><?php echo $value->data_viby; ?> G</td>
                                                        <td><?php echo $value->data_vibz; ?> G</td>
                                                        <td><?php echo $value->data_temp; ?> c</td>
                                                        <td><?php echo $value->data_current; ?> A</td>
                                                        <td class="text-success"><?php echo $value->data_battery; ?> %</td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Power Error -->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            

                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Detected Alarm Logs</h4>
                                    </div>
                                    <div class=n2Status>
                                        <div id="fButton">
                                            <a href="#" onclick='location.reload(true); return false;'><span class="ti-reload"></span> Refresh</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date/Time</th>
                                                    <th>Current 1</th>
                                                    <th>Current 2</th>
                                                    <th>Current 3</th>
                                                    <th>Power Rating</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    // 
                                                    foreach($rowData as $value) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $value->data_date; ?></td>
                                                        <td><?php echo $value->data_current; ?> A</td>
                                                        <td><?php echo $value->data_current2; ?> A</td>
                                                        <td><?php echo $value->data_current3; ?> A</td>
                                                        <td><?php echo $value->data_power; ?> KW</td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Power OK -->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            

                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Device Logs</h4>
                                    </div>
                                    <div class=n2Status>
                                        <div id="fButton">
                                            <a href="#" onclick='location.reload(true); return false;'><span class="ti-reload"></span> Refresh</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="dataTableExample4" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date/Time</th>
                                                    <th>Current 1</th>
                                                    <th>Current 2</th>
                                                    <th>Current 3</th>
                                                    <th>Power Rating</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    // 
                                                    foreach($rowDeviceDataOK as $value) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $value->data_date; ?></td>
                                                        <td><?php echo $value->data_current; ?> A</td>
                                                        <td><?php echo $value->data_current2; ?> A</td>
                                                        <td><?php echo $value->data_current3; ?> A</td>
                                                        <td><?php echo $value->data_power; ?> KW</td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class=row>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Edit Machine Details</h4>
                                    </div>
                                    <div class=n2Status>
                                        <div id="fButton">
                                            <a id="fSubmit" href="#"><span class="ti-save"></span> Update</a> &nbsp&nbsp&nbsp
                                            <a id="fDelete" href="#"><span class="ti-trash"></span> Delete</a> &nbsp&nbsp&nbsp
                                            <a id="fClear" href="#"><span class="ti-reload"></span> Clear</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form id="fInfo" action="asdsad.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                                                <h4 class="text-center">Machine Information</h4>
                                                <p class="m-b-20 text-center">Details and information of Machine</p><br>

                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Name / ID</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" placeholder="" id="example-text-input" name="cName" value="<?php echo $rowCabinet[0]->cabinet_name; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">OIC</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" placeholder="" id="example-text-input" name="cOwner" value="<?php echo $rowCabinet[0]->cabinet_oic; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Area</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="cArea" name="cArea" required>
                                                            <?php

                                                                // Area
                                                                foreach ($rowArea as $val)
                                                                {
                                                            ?>
                                                                    <option value="<?php echo $val->id; ?>" <?php if ($rowCabinet[0]->cabinet_area == $val->id) { echo "selected"; } ?>><?php echo $val->area_name; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row"></div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                                                <h4 class="text-center">EETech Device Information</h4>
                                                <p class="m-b-20 text-center">Device setup & configuration</p><br>

                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Device ID</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" placeholder="" id="example-text-input" name="cDevice" value="<?php echo $rowCabinet[0]->cabinet_deviceid; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Temperature Trigger Level (C)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="<?php echo $rowCabinet[0]->cabinet_trigger_temp; ?>" placeholder="" id="example-text-input" name="cTriggerTemp" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Humidity Trigger Level (%)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="<?php echo $rowCabinet[0]->cabinet_trigger_humi; ?>" placeholder="" id="example-text-input" name="cTriggerHumi" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">X Axis Trigger (G)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="<?php echo $rowCabinet[0]->cabinet_trigger_vibx; ?>" placeholder="" id="example-text-input" name="cTriggerVibX" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Y Axis Trigger (G)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="<?php echo $rowCabinet[0]->cabinet_trigger_viby; ?>" placeholder="" id="example-text-input" name="cTriggerVibY" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Z Axis Trigger (G)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="<?php echo $rowCabinet[0]->cabinet_trigger_vibz; ?>" placeholder="" id="example-text-input" name="cTriggerVibZ" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Current Trigger 1 (A)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="<?php echo $rowCabinet[0]->cabinet_trigger_current; ?>" placeholder="" id="example-text-input" name="cTriggerCurrent1" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Current Trigger 2 (A)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="<?php echo $rowCabinet[0]->cabinet_trigger_current2; ?>" placeholder="" id="example-text-input" name="cTriggerCurrent2" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Current Trigger 3 (A)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="<?php echo $rowCabinet[0]->cabinet_trigger_current3; ?>" placeholder="" id="example-text-input" name="cTriggerCurrent3" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            // ================
            // JS
            // ================
            echo $contentPageJS; 
        ?>
        

        <script>
            $(document).ready(function(){
                // Load
                $('#dataTableExample1').DataTable({
                    order: [[0, 'desc']],
                });
                $('#dataTableExample2').DataTable({
                    order: [[0, 'desc']],
                });
                $('#dataTableExample3').DataTable({
                    ordering: false,
                });
                $('#dataTableExample4').DataTable({
                    ordering: false,
                });


                $('#cArea').select2();
                LoadForm();

                // Press - Submit
                $('#fSubmit').click(function(e) {
                    swal(
                        {
                            title: "Are you sure?",
                            text: "Pressing the Proceed button will update the data.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3C6F18",
                            confirmButtonText: "Proceed",
                            closeOnConfirm: false
                        },
                        function() {
                            // form
                            $.ajax({
                                type: "POST",
                                url: "server/api.php?mode=11&id=<?php echo $_GET['id']; ?>",
                                data: $("#fInfo").serialize(),
                                beforeSend: function() {
                                    // button
                                    $('#fButton').toggle();
                                },
                                success: function(data) {
                                    // button
                                    $('#fButton').toggle();

                                    // result
                                    const result = JSON.parse(data);

                                    // check
                                    if (result.status == "ok")
                                    {
                                        //message
                                        swal("Updated!", result.message, "success");
                                    }
                                    else
                                    {
                                        // message
                                        swal("Error!", result.message, "error");
                                    }
                                },
                                error: function(data) {
                                    // button
                                    $('#fButton').toggle();

                                    // message
                                    swal("Error!", "Something went wrong. Please try again.", "error");
                                }
                            });
                        }
                    );
                });

                // Press - Delete
                $('#fDelete').click(function(e) {
                    swal(
                        {
                            title: "Are you sure?",
                            text: "Pressing the Delete button will remove the data.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3C6F18",
                            confirmButtonText: "Delete",
                            closeOnConfirm: false
                        },
                        function() {
                            // form
                            $.ajax({
                                type: "POST",
                                url: "server/api.php?mode=12&id=<?php echo $_GET['id']; ?>",
                                data: $("#fInfo").serialize(),
                                beforeSend: function() {
                                    // button
                                    $('#fButton').toggle();
                                },
                                success: function(data) {
                                    // button
                                    $('#fButton').toggle();

                                    // result
                                    const result = JSON.parse(data);

                                    // check
                                    if (result.status == "ok")
                                    {
                                        // message
                                        swal(
                                            {
                                                title: "Deleted!",
                                                text: result.message,
                                                type: "success",
                                                showCancelButton: false,
                                                closeOnConfirm: true
                                            },
                                            function() {
                                                window.location.reload(true);
                                            }
                                        );
                                    }
                                    else
                                    {
                                        // message
                                        swal("Error!", result.message, "error");
                                    }
                                },
                                error: function(data) {
                                    // button
                                    $('#fButton').toggle();

                                    // message
                                    swal("Error!", "Something went wrong. Please try again.", "error");
                                }
                            });
                        }
                    );
                });

                // Press - Clear
                $('#fClear').click(function(e) {
                    swal(
                        {
                            title: "Are you sure?",
                            text: "Pressing the Clear button will reset the unsaved data.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3C6F18",
                            confirmButtonText: "Clear",
                            closeOnConfirm: false
                        },
                        function() {
                            LoadForm();

                            //message
                            swal("Reset!", "Form reset to its default value.", "success");
                        }
                    );
                });
            });



            // Function
            // -------------------------
            // Load Form
            function LoadForm()
            {
                $('#fInfo')[0].reset();
            }
            
            // Load Chart
            var flag = false;
            setInterval(() => {
                // check
                if (!flag)
                {
                    // flag
                    flag = true;

                    // request
                    $.ajax({
                        type: "POST",
                        url: "server/api.php?mode=21&id=<?php echo $_GET['id']; ?>",
                        dataType: 'json',
                        async: false,
                        success: function(data) {
                            // flag
                            flag = false;

                            // data
                            if (Object.keys(data.data.cabinet_data).length > 0)
                            {
                                var chart = AmCharts.makeChart("chartN2", {
                                    "type": "serial",
                                    "theme": "dark",
                                    "marginLeft": 40,
                                    "autoMarginOffset": 20,
                                    "valueAxes": [{
                                            "id": "v1",
                                            "axisAlpha": 0,
                                            "position": "left",
                                            "ignoreAxisWidth": true,
                                        }],
                                    "balloon": {
                                        "borderThickness": 1,
                                        "shadowAlpha": 0
                                    },
                                    "graphs": [
                                        {
                                            "id": "g1",
                                            "balloon": {
                                                "drop": true,
                                                "adjustBorderColor": false,
                                                "color": "#ffffff",
                                                "type": "smoothedLine"
                                            },
                                            "lineColor": "#E5343D",
                                            "fillColors": "#E5343D",
                                            "bullet": "round",
                                            "bulletBorderAlpha": 1,
                                            "bulletColor": "#FFFFFF",
                                            "bulletSize": 5,
                                            "hideBulletsCount": 50,
                                            "lineThickness": 2,
                                            "title": "Current 1",
                                            "useLineColorForBulletBorder": true,
                                            "valueField": "value1",
                                            "balloonText": "<span style='font-size:18px;'>[[value]]</span>",
                                        },
                                        {
                                            "id": "g2",
                                            "balloon": {
                                                "drop": true,
                                                "adjustBorderColor": false,
                                                "color": "#ffffff",
                                                "type": "smoothedLine"
                                            },
                                            "lineColor": "#62d0f1",
                                            "fillColors": "#62d0f1",
                                            "bullet": "round",
                                            "bulletBorderAlpha": 1,
                                            "bulletColor": "#FFFFFF",
                                            "bulletSize": 5,
                                            "hideBulletsCount": 50,
                                            "lineThickness": 2,
                                            "title": "Current 2",
                                            "useLineColorForBulletBorder": true,
                                            "valueField": "value2",
                                            "balloonText": "<span style='font-size:18px;'>[[value]]</span>",
                                        },
                                        {
                                            "id": "g3",
                                            "balloon": {
                                                "drop": true,
                                                "adjustBorderColor": false,
                                                "color": "#ffffff",
                                                "type": "smoothedLine"
                                            },
                                            "lineColor": "#558B2F",
                                            "fillColors": "#558B2F",
                                            "bullet": "round",
                                            "bulletBorderAlpha": 1,
                                            "bulletColor": "#FFFFFF",
                                            "bulletSize": 5,
                                            "hideBulletsCount": 50,
                                            "lineThickness": 2,
                                            "title": "Current 3",
                                            "useLineColorForBulletBorder": true,
                                            "valueField": "value3",
                                            "balloonText": "<span style='font-size:18px;'>[[value]]</span>",
                                        }
                                    ],
                                    "chartCursor": {
                                        "valueLineEnabled": true,
                                        "valueLineBalloonEnabled": true,
                                        "cursorAlpha": 0,
                                        "zoomable": false,
                                        "valueZoomable": true,
                                        "valueLineAlpha": 0.5
                                    },
                                    "categoryField": "date",
                                    "categoryAxis": {
                                        "labelRotation": 90,
                                        "parseDates": false,
                                        "minPeriod": "ss",
                                        "dashLength": 1,
                                        "minorGridEnabled": true
                                    },
                                });

                                chart.dataProvider = data.data.cabinet_data;
                                chart.validateNow();

                                //console.log(data.data.cabinet_data);

                                //
                                //var humiVal = parseFloat(data.data.cabinet_info[0].cabinet_humi)
                                //$("#cHumi").html(humiVal);    

                                //$("#cTemp").html(data.data.cabinet_info[0].cabinet_temp);   

                                // Reading: Current
                                $("#cCur").html(data.data.cabinet_info[0].cabinet_current);   
                                $("#cCur2").html(data.data.cabinet_info[0].cabinet_current2);   
                                $("#cCur3").html(data.data.cabinet_info[0].cabinet_current3);   
                                $("#cPower").html(data.data.cabinet_info[0].cabinet_power);   

                                //$("#cVibX").html(data.data.cabinet_info[0].cabinet_vibx);   
                                //$("#cVibY").html(data.data.cabinet_info[0].cabinet_viby);   
                                //$("#cVibZ").html(data.data.cabinet_info[0].cabinet_vibz);   

                                //$("#cUpdate").html((parseFloat(data.data.cabinet_info[0].cabinet_save) / 60).toFixed(2));

                                //$("#cOnline").html((parseFloat(data.data.cabinet_info[0].cabinet_onlinetime) / 60).toFixed(2));
                                //$("#cBat").html(data.data.cabinet_info[0].cabinet_battery);  
                                
                                /*
                                // ALERTS
                                if (triggerVal <= humiVal)
                                {
                                    $("#cHumi").addClass("text-danger2");
                                }
                                else
                                {
                                    $("#cHumi").removeClass("text-danger2");
                                }
                                */
                            }
                        }
                    });
                }
            }, 5000);

            /*
            // Demo 
            setInterval(() => {
                var vTemp = randomIntFromInterval(0, 100);
                var vHumi = randomIntFromInterval(0, 100);

                $.ajax({
                    type: "POST",
                    url: "server/api.php?mode=22&did=<?php echo $rowCabinet[0]->cabinet_deviceid; ?>&st=" + vTemp.toString() + "&sh=" + vHumi.toString(),
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                    }
                });
            }, 1000);
            */

            function randomIntFromInterval(min, max) { // min and max included 
                return Math.floor(Math.random() * (max - min + 1) + min)
            }

        </script>
    </body>
</html>
