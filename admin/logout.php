<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or another appropriate page
header("Location: /setwaysemp/admin/index.php");
exit;
?>