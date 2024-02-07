<?php

namespace Astrotomic\Ecologi\Requests\Purchasing;

use Astrotomic\Ecologi\Data\TreePurchase;
use Astrotomic\Ecologi\Ecologi;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://docs.ecologi.com/docs/public-api-docs/004342d262f93-purchase-trees
 */
class BuyTrees extends Request implements HasBody
{
    use CreatesDtoFromResponse;
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly int $number,
        public readonly ?string $name = null,
        public readonly bool $test = false,
        public readonly ?string $idempotency = null
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/impact/trees';
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
            'name' => $this->name,
            'test' => $this->test,
        ]);
    }

    public function createDtoFromResponse(Response $response): TreePurchase
    {
        return TreePurchase::fromArray($this->number, $response->json());
    }
}
