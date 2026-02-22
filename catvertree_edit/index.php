<?php
include "config.php";
$sql = "
SELECT c.*, 
       (SELECT image_name FROM cat_images 
        WHERE cat_id = c.id 
        LIMIT 1) AS image
FROM cats_edit c
WHERE c.is_visible = 1
";

$result = $conn->query($sql);?>
<?php include 'header.php'; ?>

<h1>🐾 สายพันธุ์แมวยอดนิยม 🐾</h1>

<div class="container">
<?php while($row = $result->fetch_assoc()): ?>
    <div class="card">
    <img src="uploads/<?php echo $row['image']; ?>" class="card-img">        
    <div class="card-content">
            <h2><?php echo $row['name_th']; ?></h2>
            <p><?php echo mb_substr($row['description'],0,100); ?>...</p>
            <a class="btn" href="detail.php?id=<?php echo $row['id']; ?>">ดูรายละเอียด</a>
        </div>
    </div>
<?php endwhile; ?>
</div>


<?php include 'footer.php'; ?>