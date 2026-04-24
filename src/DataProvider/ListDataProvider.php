<?php

declare(strict_types=1);

namespace Csaba\SalesApi\DataProvider;

use Csaba\SalesApi\DTO\ListDTO;
use Csaba\SalesApi\DTO\ListFormDTO;
use Csaba\SalesApi\Services\ApiConnector;

final class ListDataProvider implements ListDataProviderInterface
{
    private ApiConnector $apiConnector;

    /**
     * @param ApiConnector $apiConnector
     */
    public function __construct(ApiConnector $apiConnector)
    {
        $this->apiConnector = $apiConnector;
    }

    /**
     * @throws \DateMalformedStringException
     * @throws \JsonException
     */
    public function getLists(): array
    {
        $listDTOs = [];

        foreach ($this->apiConnector->getLists() as $list) {
            $listDTOs[] = new ListDTO(
                $list['id'],
                $list['name'],
                $list['size'],
                new \DateTimeImmutable($list['created_at'])
            );
        }

        return $listDTOs;
    }

    public function getListForms(string $listId): array
    {
        $listFormDTOs = [];

        foreach ($this->apiConnector->getListForms($listId) as $form) {
            if ($form['list_id'] !== $listId) {
                continue;
            }

            $listFormDTOs[] = new ListFormDTO(
                $form['id'],
                $form['name'],
                $form['link']
            );
        }

        return $listFormDTOs;
    }
}
