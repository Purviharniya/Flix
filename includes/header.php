<?php

require_once "config.php";
include_once "includes/header_scripts.php";
include "includes/classes/Entity.php";
include "includes/classes/PreviewProvider.php";

if (!isset($_SESSION['userLoggedIn'])) {
    header("Location: login.php");
}

$username = $_SESSION['userLoggedIn'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flix</title>
</head>

<body>
    <div class='wrapper'>