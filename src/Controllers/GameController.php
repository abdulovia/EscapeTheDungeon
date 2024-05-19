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

    public function run() {
        $this->game->start();
        $this->view->welcome();

        while (!$this->game->isComplete()) {
            $currentRoom = $this->game->getCurrentRoom();
            $this->view->displayRoom($currentRoom);

            $roomId = $this->view->askForRoomId();
            $this->game->makeMove($roomId);
        }

        $this->view->congratulate($this->game->getScore(), $this->game->getPath());
    }
}
