<?php
$hideNav = true;
require_once "includes/header.php";

if (!isset($_GET['id'])) {
    ErrorMessage::show("Episode ID was not passed in the page");
}

$id = $_GET['id'];
$video = new Video($con, $id);
$video->incrementViews();

$upnext = VideoProvider::getUpNext($con, $video);

?>

<div class="watchContainer">
    <div class="videoControls watchnav">
        <button class='transparent iconButton' onclick='goBack()'><i class="fas fa-arrow-left"></i></button>
        <h3><?php echo $video->getTitle(); ?></h3>
    </div>

    <div class="videoControls upNext" style="display:none;">
        <button onclick="restartVideo()">
            <i class="fas fa-redo"></i>
        </button>
        <div class="upnextContainer">
            <h2>Up next:</h2>
            <h3><?php echo $upnext->getTitle(); ?></h3>
            <h3><?php echo $upnext->getSeasonAndEpisode(); ?></h3>
            <button class='playNext' onclick="watchVideo(<?php echo $upnext->getId(); ?>)"> <i class="fas fa-play"></i>
                Play</button>
        </div>
    </div>

    <video controls muted onended="showUpNext()">
        <!-- add autoplay for automatic playing on page load  -->
        <source src='<?php echo $video->getFilePath(); ?>' type='video/mp4'>
    </video>

</div>

<script>
initVideo("<?php echo $video->getId(); ?>", "<?php echo $username; ?>");
</script>