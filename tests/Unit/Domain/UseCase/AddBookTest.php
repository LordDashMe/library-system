<?php

namespace JoshuaReyes\LibrarySystem\Tests\Unit\Domain\UseCase;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\UseCase\AddBook;
use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;
use JoshuaReyes\LibrarySystem\Domain\Exception\AddBookFailedException;

class AddBookTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_add_book_class()
    {
        $bookData = [];
        
        $bookRepository = Mockery::mock(BookRepository::class);

        $this->assertInstanceOf(AddBook::class, new AddBook($bookData, $bookRepository));
    }

    /**
     * @test
     */
    public function it_should_throw_exception_when_required_field_is_empty()
    {
        $this->expectException(AddBookFailedException::class);
        $this->expectExceptionCode(AddBookFailedException::REQUIRED_FIELD_IS_EMPTY);

        $bookData = [
            'title' => '',
            'description' => '',
            'author' => ''
        ];

        $bookRepository = Mockery::mock(BookRepository::class);

        $addBook = new AddBook($bookData, $bookRepository);
        $addBook->validate();
    }

    /**
     * @test
     */
    public function it_should_add_book()
    {
        $bookData = [
            'title' => 'Title Book 101',
            'description' => 'This is a sample book.',
            'author' => 'John Doe'
        ];

        $bookRepository = Mockery::mock(BookRepository::class);

        $bookRepository->shouldReceive('add')
            ->withArgs(function ($bookEntity) {
                if ($bookEntity instanceof Book) {
                    return true;
                }
                return false;
            });

        $addBook = new AddBook($bookData, $bookRepository);
        $addBook->validate();
        $addBook->perform(); 
    }
}
