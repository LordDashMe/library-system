<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';
require '../../helpers.php';

use JoshuaReyes\LibrarySystem\Domain\UseCase\DeleteBook;
use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("You're not using POST request method.");
}

$bookId = $_POST['id'];

$deleteBook = new DeleteBook($bookId, new BookRepositoryImpl($entityManager));

$records = $deleteBook->perform();

APIJsonFormatter::format('Record successfully deleted.', APIJsonFormatter::HTTP_CODE_SUCCESS);
