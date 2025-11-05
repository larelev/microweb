<?php

declare(strict_types=1);

namespace App\Error;

class DebugErrorHandler implements ErrorHandlerInterface
{
    public function handle(\Throwable $throwable): void
    {
        // Enhanced error handling logic for debugging purposes
        error_log(
            'Debug Info: ' . $throwable->getMessage() . ' in ' . $throwable->getFile() .
            ' on line ' . $throwable->getLine()
        );
        error_log($throwable->getTraceAsString());
    }
}
