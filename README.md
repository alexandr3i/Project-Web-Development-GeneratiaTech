# 🎬 Movie Review Web App – Generația Tech Project

This is a web project developed as part of the **Generația Tech** program. It is a PHP application connected to a SQL Server database, designed to display and filter movies and genres.

---

## 📌 Features

- 🔍 Search movies by title (`search-results.php`)
- 🎥 Display movie list (`movies.php`)
- 🧾 View individual movie details (`movie.php`)
- 🎭 Filter by genre (`genres.php`)
- 📬 Contact page (`contact.php`)
- 🗄️ Store reviews in a database (`reviews.sql`)
- 🧩 Modular code structure using `includes/` and `assets/`

---

## 🛠️ Technologies Used

- PHP 8+
- Microsoft SQL Server
- HTML5 + CSS3
- XAMPP for local development

---

## 🧪 Local Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/alexandr3i/Project-Web-Development-GeneratiaTech.git
   ```

2. Move the `demo/` folder to your XAMPP `htdocs` directory:
   ```
   C:\xampp\htdocs\demo
   ```

3. Create a database named `movie_db` in SQL Server and import:
   ```
   demo/reviews.sql
   ```

4. Update your connection credentials:
   ```php
   // conexiune_php_sql.php
   $serverName = "localhost";
   $connectionInfo = array("Database"=>"movie_db", "UID"=>"sa", "PWD"=>"your_password");
   ```

5. Open in your browser:
   ```
   http://localhost/demo/index.php
   ```

---

## 🧑‍💻 Author

**Alexandru**  
🎓 Project developed during the **Generația Tech – Web Development** program  
📅 July 2025

---

## 📜 License

This project is open-source and may be reused for educational purposes.
