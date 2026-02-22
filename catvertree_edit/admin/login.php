<?php include '../config.php'; ?>
<?php include 'header.php'; ?>

<h2>Admin Login</h2>

<form method="POST" action="check_login.php" style="text-align:center;">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" class="btn">Login</button>
</form>
<?php
if (password_verify($password, $row['password'])) {
    $_SESSION['admin_id'] = $row['id'];
}
?>

<?php include 'footer.php'; ?>
