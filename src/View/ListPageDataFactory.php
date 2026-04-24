<?php

declare(strict_types=1);

namespace Csaba\SalesApi\View;

use Csaba\SalesApi\DataProvider\ListDataProviderInterface;
use Csaba\SalesApi\DTO\ListDTO;

final class ListPageDataFactory
{
    private const DEFAULT_SORT = 'name';
    private const DEFAULT_DIR = 'asc';
    private const FORMS_LIMIT = 20;
    private const ALLOWED_SORT_COLUMNS = ['name', 'size', 'createdAt'];
    private const ALLOWED_DIRECTIONS = ['asc', 'desc'];

    public function __construct(private ListDataProviderInterface $dataProvider)
    {
    }

    public function build(array $queryParams): array
    {
        $sort = $this->resolveSort($queryParams['sort'] ?? null);
        $direction = $this->resolveDirection($queryParams['dir'] ?? null);
        $selectedListId = $this->resolveSelectedListId($queryParams['listId'] ?? null);

        $lists = $this->dataProvider->getLists();
        $this->sortLists($lists, $sort, $direction);

        $selectedList = $this->findSelectedList($lists, $selectedListId);
        $selectedListForms = [];

        if ($selectedList !== null) {
            $selectedListForms = array_slice(
                $this->dataProvider->getListForms($selectedList->id),
                0,
                self::FORMS_LIMIT
            );
        }

        return [
            'lists' => $lists,
            'sort' => $sort,
            'dir' => $direction,
            'selectedListId' => $selectedListId,
            'selectedList' => $selectedList,
            'selectedListForms' => $selectedListForms,
        ];
    }

    private function resolveSort(mixed $sort): string
    {
        if (!is_string($sort) || !in_array($sort, self::ALLOWED_SORT_COLUMNS, true)) {
            return self::DEFAULT_SORT;
        }

        return $sort;
    }

    private function resolveDirection(mixed $direction): string
    {
        if (!is_string($direction)) {
            return self::DEFAULT_DIR;
        }

        $direction = strtolower($direction);
        if (!in_array($direction, self::ALLOWED_DIRECTIONS, true)) {
            return self::DEFAULT_DIR;
        }

        return $direction;
    }

    private function resolveSelectedListId(mixed $selectedListId): ?string
    {
        if (!is_string($selectedListId) || $selectedListId === '') {
            return null;
        }

        return $selectedListId;
    }

    /**
     * @param ListDTO[] $lists
     */
    private function sortLists(array &$lists, string $sort, string $direction): void
    {
        usort(
            $lists,
            static function (ListDTO $left, ListDTO $right) use ($sort, $direction): int {
                $result = match ($sort) {
                    'name' => strcasecmp($left->name, $right->name),
                    'size' => $left->size <=> $right->size,
                    'createdAt' => $left->createdAt->getTimestamp() <=> $right->createdAt->getTimestamp(),
                    default => 0,
                };

                return $direction === 'desc' ? -$result : $result;
            }
        );
    }

    /**
     * @param ListDTO[] $lists
     */
    private function findSelectedList(array $lists, ?string $selectedListId): ?ListDTO
    {
        if ($selectedListId === null) {
            return null;
        }

        foreach ($lists as $list) {
            if ($list->id === $selectedListId) {
                return $list;
            }
        }

        return null;
    }
}
