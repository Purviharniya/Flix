<?php

require_once "includes/header.php";

if (!isset($_GET['id'])) {
    ErrorMessage::show("ID was not passed in the page");
}

$id = $_GET['id'];

$entity = new Entity($con, $id);

$preview = new PreviewProvider($con, $username);

echo $preview->createPreviewVideo($entity);

$seasonProvider = new SeasonProvider($con, $username);
echo $seasonProvider->create($entity);


$categoryContainers = new CategoryContainers($con, $username);
echo $categoryContainers->showCategory($entity->getCategoryID(),"You might also like");