# 🌟 Aaravam | Unified College Event Management System



> **"Bridging the Gap Between Talent and Opportunity"**

Aaravam is a cutting-edge, web-based platform designed to revolutionize how college festivals and academic events are managed. Built with a focus on user experience and administrative efficiency, it provides a unified hub for students and organizers alike.

---

## 📑 Table of Contents
- [About the Project](#-about-the-project)
- [Key Features](#-key-features)
- [System Architecture](#-system-architecture)
- [Technology Stack](#-technology-stack)
- [Installation Guide](#-installation-guide)
- [Usage Instructions](#-usage-instructions)
- [Screenshots](#-screenshots)
- [Future Enhancements](#-future-enhancements)
- [Author Details](#-author-details)

---

## 📖 About the Project
**Aaravam** (meaning "Joyful Sound") is an all-in-one Event Management System developed specifically for educational institutions. The platform handles the entire lifecycle of college events—from initial announcement and registration to result publication and administrative reporting. 

It eliminates the traditional paperwork and chaotic manual registration processes, offering a clean, glassmorphic interface that resonates with modern design standards.

---

## 🚀 Key Features

### 👤 User (Student) Portal
- **One-Click Registration:** Seamless enrollment in Arts, Sports, Cultural, and Technical fests.
- **Personal Dashboard:** Track registered events and view participation history in real-time.
- **Modern UI:** Interactive, responsive design optimized for both mobile and desktop.
- **Results Board:** Access event winners and updates instantly.

### 🛠️ Administrator Panel (Super Admin & Category Admin)
- **Role-Based Access:** Separate dashboards for System Admins and Category Managers.
- **Dynamic Event Management:** Complete CRUD operations for adding, editing, or removing events.
- **Approval System:** Robust verification process for new admin registrations.
- **Real-Time Analytics:** Visual insights into registration counts and participant demographics.
- **Export Capabilities:** Generate Excel/PDF reports of participant lists for offline management.

### 🔒 Security & Performance
- **Secure Authentication:** Multi-guard authentication using Laravel's session management.
- **OTP Verification:** Enhanced security for password resets and critical actions.
- **Optimized Performance:** Fast load times with Vite-bundled assets and efficient database querying.

---

## 🏗️ System Architecture
The project follows the **MVC (Model-View-Controller)** architecture provided by the Laravel framework:

1.  **Model:** Manages data logic and interacts with the MySQL database using Eloquent ORM.
2.  **View:** Handles the user interface using Blade templating engine with modern CSS/JS.
3.  **Controller:** Acts as the brain, processing user requests and coordinating between Models and Views.

---

## 💻 Technology Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 8.x (Laravel Framework) |
| **Frontend** | HTML5, CSS3 (Vanilla & Modern Glassmorphism), JavaScript (ES6+) |
| **Database** | MySQL |
| **Build Tool** | Vite |
| **Package Management** | Composer & NPM |

---

## ⚙️ Installation Guide

Follow these steps to set up the project on your local machine:

1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/your-username/aaravam.git
    cd aaravam
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies:**
    ```bash
    npm install
    npm run dev
    ```

4.  **Environment Setup:**
    - Duplicate `.env.example` and rename it to `.env`.
    - Configure your database credentials:
    ```env
    DB_DATABASE=aaravam_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations:**
    ```bash
    php artisan migrate
    ```

7.  **Start the Server:**
    ```bash
    php artisan serve
    ```

Access the app at: `http://127.0.0.1:8000`

---

## 📖 Usage Instructions

- **Students:** Register an account, log in, and browse various categories like Arts/Sports to join events.
- **Admins:** Access the portal via `/admin`. Use the dashboard to create events or approve participant lists.
- **System Ops:** Use the Super Admin portal to manage other coordinators and overall system health.

---

## 📸 Screenshots

| Home Page | Admin Dashboard |
|---|---|
| (<img width="400" height="250" alt="Home" src="https://github.com/user-attachments/assets/d426ea3f-0002-4f98-b0a3-218b5d5cd8d9" />) |(<img width="400" height="250" alt="Admin" src="https://github.com/user-attachments/assets/0252b509-d8e6-4f56-9639-333cb9e56806" />) |

---

## 🔮 Future Enhancements
- [ ] **Email/SMS Notifications:** Automated alerts for event schedules and result announcements.
- [ ] **Payment Integration:** Support for fee-based events using Razorpay/Stripe.
- [ ] **QR Code Attendance:** Instant check-ins at event venues using mobile scanners.
- [ ] **Certificate Generation:** Automated PDF certificate issuance for participants.

---

## ✍️ Author Details

- **Name:** DILLU DILEEP
- **Project:** Aaravam Event Management System
- **Year:** Final Year Diploma Project (2025-26)

---
<p align="center">Made with ❤️ for the student community.</p>
