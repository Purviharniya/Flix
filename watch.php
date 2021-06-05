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
    <div class="videoControls watchnav">
        <button class='transparent iconButton' onclick='goBack()'><i class="fas fa-arrow-left"></i></button>
        <h3><?php echo $video->getTitle();?></h3>
    </div>
    <video controls muted>
        <!-- add autoplay for automatic playing on page load  -->
        <source src='<?php echo $video->getFilePath(); ?>' type='video/mp4'>
    </video>

</div>

<script>
initVideo("<?php echo $video->getId(); ?>", "<?php echo $username; ?>");
</script>