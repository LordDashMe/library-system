<?php

namespace JoshuaReyes\LibrarySystem\Domain\UseCase;

use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Title;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Description;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Author;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DatePublished;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DateCreated;
use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;
use JoshuaReyes\LibrarySystem\Domain\Exception\AddBookFailedException;

class AddBook
{
    private $requiredFields = [
        'title' => 'Title',
        'description' => 'Description',
        'author' => 'Author'
    ];

    private $bookData;
    private $bookRepository;

    public function __construct($bookData, BookRepository $bookRepository)
    {
        $this->bookData = $bookData;
        $this->bookRepository = $bookRepository;
    }

    public function validate()
    {
        $this->validateRequiredFields();
    }

    private function validateRequiredFields()
    {
        foreach ($this->requiredFields as $requiredField => $requiedFieldLabel) {
            if (empty($this->bookData[$requiredField])) {
                throw AddBookFailedException::requiredFieldIsEmpty($requiedFieldLabel);
            }
        }
        return $this;
    }

    public function execute()
    {
        return $this->bookRepository->add($this->buildBookEntity());
    }

    private function buildBookEntity()
    {
        return new Book(
            new BookId(),
            new Title($this->bookData['title']),
            new Description($this->bookData['description']),
            new Author($this->bookData['author']),
            new DatePublished(),
            new DateCreated(DateCreated::GENERATE)
        );   
    }
}
