<?php

namespace App\Webhook\Handler;

use App\DTO\Webhook;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class HandlerDelegator
{

    public function __construct(
        #[AutowireIterator('webhook.handler')] private iterable $handlers,
    )
    {

    }

    public function delegate(Webhook $webhook): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler->supports($webhook)) {
                $handler->handle($webhook);
            }
        }
    }
}
