<?php

    // Database
    include("config/config.php");


    // Fetch
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
                                <li class=active><a href="cabinetadd.php">Add Motor Info</a></li>
                                <li><a href="cabinetlist.php">Motor Info List</a></li>
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
                            <h1>Add New Machine Info</h1>
                            <small>Create new entry for Machine monitoring</small>
                            <ol class=breadcrumb>
                                <li><a href=index.php><i class=pe-7s-home></i> Home</a></li>
                                <li class=active>Add Motor</li>
                            </ol>
                        </div>
                    </div>
                    <div class=row>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            

                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Motor</h4>
                                    </div>
                                    <div class=n2Status>
                                        <div id="fButton">
                                            <a id="fSubmit" href="#"><span class="ti-save"></span> Save</a> &nbsp&nbsp&nbsp
                                            <a id="fClear" href="#"><span class="ti-reload"></span> Clear</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form id="fInfo" action="asdsad.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6 p-l-30 p-r-30">
                                                <h4 class="text-center">Machine Information</h4>
                                                <p class="m-b-20 text-center">Details and information of new machine</p><br>

                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Name / ID</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" placeholder="" id="example-text-input" name="cName" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">OIC</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" placeholder="" id="example-text-input" name="cOwner" required>
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
                                                                    <option value="<?php echo $val->id; ?>"><?php echo $val->area_name; ?></option>
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
                                                        <input class="form-control" type="text" placeholder="" id="example-text-input" name="cDevice" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Temperature Trigger Level (C)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="1" placeholder="" id="example-text-input" name="cTriggerTemp" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Humidity Trigger Level (%)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="1" placeholder="" id="example-text-input" name="cTriggerHumi" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">X Axis Trigger (G)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="1" placeholder="" id="example-text-input" name="cTriggerVibX" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Y Axis Trigger (G)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="1" placeholder="" id="example-text-input" name="cTriggerVibY" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Z Axis Trigger (G)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="1" placeholder="" id="example-text-input" name="cTriggerVibZ" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Current Trigger 1 (A)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="1" placeholder="" id="example-text-input" name="cTriggerCurrent1" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Current Trigger 2 (A)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="1" placeholder="" id="example-text-input" name="cTriggerCurrent2" min=1 max=100 step=1 required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-3 col-form-label">Current Trigger 3 (A)</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="number" value="1" placeholder="" id="example-text-input" name="cTriggerCurrent3" min=1 max=100 step=1 required>
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
                $('#dataTableExample1').DataTable();
                $('#cArea').select2();
                LoadForm();

                // Press - Submit
                $('#fSubmit').click(function(e) {
                    swal(
                        {
                            title: "Are you sure?",
                            text: "Pressing the Proceed button will save the data.",
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
                                url: "server/api.php?mode=10",
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
                                        swal("Added!", result.message, "success");
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
                            text: "Pressing the Clear button will clear the unsaved data.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3C6F18",
                            confirmButtonText: "Clear",
                            closeOnConfirm: false
                        },
                        function() {
                            LoadForm();

                            //message
                            swal("Cleared!", "Form is now cleared.", "success");
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
        </script>
    </body>
</html>
