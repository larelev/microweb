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
                'Could not map %s to %s',
                [
                    $type,
                    $modelClass,
                ],
            ),
            500,
            $previous
        );
    }
}
