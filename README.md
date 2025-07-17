# 🎬 Movie Review Web App – Generația Tech Project

Acesta este un proiect web realizat în cadrul programului **Generația Tech**, ce constă într-o aplicație PHP conectată la o bază de date SQL Server, destinată afișării și filtrării de filme și genuri.

---

## 📌 Funcționalități

- 🔍 Căutare filme după titlu (`search-results.php`)
- 🎥 Afișare listă filme (`movies.php`)
- 🧾 Detalii film individual (`movie.php`)
- 🎭 Filtrare după gen (`genres.php`)
- 📬 Pagină de contact (`contact.php`)
- 🗄️ Stocare recenzii în baza de date (`reviews.sql`)
- 🧩 Cod organizat modular cu `includes/` și `assets/`

---

## 🛠️ Tehnologii utilizate

- PHP 8+
- Microsoft SQL Server
- HTML5 + CSS3
- XAMPP pentru rulare locală

---

## 🧪 Configurare locală

1. Clonează repository-ul:
   ```bash
   git clone https://github.com/alexandr3i/Project-Web-Development-GeneratiaTech.git
   ```

2. Mută folderul `demo/` în directorul `htdocs` din XAMPP:
   ```
   C:\xampp\htdocs\demo
   ```

3. Creează baza de date `movie_db` în SQL Server și importă fișierul:
   ```
   demo/reviews.sql
   ```

4. Verifică fișierul de conexiune:
   ```php
   // conexiune_php_sql.php
   $serverName = "localhost";
   $connectionInfo = array("Database"=>"movie_db", "UID"=>"sa", "PWD"=>"parola_ta");
   ```

5. Deschide în browser:
   ```
   http://localhost/demo/index.php
   ```

---

## 🧑‍💻 Autor

**Alexandru**  
🎓 Proiect dezvoltat în cadrul **Generația Tech – Web Development**  
📅 Iulie 2025

---

## 📜 Licență

Acest proiect este open-source și poate fi reutilizat în scop educațional.
