<?php

namespace App\Tests\TestDoubles\CDP\Http;

use App\CDP\Analytics\Model\ModelInterface;
use App\CDP\Http\CdpClientInterface;

class FakeCdpClient implements CdpClientInterface
{
    private ModelInterface $identifyModel;

    private int $identifyCallCount = 0;

    private ModelInterface $trackModel;

    private int $trackCallCount = 0;

    public function track(ModelInterface $model): void
    {
        $this->trackCallCount++;
        $this->trackModel = $model;
    }

    public function identify(ModelInterface $model): void
    {
        $this->identifyCallCount++;
        $this->identifyModel = $model;
    }

    public function getIdentifyModel(): ModelInterface
    {
        return $this->identifyModel;
    }

    public function getIdentifyCallCount(): int
    {
        return $this->identifyCallCount;
    }

    public function getTrackModel(): ModelInterface
    {
        return $this->trackModel;
    }

    public function getTrackCallCount(): int
    {
        return $this->trackCallCount;
    }



}