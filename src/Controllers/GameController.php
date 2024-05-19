<?php

namespace EscapeTheDungeon\Controllers;

use EscapeTheDungeon\Models\Game\Game;
use EscapeTheDungeon\Views\ConsoleView;

class GameController {
    private $game;
    private $view;

    public function __construct(Game $game, ConsoleView $view) {
        $this->game = $game;
        $this->view = $view;
    }

    public function startGame() {
        $this->view->startView();
        $this->game->placePlayerAtStart(); // Помещаем игрока в начальную комнату и взаимодействуем с ней
        $this->view->displayMoveResult();
        $this->view->displayCurrentRoom();
        while (!$this->game->isComplete()) {
            $this->view->promptMove(); // Итерация следующего хода игрока
        }
        $this->view->displayCompletion();
    }
}
