# NFQ PHP task

## Build instructions
- Install laravel
- Clone this repository
- Navigate to the project folder and edit `.env` and `config/database.php` files to match your database connections
- Run `php artisan migrate` to create the database tables
- Run `php artisan serve` to launch the web application on localhost

## Aboout the database
All the data is stored inside of a database, table "students" holds all the information about the students and table "projects" holds
the information about the projects. The tables were created using laravels migrations, they can be seen inside `database/migrations` file,
if translated to SQL they would look something like this:

`CREATE TABLE students (
id INT AUTO_INCREMENT PRIMARY KEY,
projectGroup INT,
projectID INT,
firstname VARCHAR(30),
lastname VARCHAR(30),
created_at VARCHAR(30),
updated_at VARCHAR(30)
);`

`CREATE TABLE projects (
id INT AUTO_INCREMENT PRIMARY KEY,
numberOfGroups INT,
studentsPerGroup INT,
projectName' VARCHAR(30),
created_at VARCHAR(30),
updated_at VARCHAR(30)
);`

## My choises for building this web application
I chose laravel to be the framework for this task, because I am most familiar with it, back-end is writen in php, front-end in html, and JavaScript for some functionality.
Code can be found in `app/Http/Controllers/HomeController.php` for back-end and `resources/views/welcome.blade.php` for frond-end, database migrations can be found in
`app/Models/Projects.php` and `app/Models/Students.php`.

## Functionality
The teacher can add a new student with a unique full name to the list, create a new project and assign student to one of the groups
 inside of the project, projects can not have the same name, the number of groups in the project and the maximum ammount of students
in the group need to be provided while creating a new project. if the student is deleted by the teacher he is automatically removed
from the project, if he is assign to one. 
