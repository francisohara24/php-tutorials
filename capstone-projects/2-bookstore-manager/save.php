<?php
session_start();
$title = $_SESSION['title'];
$isbn = $_SESSION['isbn'];
$author = $_SESSION['author'];
$date_published = $_SESSION['date_published'];

// connect to database
$conn = new mysqli('localhost', 'root', 'password', 'bookstore');

try {
    // run insert query on database
    $stmt = "INSERT INTO book(book_title, book_isbn, book_author, book_date_published) VALUES ('$title', '$isbn', '$author', '$date_published')";
    $result = $conn->query($stmt);

    // select book from database
    $stmt = "SELECT * FROM book WHERE book_title='$title' AND book_isbn='$isbn' AND book_author='$author' AND book_date_published='$date_published';";
    $result = $conn->query($stmt);

// display selected book in table
    foreach ($result as $row) {
        echo "
        <strong style='color: green'>The following book has been added successfully:</strong>
        <table>
        <tr>
        <th>ID</th>
        <th>Title</th>
        <th>ISBN</th>
        <th>Author</th>
        <th>Date Published</th>
        </tr>
        <tr>
            <td>{$row['book_id']}</td>
            <td>{$row['book_title']}</td>
            <td>{$row['book_isbn']}</td>
            <td>{$row['book_author']}</td>
            <td>{$row['book_date_published']}</td>
        </tr>
        </table>
        <style>
        td {border: 1px solid black}
        th {border: 1px solid black}
        table {border: 2px solid black}
        </style>
        ";
    }
} catch (Exception $exception) {
    echo "<strong style='color: red'>There was an error saving the book! Make sure the book details follow the right format!</strong>";
}
session_destroy();
exit();