<?php

require_once "config.php";
include "includes/classes/Entity.php";
include "includes/classes/PreviewProvider.php";

if (!isset($_SESSION['userLoggedIn'])) {
    header("Location: login.php");
}

$username = $_SESSION['userLoggedIn'];
$preview = new PreviewProvider($con, $username);

$preview->createPreviewVideo(null);
?>


<div></div>