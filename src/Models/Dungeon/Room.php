<?php

namespace EscapeTheDungeon\Models\Dungeon;

class Room {
    protected $id;
    protected $doors = [];
    protected $visited = false;

    public function __construct($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function addDoor(Room $room) {
        $this->doors[] = $room;
    }

    public function getDoors() {
        return $this->doors;
    }

    public function isVisited() {
        return $this->visited;
    }

    public function visit() {
        $this->visited = true;
    }
}
