<?php
include "../config.php";
$result = $conn->query("SELECT * FROM cats_edit");
?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin - จัดการสายพันธุ์แมว</title>

</head>
<body>

<div class="header">

</div>
<center>
<div class="container">
<a class="btn add" href="add.php">+ เพิ่มสายพันธุ์</a>

<table>
<tr>
 
    <th>รูป</th>
    <th>ชื่อ</th>
    <th>สถานะ</th>
    <th>จัดการ</th>

</tr>
</center>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td>
        <img src="../uploads/<?php echo $row['image']; ?>" width="100">
    </td>
    <td>
        <?php echo $row['name_th']; ?>
    </td>
    <td>
        <?php echo $row['is_visible'] ? "แสดง" : "ซ่อน"; ?>
    </td>
    <td>
        <a class="btn edit" href="edit.php?id=<?php echo $row['id']; ?>">แก้ไข</a>
        <a class="btn delete" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
        <a class="btn toggle" href="toggle.php?id=<?php echo $row['id']; ?>">เปลี่ยนสถานะ</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</div>

</body>
</html>
<?php include 'footer.php'; ?>
