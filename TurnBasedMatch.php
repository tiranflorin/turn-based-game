<?php

class TurnBasedMatch
{
    protected $state; // NOT_STARTED, IN_PROGRESS, ENDED
    protected $nbTurns;
    protected $turnStatus;
    protected $winner;

    /** @var  Hero $hero */
    protected $hero;

    /** @var  Beast $beast */
    protected $beast;

    public function __construct()
    {
        $this->state = 'NOT_STARTED';
        $this->nbTurns = 1;
        $this->winner = 'none';
    }

    public function prepare(GameCharacter $hero, GameCharacter $beast)
    {
        $this->hero = $hero;
        $this->beast = $beast;

        if ($hero->getLuck() > $beast->getLuck()) {
            $this->turnStatus = 'hero';
        } else {
            $this->turnStatus = 'beast';
        }

        echo 'Initial STATS: ' . PHP_EOL;

        echo 'Hero: ' . PHP_EOL;
        echo chr(9) . 'Health: ' . $hero->getHealth() . PHP_EOL;
        echo chr(9) . 'Strength: ' . $hero->getStrength() . PHP_EOL;
        echo chr(9) . 'Defense: ' . $hero->getDefense() . PHP_EOL;
        echo chr(9) . 'Speed: ' . $hero->getSpeed() . PHP_EOL;
        echo chr(9) . 'Luck: ' . $hero->getLuck() . PHP_EOL;

        echo 'Beast: ' . PHP_EOL;
        echo chr(9) . 'Health: ' . $beast->getHealth() . PHP_EOL;
        echo chr(9) . 'Strength: ' . $beast->getStrength() . PHP_EOL;
        echo chr(9) . 'Defense: ' . $beast->getDefense() . PHP_EOL;
        echo chr(9) . 'Speed: ' . $beast->getSpeed() . PHP_EOL;
        echo chr(9) . 'Luck: ' . $beast->getLuck() . PHP_EOL . PHP_EOL;

    }

    public function start()
    {
        $this->state = 'IN_PROGRESS';
        while ($this->nbTurns <= 20) {

            if ($this->turnStatus === 'hero') {
                $this->fight($this->hero, $this->beast);
                $this->turnStatus = 'beast';
            } else {
                $this->fight($this->beast, $this->hero);
                $this->turnStatus = 'hero';
            }

            if ($this->state === 'ENDED') {
                $this->end();
                break;
            }

            $this->nbTurns++;
        }
    }

    protected function fight(GameCharacter $attacker, GameCharacter $defender)
    {
        echo 'Round ' . $this->nbTurns . ':' . PHP_EOL;
        echo 'Attacker: ' . $attacker->getCharacterType() . PHP_EOL;
        echo 'Defender: ' . $defender->getCharacterType() . PHP_EOL;
        echo 'Defender health before the attack: ' . $defender->getHealth() . PHP_EOL;

        if ($defender->isLucky()) {
            echo 'Defender was lucky. No damage inflicted this turn. ' . PHP_EOL;

            return;
        }

        $magicShieldUsed = false;
        if ($defender->getCharacterType() == 'hero') {
            $magicShieldUsed = $defender->isUsingSkill('magicShield');
        }

        $healthRemaining = $this->strike($attacker, $defender, $magicShieldUsed);
        if ($attacker->getCharacterType() == 'hero') {
            $rapidStrikeUsage = $attacker->isUsingSkill('rapidStrike');
            if ($rapidStrikeUsage) {
                $defender->setHealth($healthRemaining);
                $healthRemaining = $this->strike($attacker, $defender, false);
                echo 'Attaker is using skill <rapidStrike>. ' . PHP_EOL;
            }
        }

        if ($healthRemaining <= 0) {
            $this->setWinner($attacker->getCharacterType());
            $this->state = 'ENDED';

            return;
        } else {
            $defender->setHealth($healthRemaining);
        }
        echo 'Defender health after the attack: ' . $defender->getHealth() . PHP_EOL . PHP_EOL;
    }

    protected function strike($attacker, $defender, $magicShieldUsed)
    {
        $damageInflicted = $attacker->getStrength() - $defender->getDefense();
        if ($magicShieldUsed) {
            $damageInflicted = $damageInflicted / 2;
            echo 'Defender is using skill <magicShield>. ' . PHP_EOL;
        }
        echo 'Damage inflicted: ' . $damageInflicted . PHP_EOL;

        return $defender->getHealth() - $damageInflicted;
    }

    public function end()
    {
        echo PHP_EOL . PHP_EOL . PHP_EOL . '___~~~^^^!!! Game Over !!!^^^~~~___' . PHP_EOL;
        if ('none' === $this->winner) {
            echo 'The opponents were tough. There\s no winner after 20 rounds.' . PHP_EOL;
        } else {
            echo 'And the winner is our ... ' . strtoupper($this->winner) . PHP_EOL;
            echo 'Match turns: ' . $this->getNbTurns() . PHP_EOL;
        }
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getNbTurns()
    {
        return $this->nbTurns;
    }

    /**
     * @param int $nbTurns
     */
    public function setNbTurns($nbTurns)
    {
        $this->nbTurns = $nbTurns;
    }

    /**
     * @return mixed
     */
    public function getTurnStatus()
    {
        return $this->turnStatus;
    }

    /**
     * @param mixed $turnStatus
     */
    public function setTurnStatus($turnStatus)
    {
        $this->turnStatus = $turnStatus;
    }

    /**
     * @return mixed
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @param mixed $winner
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
    }
}
