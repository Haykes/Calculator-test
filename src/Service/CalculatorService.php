<?php

declare(strict_types=1);

namespace App\Service;

class CalculatorService
{
    /** @var float[] */
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

    public function divide(float $a, float $b): float
    {
        if ($b === 0.0) {
            throw new \InvalidArgumentException('Division by zero');
        }

        $result = $a / $b;
        $this->storeInHistory($result);
        return $result;
    }

    private function storeInHistory(float $result): void
    {
        $this->history[] = $result;
    }

    /**
     * @return float[]
     */
    public function getHistory(): array
    {
        return $this->history;
    }

    public function clearHistory(): void
    {
        $this->history = [];
    }
}
