<?php

class CategoryContainers
{
    private $con, $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function showAllCategories()
    {
        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();
        $html = "<div class='previewCategories'>";
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $html .= $this->getCategoryHTML($row, null, true, true);

        }

        return $html . "</div>";
    }

    private function getCategoryHTML($sqlData, $title, $tvshows, $movies)
    {
        $categoryID = $sqlData['id'];
        $title = $title == null ? $sqlData['name'] : $title;

    }

}