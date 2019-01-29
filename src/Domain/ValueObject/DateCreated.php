<?php

namespace JoshuaReyes\LibrarySystem\Domain\ValueObject;

class DateCreated
{
    const MYSQL_DATETIME_FORMAT = 'Y-m-d H:i:s';
    
    private $dateCreated;
    
    public function __construct($dateCreated = '')
    {
        $this->dateCreated = $dateCreated ?: '' ;
    }

    public function generate()
    {
        $this->dateCreated = \date(self::MYSQL_DATETIME_FORMAT);
        
        return $this;
    }

    public function get()
    {
        return $this->dateCreated;
    }
}
