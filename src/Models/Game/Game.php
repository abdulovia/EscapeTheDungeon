<?php

namespace EscapeTheDungeon\Models\Game;

use EscapeTheDungeon\Models\Dungeon\Dungeon;
use EscapeTheDungeon\Models\Player\Player;

class Game {
    private $dungeon;
    private $player;
    private $path = [];

    public function __construct(Dungeon $dungeon) {
        $this->dungeon = $dungeon;
        $this->player = new Player($dungeon->getStartRoom());
    }

    public function placePlayerAtStart() {
        $this->player->setCurrentRoom($this->dungeon->getStartRoom());
        $this->player->interactWithRoom();
        $this->player->getCurrentRoom()->visit();
        $this->path[] = $this->dungeon->getStartRoom()->getId();
    }

    public function makeMove($roomId) {
        $this->path[] = $roomId;
        $this->player->makeMove($roomId, $this->dungeon);
        $this->player->setCurrentRoom($this->dungeon->getRoom($roomId));
    }

    public function isComplete() {
        return $this->player->getCurrentRoom() === $this->dungeon->getExitRoom();
    }

    public function getCurrentRoom() {
        return $this->player->getCurrentRoom();
    }

    public function getScore() {
        return $this->player->getPoints();
    }

    public function getDoors() {
        return $this->player->getCurrentRoom()->getDoors();
    }

    public function getPath() {
        return $this->path;
    }
}
