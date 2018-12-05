<?php

namespace App\MessageHandler;

use App\Exception\RejectMessageException;
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
        if (\random_int(1, 1005) === 5) {
            throw new RejectMessageException('This Exception it\'s done  on purpose to remove the message from the queue');
        }

        dump($message->bet->getWho() . ' ' . get_class($message) . '<br />');
    }
}