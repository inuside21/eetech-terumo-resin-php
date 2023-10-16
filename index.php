<?php

    // Database
    include("config/config.php");

    // Config
    // =============================
    {
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
                    $rowArea[$rowsArea->id] = $rowsArea;
                }
            }
            else
            {
                // redirect
                header("Location: areaadd.php?info");
                exit();
            }
        }
    }

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

        // Area
        // --------------------------
        {
            if (!isset($_GET['a']))
            {
                $areaId = 0;
                $areaName = "All Area";
                $sql = "select * from device_tbl";
            }
            else
            {
                $areaId = $_GET['a'];
                $areaName = $rowArea[$_GET['a']]->area_name;
                $sql = "select * from device_tbl where area_id = '" . $areaId . "'";
            }
        }
    }

    // Fetch
    // =============================
    {
        // Fetch Cabinet
        // --------------------------
        {
            $rowCabinet = array();
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
    <body style="overflow: hidden;">
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
                            <a href="#" class="dropdown-toggle material-ripple" data-toggle=dropdown>EETech Equipment Alarm Monitoring</a>
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
                        <li class=active><a href=index.php class=material-ripple><i class=material-icons>home</i> Dashboard</a></li>
                        <li>
                            <a href="#" class="material-ripple"><i class="material-icons">storage</i> Machine Manager<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="cabinetadd.php">Add Machine Info</a></li>
                                <li><a href="cabinetlist.php">Machine Info List</a></li>
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
                                echo '<li><a href=index.php?a=' . $value->id . ' class=material-ripple><i class=material-icons>domain</i> ' . $value->area_name . '</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class=control-sidebar-bg></div>

            <!-- Main Content -->
            <div id=page-wrapper>
                <div class=content>
                    
                    <div class=row>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class=row style="margin-top: 15px;">

                                <?php

                                    // Load Cabinets
                                    foreach ($rowCabinet as $valCabinet)
                                    {
                                        $id = $valCabinet->id;
                                ?>
                                
                                        <div class="col-lg-4">
                                            <div id="cPanel<?php echo $id; ?>" class="panel panel-bd">
                                                <div class=panel-heading>
                                                    <div class=panel-title>
                                                        <i class=ti-panel></i>
                                                        <h4><span id="cPanelStatus<?php echo $id; ?>">Connecting...</span></h4>
                                                    </div>
                                                    <div class=n2Status>
                                                        <small>
                                                            
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class=panel-body>
                                                    <div class=row style="display: flex;">
                                                        <div class=col-lg-5 style="align-items: center; display: flex;">
                                                            <h2 style="margin-top: -10px;">
                                                                <small>
                                                                    <?php 
                                                                        // Area
                                                                        foreach($rowArea as $valArea)
                                                                        {
                                                                            // check
                                                                            if ($valCabinet->area_id == $valArea->id)
                                                                            {
                                                                                echo $valArea->area_name;
                                                                            }
                                                                        }   
                                                                    ?>
                                                                </small>
                                                                <br>
                                                                <b>
                                                                    <span id="cPanelText<?php echo $id; ?>"><?php echo $valCabinet->dev_name; ?></span>
                                                                </b>
                                                            </h2>
                                                        </div>
                                                        <div class=col-lg-2>
                                                        </div>
                                                        <div class="col-lg-5 text-center">
                                                            <img src=assets/images/cabinet/panel.png height=125 width=125><Br><Br>
                                                        </div> 
                                                    </div>  
                                                    
                                                </div>
                                            </div>
                                        </div>
                                
                                <?php
                                    }
                                ?>

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
                $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
                $(".progress-animated").each(function () {
                    each_bar_width = $(this).attr('aria-valuenow');
                    $(this).width(each_bar_width + '%');
                });     
            });

            // Load Cabinet Info
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
                        url: "server/api.php?mode=20&a=<?php echo $areaId; ?>",
                        dataType: 'json',
                        async: false,
                        success: function(data) {
                            // flag
                            flag = false;

                            // data
                            data.data.cabinet_info.forEach(element => {
                                // id
                                var ids = element.id;

                                // status
                                {
                                    if (element.timeNow <= element.dev_lastupdate)
                                    {
                                        if (element.dev_status == "0")
                                        {
                                            $('#cPanel' + ids).removeClass();
                                            $('#cPanel' + ids).addClass("panel");
                                            $('#cPanel' + ids).addClass("panel-danger");

                                            $('#cPanelText' + ids).removeClass();
                                            $('#cPanelText' + ids).addClass("text-danger");

                                            $('#cPanelStatus' + ids).text("Panel Alarm Active");
                                        } 
                                        else
                                        {
                                            $('#cPanel' + ids).removeClass();
                                            $('#cPanel' + ids).addClass("panel");
                                            $('#cPanel' + ids).addClass("panel-success");

                                            $('#cPanelText' + ids).removeClass();
                                            $('#cPanelText' + ids).addClass("text-success");

                                            $('#cPanelStatus' + ids).text("Panel Alarm OK");
                                        }
                                    }
                                    else
                                    {
                                        $('#cPanel' + ids).removeClass();
                                        $('#cPanel' + ids).addClass("panel");
                                        $('#cPanel' + ids).addClass("panel-bd");

                                        $('#cPanelText' + ids).removeClass();
                                        $('#cPanelText' + ids).addClass("text-light");

                                        $('#cPanelStatus' + ids).text("Disconnected. Restart Panel Controller");
                                    }
                                }
                            });
                        }
                    });
                }
            }, 1000);
        </script>
    </body>
</html>
