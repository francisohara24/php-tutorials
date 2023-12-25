<?php
session_start();
$title = $_SESSION['title'];
$isbn = $_SESSION['isbn'];
$author = $_SESSION['author'];
$date_published = $_SESSION['date_published'];

// define mysql query
/*
Truth table for MySQL queries (8 queries)  // 0=absent 1=present;
TITLE   ISBN    AUTHOR	DATE
  1       0	      0	     0
  1       0	      0	     1
  1       0	      1	     0
  1       0	      1	     1
  1       1	      0	     0
  1       1	      0	     1
  1       1	      1	     0
  1       1	      1	     1
*/
if ($isbn == NULL) {
    if ($author == NULL) {
        if ($date_published == NULL)
            $stmt = "SELECT * FROM book WHERE book_title='$title';";
        else
            $stmt = "SELECT * FROM book WHERE book_title='$title' AND book_date_published='$date_published';";
    } elseif ($date_published == NULL)
        $stmt = "SELECT * FROM book WHERE book_title='$title' AND book_author='$author';";
    else
        $stmt = "SELECT * FROM book WHERE book_title='$title' AND book_author='$author' AND book_date_published='$date_published';";
} elseif ($author == NULL) {
    if ($date_published == NULL)
        $stmt = "SELECT * FROM book WHERE book_title='$title' AND book_isbn='$isbn';";
    else
        $stmt = "SELECT * FROM book WHERE book_title='$title' AND book_isbn='$isbn' AND book_date_published='$date_published';";
} elseif ($date_published == NULL)
    $stmt = "SELECT * FROM book WHERE book_title='$title' AND book_isbn='$isbn' AND book_author='$author';";
else
    $stmt = "SELECT * FROM book WHERE book_title='$title' AND book_isbn='$isbn' AND book_author='$author' AND book_date_published='$date_published';";

// connect to database
$conn = new mysqli("localhost", "root", "password", "bookstore");

// run select query
$result = $conn->query($stmt);
if ($result->num_rows == 0) {
    echo "<strong style='color: red'>No matching books were found in the catalog! Make sure you entered the book details correctly.";
}
else {

    echo "
    <strong style='color: green'>The following books were found in the catalog:</strong>
    <table>
    <tr>
        <th colspan='5'>Results</th>
    </tr>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>ISBN</th>
        <th>Author</th>
        <th>Date Published</th>
    </tr>
";
    foreach ($result as $row) {
        echo "
        <tr>
            <td>{$row['book_id']}</td>
            <td>{$row['book_title']}</td>
            <td>{$row['book_isbn']}</td>
            <td>{$row['book_author']}</td>
            <td>{$row['book_date_published']}</td>
        </tr>
        ";
    }
    echo "</table>
        <style> table {border: solid 1px black} th {border: solid 1px black} td {border: solid 1px black}</style>
        ";
    }
session_destroy();
exit;
