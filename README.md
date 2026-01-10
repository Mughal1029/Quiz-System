# Quiz Management System

This is a web-based Quiz Management System developed using PHP Laravel and MySQL.
The system is designed with a clear separation between User Interface and Admin Interface.

## 📌 System Overview
This system is based on a hierarchical quiz structure:

- Categories
- Each category contains multiple quizzes
- Each quiz contains multiple MCQs
- Users can attempt quizzes
- Results are generated after quiz submission
- Users can download their certificate after completing a quiz

The system focuses on functionality and backend logic rather than heavy frontend design.

## 👤 User Interface Features
- User registration and login
- View available categories
- Browse quizzes under each category
- Attempt quizzes containing MCQs
- Automatic result generation
- Option to download certificate after result
- Simple and clean user flow

## 🛠 Admin Interface Features
- Secure admin login
- View list of all registered users (read-only)
  - Admin can only view users
  - Admin cannot edit or delete users
- Add and manage categories
- Add and manage quizzes under categories
- Add and manage MCQs under quizzes
- Full control over quiz structure and content

## 🧑‍💻 Technologies Used
- PHP (Laravel Framework)
- MySQL Database
- phpMyAdmin (Database Management)
- Blade Templates (Laravel Views)

Note:
CSS and JavaScript are kept minimal.
Styling is handled mainly using Laravel's default structure and basic layouts.

## 🗂 Database
- MySQL database is used extensively
- All system data (users, categories, quizzes, MCQs, results) is stored in the database
- Database is managed using phpMyAdmin

## 🚀 How to Run the Project
1. Clone the repository
2. Create a MySQL database
3. Import database or run migrations
4. Configure `.env` file
5. Run the project using local server
6. Login as Admin or User

## 🎯 Purpose of the Project
This project is developed for learning and practice purposes.
It helps in understanding:
- Laravel MVC structure
- Database relationships
- Authentication
- Admin and user role separation
- Real-world quiz system logic

## 📄 License
This project is open-source and available for educational and learning use.
