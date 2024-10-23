<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class WebhooksControllerTest extends WebTestCase
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

        $this->webTester->request(
            method: 'POST',
            uri: '/webhook',
            server: [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => '*/*',
            ],
            content: $incomingWebhookPayload,
        );

        // Assert CdpClient::identify() called once

        // Assert correct IdentifyModel is passed to CdpClient::identify() method

        // Assert IdentifyModel::toArray() organizes data into format expected by CDP

        // Assert CdpClient::track() called once

        // Assert correct TrackModel is passed to CdpClient::track() method

        // Assert TrackModel::toArray() organizes data into format expected by CDP

        $this->assertSame(Response::HTTP_NO_CONTENT, $this->webTester->getResponse()->getStatusCode());
    }
}
