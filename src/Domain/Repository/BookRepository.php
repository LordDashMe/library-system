<?php

namespace JoshuaReyes\LibrarySystem\Domain\Repository;

use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;

interface BookRepository
{
    public function getAllBooks();

    public function add(Book $book);

    public function edit(Book $book);

    public function softDelete(BookId $bookId);
}
