<?php

require_once "includes/header.php";

if (!isset($_GET['id'])) {
    ErrorMessage::show('Category ID has not been passed!');
}

$preview = new PreviewProvider($con, $username);

echo $preview->createCategoryPreviewVideo($_GET['id']);

$categories = new CategoryContainers($con, $username);

echo $categories->showCategory($_GET['id']);
?>


<div></div>


<?php 
include "includes/footer.php";
?>