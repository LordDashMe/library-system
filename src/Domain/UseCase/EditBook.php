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
        $this->validateBookIdIsNotEmpty();
        $this->validateRequiredFields();

        return $this;
    }

    private function validateBookIdIsNotEmpty()
    {
        if (empty($this->bookId)) {
            throw EditBookFailedException::bookIdIsEmpty();
        }
    }

    private function validateRequiredFields()
    {
        foreach ($this->requiredFields as $requiredField => $requiedFieldLabel) {
            if (empty($this->bookData[$requiredField])) {
                throw EditBookFailedException::requiredFieldIsEmpty($requiedFieldLabel);
            }
        }
    }

    public function perform()
    {
        $bookEntity = $this->bookRepository->find(new BookId($this->bookId));

        $datePublished = new DatePublished($bookEntity->getDatePublished());

        if (! $bookEntity->isPublished()) {
            if ($this->bookData['is_published'] === Book::IS_PUBLISHED) {
                $dateCreated = (new DateCreated())->generate()->get();
                $datePublished = new DatePublished($dateCreated);
            }
        }

        return $this->bookRepository->edit($this->composeBookEntity($bookEntity, $datePublished));
    }

    private function composeBookEntity($bookEntity, $datePublished)
    {
        $bookEntity = new Book(
            new BookId($bookEntity->getId()),
            new Title($this->bookData['title']),
            new Description($this->bookData['description']),
            new Author($this->bookData['author']),
            $datePublished,
            new DateCreated($bookEntity->getDateCreated())
        );

        $bookEntity->setIsPublished($this->bookData['is_published']);

        return $bookEntity;
    }
}
