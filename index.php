<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php include 'db.php'; ?>

<div class="posts">
    <?php
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<h2><a href='post.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></h2>";
            echo "<p>" . substr(htmlspecialchars($row['content']), 0, 150) . "...</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No posts yet.</p>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>
