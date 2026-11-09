# JDD Hotels CRM

A Laravel CRM and project management system built for a hospitality business. It covers the path from lead to project to invoice and payment.

## Modules

- **Leads**: stages, sources and labels.
- **Projects**: stages, milestones, tasks, files, comments, checklists, timesheets and notes.
- **Bug tracking**: statuses, comments and file attachments.
- **Clients**: client accounts with their own permissions.
- **Products and stock**: product units and stock-in.
- **Finance**: invoices with line items and taxes, invoice payments, expenses and expense categories, and Stripe card payments. PDF invoices are generated with FPDF.
- **Admin**: users, roles and permissions (spatie/laravel-permission), plans, settings, calendar, activity log and multi-language UI.

## Stack

- PHP 7.1+, Laravel 5.8, MySQL
- spatie/laravel-permission, laravelcollective/html, Stripe PHP, FPDF
- Web installer (rachidlaasri/laravel-installer)

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
# set DB_* in .env
php artisan migrate --seed
php artisan serve
```
