<?php

namespace EscapeTheDungeon\Models\Player;

class Player {
    private $points = 0;

    public function addPoints($points) {
        $this->points += $points;
    }

    public function getPoints() {
        return $this->points;
    }
}
