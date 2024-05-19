<?php

namespace EscapeTheDungeon\Models\Dungeon;

class Room {
    protected int $id;
    protected array $doors;
    protected bool $visited;

    public function __construct($id) {
        $this->id = $id;
        $this->doors = [];
        $this->visited = false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addDoor(Room $room): void
    {
        $this->doors[] = $room;
    }

    public function getDoors(): array
    {
        return $this->doors;
    }

    public function isVisited(): bool
    {
        return $this->visited;
    }

    public function visit(): void
    {
        $this->visited = true;
    }
}
