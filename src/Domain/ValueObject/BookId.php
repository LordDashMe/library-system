<?php

namespace JoshuaReyes\LibrarySystem\Domain\ValueObject;

class BookId
{
    private $bookId;
    
    public function __construct($bookId = '')
    {
        $this->bookId = ($bookId) ?: uniqid();
    }

    public function get()
    {
        return $this->bookId;
    }
}
