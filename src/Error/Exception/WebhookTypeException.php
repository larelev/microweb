<?php

declare(strict_types=1);

namespace App\Error\Exception;

use Throwable;

class WebhookTypeException extends WebhookException
{
    public function __construct(string $type, ?Throwable $previous = null)
    {
        parent::__construct(
            vsprintf(
                'Mapping the type %s to IdentifyModel target failed%s',
                [
                    $type,
                    PHP_EOL,
                ],
            ),
            500,
            $previous
        );
    }
}
