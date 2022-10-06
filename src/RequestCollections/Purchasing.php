<?php

namespace Astrotomic\Ecologi\RequestCollections;

use Astrotomic\Ecologi\Data\CarbonOffsetPurchase;
use Astrotomic\Ecologi\Data\TreePurchase;
use Astrotomic\Ecologi\Enums\CarbonUnit;
use Astrotomic\Ecologi\Requests\Purchasing\BuyCarbonOffset;
use Astrotomic\Ecologi\Requests\Purchasing\BuyTrees;
use Sammyjo20\Saloon\Http\RequestCollection;
use Sammyjo20\Saloon\Http\SaloonConnector;

class Purchasing extends RequestCollection
{
    public function __construct(
        SaloonConnector $connector,
        protected readonly bool $test = false
    ) {
        parent::__construct($connector);
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
