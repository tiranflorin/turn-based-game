<?php

require_once 'Beast.php';
require_once 'Hero.php';
require_once 'TurnBasedMatch.php';

$hero = new Hero();
$beast = new Beast();
$match = new TurnBasedMatch();

$match->prepare($hero, $beast); // Set up game data
$match->start();

if ($match->getState() !== 'ENDED') {
    $match->end();
}
