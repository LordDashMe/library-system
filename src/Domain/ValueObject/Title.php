<?php

namespace JoshuaReyes\LibrarySystem\Domain\ValueObject;

class Title
{
    private $title;
    
    public function __construct($title)
    {
        $this->title = $title;
    }

    public function get()
    {
        return $this->title;
    }
}
