<?php


namespace App\Middleware;


use App\Stamp\UuidStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class AuditMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (null === $envelope->last(UuidStamp::class)) {
            $envelope = $envelope->with(new UuidStamp());
        }

        return $stack->next()->handle($envelope, $stack);

    }
}