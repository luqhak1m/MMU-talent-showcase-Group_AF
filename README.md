# 🎓 MMU Talent Showcase Portal

> **Group Name:** `MMU-talent-showcase-Group_AF`  
> **Subject:** CIT6224 - Web Application Development  
> **Term:** 2510  
> **Lecture Section:** TC1L  
> **Lecturer:** Dr. Mohana A/P Muniady

---

## 👥 Group Members

| Student ID   | Student Name                                  |
|--------------|-----------------------------------------------|
| 1211101583   | LUQMAN HAKIM BIN NOORAZMI                     |
| 1211101069   | TENGKU ALYSSA SABRINA BINTI TENGKU ERWIN      |
| 1211103144   | VAARINDRAN A/L NYANASEGRAN                    |
| 1211103222   | ASYRANI SYAZWAN BIN YUHANIS                   |

---

## Project Setup Instructions

### 1. Install and Start XAMPP

- Download XAMPP: [https://www.apachefriends.org/](https://www.apachefriends.org/)
- Install and launch the **XAMPP Control Panel**
- Start the following services:
  - **Apache**
  - **MySQL**

---

### 2. Move Project to XAMPP `htdocs` Folder

1. Unzip the project folder: `MMU-talent-showcase-Group_AF`
2. Move it to the following directory:
   - **Windows:** `C:\xampp\htdocs\`
   - **macOS:** `/Applications/XAMPP/htdocs/`

Final Path Example:
```
C:\xampp\htdocs\MMU-talent-showcase-Group_AF
```

---

### 3. Create `uploads` Folder (IMPORTANT)

Used to store profile pictures and media uploads.

#### macOS Terminal
```bash
cd /Applications/XAMPP/htdocs/MMU-talent-showcase-Group_AF
mkdir -p public/uploads
chmod 777 public/uploads
```

#### Windows Command Prompt (Run as Admin)
```cmd
cd C:\xampp\htdocs\MMU-talent-showcase-Group_AF
mkdir public\uploads
icacls public\uploads /grant Everyone:(F) /T
```

---

### 4. Setup the Database

1. Go to: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Create a new database named:
   ```
   mmu_talent_portal
   ```
3. Import the provided `.sql` file:
   - Click the **Import** tab
   - Choose the SQL file from the config folder
   - Click **Go**

---

### 5. Configure Database Connection

- Open the file:
  ```
  config/database_config.php
  ```
- Ensure it contains the correct MySQL credentials:
  ```php
  $host = 'localhost';
  $db   = 'mmu_talent_portal';
  $user = 'root';
  $pass = ''; // Default is empty on XAMPP
  ```

---

### 6. Run the Web Application

- Visit the following URL in your browser:
  ```
  http://localhost/MMU-talent-showcase-Group_AF/public/index.php
  ```

---

## About the Web Application

The **MMU Talent Showcase Portal** is a web-based application developed to provide a centralized platform for **Multimedia University (MMU)** students to showcase their talents in:

- Music  
- Art  
- Writing  
- Programming  
- and more...

It serves as both a **digital gallery** and **community hub**, encouraging collaboration and recognition among students from different faculties.

---

## Target Users

- MMU students  
- Admin users

---

## Additional Features

- Like system to boost morale and visibility for talents
- Leaderboard to showcase top MMU talents
- Comment system with user linkage and timestamps
- Follow/unfollow functionality to keep track of your favorite talents

---