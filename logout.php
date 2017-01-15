<?php

session_start();
unset($_SESSION["pelanggan"]);
header('Location: login.php');
