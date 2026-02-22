<?php
include "../config.php";
$result = $conn->query("SELECT * FROM cats_edit");
?>

<?php include 'header.php'; ?>

<h1 style="text-align:center;">จัดการสายพันธุ์แมว</h1>

<div style="text-align:center; margin-bottom:20px;">
    <a class="btn" href="add.php">+ เพิ่มสายพันธุ์</a>
</div>

<table style="width:100%; border-collapse: collapse; text-align:center;">
<tr style="background:#e0f7fa;">
    <th style="padding:10px;">รูป</th>
    <th>ชื่อ</th>
    <th>สถานะ</th>
    <th>จัดการ</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr style="border-bottom:1px solid #eee;">
    <td style="padding:10px;">
        <?php
        $imgResult = $conn->query("
            SELECT image_name 
            FROM cat_images 
            WHERE cat_id = {$row['id']} 
            LIMIT 1
        ");
        $img = $imgResult->fetch_assoc();

        if($img){
            echo '<img src="../uploads/'.$img['image_name'].'" width="100" style="border-radius:10px;">';
        }else{
            echo 'ไม่มีรูป';
        }
        ?>
    </td>

    <td><?php echo $row['name_th']; ?></td>

    <td>
        <?php echo $row['is_visible'] ? "แสดง" : "ซ่อน"; ?>
    </td>

    <td>
        <a class="btn" href="edit.php?id=<?php echo $row['id']; ?>">แก้ไข</a>
        <a class="btn" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
        <a class="btn" href="toggle.php?id=<?php echo $row['id']; ?>">เปลี่ยนสถานะ</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<?php include 'footer.php'; ?>