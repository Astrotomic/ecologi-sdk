<?php

namespace Astrotomic\Ecologi\Data;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;
use Money\Parser\DecimalMoneyParser;

class TreePurchase
{
    /**
     * @param  non-empty-string  $currency
     */
    final public function __construct(
        public readonly int $trees,
        public readonly float $amount,
        public readonly string $currency,
        public readonly string $treeUrl,
        public readonly ?string $name,
    ) {
    }

    public static function fromArray(int $trees, array $data): self
    {
        return new static(
            trees: $trees,
            amount: $data['amount'],
            currency: $data['currency'],
            treeUrl: $data['treeUrl'],
            name: $data['name'] ?? null,
        );
    }

    public function currency(): Currency
    {
        return new Currency($this->currency);
    }

    public function costs(): Money
    {
        return (new DecimalMoneyParser(new ISOCurrencies()))->parse(
            (string) $this->amount,
            $this->currency()
        );
    }
}
