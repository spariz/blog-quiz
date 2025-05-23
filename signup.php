<?php
session_start();
?>

<?php include 'db.php'; ?>

<h2>Sign Up</h2>
<form action="" method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" name="signup">Register</button>
</form>

<?php
if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Check if username or email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<p style='color:red;'>Username or email already exists.</p>";
    } else {
        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Signup successful. You can now <a href='login.php'>log in</a>.</p>";
        } else {
            echo "<p style='color:red;'>Signup failed. Please try again.</p>";
        }
    }
}
?>
