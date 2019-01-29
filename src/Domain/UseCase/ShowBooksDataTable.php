<?php

namespace JoshuaReyes\LibrarySystem\Domain\UseCase;

use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;

class ShowBooksDataTable
{
    private $options;
    private $bookRepository;

    public function __construct($options, BookRepository $bookRepository)
    {
        $this->options = $options;
        $this->bookRepository = $bookRepository;
    }

    public function perform()
    {
        return $this->bookRepository->getBooksDataTable($this->options);
    }
}
