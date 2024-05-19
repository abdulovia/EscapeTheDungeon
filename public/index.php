<?php

require_once __DIR__ . '/../vendor/autoload.php';

use EscapeTheDungeon\Models\Dungeon\Dungeon;
use EscapeTheDungeon\Models\Game\Game;
use EscapeTheDungeon\Views\ConsoleView;
use EscapeTheDungeon\Controllers\GameController;

$dungeonData = json_decode(file_get_contents(__DIR__ . '/../data/dungeon.json'), true);

$dungeon = new Dungeon($dungeonData);
$game = new Game($dungeon);
$view = new ConsoleView($game);
$controller = new GameController($game, $view);

$controller->startGame();
