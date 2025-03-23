# RESTful API with JWT Authentication

This project is a simple RESTful API built using PHP and MySQL, with JWT (JSON Web Token) authentication. It allows users to register, log in, and manage products. The API is designed to be secure, with password hashing and JWT token validation.

---
`jwt_middleware.php`  | Protects routes by validating JWT tokens.    
`jwt_auth.php`        | Manages JWT token generation and validation.   

### **Signup Request in Postman**
![Signup Request in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/signupPostman.png)

### **Login Request in Postman**
![Login Request in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/login.png)

### **Add Product in Postman**
![Add Product in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/addproduct.png)

### **Get All Product in Postman**
![GEt ALL Product in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/getProducts.png)

### **Get Single Product in Postman**
![Get Single Product in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/getSingleProduct.png)

### **Delete Product in Postman**
![Delete Product in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/deleteProduct.png)

### **Update Product in Postman**
![Update Product in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/updateProduct.png)

## **Features**

- **User Registration**: Users can register by providing a `name`, `username`, and `password`.
- **User Login**: Users can log in using their `username` and `password` to receive a JWT token.
- **Product Management**: Authenticated users can add, retrieve, update, and delete products.
- **JWT Authentication**: Protects certain routes by requiring a valid JWT token.

---

## **Database Schema**

The database consists of two tables:

### **Users Table**
- `id` (Primary Key, Auto-increment)
- `name` (String, Required)
- `username` (String, Unique, Required)
- `password` (Hashed, Required)

### **Products Table**
- `pid` (Primary Key, Auto-increment)
- `pname` (String, Required)
- `description` (Text)
- `price` (Decimal, Required)
- `stock` (Integer, Required)
- `created_at` (Timestamp)

---

## **API Endpoints**

### **Authentication**
1. **POST /signup**: Register a new user.
2. **POST /login**: Authenticate user and return JWT token.

### **User Operations**
3. **PUT /users/{id}**: Update user details (requires valid JWT token).

### **Product Operations (Require JWT Token)**
4. **POST /products**: Add a new product.
5. **GET /products**: Retrieve all products.
6. **GET /products/{pid}**: Retrieve a single product by ID.
7. **PUT /products/{pid}**: Update product details.
8. **DELETE /products/{pid}**: Delete a product.

---

## **Setup Instructions**

1. **Install XAMPP**:
   - Download and install XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).
   - Start the Apache and MySQL services.

2. **Create the Database**:
   - Open phpMyAdmin and create a new database named `restful_api`.
   - Run the following SQL queries to create the `Users` and `Products` tables:

```sql
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE Products (
    pid INT AUTO_INCREMENT PRIMARY KEY,
    pname VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

3. **Download the Project**:
   - Clone or download the project repository to your `htdocs` directory in XAMPP.

4. **Configure the Environment**:
   - Set the `JWT_SECRET_KEY` environment variable in your server configuration or `.env` file:
     ```
     JWT_SECRET_KEY=your_secure_secret_key
     ```

5. **Run the API**:
   - Access the API endpoints using Postman or any API testing tool.

---

## **Testing the API**

Below are the **test cases** for each endpoint:

---

### **1. Signup**

#### **Endpoint**: `POST /signup`

#### **Test Case 1: Successful Signup**
- **Request**:
  - **URL**: `http://localhost/RESTful_API/signup.php`
  - **Method**: `POST`
  - **Headers**:
    - `Content-Type: application/json`
  - **Body** (JSON):
    ```json
    {
        "name": "ahmed",
        "username": "ahmedbekhit",
        "password": "password123"
    }
    ```
- **Expected Response**:
  - **Status Code**: `201 Created`
  - **Response Body**:
    ```json
    {
        "message": "User registered successfully"
    }
    ```

#### **Test Case 2: Missing Required Fields**
- **Request**:
  - **Body** (JSON):
    ```json
    {
        "name": "ahmed",
        "username": "ahmedbekhit"
    }
    ```
- **Expected Response**:
  - **Status Code**: `400 Bad Request`
  - **Response Body**:
    ```json
    {
        "message": "Missing required fields"
    }
    ```

#### **Test Case 3: Duplicate Username**
- **Request**:
  - **Body** (JSON):
    ```json
    {
        "name": "ahmed",
        "username": "ahmedbekhit",
        "password": "password123"
    }
    ```
- **Expected Response**:
  - **Status Code**: `400 Bad Request`
  - **Response Body**:
    ```json
    {
        "message": "Username already exists"
    }
    ```

---

### **2. Login**

#### **Endpoint**: `POST /login`

#### **Test Case 1: Successful Login**
- **Request**:
  - **URL**: `http://localhost/RESTful_API/login.php`
  - **Method**: `POST`
  - **Headers**:
    - `Content-Type: application/json`
  - **Body** (JSON):
    ```json
    {
        "username": "ahmedbekhit",
        "password": "password123"
    }
    ```
- **Expected Response**:
  - **Status Code**: `200 OK`
  - **Response Body**:
    ```json
    {
        "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
    }
    ```

#### **Test Case 2: Invalid Credentials**
- **Request**:
  - **Body** (JSON):
    ```json
    {
        "username": "ahmedbekhit",
        "password": "wrongpassword"
    }
    ```
- **Expected Response**:
  - **Status Code**: `401 Unauthorized`
  - **Response Body**:
    ```json
    {
        "message": "Invalid credentials"
    }
    ```

---

### **3. Add Product**

#### **Endpoint**: `POST /products`

#### **Test Case 1: Successful Product Addition**
- **Request**:
  - **URL**: `http://localhost/RESTful_API/add_product.php`
  - **Method**: `POST`
  - **Headers**:
    - `Content-Type: application/json`
    - `Authorization: Bearer <JWT_TOKEN>`
  - **Body** (JSON):
    ```json
    {
        "pname": "Laptop",
        "description": "A high-performance laptop",
        "price": 1200.00,
        "stock": 10
    }
    ```
- **Expected Response**:
  - **Status Code**: `201 Created`
  - **Response Body**:
    ```json
    {
        "message": "Product added successfully"
    }
    ```

#### **Test Case 2: Missing Required Fields**
- **Request**:
  - **Body** (JSON):
    ```json
    {
        "pname": "Laptop",
        "price": 1200.00
    }
    ```
- **Expected Response**:
  - **Status Code**: `400 Bad Request`
  - **Response Body**:
    ```json
    {
        "message": "Missing required fields"
    }
    ```

---

### **4. Retrieve All Products**

#### **Endpoint**: `GET /products`

#### **Test Case 1: Successful Retrieval**
- **Request**:
  - **URL**: `http://localhost/RESTful_API/get_products.php`
  - **Method**: `GET`
  - **Headers**:
    - `Authorization: Bearer <JWT_TOKEN>`
- **Expected Response**:
  - **Status Code**: `200 OK`
  - **Response Body**:
    ```json
    [
        {
            "pid": 1,
            "pname": "Laptop",
            "description": "A high-performance laptop",
            "price": 1200.00,
            "stock": 10,
            "created_at": "2023-10-01 12:34:56"
        }
    ]
    ```

---

### **5. Retrieve a Single Product**

#### **Endpoint**: `GET /products/{pid}`

#### **Test Case 1: Successful Retrieval**
- **Request**:
  - **URL**: `http://localhost/RESTful_API/get_product.php?pid=1`
  - **Method**: `GET`
  - **Headers**:
    - `Authorization: Bearer <JWT_TOKEN>`
- **Expected Response**:
  - **Status Code**: `200 OK`
  - **Response Body**:
    ```json
    {
        "pid": 1,
        "pname": "Laptop",
        "description": "A high-performance laptop",
        "price": 1200.00,
        "stock": 10,
        "created_at": "2023-10-01 12:34:56"
    }
    ```

#### **Test Case 2: Product Not Found**
- **Request**:
  - **URL**: `http://localhost/RESTful_API/get_product.php?pid=999`
- **Expected Response**:
  - **Status Code**: `404 Not Found`
  - **Response Body**:
    ```json
    {
        "message": "Product not found"
    }
    ```

---

### **6. Update Product**

#### **Endpoint**: `PUT /products/{pid}`

#### **Test Case 1: Successful Update**
- **Request**:
  - **URL**: `http://localhost/RESTful_API/update_product.php?pid=1`
  - **Method**: `PUT`
  - **Headers**:
    - `Content-Type: application/json`
    - `Authorization: Bearer <JWT_TOKEN>`
  - **Body** (JSON):
    ```json
    {
        "pname": "Updated Laptop",
        "description": "An updated high-performance laptop",
        "price": 1300.00,
        "stock": 5
    }
    ```
- **Expected Response**:
  - **Status Code**: `200 OK`
  - **Response Body**:
    ```json
    {
        "message": "Product updated successfully"
    }
    ```

---

### **7. Delete Product**

#### **Endpoint**: `DELETE /products/{pid}`

#### **Test Case 1: Successful Deletion**
- **Request**:
  - **URL**: `http://localhost/RESTful_API/delete_product.php?pid=1`
  - **Method**: `DELETE`
  - **Headers**:
    - `Authorization: Bearer <JWT_TOKEN>`
- **Expected Response**:
  - **Status Code**: `200 OK`
  - **Response Body**:
    ```json
    {
        "message": "Product deleted successfully"
    }
    ```

---

## **Screenshots**

### **Database After Signup**
![Database After Signup](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/signupDatabase.png)

### **Database After Adding a Product**
![Database After Adding a Product](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/addproductDatabase.png)

---

## **Security & Best Practices**

- **Password Hashing**: Passwords are hashed using `password_hash()` before being stored in the database.
- **JWT Authentication**: JWT tokens are used for authentication and are valid for 10 minutes.
- **Environment Variables**: Sensitive information like the JWT secret key is stored in environment variables for security.
- **Input Validation**: All user inputs are validated to prevent SQL injection and other attacks.

---

## **Evaluation Criteria**

- **Correct Database Schema**: The database schema is correctly designed and implemented using MySQL.
- **JWT Authentication**: Proper implementation of JWT-based authentication.
- **API Functionality**: All CRUD operations for users and products are functional.
- **Security**: Passwords are hashed, and JWT tokens are validated.
- **Code Quality**: The code is readable, well-documented, and follows best practices.
