# 📚 SOFTLIB - Smart Library Management System

SOFTLIB is a web-based Library Management System designed for educational institutions to automate and streamline the process of book issuance, returns, student activity tracking, and library administration.

The project is fully responsive and deployed on AWS EC2, enabling students and admins to access the system from any device, anywhere.

---

## 📸 Screenshots

### 🖥️ Desktop View

<img src="https://github.com/user-attachments/assets/f96a36e9-3368-403f-8dc1-26c6df6997ff" width="750" alt="Desktop View" />

---

### 📱 Mobile View

<div align="center">
  <img src="https://github.com/user-attachments/assets/a34f3e3d-549e-4ea6-b024-c34cbe79c11f" width="240" alt="Mobile View 1" />
  <img src="https://github.com/user-attachments/assets/63547e2b-c146-4455-b9e7-0edcb72c695c" width="240" alt="Mobile View 2" />

</div>

---

### 🎓 Student Dashboard

<img src="https://github.com/user-attachments/assets/d0e19024-2da5-4df6-a6e0-3325df46b246" width="750" alt="Student Dashboard" />

---

### 🔐 Admin Panel

<img src="https://github.com/user-attachments/assets/6d226914-2ce4-4c5d-b3fa-5de1dcfb50ce" width="750" alt="Admin Panel" />
<img src="https://github.com/user-attachments/assets/2cfb098b-b6a1-40fb-b5aa-8a746b57037e" width="750" alt="Admin Panel 2" />
<img src="https://github.com/user-attachments/assets/89bfa986-558b-4b7a-ae30-24a682d7aab7" width="750" alt="Admin Dashboard 3" />


---

## 🚀 Features

- 🔐 Role-Based Access (Admin / Student)
- 📚 Book Management: Add, Edit, Delete, Categorize Books
- 🔄 Issue / Return Tracking
- 🔍 Searchable Book Listings
- 📈 Admin Reports & Student History
- 📱 Fully Responsive UI (PC, Tablet, Mobile)
- ☁️ Live Deployment on AWS EC2 Ubuntu Server
- 🛡️ Session-Based Authentication & Hashed Passwords

---

## ⚙️ Technologies Used

| Frontend          | Backend       | Database | Hosting   | Tools              |
|-------------------|---------------|----------|-----------|--------------------|
| HTML, CSS, JS     | PHP           | MySQL    | AWS EC2   | phpMyAdmin, GitHub |
| Bootstrap         |               |          | Apache    | VS Code, XAMPP     |

---

## 🛠️ How to Run Locally

1. **Clone the repository:**

   ```bash
   git clone https://github.com/UrvishSuhagiya/SOFTLIB.git
2. **Start Apache & MySQL using XAMPP.**

3. **Import the database:**

- Open phpMyAdmin

- Import mylib.sql from the project folder

4. **Update DB credentials in /includes/config.php:**
 -define('DB_HOST','localhost');
 -define('DB_USER','root');
 -define('DB_PASS','');
 -define('DB_NAME','mylib');

5. Open your browser and run:
http://localhost/SOFTLIB/index.php

--- 

# ☁️ Deployment on AWS EC2
- Ubuntu Server (22.04 LTS)
- Apache2, MySQL, PHP (LAMP stack)
- Project deployed inside /var/www/html/SOFTLIB/
- MySQL managed using phpMyAdmin over public IP
- Security groups configured for HTTP (80) and MySQL access

---

# ✅ Future Enhancements
- Use password_hash() instead of md5 for better security
- Add email/SMS notifications for due/overdue books
- Include online fine payment integration
- Implement AI-based book recommendations
