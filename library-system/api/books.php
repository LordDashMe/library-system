<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';
require 'json_formatter.php';

use JoshuaReyes\LibrarySystem\Domain\UseCase\ShowBooks;
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

$showBooks = new ShowBooks($options, new BookRepositoryImpl($entityManager));

$records = $showBooks->execute();

$payload = [
    'recordsTotal' => $records['total'],
    'recordsFiltered' => $records['filteredTotal'],
];

$data = [];

foreach ($records['result'] as $record) {
    array_push($data, [
        'book_id' => $record->id(),
        'book_title' => $record->title(),
        'book_description' => $record->description(),
        'book_author' => $record->author(),
        'book_publish' => $record->isPublished()
    ]);
}

$payload['data'] = $data;

APIJsonFormatter::format($payload, APIJsonFormatter::HTTP_CODE_SUCCESS);
