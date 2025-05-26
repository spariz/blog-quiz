<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$post = null;

// Fetch post data
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $post = $result->fetch_assoc();
} else {
    echo "<p>Post not found.</p>";
    exit();
}
?>

<h2>Edit Post</h2>

<form action="" method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
    <textarea name="content" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
    <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
    $newTitle = trim($_POST['title']);
    $newContent = trim($_POST['content']);

    $updateStmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $updateStmt->bind_param("ssi", $newTitle, $newContent, $id);

    if ($updateStmt->execute()) {
        echo "<p style='color:green;'>Post updated!</p>";
    } else {
        echo "<p style='color:red;'>Update failed.</p>";
    }
}
?>
