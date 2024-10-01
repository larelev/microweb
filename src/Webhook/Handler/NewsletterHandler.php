<?php

namespace App\Webhook\Handler;

use App\DTO\Webhook;

class NewsletterHandler implements WebhookHandlerInterface
{

    public function handle(Webhook $webhook): void
    {
        // TODO: Implement handle() method.
    }

    public function supports(Webhook $webhook): bool
    {
        // TODO: Implement supports() method.
    }
}