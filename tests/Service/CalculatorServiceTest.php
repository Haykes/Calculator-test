<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\CalculatorService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CalculatorServiceTest extends TestCase
{
    private CalculatorService $calculator;

    /** @var SessionInterface&MockObject */
    private $session;

    protected function setUp(): void
    {
        $this->session = $this->createMock(SessionInterface::class);

        $requestStack = $this->createMock(RequestStack::class);
        $requestStack
            ->method('getSession')
            ->willReturn($this->session);

        $this->calculator = new CalculatorService($requestStack);
    }

    public function testAdd(): void
    {
        $this->session
            ->expects(self::once())
            ->method('get')
            ->with('calculator_history', [])
            ->willReturn([]);

        $this->session
            ->expects(self::once())
            ->method('set')
            ->with('calculator_history', ['2 + 3 = 5']);

        $result = $this->calculator->add(2, 3);

        self::assertSame(5.0, $result);
    }

    public function testSubtract(): void
    {
        $this->session
            ->expects(self::once())
            ->method('get')
            ->with('calculator_history', [])
            ->willReturn([]);

        $this->session
            ->expects(self::once())
            ->method('set')
            ->with('calculator_history', ['5 - 3 = 2']);

        $result = $this->calculator->subtract(5, 3);

        self::assertSame(2.0, $result);
    }

    public function testMultiply(): void
    {
        $this->session
            ->expects(self::once())
            ->method('get')
            ->with('calculator_history', [])
            ->willReturn([]);

        $this->session
            ->expects(self::once())
            ->method('set')
            ->with('calculator_history', ['4 × 5 = 20']);

        $result = $this->calculator->multiply(4, 5);

        self::assertSame(20.0, $result);
    }

    public function testDivide(): void
    {
        $this->session
            ->expects(self::once())
            ->method('get')
            ->with('calculator_history', [])
            ->willReturn([]);

        $this->session
            ->expects(self::once())
            ->method('set')
            ->with('calculator_history', ['10 ÷ 2 = 5']);

        $result = $this->calculator->divide(10, 2);

        self::assertSame(5.0, $result);
    }

    public function testDivideByZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Division by zero');

        $this->calculator->divide(10, 0);
    }

    public function testGetHistory(): void
    {
        $expectedHistory = ['2 + 2 = 4', '3 × 3 = 9'];

        $this->session
            ->expects(self::once())
            ->method('get')
            ->with('calculator_history', [])
            ->willReturn($expectedHistory);

        $history = $this->calculator->getHistory();

        self::assertSame($expectedHistory, $history);
    }

    public function testClearHistory(): void
    {
        $this->session
            ->expects(self::once())
            ->method('remove')
            ->with('calculator_history');

        $this->calculator->clearHistory();
    }
}
