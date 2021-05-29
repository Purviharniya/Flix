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
        return "<div class='preview-container'>
                <img src='$thumbnail' class='preview-image' hidden>

                <video autoplay muted class='preview-video' onended='previewEnded()'>
                    <source src='$preview' type='video/mp4' >
                </video>

                <div class='preview-overlay'>
                    <div class='main-details'>
                        <h3> $name </h3>
                        <div class='overlay-buttons'>
                            <button> <i class='fas fa-play'></i> Play </button>
                            <button onclick='volumeToggle(this)'><i class='fas fa-volume-mute'></i></button>
                        </div>
                    </div>
                </div>
        </div>";
    }

    private function getRandomEntity()
    {
        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }
}