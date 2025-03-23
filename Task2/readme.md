# RESTful API with JWT Authentication

This project is a simple RESTful API built using PHP and MySQL, with JWT (JSON Web Token) authentication. It allows users to register, log in, and manage products. The API is designed to be secure, with password hashing and JWT token validation.

---

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

### **Signup**
- **URL**: `http://localhost/RESTful_API/signup.php`
- **Method**: `POST`
- **Headers**:
  - `Content-Type: application/json`
- **Body** (JSON):
  ```json
  {
      "name": "John Doe",
      "username": "johndoe",
      "password": "password123"
  }
  ```

### **Login**
- **URL**: `http://localhost/RESTful_API/login.php`
- **Method**: `POST`
- **Headers**:
  - `Content-Type: application/json`
- **Body** (JSON):
  ```json
  {
      "username": "johndoe",
      "password": "password123"
  }
  ```

### **Add Product**
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

---

## **Screenshots**

### **Signup Request in Postman**
![Signup Request in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/signupPostman.png)

### **Login Request in Postman**
![Login Request in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/login.png)

### **Add Product in Postman**
![Add Product in Postman](https://github.com/ahmedmohamedbekhit1/Information_Security_Mangment/blob/main/Task2/img/addproduct.png)

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
