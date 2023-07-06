<?php

namespace App\ValueObject;

use InvalidArgumentException;

/**
 * @property-read string $currency
 */
final class Currency
{
    /**
     * 扱っている通貨単位
     *
     * @static
     * @var string[]
     */
    private const CURRENCIES = [
        'JPY',
    ];

    /**
     * @var string
     */
    public readonly string $currency;

    /**
     * @param  string  $currency
     */
    public function __construct(string $currency)
    {
        if (!in_array($currency, self::CURRENCIES, true)) {
            throw new InvalidArgumentException('取り扱いのない通貨です');
        }

        $this->currency = $currency;
    }

    /**
     * 通貨単位が一致しているか
     *
     * @param  Currency  $currency
     * @return bool
     */
    public function equals(Currency $currency): bool
    {
        return (
            $this->currency === $currency->currency
        );
    }
}