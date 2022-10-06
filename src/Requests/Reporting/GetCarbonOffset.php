<?php

namespace Astrotomic\Ecologi\Requests\Reporting;

use Astrotomic\Ecologi\Ecologi;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

/**
 * @link https://docs.ecologi.com/docs/public-api-docs/6046ba6f68449-get-total-tonnes-of-co-2e-offset
 */
class GetCarbonOffset extends SaloonRequest
{
    use CastsToDto;

    protected ?string $connector = Ecologi::class;

    protected ?string $method = Saloon::GET;

    public function __construct(public readonly string $username)
    {
    }

    public function defineEndpoint(): string
    {
        return "/users/{$this->username}/carbon-offset";
    }

    protected function castToDto(SaloonResponse $response): float
    {
        return (float) $response->json('total');
    }
}
