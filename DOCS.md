# Equipment API Documentation

## Overview

REST API for managing users and equipment assignments. Built with Laravel 11 + Sanctum. Only **admin** users can authenticate and access the API.

---

## Authentication

### Login
`POST /api/auth/login`

**Request**
```json
{
  "email": "alice@example.com",
  "password": "password"
}
```

**Response** `200 OK`
```json
{
  "token": "1|abc123..."
}
```

**Errors**
- `422` — wrong credentials or non-admin user

**Token lifetime:** Never expires (`sanctum.expiration = null`).

Use the token as a Bearer header on all subsequent requests:
```
Authorization: Bearer <token>
```

---

## Endpoints

> All endpoints below require `Authorization: Bearer <token>`.

---

### Users List
`GET /api/users`

Returns all users, each with their assigned equipment (can be multiple).

**Response** `200 OK`
```json
[
  {
    "id": 1,
    "name": "Alice Smith",
    "email": "alice@example.com",
    "role": "admin",
    "equipments": [
      { "id": 1, "name": "Laptop Dell XPS", "user_id": 1 },
      { "id": 2, "name": "iPhone 15",        "user_id": 1 }
    ]
  },
  {
    "id": 3,
    "name": "Charlie Brown",
    "email": "charlie@example.com",
    "role": "user",
    "equipments": []
  }
]
```

---

### Equipment List
`GET /api/equipments`

Returns all equipment, each with the single assigned user (or `null` if unassigned).

**Response** `200 OK`
```json
[
  {
    "id": 1,
    "name": "Laptop Dell XPS",
    "user_id": 1,
    "user": {
      "id": 1,
      "name": "Alice Smith",
      "email": "alice@example.com"
    }
  },
  {
    "id": 6,
    "name": "Webcam Logitech",
    "user_id": null,
    "user": null
  }
]
```

---

## Database Schema

### users
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| name | varchar | |
| email | varchar | unique |
| password | varchar | bcrypt hashed |
| role | enum | `admin` or `user` |
| timestamps | | |

### equipments
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| name | varchar | |
| user_id | bigint | FK → users, nullable |
| timestamps | | |

---

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

Default admin credentials (from seeder):
- Email: `alice@example.com`
- Password: `password`
