<?php

namespace JoshuaReyes\LibrarySystem\Common\Domain\Exception;

use Exception;

class WriteBookException extends Exception
{
    const REQUIRED_FIELD_IS_EMPTY = 1;

    public static function requiredFieldIsEmpty($requiredField, $previous = null) 
    {
        $message = "The {$requiredField} field is empty.";
        $code = static::REQUIRED_FIELD_IS_EMPTY;

        return new static($message, $code, $previous);
    }
}
