<?php

require_once "includes/header.php";

$preview = new PreviewProvider($con, $username);

echo $preview->createMoviePreviewVideo(null);

$categories = new CategoryContainers($con, $username);

echo $categories->showMovieCategories();
?>


<div></div>