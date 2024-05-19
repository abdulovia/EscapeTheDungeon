<?php

namespace EscapeTheDungeon\Views;

use EscapeTheDungeon\Models\Game\Game;

class ConsoleView {
    private Game $game;

    public function __construct(Game $game) {
        $this->game = $game;
    }

    public function startView(): void
    {
        echo "Добро пожаловать в игру EscapeTheDungeon!\n";
        echo "Вы начинаете свое приключение...\n";
    }

    public function promptMove(): void
    {
        echo "\nВведите номер комнаты для перехода: ";
        $roomId = trim(fgets(STDIN));
        $doors = array_map(function($room) {
            return $room->getId();
        }, $this->game->getCurrentRoom()->getDoors());
        if (is_numeric($roomId) && in_array((int)$roomId, $doors)) {
            $this->game->makeMove((int)$roomId);
            $this->displayMoveResult();
            $this->displayCurrentRoom();
        } else {
            echo "Пожалуйста, введите допустимый номер комнаты, в который ведет дверь.\n";
            $this->promptMove();
        }
    }

    public function displayCurrentRoom(): void
    {
        $currentRoom = $this->game->getCurrentRoom();
        echo "Вы в комнате " . $currentRoom->getId() . "\n";

        $doors = array_map(function($room) {
            return $room->getId();
        }, $currentRoom->getDoors());

        echo "Доступные комнаты для перехода: " . implode(", ", $doors) . "\n";
    }

    public function displayMoveResult(): void
    {
        echo "Ваш текущий счет: " . $this->game->getScore() . "\n";
    }

    public function displayCompletion(): void
    {
        echo "\nПоздравляем, вы достигли выхода из подземелья!\n";
        echo "Ваш итоговый счет: " . $this->game->getScore() . "\n";
    }
}
