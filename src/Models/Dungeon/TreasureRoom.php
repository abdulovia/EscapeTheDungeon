<?php

namespace EscapeTheDungeon\Models\Dungeon;

class TreasureRoom extends Room {
    private string $rarity;
    private int $treasure;

    public function __construct($id, $rarity) {
        parent::__construct($id);
        $this->rarity = $rarity;
        $this->generateTreasure();
    }

    private function generateTreasure(): void
    {
        $this->treasure = match ($this->rarity) {
            'common' => rand(0, 10),
            'rare' => rand(10, 20),
            'epic' => rand(20, 30),
            default => 0,
        };
    }

    public function getTreasureRarity(): string
    {
        return $this->rarity;
    }

    public function collectTreasure(): int
    {
        $treasure = $this->treasure;
        $this->treasure = 0;
        return $treasure;
    }
}
