# Software Requirements Specification (SRS) - ആരവം (Aaravam)

## 1. Introduction

### 1.1 Purpose
This document provides a comprehensive overview of the **Aaravam** Event Management System. It outlines the functional and non-functional requirements, project scope, and architectural design for the platform developed for **GPTC Muttom**.

### 1.2 Scope
**Aaravam** is a centralized web-based platform designed to streamline campus life and event management at GPTC Muttom. The system facilitates student registrations for various fests (Technical, Cultural, Arts, and Sports), provides an administrative console for event oversight, and serves as a public portal for academic timelines and galleries.

### 1.3 Definitions, Acronyms, and Abbreviations
- **GPTC**: Government Polytechnic College.
- **SRS**: Software Requirements Specification.
- **Admin**: System administrators responsible for managing events and registrations.
- **Super Admin**: High-level administrators with authority over staff accounts and master configurations.
- **CRUD**: Create, Read, Update, Delete.
- **OTP**: One-Time Password.

---

## 2. Overall Description

### 2.1 Product Perspective
Aaravam is a standalone web application built using the Laravel framework. it replaces manual registration processes with a modern, glassmorphic digital interface, improving efficiency for both students and staff.

### 2.2 Product Functions
- **Multi-Role Authentication**: Secure access for Students, Category Admins, and Super Admins.
- **Event Discovery**: Browsing categorized events (Sports, Arts, Tech, etc.) with detailed metadata.
- **Mass Registration**: Multi-selection event registration flow for students.
- **Admin Control Center**: Comprehensive dashboard for registration approval, result management, and content updates.
- **Information Hub**: Academic calendar, public galleries, and result boards.

### 2.3 User Classes and Characteristics
1.  **Students**: Primary users who browse events, register for competitions, and track their participation through a personal portal.
2.  **Category Admins (Sector Heads)**: Staff members responsible for specific fest categories (e.g., Tech Head, Sports Head). They manage events and registration statuses within their domain.
3.  **Super Admins (Master Root)**: Technical or administrative leads who manage staff accounts, infrastructure, and site-wide settings.
4.  **Public Visitors**: Unauthenticated users who can view the home page, academic calendar, and galleries.

### 2.4 Operating Environment
- **Server**: Linux-based server (Ubuntu recommended), PHP 8.2+, MySQL 8.0+.
- **Client**: Any modern web browser (Chrome, Firefox, Safari, Edge) with responsive support for mobile devices.

---

## 3. System Features

### 3.1 User Authentication & Profile Management
- **Description**: Secure login and registration flows for all user roles.
- **Requirements**:
    - **Student Auth**: Email/username login, registration with USN/Reg No, and OTP-based password reset.
    - **Admin Auth**: Separate login portal for administrative staff.
    - **Profile Customization**: Students can update their profile images and basic information.

### 3.2 Event Browsing & Registration
- **Description**: Interactive discovery of college fests and competitions.
- **Requirements**:
    - **Dynamic Listing**: Events grouped by category (Algorithm, UTSAV, ARENA, etc.).
    - **Multi-Selection**: Students can select multiple events in one session using a "cart" or "chip" based selection system.
    - **AJAX Submission**: Registrations are processed without full page reloads for better UX.

### 3.3 Student Portal
- **Description**: A personal dashboard for authenticated students.
- **Requirements**:
    - **Registration Tracking**: View status (Pending/Approved/Rejected) of event applications.
    - **Result Access**: View and export/download competition certificates or result cards.

### 3.4 Admin "Operations Center"
- **Description**: A high-performance dashboard for institutional management.
- **Requirements**:
    - **Analytics**: Overview of total students, registrations, and event statistics.
    - **Registration Handling**: Bulk approval or rejection of student applications.
    - **Result Entry**: Entering scores and ranks for competition winners.
    - **Staff Management**: Super Admins can approve or terminate staff accounts.

### 3.5 Content Management
- **Description**: Tools to keep the platform updated.
- **Requirements**:
    - **Gallery Management**: Uploading and categorizing photos from past fests.
    - **Academic Timeline**: CRUD interface for college calendar events.
    - **Image Mapping**: Smart handling of event posters and category images.

---

## 4. External Interface Requirements

### 4.1 User Interfaces
- **Design Philosophy**: High-fidelity "Operations Center" aesthetic using dark mode, glassmorphism (backdrop-blurs), and vibrant accent colors (#3b82f6).
- **Responsive Web Design**: Fluid layouts that transition seamlessly from desktop monitors to mobile screens.

### 4.2 Software Interfaces
- **Database**: MySQL for persistent storage of users, events, and registration records.
- **Storage**: Local or Cloud storage for serving event images and student profile photos.

---

## 5. Non-functional Requirements

### 5.1 Performance
- Page load times under 2 seconds for core navigation pages.
- Concurrent handling of up to 500+ student registrations during peak fest hours.

### 5.2 Security
- CSRF protection on all form submissions.
- Password hashing using bcrypt.
- Middleware-based role protection (Category Admin vs Super Admin vs Student).

### 5.3 Reliability
- Soft-delete functionality to prevent accidental data loss for users and events.
- Transaction-based registration processing to ensure data integrity.

### 5.4 Maintainability
- Modular Laravel structure following MVC (Model-View-Controller) patterns.
- Semantic HTML and standardized CSS variables for easy theme modification.
