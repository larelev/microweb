<?php

namespace App\CDP\Analytics\Model;

/* identify Model should look like this when sent */

class IdentityModel implements ModelInterface
{
    public function toArray(): array
    {
        return [
            'type' => 'identify',
            'context' => [
                'product' => 'TechGadget-3000X', // newsletter.product_id
                'event_date' => '2024-12-12' // timestamp
            ],
            'traits' => [
                'subscription_id' => '12345', // id
                'email' => 'email@example.com' // user.email
            ],
            'id' => '4a2b342d-6235-46a9-bc95-6e889b8e5de1' // user.client_id
        ];
    }
}

