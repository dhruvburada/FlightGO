
# Flight Booking System

This project is a comprehensive Flight Booking System developed as part of a college project. It allows users to register, book flights, and manage their bookings while providing an administrative interface for managing flights and user details.

## Tech Stack

- **Frontend**: CSS, Bootstrap 5, jQuery, JavaScript
- **Backend**: PHP
- **Payment Gateway**: Razorpay

## Features

### User Features

- **User Registration**: Users can register on the platform to create an account.
- **User Login**: Registered users can log in to access their profile and booking history.
- **Forget Password**: Users can reset their password using the PHP mailer functionality.
- **Flight Booking**: Users can book flights and get an allocated seat number.
- **Discount Coupons**: Users can apply discount coupons during the booking process.
- **Rewards System**: Users earn reward points with each booking, which can be redeemed for discount coupons.
- **Payment Options**: Payments can be made through the Razorpay gateway, UPI, or direct bank transfer (with screenshot upload for manual payments).

### Admin Features

- **Flight Management**: Admins can add, remove, or edit flight details.
- **User Management**: Admins can add, remove, or modify user details.
- **Maintenance Broadcasts**: Admins can send broadcast messages to all users regarding maintenance or other important updates.
- **Flight Issues**: Admins can mark flights with issues and manage them accordingly.

### Additional Pages

- **Explore Locations**: Users can explore various flight destinations.
- **About Us**: Information about the company and team.
- **Contact Us**: Users can get in touch with the support team.
- **My Profile**: Users can view and edit their profile information including passwords.

## Setup Instructions

1. **Clone the repository**:
    ```bash
    git clone https://github.com/dhruvburada/FlightGO.git
    cd FlightGO
    ```

2. **Database Configuration**:
    - Create a database named `FlightGO`.
    - Import the provided `FlightGO.sql` file to set up the database schema.
    - Update the database configuration in `connection.php` admin/helpers/init_conn_db.php` if required

3. **Install Dependencies**:
    - Ensure you have PHP and a web server (like Apache) installed.
    - Place the project in the web server's root(htdocs) directory.

4. **Configure PHP Mailer**:
    - Update the `PHPMailer` configuration in `forget-password-action.php`,`Registration.php` with your email server details.

5. **Run the Project**:
    - Start your web server and navigate to the project directory in your browser.
    - Access the user interface at `http://localhost/FlightGO/`.

## Live Demo

Check out the live demo of the project [here](http://flightgo.great-site.net/index.php).

## Future Improvements

- Improve the frontend design for a better user experience.
- Add more robust error handling and validation.

## Contribution

Feel free to fork this repository and contribute by submitting a pull request. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.



