<?php

$data = array(
    'csn' => isset($_SESSION['csaladi_nev']) ? $_SESSION['csaladi_nev'] : '',
    'un' => isset($_SESSION['utonev']) ? $_SESSION['utonev'] : '',
    'login' => isset($_SESSION['login']) ? $_SESSION['login'] : ''
);


unset($_SESSION["csaladi_nev"]);
unset($_SESSION["utonev"]);
unset($_SESSION["login"]);


session_destroy();
header("Location: index.php");