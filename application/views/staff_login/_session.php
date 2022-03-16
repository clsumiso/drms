<?php
    if(isset($_SESSION["UID"])) {
        header("Location: staff/");
    }
?>