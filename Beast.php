<?php

require_once 'GameCharacter.php';

class Beast extends GameCharacter {

    public function __construct()
    {
        $this->setHealth(mt_rand(60, 90));
        $this->setStrength(mt_rand(60, 90));
        $this->setDefense(mt_rand(40, 60));
        $this->setSpeed(mt_rand(40, 60));
        $this->setLuck(mt_rand(25, 40));
        $this->setCharacterType('beast');
    }
}
