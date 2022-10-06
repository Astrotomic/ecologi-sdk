<?php

use Astrotomic\Ecologi\Data\Impact;

it('responds with total number of trees', function (string $username): void {
    $total = $this->ecologi->reporting()->getTrees($username);

    expect($total)
        ->toBeInt()
        ->toBeGreaterThanOrEqual(0);
})->group('reporting', 'getTrees')->with('usernames');

it('responds with total tonnes of carbon offset', function (string $username): void {
    $total = $this->ecologi->reporting()->getCarbonOffset($username);

    expect($total)
        ->toBeFloat()
        ->toBeGreaterThanOrEqual(0);
})->group('reporting', 'getCarbonOffset')->with('usernames');

it('responds with total impact', function (string $username): void {
    $data = $this->ecologi->reporting()->getImpact($username);

    expect($data)
        ->toBeInstanceOf(Impact::class)
        ->trees->toBeGreaterThanOrEqual(0)
        ->carbonOffset->toBeGreaterThanOrEqual(0);
})->group('reporting', 'getImpact')->with('usernames');
