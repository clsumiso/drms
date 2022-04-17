<?php
    if(isset($_SESSION["admin_ID"])) {
        header("Location: ".base_url('/admin'));
    }
?>