<?php

namespace Astrotomic\Ecologi\Responses;

use Astrotomic\Ecologi\Exceptions\BadResponseException;
use Astrotomic\Ecologi\Exceptions\ClientException;
use Astrotomic\Ecologi\Exceptions\ServerException;
use Sammyjo20\Saloon\Http\SaloonResponse;

class EcologiResponse extends SaloonResponse
{
    public function toException(): ?BadResponseException
    {
        return match (true) {
            $this->clientError() => ClientException::fromResponse($this),
            $this->serverError() => ServerException::fromResponse($this),
            $this->failed() => BadResponseException::fromResponse($this),
            default => null,
        };
    }
}
