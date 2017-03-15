<?php

abstract class GameCharacter
{
    protected $health;
    protected $strength;
    protected $defense;
    protected $speed;
    protected $luck;

    protected $lucky;
    protected $characterType;

    public function __construct()
    {
        $this->lucky = false;
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param mixed $health
     */
    public function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    /**
     * @return mixed
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @param mixed $defense
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @param mixed $luck
     */
    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    /**
     * @return mixed
     */
    public function getCharacterType()
    {
        return $this->characterType;
    }

    /**
     * @param mixed $characterType
     */
    public function setCharacterType($characterType)
    {
        $this->characterType = $characterType;
    }

    public function isLucky()
    {
        if ($this->lucky) {
            return true;
        } else {
            return false;
        }
    }
}
