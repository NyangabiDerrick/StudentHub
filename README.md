# StudentHub

## Description

**StudentHub** is a role-based student records management system that stores students' records from their personal details to their academic portfolio. It has a detailed background of the students' personal details. It also has a detailed depiction of the relationship between the student, the course they are taking, the unit incorporated, all credits earned and all the records of their academic status since enrollment.

The system supports three distinct user roles — Admin, Registrar, and Student — each with tailored access to the platform, ensuring data privacy and appropriate permissions across the institution.

## Features

- 🔐 Secure, role-based login system (Admin, Registrar, Student)
- 🧑‍🎓 Registrar can register new students, auto-generating their login credentials
- 📋 Add, view, edit, and delete courses and units
- 👥 Add, view, edit, and delete student records
- 📚 Assign units to students and track academic performance through grades
- 📈 View and manage student academic status history (active, suspended, graduated, deferred)
- 🏆 Manage certificates earned by students
- 👤 Students can log in and view their own personal details, units, status history, and certificates — and nothing else
- 🛡️ Passwords are securely hashed (never stored in plain text)
- 🎨 Clean, professional dashboard-style interface

## User Roles & Permissions

| Action | Admin | Registrar | Student |
|---|---|---|---|
| View courses & units | ✅ | ✅ | ✅ |
| Add / Edit / Delete courses & units | ✅ | ✅ | ❌ |
| View all students | ✅ | ✅ | ❌ (own record only) |
| Register / Edit / Delete students | ✅ | ✅ | ❌ |
| Manage student units, status history, certificates | ✅ | ✅ | ❌ (own records, view only) |
| View own profile (personal details, units, status, certificates) | — | — | ✅ |

### How student accounts are created

Students do not self-register. When a Registrar (or Admin) adds a new student via the "Add Student" form, the system automatically creates a matching login account:

- **Username:** the student's registration number (lowercase)
- **Password:** the student's first name (lowercase) — intended as a temporary password for first login

## Database Schema

### Users
|Column|Type|Description|
|---|---|---|
|user_id|INT|primary key, auto increment|
|username|VARCHAR(50)|unique login name|
|password|VARCHAR(255)|securely hashed password|
|role|ENUM('admin','registrar','student')|account type|
|student_id|INT|nullable, foreign key referencing students.student_id (only set for student accounts)|

### Course
|Column|Type|Description|
|---|---|---|
|course_id|INT|primary key, auto increment|
|course_title|VARCHAR(50)|name of the course|
|duration|INT|total time to complete the course in years|
|level|VARCHAR(30)|the course stage in years and semesters|
|department|VARCHAR(40)|the school where the course belongs to|

### Units
|Column|Type|Description|
|---|---|---|
|unit_id|INT|primary key, auto increment|
|unit_code|VARCHAR(10)|unique code for a specific unit|
|unit_title|VARCHAR(30)|name of the unit|
|course_id|INT|foreign key referencing courses.course_id|

### Students
|Column|Type|Description|
|---|---|---|
|student_id|INT|primary key, auto increment|
|full_name|VARCHAR(50)|name of the student|
|registration_number|VARCHAR(15)|unique registration number of the student|
|course_id|INT|foreign key referencing courses.course_id|
|date_of_birth|DATE|date of birth of the student|
|gender|VARCHAR(10)|gender of the student|
|year_of_study|INT|current year of study|
|mode_of_study|VARCHAR(15)|mode of study — full-time, part-time, or online|
|phone|VARCHAR(15)|phone number|
|email|VARCHAR(100)|email address of the student|
|address|VARCHAR(30)|home location|
|guardian_name|VARCHAR(50)|name of the guardian|
|guardian_contact|VARCHAR(15)|phone number of the guardian|
|enrollment_date|DATE|the date of enrollment|

### Student_units
|Column|Type|Description|
|---|---|---|
|id|INT|primary key, auto increment|
|student_id|INT|foreign key referencing students.student_id|
|unit_id|INT|foreign key referencing units.unit_id|
|status|VARCHAR(20)|taken / currently taking / future|
|grade|VARCHAR(10)|nullable, only set once status = taken|
|year_taken|VARCHAR(15)|year of study when unit was taken|
|semester_taken|VARCHAR(15)|semester when the unit was taken|

### Student_status_history
|Column|Type|Description|
|---|---|---|
|id|INT|primary key, auto increment|
|student_id|INT|foreign key referencing students.student_id|
|status|VARCHAR(15)|active / suspended / graduated / deferred|
|reason|VARCHAR(100)|nullable, reason for suspension/deferment|
|date_changed|DATE|the date when each change of status occurs|

### Certificates
|Column|Type|Description|
|---|---|---|
|id|INT|primary key, auto increment|
|student_id|INT|foreign key referencing students.student_id|
|certificate_name|VARCHAR(50)|name of certification|
|issuing_body|VARCHAR(50)|name of the body or institution|
|date_earned|DATE|date of issuance|

## Tech Stack
- 🌐 HTML
- 🎨 CSS
- ⚡ JavaScript
- 🐘 PHP
- 🐬 MySQL (MariaDB)
- 🪟 XAMPP

## Project Structure

```
StudentHub/
├── assets/
│   └── style.css
├── database/
│   └── schema.sql
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── auth_check.php
├── views/
│   ├── view_courses.php
│   ├── view_units.php
│   ├── view_students.php
│   ├── view_student_units.php
│   ├── view_status_history.php
│   └── view_certificates.php
├── add/
│   ├── add_course.php / add_course_process.php
│   ├── add_unit.php / add_unit_process.php
│   ├── add_student.php / add_student_process.php
│   ├── add_student_unit.php / add_student_unit_process.php
│   ├── add_status_history.php / add_status_history_process.php
│   └── add_certificate.php / add_certificate_process.php
├── edit/
│   ├── edit_course.php / edit_course_process.php
│   ├── edit_unit.php / edit_unit_process.php
│   ├── edit_student.php / edit_student_process.php
│   ├── edit_student_unit.php / edit_student_unit_process.php
│   ├── edit_status_history.php / edit_status_history_process.php
│   └── edit_certificate.php / edit_certificate_process.php
├── delete/
│   ├── delete_course.php
│   ├── delete_unit.php
│   ├── delete_student.php
│   ├── delete_student_unit.php
│   ├── delete_status_history.php
│   └── delete_certificate.php
├── db_config.php          (not tracked in Git — contains DB credentials)
├── login.php
├── logout.php
├── index.php
├── my_profile.php
└── README.md
```

## Setup Instructions

1. **Install XAMPP** and start Apache and MySQL:
   ```bash
   sudo /opt/lampp/lampp start
   ```

2. **Clone this repository** into your `htdocs` folder:
   ```bash
   cd /opt/lampp/htdocs
   git clone https://github.com/NyangabiDerrick/StudentHub.git
   ```

3. **Create the database:**
   ```bash
   /opt/lampp/bin/mysql -u root -p -e "CREATE DATABASE StudentHub;"
   ```

4. **Import the schema:**
   ```bash
   /opt/lampp/bin/mysql -u root -p StudentHub < database/schema.sql
   ```

5. **Create `db_config.php`** in the project root (this file is intentionally excluded from Git for security):
   ```php
   <?php
   $host = "localhost";
   $username = "root";
   $password = "";
   $database = "StudentHub";

   $conn = mysqli_connect($host, $username, $password, $database);

   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   ?>
   ```

6. **Create the initial Admin and Registrar accounts.** Since passwords must be hashed, run a one-time script to insert the first `admin` and `registrar` users into the `users` table, using PHP's `password_hash()` function.

7. **Visit the app** in your browser:
   ```
   http://localhost/StudentHub/login.php
   ```

### Default login (for demo/testing purposes — change before any real deployment)
| Role | Username | Password |
|---|---|---|
| Admin | admin | studenthub2026 |
| Registrar | registrar | registrar2026 |
| Student | *(registration number)* | *(student's first name, lowercase)* |

---

## How It Works (Architecture)

### Authentication & Sessions

When a user logs in via `login.php`, their submitted username is looked up in the `users` table. Their submitted password is checked against the stored hash using PHP's `password_verify()` — the actual password is never stored or compared in plain text.

On successful login, PHP starts a **session** (`session_start()`) and stores:
- `$_SESSION['loggedin']` — flags the user as authenticated
- `$_SESSION['role']` — 'admin', 'registrar', or 'student'
- `$_SESSION['student_id']` — only set for student accounts; used to fetch that student's own data
- `$_SESSION['username']`

Every protected page begins by requiring `includes/auth_check.php`, which:
1. Confirms a valid session exists (redirects to `login.php` if not)
2. Optionally checks the page's `$allowed_roles` array against `$_SESSION['role']`, blocking access if the logged-in user's role isn't permitted on that page

This means access control is enforced on the **server side**, on every page load — not just hidden by the navigation menu. The navigation bar itself is also role-aware (built with a PHP conditional in `includes/header.php`), so each role only ever sees links relevant to them — but this is a UX convenience, not the actual security boundary; `auth_check.php` is what truly enforces access.

### The CRUD Pattern

Every manageable table (courses, units, students, student_units, status history, certificates) follows the same four-file pattern, organized into dedicated folders:

- **`views/view_X.php`** — fetches all rows (with `JOIN`s to display readable names instead of raw foreign key IDs) and displays them in a table, with Edit/Delete links per row
- **`add/add_X.php`** → **`add/add_X_process.php`** — a form collects input; the process file validates, uses a **prepared statement** to safely insert the data, then redirects back to the view page
- **`edit/edit_X.php`** → **`edit/edit_X_process.php`** — fetches the specific row by ID (via `$_GET['id']`), pre-fills a form with its current values, and on submit, updates that row via a prepared statement
- **`delete/delete_X.php`** — deletes a specific row by ID; wrapped in a `try/catch` block since deleting a record that other tables still reference (e.g. a student with existing certificates) is blocked by foreign key constraints, and this is handled gracefully rather than crashing

### Security Measures

- **Prepared statements** (`mysqli_prepare` + `mysqli_stmt_bind_param`) are used for every database query involving user input, preventing SQL injection — user input is always treated as data, never executable SQL
- **Password hashing** via `password_hash()` / `password_verify()` — passwords are never stored or compared as plain text
- **Session-based, server-side access control** — role restrictions can't be bypassed by simply hiding a link in the UI; every protected page independently verifies the user's session and role
- **Student data isolation** — a logged-in student's own `student_id` is read only from their session (set at login), never from a URL parameter, preventing one student from viewing another's private data by editing the URL
- **`db_config.php`** (containing database credentials) is excluded from version control via `.gitignore`

### Student Self-Service Flow

1. A Registrar or Admin adds a new student via `add/add_student.php`
2. On submission, `add/add_student_process.php` inserts the student record, then automatically creates a matching row in `users`:
   - Username = registration number (lowercased)
   - Password = student's first name (lowercased), hashed before storage
3. The student can now log in with these credentials and access `my_profile.php`, which shows only their own personal details, unit records, status history, and certificates — fetched using their `student_id` from the session, never from user-editable input

## Usage Walkthrough

**As Admin or Registrar:**
1. Log in with your credentials
2. Use the navigation bar to jump between Courses, Units, Students, Student Units, Status History, and Certificates
3. On any listing page, click **+ Add New...** to create a record, **Edit** to modify one, or **Delete** to remove one (you'll be asked to confirm before deletion)
4. When adding a Student, a login account is automatically generated for them — share their registration number and first name with them as their initial login details

**As a Student:**
1. Log in using the registration number and first name provided by your Registrar
2. Browse available Courses and Units from the navigation bar
3. Click **My Profile** to view your personal details, the units you're enrolled in (with grades where available), your academic status history, and any certificates on record