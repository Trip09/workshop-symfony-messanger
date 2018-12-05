<?php

namespace App\Controller;

use App\Entity\Bet;
use App\Message\GetBets;
use App\Message\RegisterBet;
use App\Message\ReportResult;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/", methods={"GET"})
     * @Template
     */
    public function home(MessageBusInterface $messageBus)
    {
        $envelope     = $messageBus->dispatch(new GetBets());
        $handledStamp = $envelope->last(HandledStamp::class);

        return ['bets' => $handledStamp->getResult()];
    }

    /**
     * @Route("/", methods={"POST"})
     * @Template
     */
    public function homePost(Request $request, MessageBusInterface $messageBus)
    {
        $messageBus->dispatch(
            new RegisterBet(
                new Bet(
                    $request->get('who'),
                    $request->get('game'),
                    $request->get('left_score'),
                    $request->get('right_score')
                )
            )
        );

        return new RedirectResponse('/');
    }
    /**
     * @Route("/report", name="report", methods={"POST"})
     * @Template
     */
    public function reportPost(Request $request, MessageBusInterface $messageBus)
    {
        $messageBus->dispatch(
            new ReportResult(
                new Bet(
                    '',
                    $request->get('game'),
                    $request->get('left_score'),
                    $request->get('right_score')
                )
            )
        );

        return new RedirectResponse('/');
    }
}
