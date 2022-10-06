<?php

namespace Tests\Feature;

use Astrotomic\Ecologi\Ecologi;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use Sammyjo20\Saloon\Http\MockResponse;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Tests\MockClient;
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

        $mockClient = new MockClient([
            function (SaloonRequest $request): MockResponse {
                if (! str_starts_with($request->getFullRequestUrl(), 'https://public.ecologi.com/')) {
                    return MockResponse::make()->throw(
                        fn (Request $guzzleRequest): Throwable => new ConnectException('Wrong base-url.', $guzzleRequest)
                    );
                }

                $body = $this->fixture(parse_url($request->getFullRequestUrl(), PHP_URL_PATH));

                return MockResponse::make($body, 200, [
                    'Content-Type' => 'application/json',
                ]);
            },
        ]);

        $this->ecologi->withMockClient($mockClient);
    }

    protected function tearDown(): void
    {
        /** @var \Sammyjo20\Saloon\Http\SaloonResponse $response */
        foreach ($this->ecologi->getMockClient()->getRecordedResponses() as $response) {
            if ($response->successful()) {
                $request = $response->getOriginalRequest();

                $filepath = $this->fixturePath(parse_url($request->getFullRequestUrl(), PHP_URL_PATH));

                @mkdir(dirname($filepath), 0777, true);
                file_put_contents(
                    $filepath,
                    json_encode($response->json(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                );
            }
        }

        parent::tearDown();
    }

    public function fixture(string $path): array
    {
        $fixturePath = $this->fixturePath($path);

        if (! file_exists($fixturePath)) {
            throw new InvalidArgumentException($fixturePath);
        }

        $json = file_get_contents($fixturePath);

        return json_decode($json, true, flags: JSON_THROW_ON_ERROR);
    }

    protected function fixturePath(string $path): string
    {
        return __DIR__.'/../fixtures/'.trim($path, '/').'.json';
    }
}
