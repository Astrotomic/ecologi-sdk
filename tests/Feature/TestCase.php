<?php

namespace Tests\Feature;

use Astrotomic\Ecologi\Ecologi;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\PendingRequest;
use Throwable;

abstract class TestCase extends \Tests\TestCase
{
    protected string $token;

    protected Ecologi $ecologi;

    protected function setUp(): void
    {
        parent::setUp();

        $this->token = getenv('ECOLOGI_TOKEN');

        $this->ecologi = new Ecologi($this->token);

        $mockClient = new \Saloon\Http\Faking\MockClient([
            function (PendingRequest $request): MockResponse {
                if (! str_starts_with($request->getUrl(), 'https://public.ecologi.com/')) {
                    return MockResponse::make()->throw(
                        fn (Request $guzzleRequest): Throwable => new ConnectException('Wrong base-url.', $guzzleRequest)
                    );
                }

                $body = $this->fixture(
                    path: parse_url($request->getUrl(), PHP_URL_PATH),
                    data: array_merge([], $request->body()?->all() ?? [], $request->query()->all())
                );

                return MockResponse::make($body, 200, [
                    'Content-Type' => 'application/json',
                ]);
            },
        ]);

        $this->ecologi->withMockClient($mockClient);
    }

    public function fixture(string $path, array $data = []): array
    {
        $fixturePath = $this->fixturePath($path, $data);

        if (! file_exists($fixturePath)) {
            throw new InvalidArgumentException($fixturePath);
        }

        $json = file_get_contents($fixturePath);

        return json_decode($json, true, flags: JSON_THROW_ON_ERROR);
    }

    protected function fixturePath(string $path, array $data = []): string
    {
        return __DIR__.'/../fixtures/'.trim($path, '/').($data ? '/'.http_build_query($data) : '').'.json';
    }
}
