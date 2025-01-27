# API Documentation - Library Management System

**Introduction**

This is an API for managing a library system. The API includes functionality for managing books, genres, publishers, users, and borrowing transactions. The following are the features available in the system based on the controllers implemented.

**Features**

**1. AdminController**

The AdminController manages operations related to genres, publishers, users, and books. The following features are available:

* **1.1 Get All Genres**
    * Endpoint: `/api/admin/genre`
    * Method: `GET`
    * Description: Retrieves all genres stored in the system.
    * Caching: Cached for 7 days.
    * Response: A list of all genres.

* **1.2 Create New Genre**
    * Endpoint: `/api/admin/genre`
    * Method: `POST`
    * Description: Creates a new genre.
    * Request Body:
        ```json
        {
          "name": "string"
        }
        ```
    * Response: Success or error message.

* **1.3 Update Genre**
    * Endpoint: `/api/admin/genre`
    * Method: `PUT`
    * Description: Updates an existing genre.
    * Request Body:
        ```json
        {
          "id": "numeric",
          "name": "string"
        }
        ```
    * Response: Success or error message.

* **1.4 Delete Genre**
    * Endpoint: `/api/admin/genre`
    * Method: `DELETE`
    * Description: Deletes an existing genre.
    * Request Body:
        ```json
        {
          "id": "numeric"
        }
        ```
    * Response: Success or error message.

* **1.5 Get All Publishers**
    * Endpoint: `/api/admin/publisher`
    * Method: `GET`
    * Description: Retrieves all publishers stored in the system.
    * Caching: Cached for 7 days.
    * Response: A list of all publishers.

* **1.6 Create New Publisher**
    * Endpoint: `/api/admin/publisher`
    * Method: `POST`
    * Description: Creates a new publisher.
    * Request Body:
        ```json
        {
          "name": "string"
        }
        ```
    * Response: Success or error message.

* **1.7 Update Publisher**
    * Endpoint: `/api/admin/publisher`
    * Method: `PUT`
    * Description: Updates an existing publisher.
    * Request Body:
        ```json
        {
          "id": "numeric",
          "name": "string"
        }
        ```
    * Response: Success or error message.

* **1.8 Delete Publisher**
    * Endpoint: `/api/admin/publisher`
    * Method: `DELETE`
    * Description: Deletes an existing publisher.
    * Request Body:
        ```json
        {
          "id": "numeric"
        }
        ```
    * Response: Success or error message.

* **1.9 List Users**
    * Endpoint: `/api/admin/user`
    * Method: `GET`
    * Description: Retrieves all users stored in the system.
    * Caching: Cached for 7 days.
    * Response: A list of all users.

* **1.10 Update User**
    * Endpoint: `/api/admin/user`
    * Method: `PUT`
    * Description: Updates an existing user.
    * Request Body:
        ```json
        {
          "id": "numeric",
          "email": "string",
          "password": "string"
        }
        ```
    * Response: Success or error message.

* **1.11 Delete User**
    * Endpoint: `/api/admin/user`
    * Method: `DELETE`
    * Description: Deletes an existing user.
    * Request Body:
        ```json
        {
          "id": "numeric"
        }
        ```
    * Response: Success or error message.

* **1.12 Ban User**
    * Endpoint: `/api/admin/user/ban`
    * Method: `POST`
    * Description: Bans an existing user.
    * Request Body:
        ```json
        {
          "id": "numeric"
        }
        ```
    * Response: Success or error message.

* **1.13 Update Book**
    * Endpoint: `/api/admin/book`
    * Method: `PUT`
    * Description: Updates the details of an existing book.
    * Request Body:
        ```json
        {
          "id": "numeric",
          "image": "file (jpeg/jpg/png)",
          "title": "string",
          "description": "string",
          "author": "string",
          "isbn": "string",
          "stock": "numeric",
          "publisher_id": "numeric",
          "genre_id": "array"
        }
        ```
    * Response: Success or error message.

* **1.14 Get Borrowing Transactions (Peminjaman)**
    * Endpoint: `/api/admin/peminjaman`
    * Method: `GET`
    * Description: Retrieves a list of borrowing transactions.
    * Response: A list of borrowing transactions with associated student profiles and book details.

**2. AuthController**

The AuthController manages user authentication-related features, specifically user registration.

* **2.1 User Registration**
    * Endpoint: `/api/auth/register`
    * Method: `POST`
    * Description: Registers a new user.
    * Request Body:
        ```json
        {
          "email": "string",
          "password": "string"
        }
        ```
    * Response: Success or error message.

* **2.2 User Login**
    * Endpoint: `/api/auth/login`
    * Method: `POST`
    * Description: Registers a new user.
    * Request Body:
        ```json
        {
          "email": "string",
          "password": "string"
        }
        ```
    * Response: Success or error message.