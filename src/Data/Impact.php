<?php

namespace Astrotomic\Ecologi\Data;

class Impact
{
    final public function __construct(
        public readonly int $trees,
        public readonly float $carbonOffset,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new static(
            trees: $data['trees'],
            carbonOffset: $data['carbonOffset'],
        );
    }
}
