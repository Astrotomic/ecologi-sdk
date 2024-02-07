<?php

namespace Astrotomic\Ecologi\Resources;

use Astrotomic\Ecologi\Data\CarbonOffsetPurchase;
use Astrotomic\Ecologi\Data\TreePurchase;
use Astrotomic\Ecologi\Enums\CarbonUnit;
use Astrotomic\Ecologi\Requests\Purchasing\BuyCarbonOffset;
use Astrotomic\Ecologi\Requests\Purchasing\BuyTrees;
use Saloon\Http\BaseResource;

class Purchasing extends BaseResource
{
    protected bool $test = false;

    public function test(bool $test = true): self
    {
        $this->test = $test;

        return $this;
    }

    public function buyTrees(int $number, ?string $name = null, ?string $idempotency = null): TreePurchase
    {
        return $this->connector->send(
            new BuyTrees($number, $name, $this->test, $idempotency)
        )->dto();
    }

    public function buyCarbonOffset(int $number, CarbonUnit $unit, ?string $idempotency = null): CarbonOffsetPurchase
    {
        return $this->connector->send(
            new BuyCarbonOffset($number, $unit, $this->test, $idempotency)
        )->dto();
    }
}
