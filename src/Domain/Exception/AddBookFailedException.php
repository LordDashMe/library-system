<?php

namespace JoshuaReyes\LibrarySystem\Domain\Exception;

class AddBookFailedException extends \Exception
{
    const REQUIRED_FIELD_IS_EMPTY = 1;

    public static function requiredFieldIsEmpty(
        $requiredField,
        $code = self::REQUIRED_FIELD_IS_EMPTY,
        $previous = null
    ) {
        $message = "The {$requiredField} field is empty.";
        return new static($message, $code, $previous);
    }
}
