<?php

require_once "includes/header.php";

$preview = new PreviewProvider($con, $username);

echo $preview->createTVShowPreviewVideo(null);

$categories = new CategoryContainers($con, $username);

echo $categories->showTVShowCategories();
?>


<div></div>



<?php 
include "includes/footer.php";
?>