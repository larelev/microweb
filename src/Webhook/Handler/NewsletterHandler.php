<?php

declare(strict_types=1);

namespace App\Webhook\Handler;

use App\DTO\Webhook;

class NewsletterHandler implements WebhookHandlerInterface
{
    private const array NEWSLETTER_EVENT = [
        'newsletter.opened',
        'newsletter.subscribed',
        'newsletter.unsubscribed',
    ];

    public function handle(Webhook $webhook): void
    {
        dd($webhook);
    }

    public function supports(Webhook $webhook): bool
    {
        // TODO: Implement supports() method.
        return in_array(
            $webhook->getEvent(),
            self::NEWSLETTER_EVENT
        );
    }
}
