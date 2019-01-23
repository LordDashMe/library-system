<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';
require 'json_formatter.php';

use JoshuaReyes\LibrarySystem\Domain\UseCase\AddBook;
use JoshuaReyes\LibrarySystem\Domain\Exception\AddBookFailedException;
use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("You're not using POST request method.");
}

$bookData = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'author' => $_POST['author']
];

$addBook = new AddBook($bookData, new BookRepositoryImpl($entityManager));

try {
    $addBook->validate();
    $addBook->execute();
    APIJsonFormatter::format('Record successfully created.', APIJsonFormatter::HTTP_CODE_SUCCESS);
} catch (AddBookFailedException $exception) {
    APIJsonFormatter::format($exception->getMessage(), APIJsonFormatter::HTTP_CODE_FAILED);
}
