<?php

namespace App\ValueObject;

use App\ValueObject\Currency;
use InvalidArgumentException;

/**
 * @property-read int $amount
 */
final class Money
{
    /**
     * @var int
     */
    public readonly int $amount;

    /**
     * @var Currency
     */
    private readonly Currency $currency;

    /**
     * @param  int  $amount
     * @param  Currency  $currency
     */
    public function __construct(
        int $amount,
        Currency $currency,
    ) {
        if ($amount < 0) {
            throw new InvalidArgumentException('金額には0以上を指定して下さい');
        }
        if (empty($currency->currency)) {
            throw new InvalidArgumentException('通貨単位を指定して下さい');
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * 金額を加算
     *
     * @param  Money  $other
     * @return self
     */
    public function add(Money $other): self
    {
        if (!$this->currency->equals($other->currency)) {
            throw new InvalidArgumentException('通貨単位が違います。');
        }

        $added = $this->amount + $other->amount;

        return new self($added, $this->currency);
    }
}