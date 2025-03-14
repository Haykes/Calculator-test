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
        self::assertSame(7.0, $result);
    }

    public function testAdditionWithNegativeNumbers(): void
    {
        $result = $this->calculator->add(-2, -3);
        self::assertSame(-5.0, $result);
    }

    public function testAdditionWithFloats(): void
    {
        $result = $this->calculator->add(1.5, 2.3);
        self::assertEqualsWithDelta(3.8, $result, 0.0001);
    }

    public function testSubtractionWithPositiveNumbers(): void
    {
        $result = $this->calculator->subtract(10, 3);
        self::assertSame(7.0, $result);
    }

    public function testSubtractionWithNegativeNumbers(): void
    {
        $result = $this->calculator->subtract(-5, -2);
        self::assertSame(-3.0, $result);
    }

    public function testSubtractionWithFloats(): void
    {
        $result = $this->calculator->subtract(5.5, 2.2);
        self::assertEqualsWithDelta(3.3, $result, 0.0001);
    }

    public function testMultiplicationWithPositiveNumbers(): void
    {
        $result = $this->calculator->multiply(4, 5);
        self::assertSame(20.0, $result);
    }

    public function testMultiplicationWithNegativeNumbers(): void
    {
        $result = $this->calculator->multiply(-3, -2);
        self::assertSame(6.0, $result);
    }

    public function testMultiplicationWithZero(): void
    {
        $result = $this->calculator->multiply(0, 10);
        self::assertSame(0.0, $result);
    }

    public function testMultiplicationWithFloats(): void
    {
        $result = $this->calculator->multiply(2.5, 4.2);
        self::assertEqualsWithDelta(10.5, $result, 0.0001);
    }

    public function testCalculatorInitialHistoryIsEmpty(): void
    {
        self::assertEmpty($this->calculator->getHistory());
    }

    public function testCalculatorStoresMultipleCalculationsInHistory(): void
    {
        $this->calculator->add(2, 3);        // 5
        $this->calculator->subtract(10, 4);  // 6
        $this->calculator->multiply(3, 3);   // 9

        $expectedHistory = [5.0, 6.0, 9.0];

        self::assertSame($expectedHistory, $this->calculator->getHistory());
    }

    public function testClearHistory(): void
    {
        $this->calculator->add(1, 1);
        $this->calculator->clearHistory();
        self::assertEmpty($this->calculator->getHistory());
    }

    public function testCalculatorStoresResultsWithFloatsInHistory(): void
    {
        $this->calculator->add(1.1, 2.2);  // 3.3
        $this->calculator->multiply(2.5, 4); // 10.0

        $expectedHistory = [3.3, 10.0];
        $history = $this->calculator->getHistory();

        foreach ($history as $key => $value) {
            self::assertEqualsWithDelta($expectedHistory[$key], $value, 0.0001);
        }
    }

    public function testDivisionByZero(): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Division by zero');

        $this->calculator->divide(10, 0);
    }
}
