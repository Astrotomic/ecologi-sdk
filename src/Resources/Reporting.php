<?php

namespace Astrotomic\Ecologi\Resources;

use Astrotomic\Ecologi\Data\Impact;
use Astrotomic\Ecologi\Requests\Reporting\GetCarbonOffset;
use Astrotomic\Ecologi\Requests\Reporting\GetImpact;
use Astrotomic\Ecologi\Requests\Reporting\GetTrees;
use Saloon\Http\BaseResource;

class Reporting extends BaseResource
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
