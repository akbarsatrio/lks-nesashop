<?php

session_start();
unset($_SESSION["login_usr"]);
header("Location: index.php?page=login");
exit();