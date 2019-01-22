<?php

namespace JoshuaReyes\LibrarySystem\Domain\ValueObject;

class Description
{
    private $description;
    
    public function __construct($description)
    {
        $this->description = $description;
    }

    public function get()
    {
        return $this->description;
    }
}
