const { test, expect } = require('@playwright/test');

test('Je peux effectuer une addition simple (2 + 3 = 5)', async ({ page }) => {
    // Ouvrir la calculatrice
    await page.goto('http://localhost:8080'); // adapte ce port selon ton Docker

    // Remplir les champs
    await page.fill('#number1', '2');
    await page.fill('#number2', '3');

    // Cliquer sur addition
    await page.click('#add');

    // Vérifier le résultat
    await expect(page.locator('#result')).toHaveText('5');
});

test('addition 1+2=3', async ({ page }) => {
    await page.goto('http://localhost:8080');
    await page.fill('#number1', '1');
    await page.fill('#number2', '2');
    await page.click('#add');
    await expect(page.locator('#result')).toHaveText('3');
});

test('multiplication 3*5=15', async ({ page }) => {
    await page.goto('http://localhost:8080');
    await page.fill('#number1', '3');
    await page.fill('#number2', '5');
    await page.click('#multiply');
    await expect(page.locator('#result')).toHaveText('15');
});
