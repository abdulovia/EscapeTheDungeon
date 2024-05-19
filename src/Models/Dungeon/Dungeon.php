<?php

namespace EscapeTheDungeon\Models\Dungeon;

class Dungeon {
    private array $rooms = [];
    private Room $startRoom;
    private Room $exitRoom;

    public function __construct(array $data) {
        $this->load($data);
    }

    private function load(array $data) : void {
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

    private function createRoom(array $roomData) : Room {
        return match ($roomData['type']) {
            'treasure' => new TreasureRoom($roomData['id'], $roomData['rarity']),
            'monster' => new MonsterRoom($roomData['id'], $roomData['strength']),
            default => new EmptyRoom($roomData['id']),
        };
    }

    public function getStartRoom(): Room
    {
        return $this->startRoom;
    }

    public function getExitRoom(): Room
    {
        return $this->exitRoom;
    }

    public function getRoom($id) {
        return $this->rooms[$id];
    }

    // Нахождения кратчайшего пути в лабиринте с помощью алгоритма поиска в ширину
    public function getPath(): ?array
    {
        $start = $this->startRoom->getId();
        $end = $this->exitRoom->getId();
        $queue = [[$start]];
        $visited = [];
        while (!empty($queue)) {
            $path = array_shift($queue);
            $roomId = end($path);
            if ($roomId == $end) {
                return $path;
            }
            if (!in_array($roomId, $visited)) {
                $visited[] = $roomId;
                foreach ($this->rooms[$roomId]->getDoors() as $neighbor) {
                    $newPath = $path;
                    $newPath[] = $neighbor->getId();
                    $queue[] = $newPath;
                }
            }
        }
        return null;
    }
}
