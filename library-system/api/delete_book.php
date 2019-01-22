<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';

use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;
use JoshuaReyes\LibrarySystem\Domain\UseCase\DeleteBooks;

$bookId = $_POST['book_id'];

$deleteBooks = new DeleteBooks($bookId, new BookRepositoryImpl());

$records = $deleteBooks->execute();

echo '<pre>';
var_dump($records);
