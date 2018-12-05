<?php

namespace App\MessageHandler;

use App\Message\GameResultMessage;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class BetResultHandler implements MessageSubscriberInterface
{
    public static function getHandledMessages(): iterable
    {
        yield GameResultMessage::class => [
            'method' => 'handle',
            'bus'    => 'this_is_the_name_that_we_have_defined_bus',
        ];
    }

    public function handle(
        GameResultMessage $message
    ): void {
        dump($message->bet->getWho() . ' ' . get_class($message) . '<br />');
    }
}