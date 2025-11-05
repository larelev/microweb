<?php

declare(strict_types=1);

namespace App\Tests\TestDoubles\Error;

use App\Error\ErrorHandlerInterface;
use Throwable;

final class FakeErrorHandler implements ErrorHandlerInterface
{
    private int $handleCount = 0;
    private ?Throwable $lastHandledThrowable = null;

    public function handle(Throwable $throwable): void
    {
        $this->handleCount++;
        $this->lastHandledThrowable = $throwable;
    }

    public function getHandleCount(): int
    {
        return $this->handleCount;
    }

    public function getError(): ?Throwable
    {
        return $this->lastHandledThrowable;
    }
}
