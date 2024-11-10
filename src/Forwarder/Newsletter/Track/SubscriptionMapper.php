<?php

declare(strict_types=1);

namespace App\Forwarder\Newsletter\Track;

use App\CDP\Analytics\Model\Subscription\SubscriptionSourceInterface;
use App\CDP\Analytics\Model\Subscription\Track\TrackModel;
use App\Error\Exception\WebhookMappingTypeException;
use Throwable;

class SubscriptionMapper
{
    /**
     * @throws WebhookMappingTypeException
     */
    public function map(SubscriptionSourceInterface $source, TrackModel $target): void
    {
        try {
            $target->setEvent($source->getEvent())
                ->setProduct($source->getProduct())
                ->setEventDate($source->getEventDate())
                ->setSubscriptionId($source->getSubscriptionId())
                ->setEmail($source->getEmail())
                ->setEvent($source->getEvent())
                ->setRequiresConsent($source->requiresConsent())
                ->setPlatform($source->getPlatform())
                ->setProductName($source->getProductName())
                ->setRenewalDate($source->getRenewalDate())
                ->setStartDate($source->getStartDate())
                ->setStatus($source->getStatus())
                ->setType($source->getType())
                ->setId($source->getUserId());
        } catch (Throwable $exception) {
            $className = get_class($source);
            throw new WebhookMappingTypeException($className, 'TrackModel', $exception);
        }
    }
}
