<?php

declare(strict_types=1);

namespace App\Forwarder\Newsletter\Identify;

use App\CDP\Analytics\Model\Subscription\Identify\IdentifyModel;
use App\CDP\Analytics\Model\Subscription\SubscriptionSourceInterface;
use App\Error\Exception\WebhookMappingTypeException;

class SubscriptionStartMapper
{
    /**
     * @throws WebhookMappingTypeException
     */
    public function map(SubscriptionSourceInterface $source, IdentifyModel $target): void
    {
        try {
            $target->setId($source->getUserId());
            $target->setProduct($source->getProduct());
            $target->setEmail($source->getEmail());
            $target->setSubscriptionId($source->getSubscriptionId());
            $target->setEventDate($source->getEventDate());
        } catch (\Throwable $exception) {
            $className = get_class($source);
            throw new WebhookMappingTypeException($className, 'IdentifyModel', $exception);
        }
    }
}
