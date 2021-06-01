<?php

require_once "includes/header.php";

if (!isset($_GET['id'])) {
    ErrorMessage::show("Episode ID was not passed in the page");
}

$id = $_GET['id'];
$video = new Video($con,$id);
$video->incrementViews();

?>

<div class="watchContainer">
    <video controls autoplay>
        <source src='<?php echo $video->getFilePath(); ?>' type='video/mp4'>
    </video>

</div>