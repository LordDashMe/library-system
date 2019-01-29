<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';
require '../../helpers.php';

use JoshuaReyes\LibrarySystem\Domain\UseCase\ShowBooksDataTable;
use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    exit("You're not using GET request method.");
}

$options = [
    'search' => $_GET['search']['value'],
    'order_column' => $_GET['columns'][$_GET['order'][0]['column']]['name'],
    'order_by' => $_GET['order'][0]['dir'],
    'limit' => $_GET['length'],
    'offset' => $_GET['start']
];

$showBooks = new ShowBooksDataTable($options, new BookRepositoryImpl($entityManager));

$records = $showBooks->perform();

$payload = [
    'recordsTotal' => $records['total'],
    'recordsFiltered' => $records['filteredTotal'],
];

$rows = [];
foreach ($records['result'] as $record) {
    array_push($rows, [
        'book_id' => $record->getId(),
        'book_title' => $record->getTitle(),
        'book_description' => $record->getDescription(),
        'book_author' => $record->getAuthor(),
        'book_publish' => $record->getIsPublished()
    ]);
}

$payload['data'] = $rows;

APIJsonFormatter::format($payload, APIJsonFormatter::HTTP_CODE_SUCCESS);
