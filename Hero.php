<?php

require_once 'GameCharacter.php';

class Hero extends GameCharacter
{

    protected $rapidStrike;
    protected $magicShield;

    public function __construct()
    {
        $this->setHealth(mt_rand(70, 100));
        $this->setStrength(mt_rand(70, 80));
        $this->setDefense(mt_rand(45, 55));
        $this->setSpeed(mt_rand(40, 50));
        $this->setLuck(mt_rand(10, 30));
        $this->setRapidStrike(10);
        $this->setMagicShield(20);
        $this->setCharacterType('hero');
    }

    /**
     * @return mixed
     */
    public function getRapidStrike()
    {
        return $this->rapidStrike;
    }

    /**
     * @param mixed $rapidStrike
     */
    public function setRapidStrike($rapidStrike)
    {
        $this->rapidStrike = $rapidStrike;
    }

    /**
     * @return mixed
     */
    public function getMagicShield()
    {
        return $this->magicShield;
    }

    /**
     * @param mixed $magicShield
     */
    public function setMagicShield($magicShield)
    {
        $this->magicShield = $magicShield;
    }

    public function isUsingSkill($skill)
    {
        $accessor = 'get' . ucfirst($skill);
        if (mt_rand(1, 100) <= $this->$accessor()) {
            return true;
        } else {
            return false;
        }
    }
}
