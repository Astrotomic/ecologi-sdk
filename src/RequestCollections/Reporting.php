<?php

namespace Astrotomic\Ecologi\RequestCollections;

use Astrotomic\Ecologi\Data\Impact;
use Astrotomic\Ecologi\Requests\Reporting\GetCarbonOffset;
use Astrotomic\Ecologi\Requests\Reporting\GetImpact;
use Astrotomic\Ecologi\Requests\Reporting\GetTrees;
use Sammyjo20\Saloon\Http\RequestCollection;

class Reporting extends RequestCollection
{
    public function getTrees(string $username): int
    {
        return $this->connector->send(
            new GetTrees($username)
        )->dto();
    }

    public function getCarbonOffset(string $username): float
    {
        return $this->connector->send(
            new GetCarbonOffset($username)
        )->dto();
    }

    public function getImpact(string $username): Impact
    {
        return $this->connector->send(
            new GetImpact($username)
        )->dto();
    }
}
