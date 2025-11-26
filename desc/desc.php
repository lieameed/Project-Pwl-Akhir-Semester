<?php
require_once '../config/db-connections.php';

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM makanan WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $card = $result->fetch_assoc();
    $name = htmlspecialchars($card['nama_makanan']);
    $desc = htmlspecialchars($card['deskripsi']);
    $img = $card['gambar'];
} else {
    echo "Resep tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= $name ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #ffffff;
      font-family: "Inter", sans-serif;
      overflow-x: hidden;
      height: 100vh;
    }

    #back {
      position: absolute;
      top: 30px;
      left: 40px;
      font-size: 35px;
      color: #f18860;
      transition: 0.2s ease;
    }
    #back:hover {
      color: black;
      cursor: pointer;
    }

    .container {
      position: relative;
      width: 100%;
      height: 100vh;
    }

    .emg {
      position: absolute;
      top: 100px;
      left: 120px;
      width: 700px;
      height: 700px;
      object-fit: cover;
      border-radius: 80px;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.3);
    }

    h1 {
      position: absolute;
      top: 180px;
      left: 900px;
      color: #f18860;
      font-size: 90px;
      font-weight: 800;
      line-height: 1.1;
    }

    .line {
      position: absolute;
      top: 400px;
      left: 900px;
      width: 500px;
      height: 4px;
      background-color: #f18860;
    }

    h3 {
      position: absolute;
      top: 460px;
      left: 900px;
      color: #f18860;
      font-size: 70px;
      font-weight: 700;
    }

    .makan {
      position: absolute;
      top: 550px;
      left: 900px;
      color: #f18860;
      font-size: 30px;
      list-style-type: disc;
      line-height: 1.8;
    }

    .makan li {
      margin-bottom: 10px;
    }

    .tombl input {
      position: absolute;
      top: 850px;
      left: 1250px;
      background: #f18860;
      color: #ffffff;
      font-family: "Inter", sans-serif;
      border: none;
      font-weight: bold;
      border-radius: 50px;
      width: 300px;
      height: 100px;
      font-size: 30px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.45);
      border-color: rgba(0, 0, 0, 0.45);
      transition: 0.2s ease;
    }

    .tombl input:hover {
      background-color: white;
      color: #f18860;
      border: solid 2px #f18860;
      transform: scale(1.05);
      cursor: pointer;
    }
  </style>
</head>

<body>
  <a href="../homepage/index.php"><i class="fa-solid fa-arrow-left" id="back"></i></a>

  <div class="container">
    <img src="../<?= $img ?>" alt="<?= $name ?>" class="emg">

    <h1><b><?= nl2br($name) ?></b></h1>
    <div class="line"></div>
    <h3>Ingredients:</h3>
    <ul class="makan">
      <?php
      $lines = explode("\n", $desc);
      foreach ($lines as $line) {
        if (trim($line) !== "") {
          echo "<li>" . trim($line) . "</li>";
        }
      }
      ?>
    </ul>

    <div class="tombl">
      <input type="button" value="TRY NOW!">
    </div>
  </div>
</body>
</html>
