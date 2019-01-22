<?php

namespace JoshuaReyes\LibrarySystem\Domain\ValueObject;

class DatePublished
{    
    private $datePublished;
    
    public function __construct($datePublished = '')
    {
        $this->datePublished = $datePublished ?: '';
    }

    public function get()
    {
        return $this->datePublished;
    }
}
