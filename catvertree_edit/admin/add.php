
<?php
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name_th = $_POST['name_th'];
    $name_en = $_POST['name_en'];
    $description = $_POST['description'];
    $characteristics = $_POST['characteristics'];
    $care = $_POST['care'];
    $is_visible = $_POST['is_visible'];

    // =========================
    // 1️⃣ INSERT แมว
    // =========================
    $stmt = $conn->prepare("INSERT INTO cats_edit (name_th, name_en, description, characteristics, care, is_visible) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssi",
        $name_th,
        $name_en,
        $description,
        $characteristics,
        $care,
        $is_visible
    );

    if ($stmt->execute()) {

        $cat_id = $conn->insert_id;
        $stmt->close();

        // =========================
        // 2️⃣ อัปโหลดรูป (หลายรูป)
        // =========================

        if (!empty($_FILES['image']['name'][0])) {

            $uploadDir = __DIR__ . "/../uploads/";

            if (!is_dir($uploadDir)) {
                die("Uploads folder not found.");
            }

            foreach ($_FILES['image']['name'] as $key => $name) {

                if (!empty($name)) {

                    $tmp = $_FILES['image']['tmp_name'][$key];

                    $safeName = preg_replace("/[^a-zA-Z0-9\._-]/", "", $name);
                    $newName = time() . "_" . uniqid() . "_" . $safeName;

                    $targetPath = $uploadDir . $newName;

                    if (move_uploaded_file($tmp, $targetPath)) {

                        $stmtImg = $conn->prepare("
                            INSERT INTO cat_images (cat_id, image_name)
                            VALUES (?, ?)
                        ");

                        $stmtImg->bind_param("is", $cat_id, $newName);
                        $stmtImg->execute();
                        $stmtImg->close();
                    }
                }
            }
        }

        header("Location: index.php");
        exit();

    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }
}
?>

<?php include 'header.php'; ?>

<div class="container">
<h2>เพิ่มสายพันธุ์แมว</h2>

<form method="post" enctype="multipart/form-data">

ชื่อไทย
<input type="text" name="name_th" required>

ชื่ออังกฤษ
<input type="text" name="name_en">

รายละเอียด
<textarea name="description"></textarea>

ลักษณะทั่วไป
<textarea name="characteristics"></textarea>

การเลี้ยงดู
<textarea name="care"></textarea>

รูปภาพ
<input type="file" name="image[]" multiple>

สถานะ
<select name="is_visible">
    <option value="1">แสดง</option>
    <option value="0">ซ่อน</option>
</select>

<button type="submit">บันทึก</button>
</form>
</div>

<?php include 'footer.php'; ?>
