<?php
session_start();  // start PHP session

// set PHP session variables
$_SESSION['title'] = $_POST['title'];
$_SESSION['isbn'] = $_POST['isbn'];
$_SESSION['author'] = $_POST['author'];
$_SESSION['date_published'] = $_POST['date_published'];
?>

<h1>Book Store Manager</h1>
<form action="" method="post">
    <fieldset>
        <legend><strong>BOOK DETAILS</strong></legend>

        <label for="title">Title: </label>
        <input type="text" id="title" name="title" placeholder="e.g. Animorphs: The Invasion">
        <br>
        <br>

        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" placeholder="e.g. 9780590629775">
        <br>
        <br>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" placeholder="e.g. Katherine Applegate">
        <br>
        <br>

        <label for="date_published">Date Published:</label>
        <input type="date" id="date_published" name="date_published" value="1996-06-01">
        <br>
        <br>

        <button type="submit" name="save">Save</button>
        <button type="submit" name="delete">Delete</button>
        <button type="submit" name="update">Update</button>
        <button type="submit" name="search">Search</button>
    </fieldset>
</form>

<?php
// perform input validation
function input_validator(): bool
{
    if ( ($_POST['title'] == NULL) || ($_POST['isbn'] == NULL) || ($_POST['author'] == NULL) || ($_POST['date_published'] == NULL)) {
        echo '<strong style="color: red">Error! All fields are required!</strong>';
        return false;
    }
    return true;
}
if (isset($_POST['save'])) {
    if (input_validator())
        header("Location: ./save.php");
}

elseif (isset($_POST['update'])) {
    if (input_validator())
        header("Location: ./update.php");
}

elseif (isset($_POST['delete'])) {
    if (input_validator())
        header("Location: ./delete.php");
}
elseif (isset($_POST['search'])) {
    if ($_POST['title'] == NULL) {
        echo '<strong style="color: red">Error! Title is required to Search books.</strong>';
    }
    else
        header("Location: ./search.php");
}
?>
