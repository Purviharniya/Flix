<?php 

class SearchResultsProvider{

    private $con,$username;

    public function __construct($con,$username){
        $this->con = $con;
        $this->username = $username;
    }

    public function getResults($input){
        $entities = EntityProvider::getSearchEntities($this->con,$input);
        $html = "<div class='noScroll previewCategories'>";
        
        $html .= $this->getResultsHTML($entities);

        return $html . "</div>";
    }

    public function getResultsHTML($entities){
        if(sizeof($entities)==0){
            return "<div class='text-center text-light'> No results found</div>";
        }

        $entitiesHtml = "";
        $previewprovider = new PreviewProvider($this->con,$this->username);

        foreach ($entities as $entity) {
            $entitiesHtml .= $previewprovider->createEntityPreviewSquare($entity);
        }

        return "
        <div class='category'>
            <div class='entities'>
                $entitiesHtml
            </div>
        </div>
        ";
    }

}

?>