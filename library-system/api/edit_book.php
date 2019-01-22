<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';

use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;
use JoshuaReyes\LibrarySystem\Domain\UseCase\EditBook;
use JoshuaReyes\LibrarySystem\Domain\Exception\EditBookFailedException;

$bookId = $_POST['book_id'];

$bookData = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'author' => $_POST['author'],
    'is_published' => ($_POST['is_published'] == '1' ? 1 : 0)
];

$editBook = new EditBook($bookId, $bookData, new BookRepositoryImpl());

try {
    $editBook->validate();
    $editBook->execute();
    
    echo '<pre>';
    var_dump('success');

} catch (EditBookFailedException $exception) {
    echo '<pre>';
    var_dump($exception);
}
