<?php
require_once '../config/db-connections.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['name'];
    $desc = $_POST['desc'];

    // Upload gambar
    $targetDir = "../posts/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowedTypes = array('jpg','jpeg','png','gif');
    if(in_array(strtolower($fileType), $allowedTypes)) {
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $sql = "INSERT INTO makanan (nama_makanan, deskripsi, gambar) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("sss", $nama, $desc, $targetFilePath);
            if($stmt->execute()) {
                echo "<script>alert('Resep berhasil diupload!'); window.location='../index.php';</script>";
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }
        } else {
            echo "<p>Gagal upload gambar.</p>";
        }
    } else {
        echo "<p>Format gambar tidak didukung. (Gunakan JPG, PNG, GIF)</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Recipes</title>
  <link rel="stylesheet" href="upload.css">
</head>
<body>
  <div class="container">
    <a href="../index.php" class="back">&#8592;</a>
    <h1>Add Recipes</h1>
  </div>

  <form action="" method="POST" enctype="multipart/form-data">
    <div class="kotak-kotak">
      <div>
        <label for="name">Recipe Name:</label>
        <input type="text" id="name" name="name" placeholder="Insert recipe name" required>

        <label for="desc">Description:</label>
        <textarea id="desc" name="desc" rows="8" placeholder="Add the recipe information..." required></textarea>
      </div>

      <div>
        <label>Attach Image</label>
        <input type="file" name="image" accept="image/*" required>
      </div>
    </div>

    <button type="submit" class="upload-button">UPLOAD</button>
  </form>
</body>
</html>
