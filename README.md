# Interactive Story Application - Setup Guide

## Prerequisites
- PHP 8.4
- Composer
- Node.js & NPM


## Installation

1. **Clone the repository**
```bash
git clone <repository-url>
cd laravel-vue
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install JavaScript dependencies**
```bash
npm install
npm run build
```

5. **Verify your .env file**
```env
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Run migrations and seeders**
```bash
php artisan migrate:fresh --seed
```

7. **Start the development servers**

In separate terminal windows:
```bash
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Vite development server
npm run dev
```

## Default Admin Account
```
Email: admin@stories.com
Password: admin12345
```
# API authentification
1. **Get an authentication token (ghetto)**
User your browser and navigate to localhost:8000/login with the admin account.
Copy the value of the "token" field in the returned JSON.

2. **Use the token in subsequent requests (example)**
```
curl -X POST http://localhost:8000/api/v1/stories \
-H "Authorization: Bearer your-token-here" \
-H "Content-Type: application/json" \
-H "Accept: application/json"
```
## Project Structure

```
laravel-vue/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── js/
│   │   └── components/
│   └── views/
└── routes/
    └── api.php
```

# API Documentation

## Base URL
```
http://localhost:8000/api/v1
```

## Authentication
All modification endpoints require authentication using a Bearer token:
```
Authorization: Bearer <your-token>
```

## Endpoints

### Stories

#### Get All Stories
```
GET /stories
```

#### Get Single Story
```
GET /stories/{id}
```

#### Get Story Chapters
```
GET /stories/{id}/chapters
```

#### Create Story (Admin only)
```
POST /stories
Body:
{
    "title": "string",
    "summary": "string",
    "author": "string"
}
```

#### Update Story (Admin only)
```
PUT /stories/{id}
Body:
{
    "title": "string",
    "summary": "string",
    "author": "string"
}
```

#### Delete Story (Admin only)
```
DELETE /stories/{id}
```

### Chapters

#### Get All Chapters
```
GET /chapters
```

#### Get Single Chapter
```
GET /chapters/{id}
```

#### Get Chapter Choices
```
GET /chapters/{id}/choices
```

#### Create Chapter (Admin only)
```
POST /chapters
Body:
{
    "content": "string",
    "number": "integer",
    "storyId": "integer"
}
```

#### Update Chapter (Admin only)
```
PUT /chapters/{id}
Body:
{
    "content": "string",
    "number": "integer",
    "storyId": "integer"
}
```

#### Delete Chapter (Admin only)
```
DELETE /chapters/{id}
```

### Choices

#### Get All Choices
```
GET /choices
```

#### Get Single Choice
```
GET /choices/{id}
```

#### Create Choice (Admin only)
```
POST /choices
Body:
{
    "text": "string",
    "nextChapterId": "integer",
    "chapterId": "integer"
}
```

#### Update Choice (Admin only)
```
PUT /choices/{id}
Body:
{
    "text": "string",
    "nextChapterId": "integer",
    "chapterId": "integer"
}
```

#### Delete Choice (Admin only)
```
DELETE /choices/{id}
```

## Response Formats

### Success Response
```json
{
    "status": "success",
    "data": {...},
    "message": "Optional success message"
}
```

### Error Response
```json
{
    "status": "error",
    "message": "Error description"
}
```

## Status Codes
- 200: Success
- 201: Created
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 422: Validation Error
- 500: Server Error
