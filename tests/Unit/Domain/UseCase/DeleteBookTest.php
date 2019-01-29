<?php

namespace JoshuaReyes\LibrarySystem\Tests\Unit\Domain\UseCase;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;
use JoshuaReyes\LibrarySystem\Domain\UseCase\DeleteBook;
use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;

class DeleteBookTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_delete_book_class()
    {
        $bookId = new BookId();
        
        $bookRepository = Mockery::mock(BookRepository::class);

        $this->assertInstanceOf(DeleteBook::class, new DeleteBook($bookId, $bookRepository));
    }

    /**
     * @test
     */
    public function it_should_delete_book()
    {
        $bookId = new BookId('ID0001');

        $bookRepository = Mockery::mock(BookRepository::class);

        $bookRepository->shouldReceive('softDelete')
            ->withArgs(function ($bookId) {
                if ($bookId instanceof BookId) {
                    return true;
                }
                return false;
            });

        $deleteBook = new DeleteBook($bookId, $bookRepository);
        $deleteBook->perform();
    }
}
