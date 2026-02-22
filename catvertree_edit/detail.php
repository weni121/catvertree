<?php
include "config.php";

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM cats_edit WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt2 = $conn->prepare("SELECT * FROM cat_images WHERE cat_id = ?");
$stmt2->bind_param("i", $id);
$stmt2->execute();
$images = $stmt2->get_result();
?>
<?php include 'header.php'; ?>

<div class="navbar">
    <a href="index.php">🐾 กลับหน้าหลัก</a>
</div>


    <h1><?php echo $row['name_th']; ?> (<?php echo $row['name_en']; ?>)</h1>

    <div class="cat-gallery">
    <?php while($img = $images->fetch_assoc()): ?>
        <img src="uploads/<?php echo $img['image_name']; ?>" class="cat-img">
    <?php endwhile; ?>
    </div>

    <h3>รายละเอียด</h3>
    <p><?php echo $row['description']; ?></p>

    <h3>ลักษณะทั่วไป</h3>
    <p><?php echo $row['characteristics']; ?></p>

    <h3>การเลี้ยงดู</h3>
    <p><?php echo $row['care']; ?></p>

    <a class="back-btn" href="index.php">← กลับหน้าหลัก</a>


<?php include 'footer.php'; ?>