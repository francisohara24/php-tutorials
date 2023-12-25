<?php
session_start();
$title = $_SESSION['title'];
$isbn = $_SESSION['isbn'];
$author = $_SESSION['author'];
$date_published = $_SESSION['date_published'];

// connect to database
$conn = new mysqli('localhost', 'root', 'password', 'bookstore');


try {
    // run delete query on database
    $stmt = "DELETE FROM book WHERE book_title='$title' AND book_isbn='$isbn' AND book_author='$author' AND book_date_published='$date_published';";
    $conn->query($stmt);
    $msg_success = "
        <strong style='color: green'>Success! The following book was deleted from the catalog:</strong>
        <table>
            <tr>
                <th>Title</th> <th>ISBN</th> <th>Author</th> <th>Date of Publication</th>
            </tr>
            <tr>
            <td>$title</td> <td>$isbn</td> <td>$author</td> <td>$date_published</td>
            </tr>
        </table>
        <style>th {border: 1px black solid} td {border: 1px black solid} table {border: 1px solid black}</style>
    ";
    echo $msg_success;  // echo success message on success.
}
catch (Exception $exception){
    $msg_err = "<strong style='color: red'>Error! Book could not be deleted from catalog. Make sure you entered the correct details.</strong>";
    echo $msg_err;  // echo error message on error.
}

