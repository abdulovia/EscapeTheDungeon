<?php

namespace EscapeTheDungeon\Models\Game;

use EscapeTheDungeon\Models\Dungeon\Dungeon;
use EscapeTheDungeon\Models\Player\Player;

class Game {
    private $dungeon;
    private $player;
    private $currentRoom;
    private $path = [];

    public function __construct(Dungeon $dungeon) {
        $this->dungeon = $dungeon;
        $this->player = new Player($dungeon->getStartRoom());
        $this->currentRoom = $this->player->getCurrentRoom();
    }

    public function start() {
        $this->path[] = $this->currentRoom->getId();
    }

    public function makeMove($roomId) {
        $this->player->makeMove($roomId, $this->dungeon);
        $this->currentRoom = $this->player->getCurrentRoom();
        $this->path[] = $this->currentRoom->getId();
    }

    public function isComplete() {
        return $this->currentRoom === $this->dungeon->getExitRoom();
    }

    public function getCurrentRoom() {
        return $this->currentRoom;
    }

    public function getScore() {
        return $this->player->getPoints();
    }

    public function getPath() {
        return $this->path;
    }
}
