<?php

declare(strict_types=1);

namespace Noldors\Sipuni;

class DefaultProvider extends AbstractProvider
{
    private const MODIFIER = 0.5;
    private const EXCEPTION_CHARS = ['ё' => 'е'];

    protected function sort(array $chars): array
    {
        \uasort($chars, [$this, 'sortFunction']);

        return $chars;
    }

    protected function sortFunction(string $a, string $b): int
    {
        $lowerA = \mb_strtolower($a);
        $lowerB = \mb_strtolower($b);

        // In order to fix Ё position, compare chars ord
        $ordA = $this->getCharOrd($lowerA);
        $ordB = $this->getCharOrd($lowerB);

        // Fix order of upper cased and lower cased chars, upper cased after lower cased
        if ($lowerA === $lowerB) {
            return $this->fixCasePosition($a, $b);
        }

        return $ordA <=> $ordB;
    }

    private function getCharOrd(string $char) {
        return \array_key_exists($char, static::EXCEPTION_CHARS)
            ? \mb_ord(static::EXCEPTION_CHARS[$char]) + static::MODIFIER
            : \mb_ord($char);
    }

    private function fixCasePosition(string $a, string $b): int
    {
        if ($this->isUpper($a) && $this->isLower($b)) {
            return 1;
        }

        if ($this->isLower($a) && $this->isUpper($b)) {
            return -1;
        }

        return 0;
    }

    private function isUpper(string $char): bool
    {
        return $char === \mb_strtoupper($char);
    }

    private function isLower(string $char): bool
    {
        return $char === \mb_strtolower($char);
    }
}
