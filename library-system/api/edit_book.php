<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';
require 'json_formatter.php';

use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;
use JoshuaReyes\LibrarySystem\Domain\UseCase\EditBook;
use JoshuaReyes\LibrarySystem\Domain\Exception\EditBookFailedException;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("You're not using POST request method.");
}

$bookId = $_POST['id'];

$bookData = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'author' => $_POST['author'],
    'is_published' => $_POST['is_published']
];

$editBook = new EditBook($bookId, $bookData, new BookRepositoryImpl());

try {
    $editBook->validate();
    $editBook->execute();
    APIJsonFormatter::format('Record successfully edited.', APIJsonFormatter::HTTP_CODE_SUCCESS);
} catch (EditBookFailedException $exception) {
    APIJsonFormatter::format($exception->getMessage(), APIJsonFormatter::HTTP_CODE_FAILED);
}
