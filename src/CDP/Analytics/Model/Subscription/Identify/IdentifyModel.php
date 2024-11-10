<?php

declare(strict_types=1);

namespace App\CDP\Analytics\Model\Subscription\Identify;

use App\CDP\Analytics\Model\ModelInterface;
use Symfony\Component\Validator\Constraints as Assert;

class IdentifyModel implements ModelInterface
{
    #[Assert\NotBlank]
    private string $product;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{4}-\d{2}-\d{2}$/',
        message: 'The event date must be in the format YYYY-MM-DD.'
    )]
    private string $eventDate;

    #[Assert\NotBlank]
    private string $subscriptionId;

    #[Assert\NotBlank]
    #[Assert\Email]
    private string $email;

    #[Assert\NotBlank]
    private string $id;

    public function setProduct(string $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function setEventDate(string $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function setSubscriptionId(string $subscriptionId): self
    {
        $this->subscriptionId = $subscriptionId;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'type' => self::IDENTIFY_TYPE,
            'context' => [
                'product' => $this->product, // newsletter.product_id
                'event_date' => $this->eventDate // timestamp
            ],
            'traits' => [
                'subscription_id' => $this->subscriptionId, // id
                'email' => $this->email // user.email
            ],
            'id' => $this->id // user.client_id
        ];
    }
}
