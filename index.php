<?php

require_once "includes/header.php";

$preview = new PreviewProvider($con, $username);

echo $preview->createPreviewVideo(null);

$categories = new CategoryContainers($con, $username);

echo $categories->showAllCategories();
?>


<div></div>

<?php 
include "includes/footer.php";
?>