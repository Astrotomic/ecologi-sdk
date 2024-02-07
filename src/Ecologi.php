<?php

namespace Astrotomic\Ecologi;

use Astrotomic\Ecologi\Resources\Purchasing;
use Astrotomic\Ecologi\Resources\Reporting;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class Ecologi extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    public function __construct(
        protected string $token
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return 'https://public.ecologi.com';
    }

    public function defaultAuth(): ?Authenticator
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
        return (new Purchasing($this))->test($test);
    }
}
