<?php

declare(strict_types=1);

namespace Csaba\SalesApi\DTO;

final class ListFormDTO
{
    public string $id;
    public string $name;
    public string $link;

    public function __construct(string $id, string $name, string $link)
    {
        $this->id = $id;
        $this->name = $name;
        $this->link = $link;
    }
}
