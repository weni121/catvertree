<?php
session_start();
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

    /* 1️⃣ เพิ่มแมว */
    $stmt = $conn->prepare("
        INSERT INTO cats_edit 
        (name_th, name_en, description, characteristics, care, is_visible) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");

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

        /* 2️⃣ อัปโหลดหลายรูป */
        if (!empty($_FILES['image']['name'][0])) {

            $uploadDir = __DIR__ . "/../uploads/";

            foreach ($_FILES['image']['name'] as $key => $name) {

                if (!empty($name)) {

                    $tmp = $_FILES['image']['tmp_name'][$key];

                    $safeName = preg_replace("/[^a-zA-Z0-9\._-]/", "", $name);
                    $newName = time() . "_" . uniqid() . "_" . $safeName;

                    if (move_uploaded_file($tmp, $uploadDir . $newName)) {

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

<h2 style="text-align:center;">เพิ่มสายพันธุ์แมว</h2>

<div class="form-wrapper">
<form method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>ชื่อไทย</label>
        <input type="text" name="name_th" required>
    </div>

    <div class="form-group">
        <label>ชื่ออังกฤษ</label>
        <input type="text" name="name_en">
    </div>

    <div class="form-group">
        <label>รายละเอียด</label>
        <textarea name="description"></textarea>
    </div>

    <div class="form-group">
        <label>ลักษณะทั่วไป</label>
        <textarea name="characteristics"></textarea>
    </div>

    <div class="form-group">
        <label>การเลี้ยงดู</label>
        <textarea name="care"></textarea>
    </div>

    <div class="form-group">
        <label>รูปภาพ (เลือกได้หลายรูป)</label>
        <input type="file" name="image[]" multiple>
    </div>

    <div class="form-group">
        <label>สถานะ</label>
        <select name="is_visible">
            <option value="1">แสดง</option>
            <option value="0">ซ่อน</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn">บันทึก</button>
    </div>

</form>
</div>

<?php include 'footer.php'; ?>