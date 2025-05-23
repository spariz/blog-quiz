<?php
session_start();
include 'db.php';
?>

<h2>Login</h2>
<form action="" method="POST">
    <input type="text" name="username" placeholder="Username or Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>

<?php
if (isset($_POST['login'])) {
    $usernameOrEmail = trim($_POST['username']);
    $password = $_POST['password'];

    // Find user by username or email
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            // Password matches, login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: admin/dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            echo "<p style='color:red;'>Invalid password.</p>";
        }
    } else {
        echo "<p style='color:red;'>User not found.</p>";
    }
}
?>
