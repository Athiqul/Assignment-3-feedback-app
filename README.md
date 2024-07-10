# Anonymous Feedback System

This PHP application provides a system for anonymous users to submit feedback and registered users to manage their feedback messages. It uses file-based storage (JSON files) for storing user information and feedbacks.

## Features

- **User Authentication**:

  - Users can register with a unique email address.
  - Registered users can log in to access their dashboard.
  - The dashboard displays feedback messages submitted by the anonymous person.

- **Anonymous Feedback**:

  - Anonymous users can provide feedback using unique links generated for registered users.
  - Feedback submissions are stored in JSON format (`feedbacks.json`).

- **Views**:
  - **Home**: Default landing page (`home.php`).
  - **Login**: Allows registered users to log in (`login.php`).
  - **Registration**: User registration form (`register.php`).
  - **Dashboard**: Displays user-specific feedback messages (`dashboard.php`).
  - **Feedback Form**: Form for anonymous users to submit feedback (`feedback.php`).
  - **Feedback Success**: Confirmation page after submitting feedback (`feedback-success.php`).
  - **404 Page**: Custom error page for invalid URLs (`views/404.php`).

## Directory Structure

```

- files/
    - users.json
    - feedbacks.json

- helpers/
    - helper.php

-images/

-includes/
   - header.php
   - footer.php
-logic/
   - dashboardHandler.php
   - feedbackReceive.php
   - loginHandler.php
   -registerHandle.php

- views/
    - home.php
    - login-form.php
    - register-form.php
    - dashboard.php
    - feedback-form.php
    - feedback-success.php
    - 404.php

- index.php
- routes.php

```

## Setup Instructions

1. Clone the repository:

   ```bash
   git clone https://github.com/your/repository.git
   ```

2. Configure your web server to point to the root directory of the application.

3. Ensure PHP 8.2 is installed and configured on your server.

4. Update `helpers/file.php` with appropriate file handling functions for `users.json` and `feedbacks.json`.

5. Access the application through your web browser.

```bash
   PHP -S localhost:8080
```

## Usage

- Navigate to `/login` to log in or `/register` to register with a valid email address.
- Once logged in, visit `/dashboard` to view your feedback messages.
- Share the generated anonymous feedback link `localhost/feedback/{user_token}` with others to collect anonymous feedback.

## Notes

- This application does not use a database and relies on file-based storage for simplicity.
- Ensure file permissions are correctly set for `data/` directory to allow read and write operations.

---

