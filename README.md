# MMU-talent-showcase-Group_AF

## Term 
2510

## Subject

CIT6224 - Web Application Development

## Assignment Title

MMU Talent Showcase Portal

## Lecture Section

TC1L

## Lecturer Name

Dr. Mohana A/P Muniady

## Student ID	 Student Name
### 1211101583	LUQMAN HAKIM BIN NOORAZMI
### 1211101069	TENGKU ALYSSA SABRINA BINTI TENGKU ERWIN
### 1211103144	VAARINDRAN A/L NYANASEGRAN
### 1211103222	ASYRANI SYAZWAN BIN YUHANIS


## Setting Up the Website

1. Install and Start XAMPP
Download XAMPP from https://www.apachefriends.org/
Install and launch the XAMPP Control Panel
Start the following:
Apache
MySQL

2. Move the Project to XAMPP's htdocs Folder
Unzip the project folder MMU-talent-showcase-Group_AF
Move the entire folder to:
Windows: C:\xampp\htdocs\
MacOS: /Applications/XAMPP/htdocs/

Final path: C:\xampp\htdocs\MMU-talent-showcase-Group_AF

3. Create the uploads Folder (IMPORTANT!)

This folder is used for profile pictures and media files.
cd /Applications/XAMPP/htdocs/MMU-talent-showcase-Group_AF

### MacOS

mkdir -p public/uploads
chmod 777 public/uploads

### Windows (Command Prompt as Admin)

mkdir public\uploads
icacls public\uploads /grant Everyone:(F) /T

4. Setup the Database
Open your browser and go to:
http://localhost/phpmyadmin
Create a new database named: mmu_talent_portal
Import the provided .sql file:
Click the Import tab
Choose the SQL file from config folder
Click Go

5. Configure Database Connection
Open the file: config/database_config.php
Check and ensure the DB credentials match your local MySQL config

6. Run the Web App
Open your browser and go to: http://localhost/MMU-talent-showcase-Group_AF/public/index.php
