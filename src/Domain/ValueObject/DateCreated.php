<?php

namespace JoshuaReyes\LibrarySystem\Domain\ValueObject;

class DateCreated
{
    const GENERATE = true;
    const MYSQL_DATETIME_FORMAT = 'Y-m-d H:i:s';
    
    private $dateCreated;
    
    public function __construct($dateCreated = '')
    {
        $this->dateCreated = $dateCreated ? \date(self::MYSQL_DATETIME_FORMAT) : '';
    }

    public function get()
    {
        return $this->dateCreated;
    }
}
