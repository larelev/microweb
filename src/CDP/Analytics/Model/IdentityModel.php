<?php

namespace App\CDP\Analytics\Model;

/* identify Model should look like this when sent */

class IdentityModel implements ModelInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $json = <<< JSON
        {
            "type": "identify",
            "context": {
                "product": "TechGadget-3000X", 
                "event_date": "2024-12-12" 
            },
            "traits": {
                "subscription_id": "12345", 
                "email": "email@example.com" 
            },
            "id": "4a2b342d-6235-46a9-bc95-6e889b8e5de1" 
        }
        JSON;

        return json_decode($json, true);
    }
}
