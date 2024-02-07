<?php

namespace Astrotomic\Ecologi\Requests\Reporting;

use Astrotomic\Ecologi\Ecologi;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://docs.ecologi.com/docs/public-api-docs/6046ba6f68449-get-total-tonnes-of-co-2e-offset
 */
class GetCarbonOffset extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $username
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/users/{$this->username}/carbon-offset";
    }

    public function createDtoFromResponse(Response $response): float
    {
        return (float) $response->json('total');
    }
}
