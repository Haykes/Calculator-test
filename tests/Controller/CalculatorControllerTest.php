<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class CalculatorControllerTest extends WebTestCase
{
    private KernelBrowser $client; // ✅ Ajout du type explicite

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testIndexPage(): void
    {
        $this->client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Calculatrice TDD');
    }

    public function testAdditionViaApi(): void
    {
        $this->client->request('GET', '/api/calculator/add?a=2&b=3');

        self::assertResponseIsSuccessful();
        $responseContent = (string) $this->client->getResponse()->getContent(); // ✅ Force en string
        self::assertJsonStringEqualsJsonString('{"result":5}', $responseContent);
    }

    public function testSubtractionApi(): void
    {
        $this->client->request('GET', '/api/calculator/subtract?a=10&b=4');

        self::assertResponseIsSuccessful();
        $responseContent = (string) $this->client->getResponse()->getContent(); // ✅ Force en string
        self::assertJsonStringEqualsJsonString('{"result":6}', $responseContent);
    }

    public function testMultiplicationApi(): void
    {
        $this->client->request('GET', '/api/calculator/multiply?a=3&b=5');

        self::assertResponseIsSuccessful();
        $responseContent = (string) $this->client->getResponse()->getContent(); // ✅ Force en string
        self::assertJsonStringEqualsJsonString('{"result":15}', $responseContent);
    }

    public function testDivisionApi(): void
    {
        $this->client->request('GET', '/api/calculator/divide?a=10&b=2');

        self::assertResponseIsSuccessful();
        $responseContent = (string) $this->client->getResponse()->getContent(); // ✅ Force en string
        self::assertJsonStringEqualsJsonString('{"result":5}', $responseContent);
    }

    public function testDivisionByZeroApi(): void
    {
        $this->client->request('GET', '/api/calculator/divide?a=10&b=0');

        self::assertResponseStatusCodeSame(400);
        $responseContent = (string) $this->client->getResponse()->getContent(); // ✅ Force en string
        self::assertJsonStringEqualsJsonString('{"error":"Division by zero"}', $responseContent);
    }
}
