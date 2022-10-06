<?php

namespace Astrotomic\Ecologi\Requests\Purchasing;

use Astrotomic\Ecologi\Data\TreePurchase;
use Astrotomic\Ecologi\Ecologi;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

/**
 * @link https://docs.ecologi.com/docs/public-api-docs/004342d262f93-purchase-trees
 */
class BuyTrees extends SaloonRequest
{
    use CastsToDto;
    use HasJsonBody;

    protected ?string $connector = Ecologi::class;

    protected ?string $method = Saloon::POST;

    public function __construct(
        public readonly int $number,
        public readonly ?string $name = null,
        public readonly bool $test = false,
        public readonly ?string $idempotency = null
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/impact/trees';
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
            'name' => $this->name,
            'test' => $this->test,
        ]);
    }

    protected function castToDto(SaloonResponse $response): TreePurchase
    {
        return TreePurchase::fromArray($this->number, $response->json());
    }
}
