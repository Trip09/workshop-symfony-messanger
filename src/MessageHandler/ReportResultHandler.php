<?php

namespace App\MessageHandler;

use App\Entity\Bet;
use App\Message\Lost;
use App\Message\ReportResult;
use App\Message\Won;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ReportResultHandler implements MessageHandlerInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var MessageBusInterface
     */
    private $eventBus;

    /**
     * ReportResultHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param MessageBusInterface    $eventBus
     */
    public function __construct(EntityManagerInterface $entityManager, MessageBusInterface $eventBus)
    {
        $this->entityManager = $entityManager;
        $this->eventBus      = $eventBus;
    }

    public function __invoke(
        ReportResult $message
    ) {
        $finalResultBet = $message->getBet();

        $bets = $this->entityManager->getRepository(get_class($finalResultBet))->findBy(
            ['game' => $finalResultBet->game]
        );

        /** @var Bet $bet */
        foreach ($bets as $bet) {
            if (
                $bet->getLeftScore() === $finalResultBet->getLeftScore()
                && $bet->getRightScore() === $finalResultBet->getRightScore()
            ) {
                $this->eventBus->dispatch(new Won($bet));
            } else {
                $this->eventBus->dispatch(new Lost($bet));
            }
        }
    }
}