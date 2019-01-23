<?php

namespace JoshuaReyes\LibrarySystem\Domain\UseCase;

use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;

class ShowBooks
{
    private $options;
    private $bookRepository;

    public function __construct($options, BookRepository $bookRepository)
    {
        $this->options = $options;
        $this->bookRepository = $bookRepository;
    }

    public function execute()
    {
        return $this->bookRepository->getAllBooks($this->options);
    }
}
