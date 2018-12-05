<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A Bet on a Game
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\BetRepository")
 */
class Bet
{
    /**
     * A id for the car
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $id;

    /**
     * Who did it?
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    public $who;

    /**
     * The game name
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    public $game;

    /**
     * The score for the left player
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    public $leftScore;

    /**
     * The score for the left player
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    public $rightScore;

    /**
     * Bet constructor.
     *
     * @param string $who
     * @param string $game
     * @param string $leftScore
     * @param string $rightScore
     */
    public function __construct(string $who, string $game, string $leftScore, string $rightScore)
    {
        $this->who        = $who;
        $this->game       = $game;
        $this->leftScore  = $leftScore;
        $this->rightScore = $rightScore;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getWho(): string
    {
        return $this->who;
    }

    /**
     * @return string
     */
    public function getLeftScore(): string
    {
        return $this->leftScore;
    }

    /**
     * @param string $leftScore
     *
     * @return $this
     */
    public function setLeftScore(string $leftScore)
    {
        $this->leftScore = $leftScore;

        return $this;
    }

    /**
     * @return string
     */
    public function getRightScore(): string
    {
        return $this->rightScore;
    }

    /**
     * @param string $rightScore
     *
     * @return $this
     */
    public function setRightScore(string $rightScore)
    {
        $this->rightScore = $rightScore;

        return $this;
    }
}
