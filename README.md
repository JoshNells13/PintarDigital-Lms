# 🎓 PintarDigital — Modern Learning Management System

PintarDigital is a professional, role-based learning management system (LMS) designed for a focused and high-performance educational experience.

## 🚀 Key Features

-   **Role-Based Access Control (RBAC)**: Distinct dashboards and permissions for **Admins**, **Instructors**, and **Students**.
-   **Advanced Quiz Engine**: Fully functional quiz builder with multiple-choice questions, automated scoring, and instant progress updates.
-   **Student Progress Tracking**: Dynamic progress bars and lesson completion tracking calculated in real-time.
-   **Course Moderation**: Admin-level workflow for approving or rejecting instructor-submitted courses.
-   **Global Settings & Notifications**: Secure profile management and a real-time notification system for enrollments and course status updates.

## 📸 Screenshots

<p align="center">
  <strong>Landing Page</strong><br>
  <img src="documentation/landingpage.png" width="900" alt="Landing Page">
</p>

<p align="center">
  <strong>Instructor Dashboard</strong><br>
  <img src="documentation/dashboardinstructor.png" width="900" alt="Instructor Dashboard">
</p>

<p align="center">
  <strong>Student Dashboard</strong><br>
  <img src="documentation/dashboardstudent.png" width="900" alt="Student Dashboard">
</p>

<p align="center">
  <strong>Course Details & Learning Player</strong><br>
  <img src="documentation/coursedetail.png" width="900" alt="Course Detail">
</p>

## 🏗️ Technical Architecture

This application follows a professional **Service and Repository Pattern** to ensure a clean separation of concerns:

-   **Repositories**: Centralized data access logic, decoupling the database from the business rules.
-   **Services**: Encapsulated business logic (scoring, enrollment, progress calculation) for high maintainability and testability.
-   **Thin Controllers**: Controllers are focused only on handling HTTP requests and returning responses.

## 🛠️ Technology Stack

-   **Backend**: Laravel 12
-   **Database**: MySQL
-   **Frontend**: Tailwind CSS (M3/Material Design Inspired Aesthetics), Blade Templates
-   **Icons**: Google Material Symbols

## ⚙️ Installation & Setup

1.  **Clone the repository and install dependencies**:
    ```bash
    composer install
    npm install
    ```
2.  **Environment Setup**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
3.  **Database Migration & Seeding**:
    ```bash
    php artisan migrate:fresh --seed
    ```
4.  **Run the application**:
    ```bash
    php artisan serve
    ```

## 🔐 Test Credentials (Seeded Data)

| Role       | Email                      | Password |
|------------|----------------------------|----------|
| **Admin**  | `admin@pintardigital.com`  | `password` |
| **Owner**  | `instructor@pintardigital.com` | `password` |
| **Student**| `student@pintardigital.com` | `password` |


