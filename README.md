# Event Booking App 🎟️📅

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/) [![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)

## Project Overview

The **Event Booking App** is a PHP-based web application designed to allow users to view, book, and manage event tickets. The app provides a smooth user experience with a clean interface, offering event details, ticket options, and a shopping cart for streamlined booking.

> **Note:** This project was developed in collaboration with two of my university colleagues as part of our coursework.

## Features

- **User Registration and Login**: Secure user authentication system for personalized access to the application.
- **Event Listings**: Display of available events with detailed information, images, and descriptions.
- **Cart Functionality**: Users can add tickets to their cart, view details, and proceed to checkout.
- **Admin Panel**: A dedicated panel for administrators to manage events, users, and ticket inventories.
- **Email Notifications**: Confirmation emails sent upon successful booking.

## System Architecture

1. **Backend**: Developed using PHP for handling server-side functionalities.
2. **Frontend**: Built with HTML and CSS for responsive design and an engaging user interface.
3. **Database**: MySQL database for storing user information, events, and booking records.

## Technology Stack

- **PHP**: Core language for backend functionality.
- **HTML**: Used for structuring content on the frontend.
- **CSS**: For styling and enhancing the visual appeal of the application.

## Setup and Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/Event_Booking_App.git
   cd Event_Booking_App
   ```

2. Database Setup

- Ensure MySQL is running.
- Import the **proiect_web_evenimente.sql** file to set up the necessary tables and data.

3. Configuration

- If applicable, set up your database credentials in a configuration file (e.g., `config.php`) to connect the app to your MySQL database.

4. Running the Application

- Move the project folder to the `htdocs` directory in your XAMPP installation.
-  Start **Apache** and **MySQL** in XAMPP.
- Open a browser and navigate to `http://localhost/Event_Booking_App`.

## Future Improvements

- **Enhanced Email Notifications**: Automate email reminders for upcoming events.
- **Data Analytics Dashboard**: Provide insights for administrators on user engagement and ticket sales.
- **Wishlist Feature**: Enable users to save events they are interested in for future bookings.

