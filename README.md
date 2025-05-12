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
