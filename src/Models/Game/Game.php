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
        $this->player = new Player();
        $this->currentRoom = $dungeon->getStartRoom();
    }

    public function start() {
        $this->path[] = $this->currentRoom->getId();
    }

    public function move($roomId) {
        $nextRoom = $this->dungeon->getRoom($roomId);
        if (in_array($nextRoom, $this->currentRoom->getDoors())) {
            $this->currentRoom = $nextRoom;
            $this->path[] = $this->currentRoom->getId();
            $this->interactWithRoom();
        }
    }

    private function interactWithRoom() {
        if (!$this->currentRoom->isVisited()) {
            if ($this->currentRoom instanceof TreasureRoom) {
                $treasure = $this->currentRoom->collectTreasure();
                $this->player->addPoints($treasure);
            } elseif ($this->currentRoom instanceof MonsterRoom) {
                $points = $this->currentRoom->fight();
                $this->player->addPoints($points);
            }
        }
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
