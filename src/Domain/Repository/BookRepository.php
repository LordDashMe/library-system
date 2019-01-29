<?php

namespace JoshuaReyes\LibrarySystem\Domain\Repository;

use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;

interface BookRepository
{
    public function add(Book $book);

    public function edit(Book $book);

    public function find(BookId $bookId);

    public function softDelete(BookId $bookId);

    public function getBooksDataTable($options);
}
