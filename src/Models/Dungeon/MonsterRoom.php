<?php

namespace EscapeTheDungeon\Models\Dungeon;

class MonsterRoom extends Room {
    private int $strength;

    public function __construct($id, $strength) {
        parent::__construct($id);
        $this->strength = $strength;
    }

    public function fightMonster(): int
    {
        $roll = rand(1, 10);
        if ($roll > $this->strength) {
            $this->strength = -1;
        } else {
            $this->strength -= $roll; 
        }
        return $roll;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function isDefeated(): bool
    {
        return $this->strength < 0;
    }
    
}
