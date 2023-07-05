<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="./CSS/register.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- include jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
      <input type="checkbox" id="flip" />
      <div class="cover">
        <div class="front">
          <div class="text">
            <span class="text-1">Menabung Dari Muda<br />Untuk Masa Tua</span>
            <span class="text-2">......</span>
          </div>
        </div>
        <div class="back">
          <!-- <img class="backImg" src="images/backImg.jpg" alt=""> -->
          <div class="text">
            <span class="text-1">1000 Mil Jauhnya <br />Dimulai Dari Langkah Pertama</span>
            <span class="text-2">Let's get started</span>
          </div>
        </div>
      </div>
      <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Masuk</div>
            <!-- Konten form login -->
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input
                  type="text"
                  placeholder="Masukan Email"
                  id="email-input-login"
                  name="email"
                  required
                />
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input
                  type="password"
                  placeholder="Masukan kata sandi"
                  id="password-input-login"
                  name="password"
                  required
                />
                <button
                  type="button"
                  id="password-toggle-btn-login"
                  onclick="togglePasswordVisibility('password-input-login', 'password-toggle-btn-login')"
                >
                  <i class="fas fa-eye"></i>
                </button>
              </div>
              <div class="text"><a href="#">Lupa kata sandi?</a></div>
              <div class="button input-box">
                <input type="submit" value="Masuk" id="login-button" />
              </div>
              <div class="text sign-up-text">
                Belum memiliki akun? <label for="flip">Daftar sekarang</label>
              </div>
            </div>
          </div>
          <div class="signup-form">
            <div class="title">Daftar Akun</div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input
                  type="text"
                  placeholder="Masukan nama Anda"
                  id="name-input"
                  name="name"
                  required
                />
                <div id="msg" class="form-group"></div>
                <script>
$(document).ready(function() {
  $("#name-input").blur(function(e) {
    var uname = $(this).val();
    if (uname == "") {
      $("#msg").html("");
      $("#register-button").attr("disabled", true);
    } else {
      $("#msg").html("checking...");
      $.ajax({
        url: "./PHP/check_username.php",
        data: {username: uname},
        type: "POST",
        success: function(data) {
          if(data > '0') {
            $("#msg").html('<span class="text-danger">Username is already taken!</span>');
            $("#register-button").attr("disabled", true);
          } else {
            $("#msg").html('<span class="text-success">Username is available!</span>');
            $("#register-button").attr("disabled", false);
          }
        }
      });
    }
  });
});

</script>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input
                  type="text"
                  placeholder="Masukan email Anda"
                  id="email-input-register"
                  name="email"
                  required
                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                  oninvalid="this.setCustomValidity('Masukan email yang valid')"
                  onchange="this.setCustomValidity('')"
                />
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input
                  type="password"
                  placeholder="Masukan password"
                  id="password-input-register"
                  name="password"
                  required
                />
                <button
                  type="button"
                  id="password-toggle-btn-register"
                  onclick="togglePasswordVisibility('password-input-register', 'password-toggle-btn-register')"
                >
                  <i class="fas fa-eye"></i>
                </button>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input
                  type="password"
                  placeholder="Masukan ulang password"
                  id="confirm-password-input"
                  name="confirm_password"
                  required
                />
                <button
                  type="button"
                  id="confirm-password-toggle-btn"
                  onclick="togglePasswordVisibility('confirm-password-input', 'confirm-password-toggle-btn')"
                >
                  <i class="fas fa-eye"></i>
                </button>
              </div>
              <div class="button input-box">
                <input type="submit" value="Daftar" id="register-button" />
              </div>
              <div class="text sign-up-text">
                Sudah memiliki akun? <label for="flip">Masuk sekarang</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
    <script>
      document.getElementById("register-button").addEventListener("click", function(event) {
        event.preventDefault(); // Menghentikan pengiriman form secara default

        // Lakukan validasi form di sini
        // ...

        // Jika semua validasi sukses, alihkan ke halaman dashboard.html
        window.location.href = "dashboard.html";
      });
    </script>




  </body>
</html>
