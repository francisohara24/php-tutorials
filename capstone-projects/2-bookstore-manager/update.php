<?php
session_start();
$title = $_SESSION['title'];
$isbn = $_SESSION['isbn'];
$author = $_SESSION['author'];
$date_published = $_SESSION['date_published'];

// form for updating book
$form_update = "
    <h2>Enter the new details for the book:</h2>
<form action='' method='post'>
    <fieldset>
        <legend><strong>NEW BOOK DETAILS</strong></legend>
        <label for='title'>Title:</label>
        <input type='text' id='title' name='title' required>
        <br>
        <br>
        <label for='isbn'>ISBN:</label>
        <input type='text' id='isbn' name='isbn' required>
        <br>
        <br>
        <label for='author'>Author:</label>
        <input type='text' id='author' name='author' required>
        <br>
        <br>
        <label for='date_published'>Date Published:</label>
        <input type='date' id='date_published' name='date_published' required>
        <br><br>
        <button type='submit' id='update' name='update'>Update</button>
    </fieldset>
</form>
";

// first time on page
if (!isset($_POST['update'])){
    // connect to db
    $conn = new mysqli('localhost', 'root', 'password', 'bookstore');

    // run select query
    $stmt = "SELECT * FROM book WHERE book_title='$title' AND book_isbn='$isbn' AND book_author='$author' AND book_date_published='$date_published';";
    $result = $conn->query($stmt);

    // no book found
    if ($result->num_rows == 0)
        echo "<strong style='color: red'>Error! No book was found with the details you specified. Try again!</strong>";
    // book found
    else {
        foreach($result as $row){
            echo "
            <strong>The following Book will be updated:</strong>
            <table>
            <tr>
                <th>ID</th> <th>TITLE</th> <th>ISBN</th> <th>AUTHOR</th> <th>DATE PUBLISHED</th>
            </tr>
            <tr>
                <td>{$row['book_id']}</td>
                <td>{$row['book_title']}</td>
                <td>{$row['book_isbn']}</td>
                <td>{$row['book_author']}</td>
                <td>{$row['book_date_published']}</td>
            </tr>
            </table>
            <style> table, td, th {border: black solid 1px}</style>
            ";
        }
        echo $form_update;
    }
    $conn->close();
}

// second time on page
else {
    // reconnect to db
    $conn = new mysqli('localhost', 'root', 'password', 'bookstore');

    // run update query
    $stmt = "UPDATE book SET book_title='{$_POST['title']}', book_isbn='{$_POST['isbn']}', book_author='{$_POST['author']}', book_date_published='{$_POST['date_published']}'
         WHERE book_title='$title' AND book_isbn='$isbn' AND book_author='$author' AND book_date_published='$date_published';";
    $result = $conn->query($stmt);

    // run select query for new details
    $stmt = "SELECT * FROM book WHERE book_title='{$_POST['title']}' AND book_isbn='{$_POST['isbn']}' AND book_author='{$_POST['author']}' AND book_date_published='{$_POST['date_published']}';";
    $result = $conn->query($stmt);

    // echo new details as table
    foreach ($result as $row) {
        echo "<strong style='color: green'>Success! The book has been updated with the following new details:</strong>
          <table>
            <tr>
                <th>ID</th> <th>TITLE</th> <th>ISBN</th> <th>AUTHOR</th> <th>DATE PUBLISHED</th>
            </tr>
            <tr>
                <td>{$row['book_id']}</td>
                <td>{$row['book_title']}</td>
                <td>{$row['book_isbn']}</td>
                <td>{$row['book_author']}</td>
                <td>{$row['book_date_published']}</td>
            </tr>
          </table>
          <style> table, td, th {border: 1px solid black}</style>
";
    }
    $conn->close();
    session_destroy();
    exit;
}
