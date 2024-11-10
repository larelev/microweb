<?php

declare(strict_types=1);

namespace App\Forwarder\Newsletter\Track;

use App\CDP\Analytics\Model\ModelValidator;
use App\CDP\Analytics\Model\Subscription\Track\TrackModel;
use App\CDP\Http\CdpClientInterface;
use App\DTO\Newsletter\NewsletterWebhook;
use App\Error\Exception\WebhookMappingTypeException;
use App\Error\Exception\WebhookValidationException;
use App\Forwarder\Newsletter\ForwarderInterface;

class SubscriptionForwarder implements ForwarderInterface
{
    public function __construct(
        private CdpClientInterface $client,
        private ModelValidator $validator,
    ) {
    }

    public function supports(NewsletterWebhook $newsletterWebhook): bool
    {
        return true;
    }

    /**
     * @throws WebhookMappingTypeException
     * @throws WebhookValidationException
     */
    public function forward(NewsletterWebhook $newsletterWebhook): void
    {
        $model = new TrackModel();
        (new SubscriptionMapper())->map($newsletterWebhook, $model);
        $this->validator->validate($model);
        $this->client->track($model);
    }
}
