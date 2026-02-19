<?php
include "config.php";

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM cats_edit WHERE id = $id");
$row = $result->fetch_assoc();


$images = $conn->query("SELECT * FROM cat_images WHERE cat_id = $id");?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['name_th']; ?></title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e6ffcc, #e2ffcc);
        }

        h1 {
            text-align: center;
            padding: 30px;
            color: #036c8c;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            background: white;
            width: 280px;
            margin: 20px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
        }

        .card h2 {
            color: #00b3aa;
            margin: 0 0 10px 0;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: linear-gradient(45deg, #99fff0, #02c1b7);
            color: white;
            text-decoration: none;
            border-radius: 20px;
            transition: 0.3s;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php">🐾 กลับหน้าหลัก</a>
</div>

<div class="container">
    <h1><?php echo $row['name_th']; ?> (<?php echo $row['name_en']; ?>)</h1>

    <?php while($img = $images->fetch_assoc()): ?>
    <img src="uploads/<?php echo $img['image_name']; ?>" width="300">
<?php endwhile; ?>

    <h3>รายละเอียด</h3>
    <p><?php echo $row['description']; ?></p>

    <h3>ลักษณะทั่วไป</h3>
    <p><?php echo $row['characteristics']; ?></p>

    <h3>การเลี้ยงดู</h3>
    <p><?php echo $row['care_instructions']; ?></p>

    <a class="back-btn" href="index.php">← กลับหน้าหลัก</a>
</div>

</body>
</html>
