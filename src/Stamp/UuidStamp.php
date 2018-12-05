<?php

namespace App\Stamp;

use Symfony\Component\Messenger\Stamp\StampInterface;

final class UuidStamp implements StampInterface
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * UuidStamp constructor.
     *
     * @param string $uuid
     */
    public function __construct(string $uuid = null)
    {

        $this->uuid = $uuid ?? uniqid('uuid-stamp', true);
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
