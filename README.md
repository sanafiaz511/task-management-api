# 🚀 Task Management API (Laravel 11)

A production-style backend REST API built with Laravel 11 demonstrating advanced backend engineering concepts including authentication, authorization, caching, queues, real-time events, and CI/CD automation.

---

## 🧱 Tech Stack

- Laravel 11 (PHP 8.3+)
- PostgreSQL
- Redis
- Laravel Horizon
- Docker & Docker Compose
- JWT Authentication (php-open-source-saver/jwt-auth)
- Pusher (Real-time broadcasting)
- GitHub Actions (CI pipeline)
- PHPUnit / Pest (testing)
- L5-Swagger (API documentation)

---

## 🎯 Project Overview

This project simulates a real-world task management system similar to tools like Trello or Jira.

It supports:
- User authentication (JWT)
- Role-based access control (Admin / Member)
- Project & task management
- Task comments system
- Background job processing
- Real-time task updates
- API caching for performance
- CI/CD automation

---

## 🏗️ Features Implemented

### 🔐 Authentication
- Register / Login / Logout / Refresh token
- JWT-based stateless authentication
- Protected API routes

---

### 👥 Authorization (RBAC)
- Roles: `admin`, `member`
- Laravel Policies implemented
- Access control on:
  - Projects
  - Tasks
  - Comments

---

### 📁 Projects Module
- Create / Read / Update / Delete projects
- User-owned projects
- Policy-based security
- Redis caching implemented

---

### ✅ Tasks Module
- Tasks belong to projects
- Status: `todo`, `in_progress`, `done`
- Priority: `low`, `medium`, `high`
- Due date support
- Ownership-based access control
- Cached listing per project

---

### 💬 Comments Module
- Comments linked to tasks
- User attribution for each comment
- Secure deletion rules
- Nested relationship structure

---

### ⚡ Background Jobs
- Redis queue system
- Laravel Horizon monitoring
- Task creation email job
- Job batching demonstration

---

### 🧠 Caching System (Redis)
- Cached project lists per user
- Cached tasks per project
- Smart cache invalidation strategy on update/delete

---

### 🌐 Real-Time Events
- Pusher broadcasting integration
- TaskCreated event
- Real-time event streaming via channel `tasks`

---

### 🧪 Testing
- PHPUnit / Pest setup
- Feature tests for:
  - Authentication
  - Projects (partial coverage)
- CI pipeline runs automated tests

---

### ⚙️ CI/CD (GitHub Actions)
- Automated testing pipeline
- PostgreSQL + Redis services in CI
- Migration + test execution on push

---

### 📄 API Documentation
- L5-Swagger integrated
- Auto-generated API documentation available at:

# 🚀 Setup Instructions (Local + Docker)

This section explains how to run the project in both **Local Environment** and **Docker Environment**.

---

# 🖥️ Local Setup (Without Docker)

## 📌 Requirements

Make sure you have installed:

- PHP 8.3+
- Composer
- PostgreSQL 15+
- Redis
- Git

---

## 1️⃣ Clone Repository

git clone https://github.com/your-username/task-management-api.git
cd task-management-api

---

## 2️⃣ Install Dependencies

composer install

---

## 3️⃣ Environment Setup

cp .env.example .env

Update `.env`:

APP_NAME="Task Management API"
APP_ENV=local
APP_KEY=

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=task_api
DB_USERNAME=postgres
DB_PASSWORD=secret

REDIS_HOST=127.0.0.1
REDIS_PORT=6379

QUEUE_CONNECTION=redis
BROADCAST_CONNECTION=pusher

---

## 4️⃣ Generate App Key

php artisan key:generate

---

## 5️⃣ Run Migrations

php artisan migrate

---

## 6️⃣ Start Server

php artisan serve

API will be available at:
http://127.0.0.1:8000

---

## 7️⃣ Start Queue Worker

php artisan queue:work

---

## 8️⃣ Start Horizon (Optional)

php artisan horizon

Horizon Dashboard:
http://127.0.0.1:8000/horizon

---

## 9️⃣ Swagger API Docs

http://127.0.0.1:8000/api/documentation

---

# 🐳 Docker Setup (Recommended)

This is the production-style setup for recruiters.

---

## 1️⃣ Build Containers

docker compose up -d --build

---

## 2️⃣ Enter App Container

docker exec -it task_api_app bash

---

## 3️⃣ Install Dependencies

composer install

---

## 4️⃣ Environment Setup

cp .env.example .env

Update `.env`:

APP_ENV=local

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=task_api
DB_USERNAME=postgres
DB_PASSWORD=secret

REDIS_HOST=redis
REDIS_PORT=6379

QUEUE_CONNECTION=redis
BROADCAST_CONNECTION=pusher

---

## 5️⃣ Generate App Key

php artisan key:generate

---

## 6️⃣ Run Migrations

php artisan migrate

---

## 7️⃣ Start Queue Worker

php artisan queue:work

---

## 8️⃣ Access Services

API: http://localhost:8000  
Swagger: http://localhost:8000/api/documentation  
Horizon: http://localhost:8000/horizon  

---

# 🧠 Important Notes

- Redis must be running
- Queue worker must always be active
- Horizon monitors jobs
- Migrate database after setup
- Pusher required for real-time features
