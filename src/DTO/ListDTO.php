<?php

declare(strict_types=1);

namespace Csaba\SalesApi\DTO;

final class ListDTO
{
    public string $id;
    public string $name;
    public int $size;
    public \DateTimeImmutable $createdAt;

    public function __construct(string $id, string $name, int $size, \DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
        $this->createdAt = $createdAt;
    }
}
