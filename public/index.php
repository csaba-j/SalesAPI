<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Csaba\SalesApi\DataProvider\MockDataProvider;
use Csaba\SalesApi\View\ListPageDataFactory;
use Csaba\SalesApi\View\View;

$listPageDataFactory = new ListPageDataFactory(new MockDataProvider());
$viewData = $listPageDataFactory->build($_GET);

(new View())->render('lists', $viewData);
