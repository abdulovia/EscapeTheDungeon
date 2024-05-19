<?php

namespace EscapeTheDungeon\Controllers;

use EscapeTheDungeon\Models\Game\Game;
use EscapeTheDungeon\Views\ConsoleView;

class GameController {
    private Game $game;
    private ConsoleView $view;

    public function __construct(Game $game, ConsoleView $view) {
        $this->game = $game;
        $this->view = $view;
    }

    public function startGame(): void
    {
        $this->view->displayMoveResult();
        $this->view->displayCurrentRoom();
        // Обрабатываем перемещения игрока пока игрок не достигнет выхода
        while (!$this->game->isComplete()) {
            $this->view->promptMove();
        }
        $this->view->displayCompletion();
    }
}
