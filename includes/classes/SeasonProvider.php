<?php

class SeasonProvider
{
    private $con, $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function create($entity)
    {
        $seasons = $entity->getSeasons($entity);

        if (sizeof($seasons) == 0) {
            return;
        }

        $seasonsHTML = "";

        foreach ($seasons as $season) {
            $seasonNumber = $season->getSeasonNumber();

            $seasonsHTML .= "<div class='season'>
                                <h3>Season $seasonNumber</h3>
                            </div>";
        }

        return $seasonsHTML;
    }
}