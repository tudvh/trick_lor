# Trick LoR - Blogging Website Project with PHP Laravel and MySQL

## Introduction

Trick LoR is a blogging website project built on the PHP Laravel framework, utilizing MySQL as the database management system. Leveraging the power of Laravel, this project aims to share programming tips and tricks through high-quality blog posts.

## Key Features

1. **Articles:**

   - Display a list of articles.
   - Search for articles by keyword.
   - View lists of popular articles.
   - Explore articles by category.
   - Add, edit, and delete articles (currently only accessible to admins).

2. **User Management:**

   - User registration and login.
   - Manage personal information and change passwords.
   - View history (viewed articles, saved articles).

3. **Comments and Feedback: (Under Development)**

   - Comment and share opinions on articles.
   - Admin management of comments, including deletion.

4. **User Interface:**

   - User-friendly and responsive design.
   - Mobile compatibility for a seamless user experience across all devices.

5. **Security:**
   - User authentication and access control.
   - Protection of personal information and articles.

## Installation

1. **System Requirements:**

   - PHP 8.0 or higher
   - Composer
   - MySQL

2. **Installation and Running the Application:**

   - **Method 1: Using Composer**

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
