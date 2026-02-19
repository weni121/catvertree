<?php
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


$id = $_GET['id'];
$result = $conn->query("SELECT * FROM cats_edit WHERE id=$id");
$row = $result->fetch_assoc();

if(isset($_POST['update'])){

    $name_th = $_POST['name_th'];
    $name_en = $_POST['name_en'];
    $description = $_POST['description'];
    $characteristics = $_POST['characteristics'];
    $care = $_POST['care'];
    $is_visible = $_POST['is_visible'];

    if($_FILES['image']['name'] != ""){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$image);
    } else {
        $image = $row['image_url'];
    }

    $sql = "UPDATE CatBreeds_API SET
        name_th='$name_th',
        name_en='$name_en',
        description='$description',
        characteristics='$characteristics',
        care_instructions='$care',
        image_url='$image',
        is_visible='$is_visible'
        WHERE id=$id";

    $conn->query($sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>แก้ไขข้อมูล</title>
<style>
body{
    font-family:Segoe UI;
    background:linear-gradient(135deg,#e6ccff,#ffcce6);
}
.container{
    width:600px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:20px;
}
input,textarea,select{
    width:100%;
    padding:8px;
    margin:8px 0;
}
button{
    background:#ff99cc;
    color:white;
    padding:10px 20px;
    border:none;
    border-radius:20px;
}
img{
    width:120px;
    border-radius:10px;
}
</style>
</head>
<body>

<div class="container">
<h2>แก้ไขสายพันธุ์</h2>

<form method="post" enctype="multipart/form-data">

ชื่อไทย
<input type="text" name="name_th" value="<?php echo $row['name_th']; ?>">

ชื่ออังกฤษ
<input type="text" name="name_en" value="<?php echo $row['name_en']; ?>">

รายละเอียด
<textarea name="description"><?php echo $row['description']; ?></textarea>

ลักษณะทั่วไป
<textarea name="characteristics"><?php echo $row['characteristics']; ?></textarea>

การเลี้ยงดู
<textarea name="care"><?php echo $row['care_instructions']; ?></textarea>

รูปปัจจุบัน<br>
<img src="../uploads/<?php echo $row['image_url']; ?>"><br><br>

เปลี่ยนรูป
<input type="file" name="image">

สถานะ
<select name="is_visible">
    <option value="1" <?php if($row['is_visible']==1) echo "selected"; ?>>แสดง</option>
    <option value="0" <?php if($row['is_visible']==0) echo "selected"; ?>>ซ่อน</option>
</select>

<button type="submit" name="update">อัปเดต</button>
</form>
</div>

</body>
</html>
