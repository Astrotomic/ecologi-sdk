<?php

namespace Astrotomic\Ecologi\Requests\Reporting;

use Astrotomic\Ecologi\Data\Impact;
use Astrotomic\Ecologi\Ecologi;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

/**
 * @link https://docs.ecologi.com/docs/public-api-docs/0eb5caf374377-get-total-impact
 */
class GetImpact extends SaloonRequest
{
    use CastsToDto;

    protected ?string $connector = Ecologi::class;

    protected ?string $method = Saloon::GET;

    public function __construct(
        public readonly string $username
    ) {
    }

    public function defineEndpoint(): string
    {
        return "/users/{$this->username}/impact";
    }

    protected function castToDto(SaloonResponse $response): Impact
    {
        return Impact::fromArray($response->json());
    }
}
