<?php

namespace Astrotomic\Ecologi\Requests\Reporting;

use Astrotomic\Ecologi\Data\Impact;
use Astrotomic\Ecologi\Ecologi;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

/**
 * @link https://docs.ecologi.com/docs/public-api-docs/0eb5caf374377-get-total-impact
 */
class GetImpact extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $username
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/users/{$this->username}/impact";
    }

    public function createDtoFromResponse(Response $response): Impact
    {
        return Impact::fromArray($response->json());
    }
}
