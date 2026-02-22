<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$id = intval($_GET['id']);

/* ดึงข้อมูลเดิม */
$result = $conn->query("SELECT * FROM cats_edit WHERE id=$id");
$row = $result->fetch_assoc();

/* อัปเดตข้อมูล */
if(isset($_POST['update'])){

    $name_th = $_POST['name_th'];
    $name_en = $_POST['name_en'];
    $description = $_POST['description'];
    $characteristics = $_POST['characteristics'];
    $care = $_POST['care'];
    $is_visible = $_POST['is_visible'];

    

    $sql = "UPDATE cats_edit SET
    name_th='$name_th',
    name_en='$name_en',
    description='$description',
    characteristics='$characteristics',
    care='$care',
    is_visible='$is_visible'
    WHERE id=$id";

    $conn->query($sql);
    header("Location: index.php");
    exit();
}
?>

<?php include 'header.php'; ?>

<h2 style="text-align:center;">แก้ไขข้อมูลสายพันธุ์แมว</h2>

<div class="form-wrapper">
<form method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>ชื่อไทย</label>
        <input type="text" name="name_th" value="<?php echo $row['name_th']; ?>" required>
    </div>

    <div class="form-group">
        <label>ชื่ออังกฤษ</label>
        <input type="text" name="name_en" value="<?php echo $row['name_en']; ?>" required>
    </div>

    <div class="form-group">
        <label>รายละเอียด</label>
        <textarea name="description"><?php echo $row['description']; ?></textarea>
    </div>

    <div class="form-group">
        <label>ลักษณะทั่วไป</label>
        <textarea name="characteristics"><?php echo $row['characteristics']; ?></textarea>
    </div>

    <div class="form-group">
        <label>การเลี้ยงดู</label>
        <textarea name="care"><?php echo $row['care']; ?></textarea>
    </div>

    <div class="form-group">
        <label>เปลี่ยนรูป</label>
        <input type="file" name="image">
        <br><br>
    </div>

    <div class="form-group">
        <label>สถานะ</label>
        <select name="is_visible">
            <option value="1" <?php if($row['is_visible']==1) echo 'selected'; ?>>แสดง</option>
            <option value="0" <?php if($row['is_visible']==0) echo 'selected'; ?>>ซ่อน</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" name="update" class="btn">อัปเดต</button>
    </div>

</form>
</div>

<?php include 'footer.php'; ?>