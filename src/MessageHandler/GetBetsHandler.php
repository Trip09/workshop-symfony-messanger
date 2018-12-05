<?php

namespace App\MessageHandler;

use App\Message\GetBets;
use App\Repository\BetRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetBetsHandler implements MessageHandlerInterface
{
    /**
     * @var BetRepository
     */
    private $betRepository;

    /**
     * GetBetsHandler constructor.
     *
     * @param $betRepository
     */
    public function __construct(BetRepository $betRepository)
    {
        $this->betRepository = $betRepository;
    }


    public function __invoke(
        GetBets $bets
    ): array {
        return
            $this->betRepository->findAll();
    }
}