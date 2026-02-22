<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include(__DIR__ . '/../config.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['admin_id'];

/* ดึงข้อมูล admin */
$stmt = $conn->prepare("SELECT username, name, email FROM admins WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($username_db, $name_db, $email_db);
$stmt->fetch();
$stmt->close();

/* อัปเดตข้อมูล */
if (isset($_POST['update'])) {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $new_password = $_POST['password'];

    if (!empty($new_password)) {

        $hashed = password_hash($new_password, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE admins SET username=?, name=?, email=?, password=? WHERE id=?");
        $update->bind_param("ssssi", $username, $name, $email, $hashed, $id);

    } else {

        $update = $conn->prepare("UPDATE admins SET username=?, name=?, email=? WHERE id=?");
        $update->bind_param("sssi", $username, $name, $email, $id);
    }

    $update->execute();
    $update->close();

    echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location='profile.php';</script>";
    exit();
}
?>

<?php include 'header.php'; ?>

<h2 style="text-align:center;">แก้ไขโปรไฟล์ผู้ดูแล</h2>

<div class="form-wrapper">

<form method="POST">

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username_db; ?>" required>
    </div>

    <div class="form-group">
        <label>ชื่อจริง</label>
        <input type="text" name="name" value="<?php echo $name_db; ?>" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email_db; ?>" required>
    </div>

    <div class="form-group">
        <label>เปลี่ยนรหัสผ่าน (ถ้าไม่เปลี่ยน ปล่อยว่างไว้)</label>
        <input type="password" name="password">
    </div>

    <div class="form-actions">
        <button type="submit" name="update" class="btn">บันทึก</button>
    </div>

</form>

</div>

<?php include 'footer.php'; ?>