<?php

namespace App\Error\Exception;

use Throwable;

class WebhookCreationException extends \Exception
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(
            vsprintf(
                'Something went wrong while creating NewsletterWebhook with the message:%s%s',
                [
                    PHP_EOL,
                    $previous?->getMessage()
                ],
            ),
            500,
            $previous
        );
    }
}
