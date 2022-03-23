<?php
    if(isset($_SESSION["UID"])) {
        header("Location: ".base_url('/admin'));
    }
?>