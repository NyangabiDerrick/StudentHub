# StudentHub


## Description
**StudentHub** is a system that stores students' records from their personal details to their academic portfolio. It has a detailed background of the students' personal details. It also has a detailed depiction of the relationship between the student, the course they are taking, the unit incorporated, all credits earned and all the records of their academic status since enrollment.


## Features
- Add new students' records.
- Register for course and units.
- Search for students' personal details.
- Track performance through grades.
- View the students' academic status.
- View the certifications that a student has.


## Database Schema
### Course
|course_id|int|primary key, auto increment|
|course_title|VARCHAR(50)|name of the course|
|duration|int|total time to complete the course in years|
|level|VARCHAR(30)|the course stage in years and semsters|
|department|VARCHAR(40)|the school where the course belongs to|

### Units
|unit_id|int|primary key, auto increment|
|unit_code|VARCHAR(10)|unique code for a specific unit|
|unit_title|VARCHAR(30)|name of the unit|
|course_id|int|foreign key referencing course.course_id|

### Students
|student_id|int|primary key, auto increment|
|full_name|VARCHAR(50)|name of the student|
|registration_number|VARCHAR(15)|unique reg no of the student|
|course_id|int|foreign key referencing courses.course_id|
|date_of_birth|date|date of birth|
|gender|VARCHAR(10)|gender of the student|
|year_of_study|int|year of study in years.semester|
|mode_of_study|VARCHAR(15)|mode of study, virtual or physical|
|phone|VARCHAR(15)|phone number|
|email|VARCHAR(100)|email address of the student|
|address|VARCHAR(30)|home location|
|guardian_name|VARCHAR(50)|name of the gurdian|
|guardian_contact|VARCHAR(15)|phone number of the gurdian|
|enrollment_date|date|the date of enrollment|

### Student_units
|id|int|primary key, auto increment|
|student_id|int|foreign key referencing students.student_id|
|unit_id|int|foreign key referencing units.unit_id|
|status|VARCHAR(15)|taken / currently taking / future|
|grade|VARCHAR(10)|it is nullable|
|year_taken|VARCHAR(15)|year when unit was taken|
|semester_taken|VARCHAR(15)|semester when the unit was taken|

### Student_status_history
|id|int|primary key, auto increment|
|student_id|int|foreign key referencing students.student_id|
|status|VARCHAR(15)|active / suspended / graduated / deferred|
|reason|VARCHAR(100)|it is nullable|
|date_changed|date|the date when each change of status occurs|

### Certificates
|id|int|primary key, auto increment|
|student_id|int|foreign key referencing students.student_id|
|certificate_name|VARCHAR(50)|name of certification|
|issuing_body|VARCHAR(50)|name of the body or institution|
|date_earned|date|date of issuance|


## Tech Stack
- 🌐 HTML
- 🎨 CSS
- ⚡ JavaScript
- 🪟 XAMPP
- 🐬 MySQL
- 🐘 PHP


## Setup Instructions
_Instructions coming soon as the project develop._
