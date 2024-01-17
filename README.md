# Trick LoR - Blogging Website Project with PHP Laravel and MySQL

## Overview

Trick LoR is an innovative blogging website project developed using the PHP Laravel framework, seamlessly integrated with MySQL as the database management system. Harnessing the capabilities of Laravel, this project aims to provide an enriching platform for sharing high-quality programming tips and tricks through insightful blog posts.

## Technology Stack

- PHP Laravel
- MySQL
- Livewire
- Pusher
- Bootstrap 5

## Key Features

### User Features

1.  **Authentication:**

- Register, login, and logout securely.
- Easily change passwords and recover forgotten passwords.
- Manage personal information and access viewing history (viewed and saved posts).

2. **Posts:**

- Effortlessly navigate and search for posts using keywords.
- Explore popular posts and categorize content by specific topics.
- Manage personal posts with CRUD operations.
- Preview posts before publishing.

3. **Comments and Feedback:**

- Enjoy real-time post commenting facilitated through Pusher technology.

### Admin Features

1. **Authentication:**

- Secure login, logout, and password management.
- Manage personal information securely.

2. **Management categories:**

- Add, edit and switch status of categories

3. **Management posts:**

- View all posts
- Approve posts
- Block post

4. **User Management (Under Development):**

   - View all users and implement user blocking.

5. **Comments Management (Under Development):**

   - View all comments and delete inappropriate comments.

### User Interface

- User-friendly and responsive design for a seamless experience on all devices.
- Option to choose between dark and light themes (Under Development).

### Security

- User authentication and access control.
- Protection of personal information and posts.

## Installation Guide

### Method 1: Using XAMPP and Composer

**System Requirements:**

- PHP 8.0 or higher
- Composer
- XAMPP
- MySQL

**Installation Steps:**

1. Clone the project from GitHub: `git clone https://github.com/Toanf2103/trick_lor.git`
2. Navigate to the project directory: `cd trick_lor`
3. Install composer packages: `composer install`
4. Create a `.env` file from `.env.example` and configure the database information.
5. Access phpMyAdmin and import the database file located in `database/trick_lor.sql`.

### Method 2: Using Docker

**System Requirements:**

- Docker
- Docker compose

**Installation Steps:**

1. Clone the project from GitHub: `git clone https://github.com/Toanf2103/trick_lor.git`
2. Navigate to the project directory: `cd trick_lor`
3. Create a `.env` file from `.env.docker` and configure the database information.
4. Run the command `docker compose up -d` to launch the application.
