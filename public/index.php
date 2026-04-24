<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Csaba\SalesApi\DataProvider\MockDataProvider;
use Csaba\SalesApi\View\ListPageDataFactory;
use Csaba\SalesApi\View\View;

$error = '';
$listPageDataFactory = new ListPageDataFactory(new MockDataProvider());
try {
    $viewData = $listPageDataFactory->build($_GET);
} catch (\Throwable $e) {
    $error = $e->getMessage();
}

(new View())->render('lists', $viewData, $error);
