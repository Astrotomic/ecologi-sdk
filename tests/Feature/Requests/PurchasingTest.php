<?php

use Astrotomic\Ecologi\Data\CarbonOffsetPurchase;
use Astrotomic\Ecologi\Data\TreePurchase;
use Astrotomic\Ecologi\Enums\CarbonUnit;
use Money\Currency;
use Money\Money;

it('responds with tree purchase', function (int $number, ?string $name): void {
    $data = $this->ecologi->purchasing(true)->buyTrees($number, $name);

    expect($data)
        ->toBeInstanceOf(TreePurchase::class)
        ->currency()->toBeInstanceOf(Currency::class)
        ->costs()->toBeInstanceOf(Money::class)
        ->trees->toEqual($number)
        ->name->toBe($name);
})
    ->group('purchasing', 'buyTrees')
    ->with([1, 10, 25, 50, 100, 1000])
    ->with([null, 'Tom', 'Gummibeer']);

it('responds with carbon offset purchase', function (int $number): void {
    $data = $this->ecologi->purchasing(true)->buyCarbonOffset($number, CarbonUnit::KG);

    expect($data)
        ->toBeInstanceOf(CarbonOffsetPurchase::class)
        ->currency()->toBeInstanceOf(Currency::class)
        ->costs()->toBeInstanceOf(Money::class)
        ->number->toEqual($number);
})
    ->group('purchasing', 'buyCarbonOffset')
    ->with([1, 10, 25, 50, 100, 1000]);
