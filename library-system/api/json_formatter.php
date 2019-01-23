<?php

class APIJsonFormatter 
{
    const HTTP_CODE_SUCCESS = 200;
    const HTTP_CODE_FAILED = 400;

    public static function format($payload, $statusCode = self::HTTP_CODE_SUCCESS)
    {
        header('Content-Type: application/json');

        http_response_code($statusCode);

        echo json_encode($payload);
        
        exit;
    }
}
