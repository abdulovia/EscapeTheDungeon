<?php

namespace EscapeTheDungeon\Models\Player;

use EscapeTheDungeon\Models\Dungeon\Dungeon;
use EscapeTheDungeon\Models\Dungeon\Room;
use EscapeTheDungeon\Models\Dungeon\TreasureRoom;
use EscapeTheDungeon\Models\Dungeon\MonsterRoom;

class Player {
    private int $points = 0;
    private Room $currentRoom;

    public function __construct(Room $startRoom) {
        $this->currentRoom = $startRoom;
    }

    public function addPoints($points): void
    {
        $this->points += $points;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function getCurrentRoom(): Room
    {
        return $this->currentRoom;
    }

    public function setCurrentRoom(Room $room): void
    {
        $this->currentRoom = $room;
    }

    public function makeMove($roomId, Dungeon $dungeon): void
    {
        $nextRoom = $dungeon->getRoom($roomId);
        if (in_array($nextRoom, $this->currentRoom->getDoors())) {
            $this->currentRoom = $nextRoom;
            $this->interactWithRoom();
            $this->currentRoom->visit();
        }
    }

    public function interactWithRoom(): void
    {
        $currentRoom = $this->currentRoom;
        if (!$currentRoom->isVisited()) {
            if ($currentRoom instanceof TreasureRoom) {
                $treasurePoints = $currentRoom->collectTreasure();
                $rarity = $currentRoom->getTreasureRarity();
                $this->addPoints($treasurePoints);
                echo "Вы нашли сундук типа $rarity с сокровищами и получили столько очков: $treasurePoints!\n";
            } elseif ($currentRoom instanceof MonsterRoom) {
                $monster = $currentRoom;
                while (!$monster->isDefeated()) {
                    $monsterStrength = $monster->getStrength();
                    echo "Монстр атакует с силой $monsterStrength.\n";
                    $rollResult = $currentRoom->fightMonster();
                    if ($monster->isDefeated()) {
                        $this->addPoints($monsterStrength);
                        echo "Вы победили монстра и получили столько очков: $monsterStrength!\n";
                    } else {
                        echo "Выпадает число $rollResult и монстр остается жив. Его сила теперь " . $monster->getStrength() . ".\n";
                    }
                }
            } else {
                echo "Увы, эта комната пустая.\n";
            }
        } else {
            echo "Вы уже посетили эту комнату, тут пусто.\n";
        }
    }
    
}
