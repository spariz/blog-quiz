<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>
<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id=$id";
$result = $conn->query($sql);
$post = $result->fetch_assoc();
?>

<div class="single-post">
    <h1><?= $post['title']; ?></h1>
    <p><?= $post['content']; ?></p>
</div>

<?php include 'footer.php'; ?>
