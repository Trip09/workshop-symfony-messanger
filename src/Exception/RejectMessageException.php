<?php

namespace App\Exception;

use Symfony\Component\Messenger\Transport\AmqpExt\Exception\RejectMessageExceptionInterface;

class RejectMessageException extends \RuntimeException implements RejectMessageExceptionInterface
{

}