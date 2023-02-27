# Planet.DEV REST API
Planet.DEV REST API is a Laravel-based API that allows users to create and manage articles, categories, tags, and comments. User roles are also implemented to limit functionalities based on access permissions.

#Technologies Used
- Laravel
- PHP
- MySQL
- API REST
- JSON
- Documentation API (POSTMAN, OPEN API or SWAGGER)
- Authentication with Laravel via (sanctum, jwt, or passport)
#Features
- Create, edit, delete, and view articles
- Create, edit, delete, and view categories
- Create, edit, delete, and view tags
- Create, edit, delete, and view comments
- Implement user roles to limit functionalities based on access permissions
#User Stories
- As a user, I can create an account using my email address and a secure password.
- As a user, I can log in to my existing account using my email address and password.
- As a user, I can reset my password using the email address associated with my account.
- As a user, I can update my account information such as my email address and password at any time.
- As an author, I can create a new article by entering a title, description, content, and associating categories and tags.
- As an author, I can edit or delete my existing articles.
- As a user, I can view the list of available articles, filter by category and/or tag, and view the details of a particular article.
- As a user, I can create or delete my comments for a particular article.
- As an administrator, I can edit or delete all articles, tags, and categories.
- As an administrator, I can delete comments.
- As an administrator, I can create, edit, and delete categories and tags.
- As an administrator, I can edit and delete user roles and assign access permissions to each role.
#Installation
To install and run this project, please follow these steps:

- Clone the repository
- Install dependencies by running composer install
- Create a new database
- Rename .env.example to .env and configure the database connection
- Run migrations by running php artisan migrate
- Start the server by running php artisan serve
#API Endpoints
This API has the following endpoints:

- /api/auth/register: Register a new user
- /api/auth/login: Login with existing user credentials
- /api/auth/logout: Logout a user
- /api/auth/reset-password: Reset user password
- /api/articles: Get all articles or create a new one
- /api/articles/{id}: Get, update or delete an article
- /api/categories: Get all categories or create a new one
- /api/categories/{id}: Get, update or delete a category
- /api/tags: Get all tags or create a new one
- /api/tags/{id}: Get, update or delete a tag
- /api/comments: Get all comments or create a new one
- /api/comments/{id}: Get, update or delete a comment
- /api/roles: Get all roles or create a new one
- /api/roles/{id}: Get, update or delete a role
For more details on how to use each endpoint, please refer to the API documentation.

#API Documentation
The API documentation is available in docs folder. It provides detailed information on how to use each endpoint and the expected responses.

#License
This project is licensed under the MIT License.
