<?php

namespace App\CDP\Analytics\Model;

/* track Model should look like this when sent */

class TrackModel implements ModelInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $json = <<< JSON
        {
            "type":  "track",
            "event":  "newsletter_subscribed",
            "context":  {
                "product":  "TechGadget-3000X",
                "event_date":  "2024-12-12",
                "traits":  {
                    "subscription_id":  "12345",
                    "email":  "email@example.com"
                }
            },
            "properties":  {
                "requires_consent":  true, 
                "platform":  "web", 
                "currency":  null, 
                "in_trial":  null, 
                "product_name":  "newsletter-001", 
                "renewal_date":  "2025-12-12", 
                "start_date":  "2024-12-12", 
                "status":  "subscribed", 
                "type":  "newsletter", 
                "is_promotion":  false
            },
            "id":  "4a2b342d-6235-46a9-bc95-6e889b8e5de1" 
        }
        JSON;

        return json_decode($json, true);
    }
}
