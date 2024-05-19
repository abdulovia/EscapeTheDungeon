<?php

namespace EscapeTheDungeon\Views;

class ConsoleView {
    public function welcome(): void
    {
        echo "Добро пожаловать в подземелье!" . PHP_EOL;
    }

    public function displayRoom($room): void
    {
        echo "Вы находитесь в комнате с ID: " . $room->getId() . PHP_EOL;
        echo "Доступные комнаты для перехода: " . implode(', ', array_map(function($door) {
                return $door->getId();
            }, $room->getDoors())) . PHP_EOL;
    }

    public function askForRoomId(): string
    {
        echo "Введите ID комнаты для перехода: ";
        return trim(fgets(fopen('php://stdin', 'r')));
    }

    public function congratulate($score, $path): void
    {
        echo "Поздравляем, вы достигли выхода!" . PHP_EOL;
        echo "Ваш итоговый счет: " . $score . PHP_EOL;
        echo "Кратчайший путь: " . implode(' -> ', $path) . PHP_EOL;
    }
}
