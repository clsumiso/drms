<?php
    if(!isset($_SESSION["UID"]) && !isset($_SESSION["staff_type"])) {
        header("Location: ".base_url('/login'));
    }

?>