<?php

declare(strict_types=1);

namespace App\Webhook\Handler;

use App\DTO\Newsletter\Factory\NewsletterWebhookFactory;
use App\DTO\Webhook;
use App\Error\Exception\WebhookCreationException;
use App\Forwarder\Newsletter\ForwarderInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class NewsletterHandler implements WebhookHandlerInterface
{
    private const array NEWSLETTER_EVENT = [
        'newsletter.opened',
        'newsletter.subscribed',
        'newsletter.unsubscribed',
    ];

    /**
     * @param NewsletterWebhookFactory $newsletterWebhookFactory
     * @param iterable<ForwarderInterface> $forwarders
     */
    public function __construct(
        private readonly NewsletterWebhookFactory $newsletterWebhookFactory,
        #[AutowireIterator('forwarder.newsletter')] private iterable $forwarders,
    ) {
    }

    /**
     * @throws WebhookCreationException
     */
    public function handle(Webhook $webhook): void
    {
        $newsletterWebhook = $this->newsletterWebhookFactory->create($webhook);

        dd(count($this->forwarders));

        foreach ($this->forwarders as $forwarder) {
            if ($forwarder->supports($newsletterWebhook)) {
                $forwarder->forward($newsletterWebhook);
            }
        }
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
