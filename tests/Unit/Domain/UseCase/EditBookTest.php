<?php

namespace JoshuaReyes\LibrarySystem\Tests\Unit\Domain\UseCase;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\UseCase\EditBook;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Title;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Author;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Description;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DateCreated;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DatePublished;
use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;
use JoshuaReyes\LibrarySystem\Domain\Exception\EditBookFailedException;

class EditBookTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_add_book_class()
    {   
        $bookId = '';
        $bookData = [];
        
        $bookRepository = Mockery::mock(BookRepository::class);

        $this->assertInstanceOf(EditBook::class, new EditBook($bookId, $bookData, $bookRepository));
    }

    /**
     * @test
     */
    public function it_should_throw_exception_when_book_id_is_empty()
    {
        $this->expectException(EditBookFailedException::class);
        $this->expectExceptionCode(EditBookFailedException::BOOK_ID_IS_EMPTY);

        $bookId = '';
        $bookData = [
            'title' => '',
            'description' => '',
            'author' => ''
        ];

        $bookRepository = Mockery::mock(BookRepository::class);

        $editBook = new EditBook($bookId, $bookData, $bookRepository);
        $editBook->validate();    
    }

    /**
     * @test
     */
    public function it_should_throw_exception_when_required_field_is_empty()
    {
        $this->expectException(EditBookFailedException::class);
        $this->expectExceptionCode(EditBookFailedException::REQUIRED_FIELD_IS_EMPTY);

        $bookId = 'ID0001';
        $bookData = [
            'title' => '',
            'description' => '',
            'author' => ''
        ];

        $bookRepository = Mockery::mock(BookRepository::class);

        $editBook = new EditBook($bookId, $bookData, $bookRepository);
        $editBook->validate();
    }

    /**
     * @test
     */
    public function it_should_edit_book()
    {
        $bookId = 'ID0001';
        $bookData = [
            'title' => 'New Title Book 101',
            'description' => 'This is a sample book.',
            'author' => 'John Doe',
            'is_published' => 1
        ];

        $bookRepository = Mockery::mock(BookRepository::class);

        $bookRepository->shouldReceive('find')
            ->andReturn(new Book(
                new BookId(),
                new Title('Clean Code Book'),
                new Description('This is a sample book.'),
                new Author('John Doe'),
                new DatePublished(),
                new DateCreated
            ));

        $bookRepository->shouldReceive('edit')
            ->withArgs(function ($bookEntity) {
                if ($bookEntity instanceof Book) {
                    return true;
                }
                return false;
            });

        $editBook = new EditBook($bookId, $bookData, $bookRepository);
        $editBook->validate();
        $editBook->perform(); 
    }
}
