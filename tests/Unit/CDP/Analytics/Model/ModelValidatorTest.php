<?php

declare(strict_types=1);

namespace App\Tests\Unit\CDP\Analytics\Model;

use App\CDP\Analytics\Model\ModelValidator;
use App\CDP\Analytics\Model\Subscription\Identify\IdentifyModel;
use App\Error\Exception\WebhookException;
use App\Error\Exception\WebhookValidationException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class ModelValidatorTest extends TestCase
{
    private ModelValidator $unit;

    protected function setUp(): void
    {
        $validator = Validation::createValidatorBuilder()->enableAttributeMapping()->getValidator();
        $this->unit = new ModelValidator($validator);
    }

    public function testInvalidIdentifyModelFailsValidation(): void
    {
        $model = new IdentifyModel();
        $model->setProduct('')
            ->setEmail('not-an-email')
            ->setEventDate('12-12-2001')
            ->setSubscriptionId('1234')
            ->setId('some-id');

        try {
            $this->unit->validate($model);
            $this->fail('No exception was thrown');
        } catch (WebhookValidationException $exception) {
            $this->assertEquals(
                'Invalid IdentifyModel properties: product, eventDate, email',
                $exception->getMessage()
            );
        }
    }

    public function testValidIdentifyModelPassesValidation(): void
    {
        $model = new IdentifyModel();
        $model->setProduct('product')
            ->setEmail('email@example.com')
            ->setEventDate('2024-12-20')
            ->setSubscriptionId('1234')
            ->setId('some-id');

        try {
            $this->unit->validate($model);
            $this->assertTrue(true, 'No exception was thrown');
        } catch (WebhookException) {
            $this->fail('Unexpected exception was thrown');
        }
    }
}
