<?php

namespace EscapeTheDungeon\Models\Dungeon;

class MonsterRoom extends Room {
    private $strength;

    public function __construct($id, $strength) {
        parent::__construct($id);
        $this->strength = $strength;
    }

    public function fightMonster() {
        $roll = rand(1, 10);
        if ($roll > $this->strength) {
            $this->strength = -1;
        } else {
            $this->strength -= $roll; 
        }
        return $roll;
    }

    public function getMonster() {
        return $this;
    }

    public function getStrength() {
        return $this->strength;
    }

    public function isDefeated() {
        return $this->strength < 0;
    }
    
}
