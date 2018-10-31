<?php
session_start();
session_destroy();
echo'<script> window.location.replace("index.php?action=login"); </script>';
#header("location:index.php?action=login");
?>
