# Arena Management System

Arena is a Laravel-based web application designed to manage gaming lounge operations, including play sessions, income tracking, expenses, debts, and monthly dashboard statistics.

The system helps an arena or gaming center record daily sessions, calculate costs, track financial activity, and view business performance from one dashboard.

## Features

- Admin dashboard for monthly overview
- Game session management
- Expense tracking
- Debt tracking with paid/unpaid status
- Income and net profit calculation
- Session cost, promo, and bar cost tracking
- Authentication system
- Laravel Blade-based interface
- Vite frontend build setup

## Main Modules

### Dashboard

Displays monthly business statistics such as:

- Monthly income
- Monthly expenses
- Monthly debts
- Net income
- Total cost grouped by game type

### Sessions

Used to manage gaming sessions, including:

- Game type
- Device number
- Minutes played
- Room cost
- Bar items and bar cost
- Total cost
- Promo percentage
- Final cost after promo
- Notes and date

### Expenses

Used to record and manage expenses, including:

- Expense name
- Amount
- Category
- Notes
- Date

### Debts

Used to track debts, including:

- Debtor name
- Amount
- Reason
- Paid status
- Paid date

### Income

Provides income reports based on selected date ranges and combines session income, expenses, and debts to calculate net income.

## Technologies Used

- PHP
- Laravel 10
- Laravel Sanctum
- JWT Authentication
- Blade Templates
- MySQL
- Bootstrap
- Vue
- Vite
- Sass
- Axios

## Project Structure

```text
arena/
├── app/
│   ├── Http/Controllers/
│   └── Models/
├── bootstrap/
├── config/
├── database/
│   └── migrations/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   ├── web.php
│   └── api.php
├── storage/
├── tests/
├── artisan
├── composer.json
├── package.json
└── README.md
