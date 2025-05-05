# Laravel Project Setup Guide

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Project Overview

Welcome to the **Flame and Crust Pizzaria** restaurant management system! 🚀

### Introduction
The **Flame and Crust Pizzaria** is a comprehensive **Restaurant Management System (RMS)** designed to streamline daily restaurant operations. This system helps manage inventory, orders, reservations, customer interactions, and employee roles efficiently. It ensures smooth coordination between the kitchen, front desk, and customers while enhancing the overall dining experience.

This guide will help you set up the project on your local machine **without running migrations** so you can start working quickly. Let's build something amazing together! 💪

---

## Getting Started

### 1. Install Prerequisites
Before cloning the project, ensure you have the following installed:
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download/)

After installing these, restart your terminal or command prompt to apply changes.

### 2. Clone the Repository

```bash
git clone your-repo-url.git
```

Replace `your-repo-url.git` with the actual repository URL.

Navigate into the project directory:

```bash
cd your-project-directory
```

### 3. Install Composer Dependencies

Run:

```bash
composer update
```

### 4. Install NPM Dependencies

Run:

```bash
npm update
```

### 5. Setup Environment File

Copy the example environment file and rename it to `.env`:

```bash
cp .env.example .env
```

### 6. Set Application Key

Use the following application key:

```bash
APP_KEY=your-app-key-here
```

Replace `your-app-key-here` with the actual key provided.

### 7. Start the Development Server

To run the Laravel application locally **without database migrations**, use:

```bash
php artisan serve
```

This will start the application at `http://127.0.0.1:8000`.

---

## Git Workflow Guide 🚀

### Pull the Latest Changes

Before making any changes, always pull the latest updates to stay in sync:

```bash
git pull origin main
```

### Create a New Branch

Before making changes, create a new branch:

```bash
git checkout -b feature-branch-name
```

Replace `feature-branch-name` with something relevant to your changes.

### Push Your Changes

After making updates, push your branch:

```bash
git add .
git commit -m "Your message here"
git push origin feature-branch-name
```

### Merge Your Changes

Once your changes are reviewed, switch to the main branch and merge:

```bash
git checkout main
git pull origin main
git merge feature-branch-name
```

Then push the updated main branch:

```bash
git push origin main
```

---

## Keep Going! 💪

Remember, every great project starts with a small step. If you face any challenges, ask for help—teamwork makes the dream work! 🚀 Let's build something awesome together! 🎉
