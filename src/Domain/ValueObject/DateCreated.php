<?php

namespace JoshuaReyes\LibrarySystem\Domain\ValueObject;

class DateCreated
{
    const GENERATE = true;
    const MYSQL_DATETIME_FORMAT = 'Y-m-d H:i:s';
    
    private $dateCreated;
    
    public function __construct($dateCreated = '')
    {
        $this->dateCreated = (is_bool($dateCreated) && $dateCreated == true) ? \date(self::MYSQL_DATETIME_FORMAT) : $dateCreated;
    }

    public function get()
    {
        return $this->dateCreated;
    }
}
