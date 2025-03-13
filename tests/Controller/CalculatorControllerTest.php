<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testCalculatorIndexPageIsSuccessful(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('title', 'Calculatrice TDD');
        $this->assertSelectorExists('#number1');
        $this->assertSelectorExists('#number2');
        $this->assertSelectorExists('#add');
        $this->assertSelectorExists('#subtract');
        $this->assertSelectorExists('#multiply');
        $this->assertSelectorExists('#result');
    }
}
