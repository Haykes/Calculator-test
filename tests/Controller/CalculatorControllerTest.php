<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testIndexPage(): void
    {
        $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Calculatrice TDD');
    }

    public function testAdditionViaApi(): void
    {
        $this->client->request('GET', '/api/calculator/add?a=2&b=3');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString('{"result":5}', $this->client->getResponse()->getContent());
    }

    public function testSubtractionApi(): void
    {
        $this->client->request('GET', '/api/calculator/subtract?a=10&b=4');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString('{"result":6}', $this->client->getResponse()->getContent());
    }

    public function testMultiplicationApi(): void
    {
        $this->client->request('GET', '/api/calculator/multiply?a=3&b=5');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString('{"result":15}', $this->client->getResponse()->getContent());
    }

    public function testDivisionApi(): void
    {
        $this->client->request('GET', '/api/calculator/divide?a=10&b=2');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString('{"result":5}', $this->client->getResponse()->getContent());
    }

    public function testDivisionByZeroApi(): void
    {
        $this->client->request('GET', '/api/calculator/divide?a=10&b=0');

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonStringEqualsJsonString(
            '{"error":"Division by zero"}',
            $this->client->getResponse()->getContent()
        );
    }
}
