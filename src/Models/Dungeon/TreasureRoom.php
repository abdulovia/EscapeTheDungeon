<?php

namespace EscapeTheDungeon\Models\Dungeon;

class TreasureRoom extends Room {
    private $rarity;
    private $treasure;

    public function __construct($id, $rarity) {
        parent::__construct($id);
        $this->rarity = $rarity;
        $this->generateTreasure();
    }

    private function generateTreasure() {
        switch ($this->rarity) {
            case 'common':
                $this->treasure = rand(10, 20);
                break;
            case 'rare':
                $this->treasure = rand(20, 50);
                break;
            case 'epic':
                $this->treasure = rand(50, 100);
                break;
            default:
                $this->treasure = 0;
        }
    }

    public function collectTreasure() {
        $treasure = $this->treasure;
        $this->treasure = 0;
        $this->visit();
        return $treasure;
    }
}
