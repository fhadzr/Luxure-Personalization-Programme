<?php
if (!isset($_SESSION)) session_start();
//destroy the session
session_destroy();

// echo javascript window pop up and redirect to login page
echo '<script type="text/javascript"> ';
echo ' if (confirm("You have been logged out")) {';
echo '    window.location.href = "index.php";';
echo ' }';
echo '</script>';
?>
