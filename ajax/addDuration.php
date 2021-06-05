<?php
require '../config.php';
// echo "hello";

if (isset($_POST['videoID']) && isset($_POST['username'])) {
    $videoID = $_POST['videoID'];
    $username = $_POST['username'];
    $query = $con->prepare("SELECT * from videoProgress WHERE videoId=:videoID AND username=:username ");
    $query->bindValue(":videoID", $videoID);
    $query->bindValue(":username", $username);
    $query->execute();

    if ($query->rowCount() == 0) {
        // echo "no video row";
        $query = $con->prepare("INSERT INTO videoProgress (username,videoId) VALUES (:username,:videoID) ");
        $query->bindValue(":username", $username);
        $query->bindValue(":videoID", $videoID);
        $query->execute();
    }
} else {
    echo 'VideoID or username not passed correctly';
}