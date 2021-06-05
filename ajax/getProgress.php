<?php
require '../config.php';
// echo "hello";

if (isset($_POST['videoID']) && isset($_POST['username'])) {
    $videoID = $_POST['videoID'];
    $username = $_POST['username'];

    $query = $con->prepare("SELECT progress from videoProgress WHERE videoId=:videoID AND username=:username ");
    $query->bindValue(":videoID", $videoID);
    $query->bindValue(":username", $username);
    $query->execute();

    echo $query->fetchColumn();
} else {
    echo 'VideoID or username not passed correctly';
}