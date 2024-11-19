<?php

namespace App\CDP\Analytics\Model\Subscription\Track;

/* track Model should look like this when sent */

use App\CDP\Analytics\Model\ModelInterface;
use App\Utils\ArrayFilter;
use Symfony\Component\Validator\Constraints as Assert;

class TrackModel implements ModelInterface
{
    #[Assert\NotBlank]
    private string $event;

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
    private bool $requires_consent = false;
    #[Assert\NotBlank]
    private string $platform;
    private ?string $currency = null;
    private ?bool $inTrial = null;
    #[Assert\NotBlank]
    private string $productName;
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{4}-\d{2}-\d{2}$/',
        message: 'The event date must be in the format YYYY-MM-DD.'
    )]
    private string $renewalDate;
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{4}-\d{2}-\d{2}$/',
        message: 'The event date must be in the format YYYY-MM-DD.'
    )]
    private string $startDate;
    #[Assert\NotBlank]
    private string $status;
    #[Assert\NotBlank]
    private string $type = 'newsletter';
    private bool $isPromotion = false;
    #[Assert\NotBlank]
    private string $id;

    public function getEvent(): string
    {
        return $this->event;
    }

    public function setEvent(string $event): self
    {
        $this->event = $event;
        return $this;
    }

    public function getProduct(): string
    {
        return $this->product;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function getEventDate(): string
    {
        return $this->eventDate;
    }

    public function setEventDate(string $eventDate): self
    {
        $this->eventDate = $eventDate;
        return $this;
    }

    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

    public function setSubscriptionId(string $subscriptionId): self
    {
        $this->subscriptionId = $subscriptionId;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function requiresConsent(): bool
    {
        return $this->requires_consent;
    }

    public function setRequiresConsent(bool $requires_consent): self
    {
        $this->requires_consent = $requires_consent;
        return $this;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): self
    {
        $this->platform = $platform;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getInTrial(): ?bool
    {
        return $this->inTrial;
    }

    public function setInTrial(?bool $inTrial): self
    {
        $this->inTrial = $inTrial;
        return $this;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;
        return $this;
    }

    public function getRenewalDate(): string
    {
        return $this->renewalDate;
    }

    public function setRenewalDate(string $renewalDate): self
    {
        $this->renewalDate = $renewalDate;
        return $this;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getIsPromotion(): bool
    {
        return $this->isPromotion;
    }

    public function setIsPromotion(bool $isPromotion): self
    {
        $this->isPromotion = $isPromotion;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
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
        $model = [
            "type" => self::TRACK_TYPE,
            "event" => $this->event,
            "context" => [
                "product" => $this->product,
                "event_date" => $this->eventDate,
                "traits" => [
                    "subscription_id" => $this->subscriptionId,
                    "email" => $this->email,
                ]
            ],
            "properties" => [
                "requires_consent" => $this->requires_consent,
                "platform" => $this->platform,
                "currency" => $this->currency,
                "in_trial" => $this->inTrial,
                "product_name" => $this->productName,
                "renewal_date" => $this->renewalDate,
                "start_date" => $this->startDate,
                "status" => $this->status,
                "type" => $this->type,
                "is_promotion" => $this->isPromotion,
            ],
            "id" => $this->id
        ];

        ArrayFilter::removeEmptyKeysRecursively($model);

        return $model;
    }
}
