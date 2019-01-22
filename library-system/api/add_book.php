<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';

use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;
use JoshuaReyes\LibrarySystem\Domain\UseCase\AddBook;
use JoshuaReyes\LibrarySystem\Domain\Exception\AddBookFailedException;

$bookData = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'author' => $_POST['author']
];

$addBook = new AddBook($bookData, new BookRepositoryImpl());

try {
    $addBook->validate();
    $addBook->execute();
    
    echo '<pre>';
    var_dump('success');

} catch (AddBookFailedException $exception) {
    echo '<pre>';
    var_dump($exception);
}
