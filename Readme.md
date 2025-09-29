Movie Ticket Booking System:

A simple web-based application to manage movies, theatres, seat booking, offers, and reviews.

Features:

Admin Dashboard:

1. Add movies with ticket price

2. Add theatres and assign movies

3. Add offers for theatres

4. View all user bookings


User Side:

1. View movies and theatres

2. Book seats with dynamic layout

3. Automatic seat lock for already booked seats

4. Extra charges for premium seats

5. GST calculation in billing

6. Pay and download or print tickets

7. Submit movie reviews and ratings



Tech Stack:

Frontend: HTML, CSS, JavaScript

Backend: PHP

Database: MySQL


Database Structure:

Tables used:

1. admins – Admin login (username, password)

2. movies – Movies with title, description, poster, ticket_price

3. theaters – Theatres with name, location

4. assign_movies – Mapping of movies to theatres

5. offers – Theatre offers

6. reviews – Movie reviews and ratings

7. bookings – User bookings (seats, total amount, movie, theatre)


Setup Instructions:

1. Clone this project or copy files to your local server (for example XAMPP htdocs).


2. Create a MySQL database (for example movie_booking).


3. Import the provided database.sql file.


4. Update config.php with your database username and password.


5. Start Apache and MySQL in XAMPP.


6. Open the project in your browser:
http://localhost/movie-booking-system/



Default Admin Login:

Username: admin1

Password: Admin@123

Default User login:

Username: ammu@gmail.com
Password: ammu

License:
This project is for educational purposes only.

