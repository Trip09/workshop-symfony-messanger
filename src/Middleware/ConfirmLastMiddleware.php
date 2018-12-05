<?php


namespace App\Middleware;


use App\Stamp\UuidStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Stamp\ReceivedStamp;
use Symfony\Component\Messenger\Stamp\SentStamp;

class ConfirmLastMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $id = $envelope->last(UuidStamp::class)->getUuid() ?? 'Missing #ID';
        if ($envelope->last(ReceivedStamp::class)) {
            dump("*** Received ***\n", $id);
        } else {
            dump("*** Dispatcing ***\n", $id);
        }

        $envelope = $stack->next()->handle($envelope, $stack);

        if ($envelope->last(SentStamp::class)) {
            dump("*** SENT ***\n", $id);
        } elseif ($envelope->last(HandledStamp::class)) {
            dump("*** Handle ***\n");
        } else {
            dump("WTF???? \n");
        }

        dump($envelope);

        return $envelope;
    }
}