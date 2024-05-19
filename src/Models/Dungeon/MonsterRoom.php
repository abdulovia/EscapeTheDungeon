<?php

namespace EscapeTheDungeon\Models\Dungeon;

class MonsterRoom extends Room {
    private $strength;

    public function __construct($id, $strength) {
        parent::__construct($id);
        $this->strength = $strength;
    }

    public function fight() {
        while ($this->strength > 0) {
            $roll = rand(1, 100);
            if ($roll > $this->strength) {
                $this->visit();
                return $this->strength;
            } else {
                $this->strength -= rand(1, 10); 
            }
        }

        $this->visit();
        return 0;
    }
}
