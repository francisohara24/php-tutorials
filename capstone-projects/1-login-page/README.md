# 1-login-page
Database-backed login page written in PHP.
 - Queries MySQL database to verify username and password.
 - Redirects to success page on success or to error page on failure.
 - Users are pre-created in database as specified in `console_login.sql` script.

### Valid User Credentials
These are the only users recognized by the login page:

| **USERNAME**   | **PASSWORD** |
|----------------|--------------|
| *francisohara* | *password*   |
| *nikola*       | *tesla*      |
