# 🧮 Calculatrice TDD

## 🚀 Objectifs du projet

Ce projet vise à valider plusieurs compétences clés :

✅ **Tester de façon unitaire** la logique métier avec **PHPUnit**  
✅ **Tester une interface utilisateur** avec des tests **E2E** via **Playwright**  
✅ **Suivre la méthodologie de développement** **TDD (Test Driven Development)**  
✅ **Assurer la qualité du code** via **linter et refactoring**

## 📖 Description du projet

L'objectif est de concevoir une **calculatrice interactive** permettant de réaliser les opérations suivantes :

- **Addition**
- **Soustraction**
- **Multiplication**
- **Division**
- **Gestion d’un historique des calculs** (affichage et suppression)

L'application est développée en **Symfony** avec une interface web dynamique et des tests **unitaires et E2E** pour garantir sa robustesse.

---

## 🏗️ Technologies utilisées

| Technologie                 | Description |
|-----------------------------|------------|
| **PHP 8.2+**                | Langage backend |
| **Symfony 7+**              | Framework PHP utilisé |
| **PHPUnit**                 | Tests unitaires |
| **Playwright**              | Tests end-to-end (E2E) |
| **Docker & Docker Compose** | Environnement de développement |
| **PHPStan**                 | Analyse statique du code |
| **PHP CS Fixer**            | Linter pour le code PHP |

---

## 📦 Installation et exécution

### 1️⃣ Prérequis

- **Docker & Docker Compose** installés sur votre machine
- **Make** installé
- **Node.js et npm** (pour Playwright)

### 2️⃣ Installation du projet

1. **Cloner le projet** :
   ```bash
   git clone https://github.com/Haykes/Calculator-test
   cd Calculatrice-test
   ```

2. **Construire et démarrer les containers Docker** :
   ```bash
   docker compose build
   docker compose up -d
   ```

3. **Installer les dépendances Composer** :
   ```bash
   make install
   ```

4. **Générer les fichiers nécessaires** :
   ```bash
   make cc
   ```

---

## 🛠️ Utilisation

### 🌍 Accéder à l'application

L'interface est disponible à l’adresse suivante :  
📌 **http://localhost:8075**

### 📂 Consulter le rapport de couverture des tests

Une fois les tests exécutés, vous pouvez consulter le rapport de couverture de code :  
📌 **file://C:/Users/Administrator/PhpstormProjects/Calculatrice-test/Calculatrice-test/build/coverage/dashboard.html**

### 🖥️ API Endpoints

| Méthode | Endpoint | Description |
|---------|---------|------------|
| `GET` | `/api/calculator/add?a=2&b=3` | Addition (2+3) |
| `GET` | `/api/calculator/subtract?a=10&b=4` | Soustraction (10-4) |
| `GET` | `/api/calculator/multiply?a=3&b=5` | Multiplication (3×5) |
| `GET` | `/api/calculator/divide?a=10&b=2` | Division (10÷2) |
| `GET` | `/api/calculator/history` | Récupérer l’historique |
| `POST` | `/api/calculator/clear-history` | Effacer l’historique |

---

## 🧪 Tests et qualité du code

### 🔍 Exécuter les tests unitaires (PHPUnit)

```bash
make phpunit
```

### 🔍 Exécuter les tests E2E (Playwright)

```bash
npx playwright test --ui
```

### 🔍 Vérifier la qualité du code (PHPStan & PHP CS Fixer)

```bash
make qa
```

### 📊 Générer le rapport de couverture de code

```bash
make coverage
```

Puis ouvrez :  
📌 **file://C:/Users/Administrator/PhpstormProjects/Calculatrice-test/Calculatrice-test/build/coverage/dashboard.html**

---

## 🏗️ Développement en TDD

Le projet a été conçu en **Test Driven Development (TDD)** :

1. **Écriture des tests** en premier
2. **Développement du code** jusqu'à passage des tests
3. **Refactoring & amélioration** continue du code

---

## 📜 Licence

Projet réalisé dans le cadre d’un exercice pédagogique.  
Tous droits réservés. 🚀

---
