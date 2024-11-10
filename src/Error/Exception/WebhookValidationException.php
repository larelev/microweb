<?php

declare(strict_types=1);

namespace App\Error\Exception;

use App\CDP\Analytics\Model\ModelInterface;
use ReflectionClass;
use Throwable;

class WebhookValidationException extends WebhookException
{
    /**
     * @param ModelInterface $model
     * @param array<int, mixed> $properties
     * @param Throwable|null $previous
     */
    public function __construct(
        ModelInterface $model,
        array $properties,
        ?Throwable $previous = null
    ) {
        $ref = new ReflectionClass($model);
        $modelClassName = $ref->getShortName();

        parent::__construct(
            vsprintf(
                "Invalid $modelClassName properties: %s",
                [
                    implode(', ', $properties),
                ],
            ),
            500,
            $previous
        );
    }
}
