<?php
require_once '../config/db-connections.php';

$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? 'all';

if (!empty($search)) {
    $sql = "SELECT * FROM makanan WHERE nama_makanan LIKE ? OR deskripsi LIKE ?";
    $stmt = $connection->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

} else {
    if ($filter === "all") {
        $sql = "SELECT * FROM makanan";
        $result = $connection->query($sql);
    } else {
        $sql = "SELECT * FROM makanan WHERE deskripsi = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $filter);
        $stmt->execute();
        $result = $stmt->get_result();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>After Taste</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="../hompage/homepage.css">
    
  <style>
  nav.category {
    display: flex;
    justify-content: space-evenly;
    flex-wrap: wrap;
    padding: 10px 0;
    margin-right: 6px;
    margin-left: 4px;
  }

    .filterable-item.hide {
    display: none;
}

    .category button.filter-btn {
      background-color: #f1f1f1;
      border: 1px solid #ddd;
      padding: 8px 10px;
      margin: 2px;
      font-size: 14px;
      cursor: pointer;
      border-radius: 20px;
      font-family: Arial, sans-serif;
      transition: background-color 0.3s;
}

    .category button.filter-btn {
      background-color: #f18860;
      color: #ffffff;
      border: 1px solid #f18860;
      padding: 8px 10px;
      margin: 2px;
      font-size: 14px;
      cursor: pointer;
      border-radius: 20px;
      font-family: 'Inter', sans-serif;
      transition: background-color 0.3s;
}

    .category button.filter-btn:hover {
      background-color: #e67e55;
      border-color: #e67e55;
}

    .category button.filter-btn.active {
      background-color: #d9704c; 
      color: white;
      border-color: #d9704c;
}
    .makananberat .filterable-item {
      display: inline-block; 
      transition: 0.3s ease;
}

a.card {
    text-decoration: none !important;
    color: inherit !important;
}

a.card:hover {
    text-decoration: none !important;
}

.card-wrapper {
    position: relative;
    display: inline-block
    list-style-type: none !important;
}

.fav-btn {
    border: none;
    background: none;
    padding: 0;
    margin: 0;
    position: absolute;
    top: 15px;
    right: 15px;
    cursor: pointer;
    overflow: hidden;
    line-height: 0;
}

.fav-btn:focus {
    outline: none;
}

.fav-btn .fa-heart {
    transition: 0.2s ease;
    overflow: hidden;
}

.fav-btn.active .fa-heart {
    color: red;
    overflow: hidden;
}

.fav-btn i {
    font-size: 28px;
    color: #f18860;
}

</style>

</head>
<body>
  <header>
  <img src="../misc/logo.svg" class="logo">
<div class="searchbar">
  <form method="GET" action="index.php">
    <input type="text" name="search" placeholder="Want to find something?"
           value="<?php echo htmlspecialchars($search); ?>">
  </form>
</div>

  <div class="buttons">
    <a href="../profile/profilepage.php"><i class="fa-solid fa-circle-user"></i></a>
  </div>

  </header>

  <nav class="navbar">
  <div class="nav-left">
  <a href="../homepage/index.html"><i class="fa fa-home"></i> Home</a>
  <a href="../aboutus/aboutus.html"><i class="fa fa-user-group"></i> About Us</a>
  <a href="../contact/contact.html"><i class="fa fa-phone"></i> Contacts</a>
  <a href="#"><i class="fa fa-circle-question"></i> FAQ</a>
  </div>

  <div class="nav-right">
  <a href="../upload/index.php"><i class="fa fa-plus-circle"></i> Upload</a>
  <a href="../fav/faporit.html"><i class="fa fa-bookmark"></i> Favorite</a>
  </div>
  </nav>

<?php if (empty($search)): ?>
  <div class="paren">
  <img src="../foto/Group 10.svg" alt="" class="gambarutama">
  </div>

<nav class="category">
  <a href="index.php?filter=all" class="filter-btn <?php if($filter === 'all') echo 'active'; ?>">Show All</a>
  <a href="index.php?filter=trending" class="filter-btn <?php if($filter === 'trending') echo 'active'; ?>">Trending Right Now</a>
  <a href="index.php?filter=traditional" class="filter-btn <?php if($filter === 'traditional') echo 'active'; ?>">Traditional Food</a>
  <a href="index.php?filter=heavy-meal" class="filter-btn <?php if($filter === 'heavy-meal') echo 'active'; ?>">Heavy Meal</a>
  <a href="index.php?filter=appetizer" class="filter-btn <?php if($filter === 'appetizer') echo 'active'; ?>">Appetizer</a>
  <a href="index.php?filter=beverage" class="filter-btn <?php if($filter === 'beverage') echo 'active'; ?>">Beverage</a>
  <a href="index.php?filter=dessert" class="filter-btn <?php if($filter === 'dessert') echo 'active'; ?>">Dessert</a>
  <a href="index.php?filter=snack" class="filter-btn <?php if($filter === 'snack') echo 'active'; ?>">Snack</a>
</nav>


<?php if ($filter === 'all' || $filter === 'trending'): ?>
  <h2 class="tulisan">Most Popular Lately</h2>
  <div class="mango">
  <a href="../desc/desc1.html"><img src="/foto/cheesecake.png" alt=""></a>
  <div class="mangotulisan"><h1>Manggo CheeseCake</h1>
  <div class="gambarkecil"><img src="/foto/cheesecakeoren.jpg" alt="">
  <img src="/foto/cheesecakecoklat.jpg" alt="">
  </div>
  </div>
  </div>
<?php endif; ?>

<?php if ($filter === 'all' || $filter === 'traditional'): ?>
  <h2 class="tulisan">Indonesian Cuisine</h2>
  <div class="mango">
   <img src="/foto/nasikuning.jpg" alt="">
  <div class="mangotulisan"><h1>Nasi Kuning</h1>
  <div class="gambarkecil"><img src="/foto/sayurasam.jpg" alt="">
   <img src="/foto/ketupat.jpg" alt="">
</div>
</div>
</div>
<?php endif; ?>

<?php if ($filter === 'all' || $filter === 'heavy-meal'): ?>
  <h2 class="tulisan">Makanan Berat</h2>
  <div class="makananberat">
   <img src="/foto/d06e5932-676a-4da9-af49-b2c2a7225954.jpg" alt="">
   <img src="/foto/2d1d7a7d-778a-49e6-a20f-e5b226682f3e.jpg" alt="">
   <img src="/foto/5ffe5d0f-d941-4ad1-97ef-d8c593e72a9a.jpg" alt="">
   <img src="/foto/ee6c53ae-493a-4304-b91d-6cf6f00459ad.jpg" alt="">
  <img src="/foto/26e8398d-35de-444b-9f62-b1b80342e878.jpg" alt="">
</div>
<?php endif; ?>

<?php if ($filter === 'all' || $filter === 'appetizer'): ?>
  <h2 class="tulisan">Makanan Pembuka</h2>
   <div class="makananberat">
    <img src="/foto/7e7c993a-ee12-4ec6-93d8-3d52e68720d4.jpg" alt="">
    <img src="/foto/5af7ff3a-4d1d-4a00-a6ac-184abad88231.jpg" alt="">
    <img src="/foto/7c2b304e-460b-4545-a920-1f2f77fc0353.jpg" alt="">
    <img src="/foto/e47f9fbc-54f4-4eb5-bfca-e10c46a1be9d.jpg" alt="">
    <img src="/foto/2d88cdd8-93d6-4bfb-9f92-1558be27805d.jpg" alt="">
   </div>
<?php endif; ?>

<?php endif; ?>

<h2 class="tulisan">Community Creation:</h2>
<div class="makananberat">
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = htmlspecialchars($row['nama_makanan']);
        $desc = htmlspecialchars($row['deskripsi']);
        $img = $row['gambar'];

        $words = explode(' ', $desc);
        $shortDesc = implode(' ', array_slice($words, 0, 15)) . (count($words) > 15 ? '...' : '');
        
echo '<div class="card-wrapper">';

echo '<button class="fav-btn" data-id="' . $id . '">
        <i class="fa-regular fa-heart"></i>
      </button>';

echo '<a href="../desc/desc.php?id=' . $id . '" class="card">';
echo '<img src="' . $img . '" alt="' . $name . '">';
echo '<h3>' . $name . '</h3>';
echo '<p>' . $shortDesc . '</p>';
echo '</a>';

echo '</div>';
    }
} else {
    echo "<p>Belum ada resep yang diupload.</p>";
}
?>
</div>


  <footer>
    <div class="footer-container">
    <div class="footer-left">
    <img src="../misc/logo.svg" class="logo">
    <p>Aftertaste is where flavors linger. Discover recipes that stay with you long after the last bite</p>
  </div>

  <div class="footer-column">
    <h3>Legal</h3>
    <ul>
      <li><a href="#">Privacy Policy</a></li>
      <li><a href="#">Terms & Conditions</a></li>
      <li><a href="#">Cookie Policy</a></li>
      <li><a href="#">Disclaimer</a></li>

  </div>

  <div class="footer-column">
    <h3>Quick Links</h3>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Services</a></li>
    </ul>
    </div>

  <div class="footer-column">
    <h3>Help</h3>
    <ul>
      <li><a href="#">FAQ</a></li>
      <li><a href="#">How to Use the App</a></li>
      <li><a href="#">Contact Support</a></li>
    </ul>
  </div>

  <div class="footer-column">
    <h3>Follow Us</h3>
    <ul>
      <li><a href="#">Instagram</a></li>
      <li><a href="#">Youtube</a></li>
      <li><a href="#">Facebook</a></li>
    </ul>


<script>
document.querySelectorAll('.fav-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        const icon = this.querySelector('i');

        icon.classList.toggle('fa-regular');
        icon.classList.toggle('fa-solid');
        this.classList.toggle('active');

        fetch('actions/auth/favorite.php', {
            method: 'POST',
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "id=" + id
        });
    });
});
</script>

</div>
</div>
</footer>

</body>
</html>

