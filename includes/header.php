<div class="header">
    <div class="container">
        <div class="logo-container">
            <a href="dashboard.php">
                <img src="assets/img/SOFTLIBlogo.png" alt="Library Logo" class="logo">
            </a>
        </div>
        
        <div class="nav-links-container">
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="issued-books.php">Issued Books</a></li>
                <li class="dropdown">
                    <a href="#">Account ▼</a>
                    <ul class="dropdown-menu">
                        <li><a href="my-profile.php">My Profile</a></li>
                        <li><a href="change-password.php">Change Password</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="logout-container">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</div>

<style>
/* General Styling */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Header Styling */
.header {
    background: linear-gradient(to top, #F8FAFC, rgb(196, 227, 246));
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

/* Logo Styling */
.logo-container {
    flex-grow: 1;
}

.logo {
    height: 60px;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2); /* Added shadow to logo */
}

/* Navbar */
.nav-links-container {
    flex-grow: 2;
    text-align: center;
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

/* Dropdown */
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

.dropdown:hover .dropdown-menu {
    display: block;
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-menu li {
    padding: 10px 0;
}

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

/* Logout Button */
.logout-container {
    position: absolute;
    right: 30px;
    top: 9%;
    transform: translateY(-50%);
}

.logout-btn {
    background: rgb(255, 113, 125);
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
}

.logout-btn:hover {
    background: rgb(200, 35, 50);
    transform: scale(1.05);
    color: white;
}
</style>