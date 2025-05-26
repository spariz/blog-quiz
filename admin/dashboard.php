<?php
session_start();
include '../includes/db.php';

// Protect the page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<h2>Admin Dashboard</h2>

<p>Welcome, <?= $_SESSION['username'] ?>! <a href="../logout.php">Logout</a></p>
<a href="create.php">+ Create New Post</a>

<table border="1" cellpadding="10" cellspacing="0" style="margin-top:20px;">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= $row['created_a_]()
