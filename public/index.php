<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Csaba\SalesApi\DataProvider\MockDataProvider;
use Csaba\SalesApi\Services\ApiConnector;
use Csaba\SalesApi\View\ListPageDataFactory;
use Csaba\SalesApi\View\View;

$error = '';
//Dummy adatok:
//$listPageDataFactory = new ListPageDataFactory(new MockDataProvider());
$apiConnector = new ApiConnector();
try {
    //Dummy adatok:
    //$viewData = $listPageDataFactory->build($_GET);
    $viewData = $apiConnector->getListForms($_GET['listId'] ?? '');
} catch (\Throwable $e) {
    $error = $e->getMessage();
}

(new View())->render('lists', $viewData, $error);
