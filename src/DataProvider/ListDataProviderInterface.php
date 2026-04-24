<?php

declare(strict_types=1);

namespace Csaba\SalesApi\DataProvider;

interface ListDataProviderInterface
{
    public function getLists(): array;

    public function getListForms(string $listId): array;
}
