<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AfterTaste Login</title>
    <link rel="stylesheet" href="../login/login.css">
</head>
<body>
  <div class="penting">
    <div class="container">
        <div class="login-box">
            <h1>Welcome, to <span>AfterTaste</span></h1>
            <p class="subtitle">Please enter your details</p>

            <form method="POST" action="../actions/auth/register.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="login" class="login-btn">Login</button>
            </form>

            <div class="links">
                <a href="#">Dont Have An account?</a>
                <a href="#">Forgot Your Password?</a>
            </div>

            <div class="divider">
                <span>Or</span>
            </div>

            <button class="google-btn">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Gmail"> 
                Log in with Gmail
            </button>

            <button class="apple-btn">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple"> 
                Log in with Apple
            </button>
        </div>

        <div class="image-box">
          <img src="../buat aku gambar hambar/top-view-delicious-healthy-food.jpg" alt="">
        </div>
    </div>
    </div>
</body>
</html>
