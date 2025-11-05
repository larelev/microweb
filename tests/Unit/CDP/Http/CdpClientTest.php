<?php

declare(strict_types=1);

namespace Tests\Unit\CDP\Http;

use App\CDP\Analytics\Model\ModelInterface;
use App\CDP\Http\CdpClient;
use App\Error\Exception\WebhookException;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use PHPUnit\Framework\TestCase;

class CdpClientTest extends TestCase
{
    public function testWebhookExceptionIsThrownWhenHttpClientProducesErrors(): void
    {
        // Test implementation goes here
        $responses = [
            new MockResponse(['{"grave": "error"}'], ['http_code' => 400]),
        ];

        $mockHttpClient = new MockHttpClient($responses);
        $unit = new CdpClient($mockHttpClient, 'fake-api-key');

        $mockTrackModel = $this->createMock(ModelInterface::class);
        $mockTrackModel->method('toArray')->willReturn(['test' => 'data']);
        
        $this->expectException(WebhookException::class);
        $this->expectExceptionMessage('{"grave": "error"}');
        
        // @phpstan-ignore-next-line argument.type
        $unit->track($mockTrackModel);

    }
}