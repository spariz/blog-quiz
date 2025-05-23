<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>


<form action="" method="POST">
    <input type="text" name="title" placeholder="Post Title" required><br>
    <textarea name="content" placeholder="Post Content" required></textarea><br>
    <button type="submit" name="submit">Post</button>
</form>

<?php
if (isset($_POST['submit'])) {
    include '../db.php';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $conn->query("INSERT INTO posts (title, content) VALUES ('$title', '$content')");
    echo "Post created successfully!";
}
?>
