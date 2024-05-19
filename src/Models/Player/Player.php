<?php

namespace EscapeTheDungeon\Models\Player;

use EscapeTheDungeon\Models\Dungeon\Dungeon;
use EscapeTheDungeon\Models\Dungeon\Room;
use EscapeTheDungeon\Models\Dungeon\TreasureRoom;
use EscapeTheDungeon\Models\Dungeon\MonsterRoom;

class Player {
    private $points = 0;
    private $currentRoom;

    public function __construct(Room $startRoom) {
        $this->currentRoom = $startRoom;
    }

    public function addPoints($points) {
        $this->points += $points;
    }

    public function getPoints() {
        return $this->points;
    }

    public function getCurrentRoom() {
        return $this->currentRoom;
    }

    public function makeMove($roomId, Dungeon $dungeon) {
        $nextRoom = $dungeon->getRoom($roomId);
        if (in_array($nextRoom, $this->currentRoom->getDoors())) {
            $this->currentRoom = $nextRoom;
            $this->interactWithRoom();
        }
    }

    private function interactWithRoom() {
        if (!$this->currentRoom->isVisited()) {
            if ($this->currentRoom instanceof TreasureRoom) {
                $treasure = $this->currentRoom->collectTreasure();
                $this->addPoints($treasure);
            } elseif ($this->currentRoom instanceof MonsterRoom) {
                $points = $this->currentRoom->fight();
                $this->addPoints($points);
            }
        }
    }
}
