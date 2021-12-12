I chose laravel to be the framework for this task, back-end is writen in php, front-end in html, and JavaScript for some functionality.
All the data is stored inside of a database, table "students" holds all the information about the students and table "projects" holds
the information about the projects. The tables were created using laravels migrations, they can be seen inside database/migrations file,
(to execute the migrations: inside the command prompt, navigate to the project folder and execute "php artisan migrate" command, first
make sure that the database is created and connected)
if translated to SQL they would look something like this:
CREATE TABLE students (
id INT AUTO_INCREMENT PRIMARY KEY,
projectGroup INT,
projectID INT,
firstname VARCHAR(30),
lastname VARCHAR(30),
created_at VARCHAR(30),
updated_at VARCHAR(30)
);

CREATE TABLE projects (
id INT AUTO_INCREMENT PRIMARY KEY,
numberOfGroups INT,
studentsPerGroup INT,
projectName' VARCHAR(30),
created_at VARCHAR(30),
updated_at VARCHAR(30)
);

To run the web application on localhost: inside command promp navigate to the project folder and execute the "php artisan serve" command.
functionality:
The teacher can add a new student with a unique full name to the list, create a new project and assign student to one of the groups
 inside of the project, projects can not have the same name, the number of groups in the project and the maximum ammount of students
in the group need to be provided while creating a new project. if the student is deleted by the teacher he is automatically removed
from the project, if he is assign to one. The front-end park can be found in resources/views/welcome.blade.php, back-end can be found 
in app/Http/Controllers/HomeController.php and models for both tables in the database: app/Models/Projects.php and app/Models/Students.php
