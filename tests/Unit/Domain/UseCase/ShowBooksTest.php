<?php

namespace JoshuaReyes\LibrarySystem\Tests\Unit\Domain\UseCase;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;
use JoshuaReyes\LibrarySystem\Domain\UseCase\ShowBooks;
use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;

class ShowBookTests extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_show_books_class()
    {
        $bookRepository = Mockery::mock(BookRepository::class);

        $this->assertInstanceOf(ShowBooks::class, new ShowBooks(array(), $bookRepository));
    }

    /**
     * @test
     */
    public function it_should_get_all_books()
    {
        $bookRepository = Mockery::mock(BookRepository::class);
        
        $bookRepository->shouldReceive('getAllBooks')
            ->andReturn(true);

        $showBooks = new ShowBooks(array(), $bookRepository);

        $this->assertEquals(true, $showBooks->execute()); 
    }
}
