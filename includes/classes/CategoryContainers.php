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

    public function showCategory($categoryID, $title = null)
    {
        $query = $this->con->prepare("SELECT * FROM categories WHERE id=:id");
        $query->bindValue(":id", $categoryID);
        $query->execute();
        $html = "<div class='previewCategories noScroll'>";
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHTML($row, $title, true, true);
        }

        return $html . "</div>";
    }

    private function getCategoryHTML($sqlData, $title, $tvshows, $movies)
    {
        $categoryID = $sqlData['id'];
        $title = $title == null ? $sqlData['name'] : $title;

        if ($tvshows && $movies) {
            $entities = EntityProvider::getEntities($this->con, $categoryID, 50);
        } else if ($tvshows) {
            //get tvshow entities
        } else {
            //get movie entities
        }

        if (sizeof($entities) == 0) {
            return;
        }

        $entitiesHTML = "";
        $previewprovider = new PreviewProvider($this->con, $this->username);
        foreach ($entities as $entity) {
            $entitiesHTML .= $previewprovider->createEntityPreviewSquare($entity);
        }

        return "
        <div class='category'>
            <a href='category.php?id=$categoryID'>
                <h3>$title</h3>
            </a>
            <div class='entities'>
                $entitiesHTML
            </div>
        </div>
        ";
    }

}