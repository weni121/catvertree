<?php
include "config.php";
$result = $conn->query("SELECT * FROM cats_edit WHERE is_visible = 1");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>สายพันธุ์แมวยอดนิยม</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #ccfffb, #ccfffc);
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

<h1>🐾 สายพันธุ์แมวยอดนิยม 🐾</h1>

<div class="container">
<?php while($row = $result->fetch_assoc()): ?>
    <div class="card">
        <img src="uploads/<?php echo $row['image']; ?>" width="100%">
        <div class="card-content">
            <h2><?php echo $row['name_th']; ?></h2>
            <p><?php echo mb_substr($row['description'],0,100); ?>...</p>
            <a class="btn" href="detail.php?id=<?php echo $row['id']; ?>">ดูรายละเอียด</a>
        </div>
    </div>
<?php endwhile; ?>
</div>

</body>
</html>
