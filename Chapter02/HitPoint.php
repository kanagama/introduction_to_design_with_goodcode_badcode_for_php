<?php

namespace App\ValueObject;

use InvalidArgumentException;

/**
 * @property-read int $hitPoint
 */
final class HitPoint
{
    /**
     * @static
     * @var int
     */
    private const MIN = 0;

    /**
     * @static
     * @var int
     */
    private const MAX = 999;

    /**
     * @var int
     */
    public readonly int $hitPoint;

    /**
     * @param int $hitPoint
     */
    public function __construct(int $hitPoint)
    {
        if ($hitPoint < self::MIN) {
            throw new InvalidArgumentException(self::MIN . '以上を指定してください');
        }
        if ($hitPoint > self::MAX) {
            throw new InvalidArgumentException(self::MAX . '以下を指定してください');
        }

        $this->hitPoint = $hitPoint;
    }

    /**
     * ダメージ計算
     *
     * @param  int  $damage
     * @return self
     */
    public function damage(int $damage): self
    {
        $damaged = $this->hitPoint - $damage;
        $corrected = ($damaged < self::MIN) ? self::MIN : $damaged;

        return new self($corrected);
    }

    /**
     * 回復計算
     *
     * @param  int  $recovery
     * @return self
     */
    public function recover(int $recovery): self
    {
        $recovered = $this->hitPoint + $recovery;
        $corrected = ($recovered > self::MAX) ? self::MAX : $recovered;

        return new self($corrected);
    }
}
