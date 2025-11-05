<?php

declare(strict_types=1);

namespace App\Error;

class ErrorHandler implements ErrorHandlerInterface
{
    public function handle(\Throwable $throwable): void
    {
        // Basic error handling logic, e.g., logging the error
        error_log($throwable->getMessage());
    }
}
