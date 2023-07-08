      // Toggle password visibility
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
      $(document).ready(function () {
        // Login form submission
        $("#login-button").click(function (e) {
          e.preventDefault();
          var email = $("#email-input-login").val();
          var password = $("#password-input-login").val();
          $.post("./PHP/login-process.php", {
            email: email,
            password: password,
          }).done(function (data) {
            if (data == 1) {
              $("#login-form").submit();
              window.location.href = "./dashboard.html";
            } else {
              $("#msg-login").html(
                '<span class="text-danger">Email atau kata sandi salah!</span>'
              );
            }
          });
        });

        // Registration form validation
        $("#name-input").blur(function (e) {
          var uname = $(this).val();
          if (uname == "") {
            $("#msg").html("");
            $("#register-button").attr("disabled", true);
          } else if (uname.length < 4) {
            $("#msg").html(
              '<span class="text-danger">Nama harus lebih dari 4 karakter!</span>'
            );
            $("#register-button").attr("disabled", true);
          } else {
            $("#msg").html("mengecek...");
            $.post("./PHP/check_username.php", { username: uname }).done(
              function (data) {
                if (data > "0") {
                  $("#msg").html(
                    '<span class="text-danger">Nama sudah diambil!</span>'
                  );
                  $("#register-button").attr("disabled", true);
                } else {
                  $("#msg").html(
                    '<span class="text-success">Nama tersedia!</span>'
                  );
                  $("#register-button").attr("disabled", false);
                }
              }
            );
          }
        });

        $("#email-input-register").blur(function (e) {
          var email = $(this).val();
          if (email == "") {
            $("#msg-email").html("");
            $("#register-button").attr("disabled", true);
          } else if (!isValidEmail(email)) {
            $("#msg-email").html(
              '<span class="text-danger">Email is not valid!</span>'
            );
            $("#register-button").attr("disabled", true);
          } else {
            $("#msg-email").html("mengecek...");
            $.post("./PHP/check_email.php", { email: email }).done(function (
              data
            ) {
              if (data > "0") {
                $("#msg-email").html(
                  '<span class="text-danger">Email is already taken!</span>'
                );
                $("#register-button").attr("disabled", true);
              } else {
                $("#msg-email").html(
                  '<span class="text-success">Email Tersedia!</span>'
                );
                $("#register-button").attr("disabled", false);
              }
            });
          }
        });

        function isValidEmail(email) {
          var emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
          return emailRegex.test(email);
        }

        // Registration form submission
        $("#register-button").click(function (event) {
          event.preventDefault();
          var name = $("#name-input").val();
          var email = $("#email-input-register").val();
          var password = $("#password-input-register").val();
          var confirm_password = $("#confirm-password-input").val();
          if (name == "" || email == "" || password == "") {
            $("#register-button").attr("disabled", true);
          }
          if (password !== confirm_password) {
            $("#msg-confirm-password").html(
              '<span class="text-danger">Password tidak sama!</span>'
            );
            return;
          } else {
            $("#msg-confirm-password").html("");
          }
          $.post("./PHP/register-process.php", {
            name: name,
            email: email,
            password: password,
          }).done(function (data) {
            alert("Registrasi berhasil!");
            window.location.href = "./dashboard.html";
          });
        });
      });