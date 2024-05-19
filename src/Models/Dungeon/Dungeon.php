<?php

namespace EscapeTheDungeon\Models\Dungeon;

class Dungeon {
    private $rooms = [];
    private $startRoom;
    private $exitRoom;

    public function __construct(array $data) {
        $this->load($data);
    }

    private function load(array $data) {
        foreach ($data['rooms'] as $roomData) {
            $room = $this->createRoom($roomData);
            $this->rooms[$roomData['id']] = $room;
        }

        foreach ($data['rooms'] as $roomData) {
            $room = $this->rooms[$roomData['id']];
            foreach ($roomData['doors'] as $doorId) {
                $room->addDoor($this->rooms[$doorId]);
            }
        }

        $this->startRoom = $this->rooms[$data['startRoomId']];
        $this->exitRoom = $this->rooms[$data['exitRoomId']];
    }

    private function createRoom(array $roomData) {
        switch ($roomData['type']) {
            case 'treasure':
                return new TreasureRoom($roomData['id'], $roomData['rarity']);
            case 'monster':
                return new MonsterRoom($roomData['id'], $roomData['strength']);
            case 'empty':
            default:
                return new EmptyRoom($roomData['id']);
        }
    }

    public function getStartRoom() {
        return $this->startRoom;
    }

    public function getExitRoom() {
        return $this->exitRoom;
    }

    public function getRoom($id) {
        return $this->rooms[$id];
    }
}
