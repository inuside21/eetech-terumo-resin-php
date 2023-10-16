<?php

    // Database
    include("config/config.php");


    // Fetch
    // =============================
    {
        // Fetch Cabinet List
        // --------------------------
        {
            $rowCabinet = array();
            $sql = "select * from cabinet_tbl";
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
                    <div class=content-header>
                        <div class=header-icon>
                            <i class=pe-7s-news-paper></i>
                        </div>
                        <div class=header-title>
                            <h1>Motor List</h1>
                            <small>View all saved Motor Details</small>
                            <ol class=breadcrumb>
                                <li><a href=index.php><i class=pe-7s-home></i> Home</a></li>
                                <li class=active>Motor List</li>
                            </ol>
                        </div>
                    </div>
                    <div class=row>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            

                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Motor Details List</h4>
                                    </div>
                                    <div class=n2Status>
                                        <div id="fButton">
                                            <a id="" href="cabinetadd.php"><span class="ti-support"></span> Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Motor</th>
                                                    <th>Area</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    // 
                                                    foreach($rowCabinet as $value) {
                                                ?>
                                                    <tr onclick="window.location.href='cabinetview.php?id=<?php echo $value->id; ?>';">
                                                        <td><?php echo $value->cabinet_name; ?></td>
                                                        <td><?php echo $value->cabinet_area; ?></td>
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
                </div>
            </div>
        </div>
        <?php
            // ================
            // JS
            // ================
            echo $contentPageJS; 
        ?>
    </body>

    <script>
        $(document).ready(function(){
            $("#dataTableExample1").DataTable();
        });
    </script>
</html>
