<?php

declare(strict_types=1);

namespace App\Webhook\Handler;

use App\DTO\Newsletter\Factory\NewsletterWebhookFactory;
use App\DTO\Webhook;

class NewsletterHandler implements WebhookHandlerInterface
{
    private const array NEWSLETTER_EVENT = [
        'newsletter.opened',
        'newsletter.subscribed',
        'newsletter.unsubscribed',
    ];

    public function __construct(
        private NewsletterWebhookFactory $newsletterWebhookFactory,
    ) {
    }

    public function handle(Webhook $webhook): void
    {
        $newsletterWebhook = $this->newsletterWebhookFactory->create($webhook);
        dd($newsletterWebhook);
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
