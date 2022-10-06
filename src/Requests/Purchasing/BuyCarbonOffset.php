<?php

namespace Astrotomic\Ecologi\Requests\Purchasing;

use Astrotomic\Ecologi\Data\CarbonOffsetPurchase;
use Astrotomic\Ecologi\Ecologi;
use Astrotomic\Ecologi\Enums\CarbonUnit;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

/**
 * @link https://docs.ecologi.com/docs/public-api-docs/e07bbee7fa605-purchase-carbon-offsets
 */
class BuyCarbonOffset extends SaloonRequest
{
    use CastsToDto;
    use HasJsonBody;

    protected ?string $connector = Ecologi::class;

    protected ?string $method = Saloon::POST;

    public function __construct(
        public readonly float $number,
        public readonly CarbonUnit $units,
        public readonly bool $test = false,
        public readonly ?string $idempotency = null
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/impact/carbon';
    }

    public function defaultHeaders(): array
    {
        return array_filter([
            'Idempotency-Key' => $this->idempotency,
        ]);
    }

    public function defaultData(): array
    {
        return array_filter([
            'number' => $this->number,
            'units' => $this->units->value,
            'test' => $this->test,
        ]);
    }

    protected function castToDto(SaloonResponse $response): CarbonOffsetPurchase
    {
        return CarbonOffsetPurchase::fromArray($response->json());
    }
}
