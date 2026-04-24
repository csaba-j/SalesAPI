<?php

declare(strict_types=1);

namespace Csaba\SalesApi\Exception;

final class NotFoundException extends \RuntimeException
{
    public function __construct(string $endpoint = '')
    {
        parent::__construct('API Endpoint not found. (' . $endpoint . ')');
    }
}
