<?php

namespace Tests;

use Sammyjo20\Saloon\Clients\MockClient as BaseMockClient;
use Sammyjo20\Saloon\Http\MockResponse;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Managers\RequestManager;
use Throwable;

class MockClient extends BaseMockClient
{
    public function guessNextResponse(SaloonRequest $request): MockResponse
    {
        try {
            return parent::guessNextResponse($request);
        } catch(Throwable $exception) {
            $response = (new RequestManager($request, null, false))->send();

            return MockResponse::make($response->body(), $response->status(), $response->headers());
        }
    }
}
