<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testIndexPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Calculatrice TDD');
    }

    public function testAdditionApi(): void
    {
        $client = static::createClient();
        $calculatorMock = $this->createMock(CalculatorService::class);
        $calculatorMock->method('add')->willReturn(5.0);

        self::getContainer()->set(CalculatorService::class, $calculatorMock);

        $client->request('GET', '/api/calculator/add?a=2&b=3');

        self::assertResponseIsSuccessful();
        self::assertJsonStringEqualsJsonString(
            '{"result":5}',
            (string) $client->getResponse()->getContent()
        );
    }

    public function testSubtractionApi(): void
    {
        $client = static::createClient();
        $calculatorMock = $this->createMock(CalculatorService::class);
        $calculatorMock->method('subtract')->willReturn(6.0);

        self::getContainer()->set(CalculatorService::class, $calculatorMock);

        $client->request('GET', '/api/calculator/subtract?a=10&b=4');

        self::assertResponseIsSuccessful();
        self::assertJsonStringEqualsJsonString(
            '{"result":6}',
            (string) $client->getResponse()->getContent()
        );
    }

    public function testMultiplicationApi(): void
    {
        $client = static::createClient();
        $calculatorMock = $this->createMock(CalculatorService::class);
        $calculatorMock->method('multiply')->willReturn(15.0);

        self::getContainer()->set(CalculatorService::class, $calculatorMock);

        $client->request('GET', '/api/calculator/multiply?a=3&b=5');

        self::assertResponseIsSuccessful();
        self::assertJsonStringEqualsJsonString(
            '{"result":15}',
            (string) $client->getResponse()->getContent()
        );
    }

    public function testDivisionApi(): void
    {
        $client = static::createClient();
        $calculatorMock = $this->createMock(CalculatorService::class);
        $calculatorMock->method('divide')->willReturn(5.0);

        self::getContainer()->set(CalculatorService::class, $calculatorMock);

        $client->request('GET', '/api/calculator/divide?a=10&b=2');

        self::assertResponseIsSuccessful();
        self::assertJsonStringEqualsJsonString(
            '{"result":5}',
            (string) $client->getResponse()->getContent()
        );
    }

    public function testDivisionByZeroApi(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/calculator/divide?a=10&b=0');

        self::assertResponseStatusCodeSame(400);
        self::assertJsonStringEqualsJsonString(
            '{"error":"Division by zero"}',
            (string) $client->getResponse()->getContent()
        );
    }

    public function testGetHistoryApi(): void
    {
        $client = static::createClient();
        $calculatorMock = $this->createMock(CalculatorService::class);
        $calculatorMock->method('getHistory')->willReturn(['2 + 2 = 4']);

        self::getContainer()->set(CalculatorService::class, $calculatorMock);

        $client->request('GET', '/api/calculator/history');

        self::assertResponseIsSuccessful();
        self::assertJsonStringEqualsJsonString(
            '{"history":["2 + 2 = 4"]}',
            (string) $client->getResponse()->getContent()
        );
    }

    public function testClearHistoryApi(): void
    {
        $client = static::createClient();

        $calculatorMock = $this->createMock(CalculatorService::class);
        $calculatorMock->expects(self::once())->method('clearHistory');

        self::getContainer()->set(CalculatorService::class, $calculatorMock);

        $client->request('POST', '/api/calculator/clear-history');

        self::assertResponseIsSuccessful();
        self::assertJsonStringEqualsJsonString(
            '{"message":"Historique effacé"}',
            (string) $client->getResponse()->getContent()
        );
    }
}
