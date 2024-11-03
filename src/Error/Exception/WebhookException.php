<?php

declare(strict_types=1);

namespace App\Error\Exception;

use Throwable;

class WebhookException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            vsprintf(
                'Something went wrong with the Webhook with the message:%s%s',
                [
                    PHP_EOL,
                    $previous->getMessage(),
                ],
            ),
            500,
            $previous
        );


    }
}
