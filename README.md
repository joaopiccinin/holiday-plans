README: Holiday Plans Management API

This project is a Laravel-based RESTful API designed to manage holiday plans for the year 2024. It allows users to perform CRUD (Create, Read, Update, Delete) operations on holiday plans and generate PDF documents summarizing the details of each plan.

Setting Up Local Environment with Docker
To run this project locally using Docker, follow these steps:

Clone the repository:

git clone https://github.com/joaopiccinin/holiday-plans.git
Navigate to the project directory:

cd api-holiday-plans
Build the Docker containers:

docker-compose build
Start the Docker containers:

docker-compose up -d

Run database migrations:

docker-compose exec app php artisan migrate

Generate encryption keys for Passport:

docker-compose exec app php artisan passport:install

Access the API:
The API will be available at http://localhost:8000.

API Documentation
Below are the endpoints available in the API:

1. Create a new holiday plan
Method: POST
URL: /api/holidayplans
Request parameters: title, description, date, location, participants (optional)
2. Retrieve all holiday plans
Method: GET
URL: /api/holidayplans
3. Retrieve a specific holiday plan by ID
Method: GET
URL: /api/holidayplans/{id}
4. Update an existing holiday plan
Method: PUT
URL: /api/holidayplans/{id}
Request parameters: title, description, date, location, participants (optional)
5. Delete a holiday plan
Method: DELETE
URL: /api/holidayplans/{id}
6. Generate PDF for a specific holiday plan
Method: POST
URL: /api/holidayPlan/pdf/{id}
7. Logout the authenticated user
Method: DELETE
URL: /api/logout
8. View the profile of the authenticated user
Method: GET
URL: /api/profile
9. Register a new user
Method: POST
URL: /api/register
10. Perform user login
Method: POST
URL: /api/login
CRUD routes for holiday plans (/api/holidayplans) and PDF generation for a specific holiday plan (/api/holidayPlan/pdf/{id}) are protected by authentication, meaning the user needs to be authenticated to access them. Other routes are for user registration, login, logout, and profile viewing.

Testing
This project includes unit tests to ensure the integrity of the main API functionalities.

To run the tests, execute the following command:

docker-compose exec app php artisan test
