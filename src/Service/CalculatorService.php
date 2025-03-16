<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class CalculatorService
{
    private const SESSION_HISTORY_KEY = 'calculator_history';
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function add(float $a, float $b): float
    {
        $result = $a + $b;
        $this->storeInHistory($a, $b, '+', $result);

        return $result;
    }

    public function subtract(float $a, float $b): float
    {
        $result = $a - $b;
        $this->storeInHistory($a, $b, '-', $result);

        return $result;
    }

    public function multiply(float $a, float $b): float
    {
        $result = $a * $b;
        $this->storeInHistory($a, $b, '×', $result);

        return $result;
    }

    public function divide(float $a, float $b): float
    {
        if (0.0 === $b) {
            throw new \InvalidArgumentException('Division by zero');
        }

        $result = $a / $b;
        $this->storeInHistory($a, $b, '÷', $result);

        return $result;
    }

    private function storeInHistory(float $a, float $b, string $operator, float $result): void
    {
        $session = $this->requestStack->getSession();
        /** @var string[] $history */
        $history = (array) $session->get(self::SESSION_HISTORY_KEY, []);

        $history[] = "{$a} {$operator} {$b} = {$result}";
        $session->set(self::SESSION_HISTORY_KEY, $history);
    }

    /**
     * @return string[]
     */
    public function getHistory(): array
    {
        /** @var string[] $history */
        return (array) $this->requestStack->getSession()->get(self::SESSION_HISTORY_KEY, []);
    }

    public function clearHistory(): void
    {
        $this->requestStack->getSession()->remove(self::SESSION_HISTORY_KEY);
    }
}
