# 📡 TeamBoard API Reference

This document provides a comprehensive reference for all routes and endpoints in the TeamBoard application.

---

## Base URL

```
Development: http://localhost:8000
Production:  https://your-domain.com
```

---

## Authentication

All routes except public routes require authentication via Laravel session.

### Authentication Endpoints

#### Login

**Display Login Form**
```
GET /login
```

**Authenticate User**
```
POST /login

Parameters:
- email (string, required): User email address
- password (string, required): User password
- remember (boolean, optional): Remember me checkbox

Response:
- Success: Redirect to /dashboard
- Error: Redirect back with validation errors
```

#### Logout

```
POST /logout

Headers:
- X-CSRF-TOKEN: Required

Response:
- Redirect to /login
```

---

## Dashboard

#### View Dashboard

```
GET /dashboard

Authentication: Required

Response:
- View with statistics and recent notices
```

---

## Employee Management

### List Employees

```
GET /employees

Authentication: Required

Query Parameters:
- search (string, optional): Search by name, email, or department
- department (string, optional): Filter by department
- page (integer, optional): Page number for pagination

Response:
- View with paginated employee list
```

### View Employee Profile

```
GET /employees/{id}

Authentication: Required

Parameters:
- id (integer): Employee ID

Response:
- View with employee details
- 404 if employee not found
```

### Create Employee Form

```
GET /employees/create

Authentication: Required
Authorization: Admin only

Response:
- View with employee creation form
- 403 if not authorized
```

### Store Employee

```
POST /employees

Authentication: Required
Authorization: Admin only

Headers:
- X-CSRF-TOKEN: Required
- Content-Type: multipart/form-data

Parameters:
- name (string, required, max:255)
- email (string, required, email, unique)
- department (string, required, max:255)
- phone (string, optional, max:255)
- photo (file, optional, image, max:2MB)
- bio (text, optional)

Response:
- Success: Redirect to /employees with success message
- Error: Redirect back with validation errors
```

### Edit Employee Form

```
GET /employees/{id}/edit

Authentication: Required
Authorization: Admin only

Parameters:
- id (integer): Employee ID

Response:
- View with employee edit form
- 403 if not authorized
- 404 if employee not found
```

### Update Employee

```
PUT /employees/{id}

Authentication: Required
Authorization: Admin only

Headers:
- X-CSRF-TOKEN: Required
- Content-Type: multipart/form-data

Parameters:
- name (string, required, max:255)
- email (string, required, email, unique except self)
- department (string, required, max:255)
- phone (string, optional, max:255)
- photo (file, optional, image, max:2MB)
- bio (text, optional)

Response:
- Success: Redirect to employee profile with success message
- Error: Redirect back with validation errors
```

### Delete Employee

```
DELETE /employees/{id}

Authentication: Required
Authorization: Admin only

Headers:
- X-CSRF-TOKEN: Required

Parameters:
- id (integer): Employee ID

Response:
- Success: Redirect to /employees with success message
- 403 if not authorized
```

---

## Notice Board

### List Notices

```
GET /notices

Authentication: Required

Query Parameters:
- search (string, optional): Search by title or content
- priority (string, optional): Filter by priority (low, medium, high)
- page (integer, optional): Page number for pagination

Response:
- View with paginated notice list
```

### View Notice

```
GET /notices/{id}

Authentication: Required

Parameters:
- id (integer): Notice ID

Response:
- View with notice details
- 404 if notice not found
```

### Create Notice Form

```
GET /notices/create

Authentication: Required

Response:
- View with notice creation form
```

### Store Notice

```
POST /notices

Authentication: Required

Headers:
- X-CSRF-TOKEN: Required

Parameters:
- title (string, required, max:255)
- content (text, required)
- priority (enum, required): low, medium, or high

Response:
- Success: Redirect to /notices with success message
- Error: Redirect back with validation errors
```

### Edit Notice Form

```
GET /notices/{id}/edit

Authentication: Required
Authorization: Owner or Admin

Parameters:
- id (integer): Notice ID

Response:
- View with notice edit form
- 403 if not authorized
- 404 if notice not found
```

### Update Notice

```
PUT /notices/{id}

Authentication: Required
Authorization: Owner or Admin

Headers:
- X-CSRF-TOKEN: Required

Parameters:
- title (string, required, max:255)
- content (text, required)
- priority (enum, required): low, medium, or high

Response:
- Success: Redirect to notice with success message
- Error: Redirect back with validation errors
```

### Delete Notice

```
DELETE /notices/{id}

Authentication: Required
Authorization: Owner or Admin

Headers:
- X-CSRF-TOKEN: Required

Parameters:
- id (integer): Notice ID

Response:
- Success: Redirect to /notices with success message
- 403 if not authorized
```

---

## Document Management

### List Documents

```
GET /documents

Authentication: Required

Query Parameters:
- search (string, optional): Search by title or filename
- page (integer, optional): Page number for pagination

Response:
- View with paginated document list
```

### Create Document Form

```
GET /documents/create

Authentication: Required

Response:
- View with document upload form
```

### Upload Document

```
POST /documents

Authentication: Required

Headers:
- X-CSRF-TOKEN: Required
- Content-Type: multipart/form-data

Parameters:
- title (string, required, max:255)
- file (file, required, max:10MB)

Response:
- Success: Redirect to /documents with success message
- Error: Redirect back with validation errors
```

### Download Document

```
GET /documents/{id}/download

Authentication: Required

Parameters:
- id (integer): Document ID

Response:
- File download
- 404 if document not found
```

### Delete Document

```
DELETE /documents/{id}

Authentication: Required
Authorization: Owner or Admin

Headers:
- X-CSRF-TOKEN: Required

Parameters:
- id (integer): Document ID

Response:
- Success: Redirect to /documents with success message
- 403 if not authorized
```

---

## Admin Panel

### Admin Dashboard

```
GET /admin

Authentication: Required
Authorization: Admin only

Response:
- View with admin panel
- 403 if not admin
```

---

## Error Responses

### 401 Unauthorized
```
Redirect to /login
```

### 403 Forbidden
```
{
    "message": "This action is unauthorized."
}
```

### 404 Not Found
```
{
    "message": "Resource not found."
}
```

### 422 Unprocessable Entity
```
{
    "message": "The given data was invalid.",
    "errors": {
        "field_name": [
            "Validation error message"
        ]
    }
}
```

### 500 Internal Server Error
```
{
    "message": "Server Error"
}
```

---

## Authorization Matrix

| Route | User | Admin |
|-------|------|-------|
| Dashboard | ✅ | ✅ |
| View Employees | ✅ | ✅ |
| Create Employee | ❌ | ✅ |
| Edit Employee | ❌ | ✅ |
| Delete Employee | ❌ | ✅ |
| View Notices | ✅ | ✅ |
| Create Notice | ✅ | ✅ |
| Edit Own Notice | ✅ | ✅ |
| Edit Any Notice | ❌ | ✅ |
| Delete Own Notice | ✅ | ✅ |
| Delete Any Notice | ❌ | ✅ |
| View Documents | ✅ | ✅ |
| Upload Document | ✅ | ✅ |
| Download Document | ✅ | ✅ |
| Delete Own Document | ✅ | ✅ |
| Delete Any Document | ❌ | ✅ |
| Admin Panel | ❌ | ✅ |

---

## Rate Limiting

Currently, no rate limiting is implemented. For production, consider adding:

```php
Route::middleware('throttle:60,1')->group(function () {
    // 60 requests per minute
});
```

---

## CORS Configuration

By default, CORS is disabled. To enable for API endpoints:

```php
// config/cors.php
'paths' => ['api/*'],
'allowed_origins' => ['*'],
```

---

## Security Headers

All responses include:
- `X-Frame-Options: SAMEORIGIN`
- `X-Content-Type-Options: nosniff`
- CSRF token validation

---

## File Upload Limits

- **Employee Photos**: 2MB max, image formats only
- **Documents**: 10MB max, all file types

Configure in php.ini:
```ini
upload_max_filesize = 10M
post_max_size = 10M
```

---

## Session Configuration

- **Driver**: Database
- **Lifetime**: 120 minutes
- **Path**: /
- **Cookie**: Laravel session cookie

---

## Testing Endpoints

### Using cURL

```bash
# Login
curl -X POST http://localhost:8000/login \
  -d "email=admin@teamboard.com" \
  -d "password=password" \
  -c cookies.txt

# Access protected route
curl http://localhost:8000/dashboard \
  -b cookies.txt
```

### Using Postman

1. Send POST to `/login` with credentials
2. Postman will automatically handle cookies
3. Access protected routes in same session

---

## Pagination

All list endpoints support pagination:

```
?page=1
```

Default: 10-15 items per page

---

## Search Syntax

### Employees
```
?search=john          # Search name, email, department
?department=Sales     # Filter by department
```

### Notices
```
?search=meeting       # Search title, content
?priority=high        # Filter by priority
```

### Documents
```
?search=report        # Search title, filename
```

---

## Response Formats

### Success Response
```php
redirect()->route('resource.index')
    ->with('success', 'Operation completed successfully');
```

### Error Response
```php
redirect()->back()
    ->withErrors(['field' => 'Error message'])
    ->withInput();
```

---

## Future API Considerations

For RESTful API implementation:

```php
// routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('employees', EmployeeApiController::class);
    Route::apiResource('notices', NoticeApiController::class);
    Route::apiResource('documents', DocumentApiController::class);
});
```

---

## Changelog

### Version 1.0.0 (Current)
- Initial release
- Basic CRUD operations
- Authentication system
- Authorization policies
- File management

---

## Support

For API questions or issues:
- GitHub Issues: https://github.com/yourusername/TeamBoard/issues
- Documentation: See README.md

---

**Last Updated**: December 2025
