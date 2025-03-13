<?php

namespace App\Tests\Service;

use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    public function testAddition(): void
    {
        $calculator = new CalculatorService();
        $result = $calculator->add(3, 4);

        $this->assertEquals(7, $result);
    }
}
