<?php
    require("header.php");
    $_SESSION["login"] = false;
    $_SESSION["user_id"] = 0;
    header( "Location: /" );
?>