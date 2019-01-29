<?php

namespace JoshuaReyes\LibrarySystem\Tests\Unit\Domain\UseCase;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;
use JoshuaReyes\LibrarySystem\Domain\UseCase\ShowBooksDataTable;

class ShowBookDataTableTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_show_books_data_table_class()
    {
        $bookRepository = Mockery::mock(BookRepository::class);

        $this->assertInstanceOf(ShowBooksDataTable::class, new ShowBooksDataTable(array(), $bookRepository));
    }

    /**
     * @test
     */
    public function it_should_get_books_data_table()
    {
        $bookRepository = Mockery::mock(BookRepository::class);
        
        $bookRepository->shouldReceive('getBooksDataTable')
            ->andReturn(true);

        $showBooks = new ShowBooksDataTable(array(), $bookRepository);

        $this->assertEquals(true, $showBooks->perform()); 
    }
}
