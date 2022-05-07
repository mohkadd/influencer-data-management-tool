<?php
session_start();
unset($_SESSION['adminid']);
unset($_SESSION['admin_username']);
unset($_SESSION['admintype']);
session_destroy();
header("Location: index.php");
?>