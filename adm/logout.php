<?php

session_start();
unset($_SESSION["login_adm"]);
header("Location: index.php?page=login");
exit();