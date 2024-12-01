# Game n' Go, a mock video game website
This project entails creating and developing a functional PHP web application driven by a database, with similarities to e-commerce websites found on the Internet. The application proficiently executes the fundamental operations of a database: creation, retrieval, updating, and deletion. The data layer of the web application is established using a MySQL database. This endeavor serves as a practical demonstration of our ability to transform a project from its conceptual phase to actual implementation. It also showcases our teamwork skills, proficiency in procedural programming with PHP, and expertise in integrating data with MySQL.

# Project Member Roles
- Jalen Vaughn: Backend Development; Database design and integration
- Ayah Hineiti: Frontend Development; Overall site design and scope

# Technical Requirements
1. Use of a sitewide external style sheet
2. Validation of user input with HTML5: including required fields and correct data types and format
3. Active filtering and sanitation of user's input and database information
4. Modularization of code with functions and file inclusion
5. Data integration with MySQL database
6. Management of state information: hidden fields, query strings, cookies, and session variables
7. Authentication and authorization of both users without permissions and administrator levels

# Basic Features
1. Displaying inventory.
2. Displaying details of a specific product/item.
3. Searching inventory with one or more keywords.
4. Protected shopping cart: adding one or more products into the shopping cart; displaying shopping cart content; checking out to empty the   shopping cart.
5. Login/logout and user registration.
6. Administrator’s features: adding new data into the database; updating and deleting existing data in the database.

# Advanced Feature #1
Password Hashing
- Only hashed passwords are input into the database
- When a user logs in, the username is queried into the database and the hashed password is retrieved by fetching associate keys.
- The default password and hashed password are checked by the function password_verify.

# Advanced Feature #2
Prevention of Duplicate Emails and Usernames
- Duplicate entries prevented in signup.inc.php.
- Entries are checked by querying the $username and $email in seperate instances. If there are any results (true), attach a session variable that prompts one of the according message to appear:
- "Username already exists. Please choose a different one."
- "Email is already registered with an account."
- The user will be redirected to the signup page with an updated $_SESSION['signup_status'] to try again.
