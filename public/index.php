<?php

require_once __DIR__ . '/../vendor/autoload.php';

use EscapeTheDungeon\Models\Dungeon\Dungeon;
use EscapeTheDungeon\Models\Game\Game;
use EscapeTheDungeon\Controllers\GameController;
use EscapeTheDungeon\Views\ConsoleView;

$dungeonData = json_decode(file_get_contents(__DIR__ . '/../data/dungeon.json'), true);

$dungeon = new Dungeon($dungeonData);

$game = new Game($dungeon);
$view = new ConsoleView();
$controller = new GameController($game, $view);

$controller->run();

