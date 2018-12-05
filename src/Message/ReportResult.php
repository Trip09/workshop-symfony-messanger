<?php

namespace App\Message;

use App\Entity\Bet;

class ReportResult
{
    private $bet;

    public function __construct(Bet $bet)
    {
        $this->bet = $bet;
    }

    /**
     * @return Bet
     */
    public function getBet(): Bet
    {
        return $this->bet;
    }
}