<?php

declare(strict_types=1);

namespace App\CDP\Analytics\Model;

use App\Error\Exception\WebhookValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ModelValidator
{
    public function __construct(
        private ValidatorInterface $validator
    ) {
    }

    /**
     * @throws WebhookValidationException
     */
    public function validate(ModelInterface $model): void
    {
        $errors = $this->validator->validate($model);
        if (count($errors) > 0) {
            $failingProperties = [];
            foreach ($errors as $error) {
                $failingProperties[] = $error->getPropertyPath();
            }

            throw new WebhookValidationException($model, $failingProperties);
        }
    }
}
