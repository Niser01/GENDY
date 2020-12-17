<?php
session_start();
session_destroy();
$_SESSION["user"]= "";
header("Location: ../index.php");
?>