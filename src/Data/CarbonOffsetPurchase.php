<?php

namespace Astrotomic\Ecologi\Data;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;
use Money\Parser\DecimalMoneyParser;

class CarbonOffsetPurchase
{
    /**
     * @param  float  $number
     * @param  float  $numberInTonnes
     * @param  float  $amount
     * @param  non-empty-string  $currency
     * @param  array  $projectDetails
     */
    final public function __construct(
        public readonly float $number,
        public readonly float $numberInTonnes,
        public readonly float $amount,
        public readonly string $currency,
        public readonly array $projectDetails,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new static(
            number: $data['number'],
            numberInTonnes: $data['numberInTonnes'],
            amount: $data['amount'],
            currency: $data['currency'],
            projectDetails: $data['projectDetails'] ?? [],
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
