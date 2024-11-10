<?php

declare(strict_types=1);

namespace App\Error\Exception;

use Throwable;

class WebhookMappingTypeException extends WebhookException
{
    public function __construct(string $type, string $modelClass, ?Throwable $previous = null)
    {
        parent::__construct(
            vsprintf(
                'Mapping the type %s to %s target failed%s',
                [
                    $type,
                    $modelClass,
                    PHP_EOL,
                ],
            ),
            500,
            $previous
        );
    }
}
