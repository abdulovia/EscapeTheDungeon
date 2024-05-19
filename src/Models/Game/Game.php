<?php

namespace EscapeTheDungeon\Models\Game;

use EscapeTheDungeon\Models\Dungeon\Dungeon;
use EscapeTheDungeon\Models\Dungeon\Room;
use EscapeTheDungeon\Models\Player\Player;

class Game
{
    private Dungeon $dungeon;
    private Player $player;

    public function __construct(Dungeon $dungeon)
    {
        $this->dungeon = $dungeon;
        $this->player = new Player($dungeon->getStartRoom());
    }

    public function placePlayerAtStart(): void
    {
        $this->player->setCurrentRoom($this->dungeon->getStartRoom());
        $this->player->interactWithRoom();
        $this->player->getCurrentRoom()->visit();
    }

    public function makeMove($roomId): void
    {
        $this->player->makeMove($roomId, $this->dungeon);
        $this->player->setCurrentRoom($this->dungeon->getRoom($roomId));
    }

    public function isComplete(): bool
    {
        return $this->player->getCurrentRoom() === $this->dungeon->getExitRoom();
    }

    public function getCurrentRoom(): Room
    {
        return $this->player->getCurrentRoom();
    }

    public function getScore(): int
    {
        return $this->player->getPoints();
    }
}