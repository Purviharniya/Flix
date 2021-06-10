<?php
require '../config.php';
require '../includes/classes/PreviewProvider.php';
require '../includes/classes/SearchResultsProvider.php';
require '../includes/classes/EntityProvider.php';
require '../includes/classes/Entity.php';
// echo "hello";

if (isset($_POST['term']) && isset($_POST['username'])) {
    $term = $_POST['term'];
    $username = $_POST['username'];

    $srp = new SearchResultsProvider($con, $username);
    echo $srp->getResults($term);

} else {
    echo 'Search term or username not passed correctly';
}