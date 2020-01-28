<?php
if (!session_id()) session_start();

$_SESSION["login"] = false;
$_SESSION["username"] = "";
$_SESSION["akses"] = "";

header('Location:../index.php');
?>