<?php

declare(strict_types=1);

namespace Csaba\SalesApi\Exception;

final class RateLimitExceededException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('API Rate limit túllépve.');
    }
}
