<?php

namespace JoshuaReyes\LibrarySystem\Domain\Exception;

class EditBookFailedException extends \Exception
{
    const BOOK_ID_IS_EMPTY = 1;
    const REQUIRED_FIELD_IS_EMPTY = 2;

    public static function requiredFieldIsEmpty(
        $requiredField,
        $code = self::REQUIRED_FIELD_IS_EMPTY,
        $previous = null
    ) {
        $message = "The {$requiredField} field is empty.";
        return new static($message, $code, $previous);
    }

    public static function bookIdIsEmpty(
        $message = "The book id is empty.",
        $code = self::BOOK_ID_IS_EMPTY,
        $previous = null
    ) {
        return new static($message, $code, $previous);
    }
}
