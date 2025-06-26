<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      /* display: flex; */
    }

    .sidebar {
      width: 270px;
      height: 100vh;
      background-color: #1c2541;
      color: white;
      padding-top: 20px;
      position: fixed;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 24px;
      letter-spacing: 1px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }

    .sidebar ul li {
      padding: 15px 20px;
      border-bottom: 1px solid #394867;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .sidebar ul li:hover {
      background-color: #3a506b;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      display: block;
    }

    .main-content {
      margin-top: -20px;
      margin-left: 270px;
      padding: 20px;
      flex: 1;

    }
  </style>
</head>

<body>

  <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li><a href="admin.php">Dashboard</a></li>
      <li><a href="add_book.php">Add Books</a></li>
      <li><a href="add-category.php">Add Category</a></li>
      <li><a href="view_books.php">All Books</a></li>
      <li><a href="view_orders.php">View Orders</a></li>
      <li><a href="view_user.php">View Users</a></li>
      <li><a href="view_user_activities.php">View User Activities</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <h1>Welcome, Admin</h1>
    <!-- <p>This is your dashboard content.</p><br> -->
  </div>

</body>

</html>