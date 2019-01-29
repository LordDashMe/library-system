<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';
require '../../helpers.php';

use JoshuaReyes\LibrarySystem\Domain\UseCase\EditBook;
use JoshuaReyes\LibrarySystem\Domain\Exception\EditBookFailedException;
use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;

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

$editBook = new EditBook($bookId, $bookData, new BookRepositoryImpl($entityManager));

try {
    $editBook->validate();
    $editBook->perform();
    APIJsonFormatter::format('Record successfully edited.', APIJsonFormatter::HTTP_CODE_SUCCESS);
} catch (EditBookFailedException $exception) {
    APIJsonFormatter::format($exception->getMessage(), APIJsonFormatter::HTTP_CODE_FAILED);
}
