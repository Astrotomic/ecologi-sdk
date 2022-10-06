<?php

namespace Astrotomic\Ecologi;

use Astrotomic\Ecologi\RequestCollections\Purchasing;
use Astrotomic\Ecologi\RequestCollections\Reporting;
use Astrotomic\Ecologi\Responses\EcologiResponse;
use Sammyjo20\Saloon\Http\Auth\TokenAuthenticator;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Interfaces\AuthenticatorInterface;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Sammyjo20\Saloon\Traits\Plugins\AlwaysThrowsOnErrors;

class Ecologi extends SaloonConnector
{
    use AcceptsJson;
    use AlwaysThrowsOnErrors;

    protected ?string $response = EcologiResponse::class;

    public function __construct(
        protected string $token
    ) {
    }

    public function defineBaseUrl(): string
    {
        return 'https://public.ecologi.com';
    }

    public function defaultAuth(): ?AuthenticatorInterface
    {
        return new TokenAuthenticator($this->token);
    }

    public function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    public function reporting(): Reporting
    {
        return new Reporting($this);
    }

    public function purchasing(bool $test = false): Purchasing
    {
        return new Purchasing($this, $test);
    }
}
