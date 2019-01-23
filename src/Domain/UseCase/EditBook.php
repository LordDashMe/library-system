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
use JoshuaReyes\LibrarySystem\Domain\Exception\EditBookFailedException;

class EditBook
{
    private $requiredFields = [
        'title' => 'Title',
        'description' => 'Description',
        'author' => 'Author'
    ];

    private $bookId;
    private $bookData;
    private $bookRepository;

    public function __construct($bookId, $bookData, BookRepository $bookRepository)
    {
        $this->bookId = $bookId;
        $this->bookData = $bookData;
        $this->bookRepository = $bookRepository;
    }

    public function validate()
    {
        $this->validateBookIdIsNotEmpty()
             ->validateRequiredFields();
    }

    private function validateBookIdIsNotEmpty()
    {
        if (empty($this->bookId)) {
            throw EditBookFailedException::bookIdIsEmpty();
        }

        return $this;
    }

    private function validateRequiredFields()
    {
        foreach ($this->requiredFields as $requiredField => $requiedFieldLabel) {
            if (empty($this->bookData[$requiredField])) {
                throw EditBookFailedException::requiredFieldIsEmpty($requiedFieldLabel);
            }
        }
        
        return $this;
    }

    public function execute()
    {
        $bookEntity = $this->bookRepository->find(new BookId($this->bookId));

        $datePublished = new DatePublished($bookEntity->datePublished());

        if ($bookEntity->isPublished() === 'np') {
            if ($this->bookData['is_published'] === 'p') {
                $dateCreated = (new DateCreated(DateCreated::GENERATE))->get();
                $datePublished = new DatePublished($dateCreated);
            }
        }

        $bookEntity = new Book(
            new BookId($bookEntity->id()),
            new Title($this->bookData['title']),
            new Description($this->bookData['description']),
            new Author($this->bookData['author']),
            $datePublished,
            new DateCreated($bookEntity->dateCreated())
        );

        $bookEntity->setIsPublished($this->bookData['is_published']);

        return $this->bookRepository->edit($bookEntity);
    }
}
