<?php
include("includes/db_con.php");
$_SESSION['panel_user'] = array();
$_SESSION['front_panel'] = array();
session_destroy();

 if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
//header("Location: ".$BaseFolder);
exit(0);
?>