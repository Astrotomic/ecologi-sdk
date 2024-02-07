<?php

namespace Astrotomic\Ecologi\Requests\Reporting;

use Astrotomic\Ecologi\Ecologi;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://docs.ecologi.com/docs/public-api-docs/2531efb510c5b-get-total-number-of-trees
 */
class GetTrees extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $username
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/users/{$this->username}/trees";
    }

    public function createDtoFromResponse(Response $response): int
    {
        return (int) $response->json('total');
    }
}
