<?php

namespace JoshuaReyes\LibrarySystem\Domain\UseCase;

use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;

class DeleteBook
{
    private $bookId;
    private $bookRepository;

    public function __construct($bookId, BookRepository $bookRepository)
    {
        $this->bookId = $bookId;
        $this->bookRepository = $bookRepository;
    }

    public function execute()
    {
        return $this->bookRepository->softDelete($this->bookId);
    }
}
