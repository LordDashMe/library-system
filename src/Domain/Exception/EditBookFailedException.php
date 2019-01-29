<?php

namespace JoshuaReyes\LibrarySystem\Domain\Exception;

use JoshuaReyes\LibrarySystem\Common\Domain\Exception\WriteBookException;

class EditBookFailedException extends WriteBookException
{
    const BOOK_ID_IS_EMPTY = 2;

    public static function bookIdIsEmpty($previous = null) 
    {
        $message = "The book id is empty.";
        $code = static::BOOK_ID_IS_EMPTY;

        return new static($message, $code, $previous);
    }
}
