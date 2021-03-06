<?php

namespace App\Message;

use App\Entity\Bet;

class Won implements GameResultMessage
{
    /**
     * @var Bet
     */
    public $bet;

    /**
     * Won constructor.
     *
     * @param Bet $bet
     */
    public function __construct(Bet $bet)
    {
        $this->bet = $bet;
    }
}
