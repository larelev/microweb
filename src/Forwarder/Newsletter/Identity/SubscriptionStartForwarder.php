<?php

declare(strict_types=1);

namespace App\Forwarder\Newsletter\Identity;

use App\DTO\Newsletter\NewsletterWebhook;
use App\Forwarder\Newsletter\ForwarderInterface;

class SubscriptionStartForwarder implements ForwarderInterface
{
    private const string SUPPORTED_EVENT = 'newsletter_subscribed';

    public function __construct(

    ) {
    }

    public function supports(NewsletterWebhook $newsletterWebhook): bool
    {
        // TODO: Implement supports() method.
        return $newsletterWebhook->getEvent() === self::SUPPORTED_EVENT;
    }

    public function forward(NewsletterWebhook $newsletterWebhook): void
    {
        // TODO: Implement forward() method.
    }
}