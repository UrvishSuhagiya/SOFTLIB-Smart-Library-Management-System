<div class="header">
    <div class="container">
        <div class="logo-container">
            <a href="dashboard.php">
                <img src="assets/img/SOFTLIBlogo.png" alt="Library Logo" class="logo">
            </a>
        </div>
        <div class="logout-container">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</div>

<nav class="navbar">
    <div class="container">
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li class="dropdown">
                <a href="#">Categories ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="add-category.php">Add Category</a></li>
                    <li><a href="manage-categories.php">Manage Categories</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Authors ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="add-author.php">Add Author</a></li>
                    <li><a href="manage-authors.php">Manage Authors</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Books ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="add-book.php">Add Book</a></li>
                    <li><a href="manage-books.php">Manage Books</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Issue Books ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="issue-book.php">Issue New Book</a></li>
                    <li><a href="manage-issued-books.php">Manage Issued Books</a></li>
                </ul>
            </li>
            <li><a href="reg-students.php">Reg Students</a></li>
            <li><a href="change-password.php">Change Password</a></li>
        </ul>
    </div>
</nav>

<style>
/* General Styling */
body {
    font-family: 'Arial', sans-serif;
    /* background: linear-gradient(to top, rgb(252, 252, 252), rgb(228, 241, 252), rgb(215, 232, 246)); */
    margin: 0;
    padding: 0;
}

/* Header Styling */
.header {
    background: linear-gradient(to top, #F8FAFC,rgb(196, 227, 246));
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    position: relative;
}

/* Logo Styling */
.logo-container {
    flex-grow: 1;
}

.logo-container a img{
    box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);
}

.logo {
    height: 60px;
}

/* Logout Button Styling */
.logout-container{
    position: absolute;
    right: 30px; /* Moves logout button to the rightmost corner */
    top: 50%;
    transform: translateY(-50%);
}

.logout-btn {
    background: rgb(255, 113, 125);
    color: black;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    height: 60px;
    transition: all 0.3s ease;
    border: 2px solid rgb(255, 113, 125); /* Adds a 2px solid border, adjust color as needed */
}

.logout-btn:hover {
    background: rgb(200, 35, 50);
    border-radius: 5px;
    border: 2px solid rgb(200, 35, 50);
    transform: scale(1.05);
    color:white;
}

/* Navbar Styling */
.navbar {
    background:  #E8F9FF;
    padding: 8px 0;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

.nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    gap: 20px;
}

.nav-links li {
    position: relative;
}

.nav-links a {
    text-decoration: none;
    font-size: 16px;
    color: #333;
    font-weight: bold;
    padding: 8px 12px;
    transition: color 0.3s ease, transform 0.2s ease;
}

.nav-links a:hover {
    color: #007bff;
    transform: scale(1.05);
}

/* 🔥 New Dropdown Menu with Smooth Animation */
.dropdown-menu {
    display: none;
    position: absolute;
    background: white;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    padding: 10px;
    border-radius: 8px;
    list-style: none;
    min-width: 180px;
    top: 100%;
    left: 0;
    z-index: 10;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-15px);
    transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s;
}

/* Trigger Animation on Hover */
.dropdown:hover .dropdown-menu {
    display: block;
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Individual Dropdown Items */
/* 🔥 Slide-In & Bounce Dropdown Animation */
.dropdown-menu {
    display: none;
    position: absolute;
    background: white;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    padding: 10px;
    border-radius: 8px;
    list-style: none;
    min-width: 180px;
    top: 100%;
    left: 0;
    z-index: 10;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-20px) scale(0.95);
    transition: opacity 0.4s ease, transform 0.4s cubic-bezier(0.3, 1.3, 0.3, 1);
}

/* Show dropdown with bounce effect */
.dropdown:hover .dropdown-menu {
    display: block;
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

/* Individual Dropdown Items */
.dropdown-menu li {
    padding: 10px 0;
}

/* 🔥 Border Glow Effect */
.dropdown-menu a {
    padding: 12px;
    display: block;
    color: #333;
    font-size: 15px;
    border-radius: 5px;
    transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
}

.dropdown-menu a:hover {
    background: #007bff;
    color: white;
    transform: scale(1.08);
    box-shadow: 0px 0px 10px rgba(12, 12, 12, 0.6);
}

/* 🔷 Soft Glow Shadow on Hover */
.dropdown-menu::before {
    content: "";
    position: absolute;
    top: -5px;
    left: 10px;
    width: 10px;
    height: 10px;
    background: white;
    transform: rotate(45deg);
    box-shadow: -4px -4px 6px rgba(0, 0, 0, 0.1);
}

</style>
