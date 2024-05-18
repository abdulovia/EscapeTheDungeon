<?php

class Player
{
    private $score;

    public function __construct($score) {
        $this->score = $score;
    }

    public function getScore() {
        return $this->score;
    }

    public function makeMove() {

    }

    public function updateScore($score) {

    }
}