<?php

    // database
    // =========================================================
    // Declare
    $connection = mysqli_connect("localhost","root","Orenzo45","eetech-equipment");
    //$connection = mysqli_connect("localhost","eetech_web","~Orenzo45","eetech-n2");

    // Session
    session_start();

    // Date
    date_default_timezone_set("Asia/Manila");
    $date = new DateTime();
    $dateResult = $date->format('Y-m-d H:i:s');
    $dateOnlyResult = $date->format('Y-m-d');
    $dateOnlyResultYearMonth = $date->format('Y-m');
    $dateOnlyResultYear = $date->format('Y');

    // Page URL
    $_SESSION['mainUrl'] = "localhost/eetech-device/server/";

    // Content
    //$contentPageTitle = "EETech Preventive Maintenance Monitoring";
    $contentPageTitle = "EETech Equipment Alarm Monitoring";

    // Content Side Menu
    $contentPageMenu = '
        
    ';

    // CSS
    $contentPageCSS = '
        <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
        <link href="assets/dist/css/base.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/toastr/toastr.min.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/emojionearea/emojionearea.min.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/monthly/monthly.min.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/amcharts/export.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/component_ui.min.css" rel=stylesheet type="text/css"/>
        <link id=defaultTheme href="assets/dist/css/skins/component_ui_black.css" rel=stylesheet type="text/css"/>
        <link href="assets/dist/css/custom.css" rel=stylesheet type="text/css"/>
    ';

    // JS
    $contentPageJS = '
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
        <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/metisMenu/metisMenu.min.js"></script>
        <script src="assets/plugins/lobipanel/lobipanel.min.js"></script>
        <script src="assets/plugins/animsition/js/animsition.min.js"></script>
        <script src="assets/plugins/fastclick/fastclick.min.js"></script>
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/toastr/toastr.min.js"></script>
        <script src="assets/plugins/sparkline/sparkline.min.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
        <script src="assets/plugins/counterup/waypoints.js"></script>
        <script src="assets/plugins/monthly/monthly.min.js"></script>
        <script src="assets/plugins/amcharts/amcharts.js"></script>
        <script src="assets/plugins/amcharts/ammap.js"></script>
        <script src="assets/plugins/amcharts/worldLow.js"></script>
        <script src="assets/plugins/amcharts/serial.js"></script>
        <script src="assets/plugins/amcharts/export.min.js"></script>
        <script src="assets/plugins/amcharts/dark.js"></script>
        <script src="assets/plugins/amcharts/pie.js"></script>
        <script src="assets/plugins/datatables/dataTables.min.js"></script>
        <script src="assets/plugins/select2/select2.min.js"></script>
        <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
        <script src="assets/dist/js/app.min.js"></script>
        <script src="assets/dist/js/jQuery.style.switcher.min.js"></script>
    ';

    // API Read
    function APIRead($url) 
    {
        $newUrl = $_SESSION['mainUrl'] . $url;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $newUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        $json = curl_exec($ch);
        if(!$json) {
            echo curl_error($ch);
        }
        curl_close($ch);
        return $json;
    }
?>