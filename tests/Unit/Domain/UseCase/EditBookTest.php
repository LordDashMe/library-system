<?php

namespace JoshuaReyes\LibrarySystem\Tests\Unit\Domain\UseCase;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\UseCase\EditBook;
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
    public function it_should_validate_book_id()
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
    public function it_should_validate_required_fields()
    {
        $this->expectException(EditBookFailedException::class);
        $this->expectExceptionCode(EditBookFailedException::REQUIRED_FIELD_IS_EMPTY);

        $bookId = 'ID123';
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
        $bookId = 'ID123';
        $bookData = [
            'title' => 'Title Book 101 NEW',
            'description' => 'This is a sample book.',
            'author' => 'John Doe',
            'isPublished' => 1
        ];
        $bookRepository = Mockery::mock(BookRepository::class);
        $bookRepository->shouldReceive('edit')
                       ->withArgs(function ($bookEntity) {
                            if ($bookEntity instanceof Book) {
                                return true;
                            }
                            return false;
                       });

        $editBook = new EditBook($bookId, $bookData, $bookRepository);
        $editBook->validate();
        $editBook->execute(); 
    }
}
