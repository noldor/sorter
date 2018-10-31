<?php

declare(strict_types=1);

namespace Noldors\Sipuni;

use PHPUnit\Framework\TestCase;

class SorterTest extends TestCase
{
    private const ACTUAL = 'lemon orange banana apple';
    private const EXPECTED = 'elmno aegnor aaabnn aelpp';

    public function testSort(): void
    {
        $this->assertSame(static::EXPECTED, Sorter::sort(static::ACTUAL));
    }

    public function testMake(): void
    {
        $this->assertInstanceOf(Sorter::class, Sorter::make(static::ACTUAL));
    }

    public function testGet(): void
    {
        $this->assertSame(static::EXPECTED, (new Sorter(static::ACTUAL))->get());
    }
}
