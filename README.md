# Trick LoR - Blogging Website Project with PHP Laravel and MySQL

## Introduction

Trick LoR is a blogging website project built on the PHP Laravel framework, utilizing MySQL as the database management system. Leveraging the power of Laravel, this project aims to share programming tips and tricks through high-quality blog posts.

## Key Features

1. **Posts:**

   - View a list of posts.
   - Effortlessly search for posts by keywords.
   - View popular posts.
   - Categorize and view posts by specific topics.
   - Perform post management tasks such as adding, editing, and deleting (currently restricted to admin access).

2. **User Management:**

   - User registration.
   - User login.
   - User forgot password.
   - User change password.
   - Manage personal information.
   - View history (viewed articles, saved articles).

3. **Comments and Feedback:**

   - Real-time posts commenting facilitated through Pusher technology.
   - Admin management of comments, including deletion (Under Development).

4. **User Interface:**

   - User-friendly and responsive design.
   - Choose between dark and light themes (Under Development).
   - Seamless mobile compatibility ensures a consistent user experience across all devices.

5. **Security:**
   - User authentication and access control.
   - Protection of personal information and articles.

## Installation

1. **System Requirements:**

   - PHP 8.0 or higher
   - Composer
   - XAMPP
   - MySQL

2. **Installation and Running the Application:**

   - **Method 1: Using XAMPP and Composer**

     - Clone the project from GitHub: `git clone https://github.com/Toanf2103/trick_lor.git`
     - Navigate to the project directory: `cd trick_lor`
     - Install composer packages: `composer install`
     - Create a `.env` file from `.env.example` and configure the database information.
     - Access phpMyAdmin and import the database file located in `database/trick_lor.sql`.

   - **Method 2: Using Docker**

     - Clone the project from GitHub: `git clone https://github.com/Toanf2103/trick_lor.git`
     - Navigate to the project directory: `cd trick_lor`
     - Create a `.env` file from `.env.example` and configure the database information
     - Run the command `docker compose up -d` to launch the application.
