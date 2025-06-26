<?php
session_start();
include("admin_sidebar2.php");
include("configuration.php");
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link rel="stylesheet" href="view_book.css?v=<?php echo time(); ?>">
</head>

<body>

    <center>
        <i class="heading_name">
            <h2 id="msg">All Books and Categories</h2>
        </i>
    </center>
    <style>
        .go-button {
            background-color: #144250;
            border-color: #144250;
            font-size: 12px;
            padding: 8px;
            color: white;
            border-radius: 8%;
            height: 34px;
            transition: transform 0.2s ease, filter 0.2s ease;
            margin-top: 11px;
        }

        .go-button:hover {
            transform: scale(1.05);
            filter: brightness(1.1);
        }

        .main-content {
            margin-left: 0;
            padding: 20px;
        }
    </style>


    <div class="size">
        <form method="POST" action="" style="display: flex;">
            <input class="searchbar" name="searchbar" placeholder="  Search by title name">
            <button type="submit" name="search"
                style="border: none; background: none; padding: 0; margin-left: -34px; margin-top: 9px;">
                <img src="search.jpg" style="width: 35px; height: 35px;">
            </button>
        </form>
    </div><br>
    <?php
    $sql = "select count(*) as total from categories";
    $sql_result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($sql_result); ?>
    <div class="main-content">
        <i>
            <h3 class="title">All Categories - (<?php echo $row['total'] ?>)</h3>
        </i>

        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1) { ?>
            <div style="background-color: #d4edda; color: #155724;
             padding: 15px; margin-bottom: 15px;margin-left:75px;margin-right:75px;border: 1px solid #c3e6cb;">
                Category deleted successfully.
            </div>
        <?php } ?>

        <?php

        $search = '';
        $highlight_id = null;

        if (isset($_POST['search']) && !empty($_POST['searchbar'])) {
            $search = $_POST['searchbar'];
            // Find the matched book to highlight
            $highlight_query = "SELECT book_id FROM books WHERE title LIKE '%$search%'";
            $highlight_result = mysqli_query($con, $highlight_query);
            if (mysqli_num_rows($highlight_result) > 0) {
                $highlight_row = mysqli_fetch_assoc($highlight_result);
                $highlight_id = $highlight_row['book_id'];
            }
        }
        ?>


        <?php
        $cate_query = "SELECT * from categories order by category_name asc";
        $cate_result = mysqli_query($con, $cate_query);
        ?>

        <div class="book-table-wrapper">
            <table class="book-table">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Action</th>
                </tr>

                <?php
                if (mysqli_num_rows($cate_result) > 0) {
                    while ($row1 = mysqli_fetch_assoc($cate_result)) {
                        echo "<tr>";
                        echo "<td>" . $row1['category_id'] . "</td>";
                        echo "<td>" . $row1['category_name'] . "</td>";
                        echo "<td><img src='images/" . $row1['category_img'] . "' style='width:50px; height:50px; object-fit:cover;'></td>";
                        echo "<td>
                    <a href='edit-category.php?id1=" . $row1['category_id'] . "' class='edit-btn'>Edit</a>
                    <a href='delete-category.php?id1=" . $row1['category_id'] . "' class='delete-btn'>Delete</a>
                  </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No categories found.</td></tr>";
                }
                ?>
            </table>
        </div>
        <?php $query = "SELECT books.*, categories.category_name 
      FROM books 
      JOIN categories ON books.category_id = categories.category_id 
      ORDER BY title ASC";
        $result = mysqli_query($con, $query);
        ?>
        <?php
        $sql1 = "select count(*) as total from books";
        $sql_result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_assoc($sql_result1); ?>
        <div id="msgg">
            <i>
                <h3 class="title">All Books - (<?php echo $row1['total'] ?>)</h3>
            </i>
        </div>

        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 2) { ?>
            <div id="msg" style="background-color: #d4edda; color: #155724;
             padding: 15px; margin-bottom: 15px;margin-left:75px;margin-right:75px;border: 1px solid #c3e6cb;">
                Book deleted successfully.
            </div>
        <?php } ?>

        <div class="book-table-wrapper">

            <table class="book-table">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $isHighlighted = ($highlight_id == $row['book_id']);
                        $rowId = $isHighlighted ? "id='matched-row'" : "";
                        $rowStyle = $isHighlighted ? "style='background-color:#d4edda;;'" : "";

                        echo "<tr $rowId $rowStyle>";
                        echo "<td>" . $row['book_id'] . "</td>";
                        echo "<td><img src='images/" . $row['book_img'] . "' style='width:125px; height:175px;'><br><br>" . $row['title'] . "</td>";
                        echo "<td>" . $row['author'] . "</td>";
                        echo "<td>" . $row['category_name'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>
                    <a href='edit-book.php?id=" . $row['book_id'] . "' class='edit-btn'>Edit</a>
                    <a href='delete-book.php?id=" . $row['book_id'] . "' class='delete-btn'>Delete</a>
                  </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No books found.</td></tr>";
                }
                ?>
            </table>
        </div>

        <script>
            const matchedRow = document.getElementById("matched-row");
            if (matchedRow) {
                matchedRow.scrollIntoView({ behavior: "smooth", block: "center" });
            }
        </script>


    </div>

</body>

</html>