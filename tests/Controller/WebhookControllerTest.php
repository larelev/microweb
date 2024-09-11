<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class WebhookControllerTest extends WebTestCase
{
    private KernelBrowser $webTester;
    protected function setUp(): void
    {
        $this->webTester = static::createClient();
    }

    public function testWebhooksAreHandled(): void
    {
        $filename = dirname(__FILE__) . '/payload.json';
        $incomingWebhookPayload = file_get_contents($filename);

//        $incomingWebhookPayload = <<<JSON
//        {
//          "event": "newsletter_subscribed",
//          "id": "12345",
//          "origin": "www",
//          "timestamp": "2024-12-12T12:00:00Z",
//          "user": {
//            "client_id": "4a2b342d-6235-46a9-bc95-6e889b8e5de1",
//            "email": "email@example.com",
//            "region": "EU"
//          },
//          "newsletter": {
//            "newsletter_id": "newsletter-001",
//            "topic": "N/A",
//            "product_id": "TechGadget-3000X"
//          }
//        }
//        JSON;

        $this->webTester->request(
            method: 'POST',
            uri: '/webhook',
            server: [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => '*/*',
            ],
            content: $incomingWebhookPayload,
        );

        $this->assertSame(Response::HTTP_NO_CONTENT, $this->webTester->getResponse()->getStatusCode());
    }
}
