<?php

declare(strict_types=1);

namespace App\Service;

class CalculatorService
{
    /**
     * @var float[]
     */
    private array $history = [];

    public function add(float $a, float $b): float
    {
        $result = $a + $b;
        $this->storeInHistory($result);
        return $result;
    }

    public function subtract(float $a, float $b): float
    {
        $result = $a - $b;
        $this->storeInHistory($result);
        return $result;
    }

    public function multiply(float $a, float $b): float
    {
        $result = $a * $b;
        $this->storeInHistory($result);
        return $result;
    }

    public function getHistory(): array
    {
        return $this->history;
    }

    public function clearHistory(): void
    {
        $this->history = [];
    }

    private function storeInHistory(float $result): void
    {
        $this->history[] = $result;
    }
}
