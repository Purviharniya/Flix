<?php

class PreviewProvider
{
    private $con, $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function createPreviewVideo($entity)
    {
        if ($entity == null) {
            $entity = $this->getRandomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();
        $categoryID = $entity->getCategoryID();

        //TODO: Add subtitle in the overlay

        $videoId = VideoProvider::getEntityVideoForUser($this->con, $id, $this->username);
        $video = new Video($this->con, $videoId);

        $subHeading = $video->isMovie() ? "" : "<h4>" . $video->getSeasonAndEpisode() . "</h4>";

        $inProgress = $video->isInProgress($this->username);
        $playbuttontext = $inProgress ? "Continue Watching" : "Play";

        return "<div class='preview-container'>
                <img src='$thumbnail' class='preview-image' hidden>

                <video autoplay muted class='preview-video' onended='previewEnded()'>
                    <source src='$preview' type='video/mp4' >
                </video>

                <div class='preview-overlay'>
                    <div class='main-details'>
                        <h3> $name </h3>
                        <div>$subHeading</div>
                        <div class='overlay-buttons'>
                            <button onclick='watchVideo($videoId)'> <i class='fas fa-play'></i> $playbuttontext </button>
                            <button onclick='volumeToggle(this)'><i class='fas fa-volume-mute'></i></button>
                        </div>
                    </div>
                </div>
        </div>";
    }


    public function createTVShowPreviewVideo(){
        $entitiesArray = EntityProvider::getTVShowEntities($this->con,null,1);
        
        if(sizeof($entitiesArray)==0){
            return ErrorMessage::show("No TV Shows to display");
        }
        // print_r($entitiesArray);
        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createMoviePreviewVideo(){
        $entitiesArray = EntityProvider::getMovieEntities($this->con,null,1);
        
        if(sizeof($entitiesArray)==0){
            return ErrorMessage::show("No Movies to display");
        }
        // print_r($entitiesArray);
        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createCategoryPreviewVideo($categoryID){
        $entitiesArray = EntityProvider::getEntities($this->con,$categoryID,1);
        
        if(sizeof($entitiesArray)==0){
            return ErrorMessage::show("No Movies to display");
        }
        // print_r($entitiesArray);
        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createEntityPreviewSquare($entity)
    {
        $id = $entity->getId();
        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' alt='$name'>
                    </div>
                </a>";
    }

    private function getRandomEntity()
    {
        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }
}