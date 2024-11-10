<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\CDP\Analytics\Model\Subscription\Identify\IdentifyModel;
use App\CDP\Http\CdpClientInterface;
use App\Tests\TestDoubles\CDP\Http\FakeCdpClient;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class WebhooksControllerTest extends WebTestCase
{
    private KernelBrowser $webTester;
    private ContainerInterface $container;
    private FakeCdpClient $fakeCdpClient;

    protected function setUp(): void
    {
        $this->webTester = static::createClient();
        $this->container = $this->webTester->getContainer();
        $this->fakeCdpClient = $this->container->get(CdpClientInterface::class);
    }

    public function testWebhooksAreHandled(): void
    {
        $filename = dirname(__FILE__) . '/payload.json';
        $jsonWebhookPayload = file_get_contents($filename);

        $this->webTester->request(
            method: 'POST',
            uri: '/webhook',
            server: [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => '*/*',
            ],
            content: $jsonWebhookPayload,
        );

        // Assert CdpClient::identify() called once
        $this->assertSame(1, $this->fakeCdpClient->getIdentifyCallCount());

        // Assert correct IdentifyModel is passed to CdpClient::identify() method
        $identifyModel = $this->fakeCdpClient->getIdentifyModel();
        assert($identifyModel instanceof IdentifyModel);

        // Assert IdentifyModel::toArray() organizes data into format expected by CDP
        $webhookPayload = json_decode($jsonWebhookPayload, true);
        $this->assertSame([
            'type' => 'identify',
            'context' =>  [
                'product' => 'TechGadget-3000X',
                'event_date' => '2024-12-12',
            ],
            'traits' =>  [
                'subscription_id' => '12345',
                'email' => 'email@example.com',
            ],
            'id' => '4a2b342d-6235-46a9-bc95-6e889b8e5de1',
        ], $identifyModel->toArray());

        // Assert CdpClient::track() called once

        // Assert correct TrackModel is passed to CdpClient::track() method

        // Assert TrackModel::toArray() organizes data into format expected by CDP

        $this->assertSame(Response::HTTP_NO_CONTENT, $this->webTester->getResponse()->getStatusCode());
    }
}
