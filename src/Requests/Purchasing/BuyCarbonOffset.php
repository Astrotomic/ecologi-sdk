<?php

namespace Astrotomic\Ecologi\Requests\Purchasing;

use Astrotomic\Ecologi\Data\CarbonOffsetPurchase;
use Astrotomic\Ecologi\Enums\CarbonUnit;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://docs.ecologi.com/docs/public-api-docs/e07bbee7fa605-purchase-carbon-offsets
 */
class BuyCarbonOffset extends Request implements HasBody
{
    use CreatesDtoFromResponse;
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly float $number,
        public readonly CarbonUnit $units,
        public readonly bool $test = false,
        public readonly ?string $idempotency = null
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/impact/carbon';
    }

    public function defaultHeaders(): array
    {
        return array_filter([
            'Idempotency-Key' => $this->idempotency,
        ]);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'number' => $this->number,
            'units' => $this->units->value,
            'test' => $this->test,
        ]);
    }

    public function createDtoFromResponse(Response $response): CarbonOffsetPurchase
    {
        return CarbonOffsetPurchase::fromArray($response->json());
    }
}
