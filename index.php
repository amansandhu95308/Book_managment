<?php
session_start();
$books = isset($_SESSION['books']) ? $_SESSION['books'] : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $year = $_POST['year'] ?? '';

    // Validation
    if ($title && $author && $year) {
        $book = new Book($title, $author, $year);
        $books[] = $book;
        $_SESSION['books'] = $books; // Store in session
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Management</title>
</head>
<body>
    <h1>Book Management System</h1>
    <form method="post">
        <label>Title:</label><input type="text" name="title"><br>
        <label>Author:</label><input type="text" name="author"><br>
        <label>Year:</label><input type="text" name="year"><br>
        <input type="submit" value="Add Book">
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    
    <h2>Book List</h2>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
        </tr>
        <?php
        foreach ($books as $book) {
            echo "<tr>
                <td>{$book->getTitle()}</td>
                <td>{$book->getAuthor()}</td>
                <td>{$book->getYear()}</td>
                </tr>";
        }
        if (empty($books)) {
            echo "<tr><td colspan='3'>No books added yet.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
