<?php

namespace App\DTO\Newsletter\Factory;

use App\DTO\Newsletter\NewsletterWebhook;
use App\DTO\Webhook;
use App\Error\Exception\WebhookCreationException;
use Symfony\Component\Serializer\SerializerInterface;

class NewsletterWebhookFactory
{
    public function __construct(
        private SerializerInterface $serializer
    ) {
    }

    /**
     * @throws WebhookCreationException
     */
    public function create(Webhook $webhook): NewsletterWebhook
    {
        try {
            return $this->serializer->deserialize(
                $webhook->getRawPayload(),
                NewsletterWebhook::class,
                'json'
            );
        } catch (\Throwable $exception) {
            throw new WebhookCreationException($exception);
        }
    }
}
