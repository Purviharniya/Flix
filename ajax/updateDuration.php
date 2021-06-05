<?php
require '../config.php';
// echo "hello";

if (isset($_POST['videoID']) && isset($_POST['username']) && isset($_POST['progress'])) {
    $videoID = $_POST['videoID'];
    $username = $_POST['username'];
    $progress = $_POST['progress'];
    $query = $con->prepare("UPDATE videoProgress SET progress=:progress, dateModified=NOW() WHERE videoId=:videoID AND username=:username ");
    $query->bindValue(":progress", $progress);
    $query->bindValue(":videoID", $videoID);
    $query->bindValue(":username", $username);
    $query->execute();

} else {
    echo 'VideoID or username or progress not passed correctly';
}