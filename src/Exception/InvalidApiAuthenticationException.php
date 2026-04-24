<?php

declare(strict_types=1);

namespace Csaba\SalesApi\Exception;

final class InvalidApiAuthenticationException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Missing or invalid API credentials.');
    }
}
