<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Form Pendaftaran </title>
    <link rel="stylesheet" href="./CSS/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="images/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Menabung Dari Muda<br> Untuk Masa Tua</span>
          <span class="text-2">......</span>
          
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="images/backImg.jpg" alt="">
        <div class="text">
          <span class="text-1">1000 Mil Jauhnya <br> Dimulai Dari Langkah Pertama</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
<div class="forms">
  <div class="form-content">
    <div class="login-form">
      <div class="title">Masuk</div>
      <form action="#">
        <div class="input-boxes">
          <div class="input-box">
            <i class="fas fa-envelope"></i>
            <input type="text" placeholder="Masukan Email" id="email-input" required>
          </div>
          <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Masukan kata sandi" id="password-input" required>
            <button type="button" id="password-toggle-btn" onclick="togglePasswordVisibility('password-input', 'password-toggle-btn')">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <div class="text"><a href="#">Lupa kata sandi?</a></div>
          <div class="button input-box">
            <input type="submit" value="Masuk" id="login-button">
          </div>
          <div class="text sign-up-text">Belum memiliki akun? <label for="flip">Daftar sekarang</label></div>
        </div>
      </form>
    </div>
    <div class="signup-form">
      <div class="title">Daftar Akun</div>
      <form action="#">
        <div class="input-boxes">
          <div class="input-box">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Masukan nama Anda" id="name-input" required>
          </div>
          <div class="input-box">
            <i class="fas fa-envelope"></i>
            <input type="text" placeholder="Masukan email Anda" id="email-input" required>
          </div>
          <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Masukan password" id="password-input" required>
            <button type="button" id="password-toggle-btn" onclick="togglePasswordVisibility('password-input', 'password-toggle-btn')">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Masukan ulang password" id="confirm-password-input" required>
            <button type="button" id="confirm-password-toggle-btn" onclick="togglePasswordVisibility('confirm-password-input', 'confirm-password-toggle-btn')">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <div class="button input-box">
            <input type="submit" value="Daftar" id="register-button">
          </div>
          <div class="text sign-up-text">Sudah memiliki akun? <label for="flip">Masuk sekarang</label></div>
        </div>
      </form>
    </div>
  </div>
</div>
    </div>
    </div>
    </div>
  </div>
</body>

<script>

function togglePasswordVisibility(inputId, buttonId) {
  const passwordInput = document.getElementById(inputId);
  const passwordToggleBtn = document.getElementById(buttonId);
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordToggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
  } else {
    passwordInput.type = "password";
    passwordToggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
  }
}
</script>
</html>