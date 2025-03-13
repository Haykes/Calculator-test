<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private CalculatorService $calculator;

    protected function setUp(): void
    {
        $this->calculator = new CalculatorService();
    }

    public function testAdditionWithPositiveNumbers(): void
    {
        $result = $this->calculator->add(3, 4);
        $this->assertSame(7.0, $result);
    }

    public function testAdditionWithNegativeNumbers(): void
    {
        $result = $this->calculator->add(-2, -3);
        $this->assertSame(-5.0, $result);
    }

    public function testAdditionWithFloats(): void
    {
        $result = $this->calculator->add(1.5, 2.3);
        $this->assertEqualsWithDelta(3.8, $result, 0.0001);
    }

    public function testSubtractionWithPositiveNumbers(): void
    {
        $result = $this->calculator->subtract(10, 3);
        $this->assertSame(7.0, $result);
    }

    public function testSubtractionWithNegativeNumbers(): void
    {
        $result = $this->calculator->subtract(-5, -2);
        $this->assertSame(-3.0, $result);
    }

    public function testSubtractionWithFloats(): void
    {
        $result = $this->calculator->subtract(5.5, 2.2);
        $this->assertEqualsWithDelta(3.3, $result, 0.0001);
    }

    public function testMultiplicationWithPositiveNumbers(): void
    {
        $result = $this->calculator->multiply(4, 5);
        $this->assertSame(20.0, $result);
    }

    public function testMultiplicationWithNegativeNumbers(): void
    {
        $result = $this->calculator->multiply(-3, -2);
        $this->assertSame(6.0, $result);
    }

    public function testMultiplicationWithZero(): void
    {
        $result = $this->calculator->multiply(0, 10);
        $this->assertSame(0.0, $result);
    }

    public function testMultiplicationWithFloats(): void
    {
        $result = $this->calculator->multiply(2.5, 4.2);
        $this->assertEqualsWithDelta(10.5, $result, 0.0001);
    }

    public function testCalculatorInitialHistoryIsEmpty(): void
    {
        $this->assertEmpty($this->calculator->getHistory());
    }

    public function testCalculatorStoresMultipleCalculationsInHistory(): void
    {
        $this->calculator->add(2, 3);            // 5
        $this->calculator->subtract(10, 4);      // 6
        $this->calculator->multiply(3, 3);       // 9

        $expectedHistory = [5.0, 6.0, 9.0];

        $this->assertSame($expectedHistory, $this->calculator->getHistory());
    }

    public function testClearHistory(): void
    {
        $this->calculator->add(1, 1);
        $this->calculator->clearHistory();

        $this->assertEmpty($this->calculator->getHistory());
    }

    public function testCalculatorStoresResultsWithFloatsInHistory(): void
    {
        $this->calculator->add(1.1, 2.2);            // 3.3
        $this->calculator->multiply(2.5, 4);         // 10.0

        $expectedHistory = [3.3, 10.0];

        $history = $this->calculator->getHistory();

        foreach ($history as $key => $value) {
            $this->assertEqualsWithDelta($expectedHistory[$key], $value, 0.0001);
        }
    }
}
