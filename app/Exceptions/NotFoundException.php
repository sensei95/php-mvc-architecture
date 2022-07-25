<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function error404(): void
    {
        http_response_code(404);
        require_once VIEWS_PATH.'errors'.DIRECTORY_SEPARATOR.'404.php';
    }
}