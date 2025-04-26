# 🏨 Serenity Hotel Booking System

Welcome to the Serenity Hotel Booking System — a user-friendly web-based application designed to streamline the booking process for Serenity Villa, a peaceful and luxurious escape.

## ✨ Overview

This project is a full-stack room reservation system built with:

- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP & MySQL
- **Authentication:** Session-based user login
- **Features:**
  - Room listing with capacity and pricing
  - Booking with check-in/check-out validation
  - Prevents overlapping bookings
  - Guest capacity restrictions
  - Admin-side booking information management

## 🛏️ Features

- ✅ View available rooms with categories and capacities
- ✅ Book rooms by selecting check-in/check-out dates
- ✅ Only allows bookings within capacity and availability
- ✅ Users must be logged in to make a booking
- ✅ Clean UI using Bootstrap
- ✅ Alerts for invalid bookings or conflicts

## 📁 Project Structure

serenity-hotel/ │ ├── db/ # Database connection file ├── assets/ # CSS, images, etc. ├── booking/ # Booking logic and form │ └── bookRoom.php # Main booking form │ ├── login.php # Login form ├── logout.php # Logout script ├── main.php # Main landing page ├── bookingInformation.php # View bookings (User/Admin) └── README.md # This file

markdown
Copy
Edit

## 🧑‍💻 Technologies Used

- PHP 8.x+
- MySQL
- HTML5
- Bootstrap 4
- JavaScript (vanilla)
- Font Awesome Icons

## 🔐 Authentication

Users must be logged in to access the booking form. Sessions are used to manage user state.

## 📌 How to Run

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/serenity-hotel.git
