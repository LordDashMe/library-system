<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';
require 'json_formatter.php';

use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;
use JoshuaReyes\LibrarySystem\Domain\UseCase\DeleteBook;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("You're not using POST request method.");
}

$bookId = $_POST['id'];

$deleteBook = new DeleteBook($bookId, new BookRepositoryImpl());

$records = $deleteBook->execute();

APIJsonFormatter::format('Record successfully deleted.', APIJsonFormatter::HTTP_CODE_SUCCESS);
