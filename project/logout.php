<!-- this file is created by Breno Oliveira -->
<?php
require_once "auth.php";
$_SESSION = [];
session_destroy();
header("Location: main.php");
exit;