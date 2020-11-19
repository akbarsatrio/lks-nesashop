<?php

session_start();
unset($_SESSION["login_usr"]);
$_SESSION[] = true;
header("Location: ../index.php?page=login");
exit();