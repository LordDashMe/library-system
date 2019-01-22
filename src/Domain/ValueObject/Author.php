<?php

namespace JoshuaReyes\LibrarySystem\Domain\ValueObject;

class Author
{
    private $author;
    
    public function __construct($author)
    {
        $this->author = $author;
    }

    public function get()
    {
        return $this->author;
    }
}
