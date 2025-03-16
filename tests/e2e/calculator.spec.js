import { test, expect } from '@playwright/test';

test.describe('Calculatrice TDD', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('http://localhost:8075/');
    });

    test('Titre de la page correct', async ({ page }) => {
        await expect(page.locator('h1')).toHaveText('Calculatrice TDD');
    });

    test('Addition fonctionne correctement', async ({ page }) => {
        await page.fill('#number1', '10');
        await page.fill('#number2', '5');
        await page.click('#add');

        await expect(page.locator('#result')).toHaveText('15');
    });

    test('Soustraction fonctionne correctement', async ({ page }) => {
        await page.fill('#number1', '20');
        await page.fill('#number2', '5');
        await page.click('#subtract');

        await expect(page.locator('#result')).toHaveText('15');
    });

    test('Multiplication fonctionne correctement', async ({ page }) => {
        await page.fill('#number1', '3');
        await page.fill('#number2', '5');
        await page.click('#multiply');

        await expect(page.locator('#result')).toHaveText('15');
    });

    test('Division fonctionne correctement', async ({ page }) => {
        await page.fill('#number1', '30');
        await page.fill('#number2', '2');
        await page.click('#divide');

        await expect(page.locator('#result')).toHaveText('15');
    });

    test('Gestion de la division par zéro', async ({ page }) => {
        await page.fill('#number1', '10');
        await page.fill('#number2', '0');
        await page.click('#divide');

        await expect(page.locator('#result')).toHaveText('Division by zero');
    });

    test('Historique affiche les calculs précédents', async ({ page }) => {
        await page.fill('#number1', '6');
        await page.fill('#number2', '2');
        await page.click('#multiply');

        const historyList = page.locator('#history-list li');

        await expect(historyList.first()).toContainText('6 × 2 = 12');
    });

    test('Effacement de l\'historique fonctionne correctement', async ({ page }) => {
        await page.click('#clear-history');

        const historyList = page.locator('#history-list');
        await expect(historyList).toBeEmpty();
    });
});
