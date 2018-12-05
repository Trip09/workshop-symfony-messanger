<?php


namespace App\Middleware;


use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class AuditMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        dump("Handling Stufff \n");
        $result = $stack->next()->handle($envelope, $stack);
        dump("After Stufff \n");

        return $result;
    }
}