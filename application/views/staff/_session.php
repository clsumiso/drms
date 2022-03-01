<?php
    if(!isset($_SESSION["UID"])) {
        header("Location: login");
    }
?>