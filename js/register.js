function openPopupAgreement() {
  document.getElementById("overlay").style.display = "flex";
}

function closePopupAgreement() {
  document.getElementById("overlay").style.display = "none";
}

function forgotPassword() {
  alert("Silahkan hubungi admin untuk reset password Anda.");
}
function disagree() {
  var checkbox = document.getElementById("agree-checkbox");
  checkbox.checked = false;
  closePopupAgreement();
  updateAgreeLabel();
}

function agree() {
  closePopupAgreement();
  updateAgreeLabel();
}

function updateAgreeLabel() {
  var checkbox = document.getElementById("agree-checkbox");
  var agreeLabel = document.querySelector(".agree-label");
  if (checkbox.checked) {
    agreeLabel.classList.add("checked");
  } else {
    agreeLabel.classList.remove("checked");
  }
}

// Fungsi untuk memeriksa apakah checkbox "Syarat dan Ketentuan" sudah dicentang
function checkAgreement() {
  var checkbox = document.getElementById("agree-checkbox");
  var registerButton = document.getElementById("register-button");
  if (checkbox.checked) {
    registerButton.disabled = false;
  } else {
    registerButton.disabled = true;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  // Event listener untuk checkbox "Syarat dan Ketentuan"
  var checkbox = document.getElementById("agree-checkbox");
  checkbox.addEventListener("change", function () {
    updateAgreeLabel();
    checkAgreement();
    if (this.checked) {
      openPopupAgreement();
    } else {
      closePopupAgreement();
    }
  });

  // Event listener untuk teks "Syarat dan Ketentuan"
  var termsLink = document.querySelector(".agree-label");
  termsLink.addEventListener("click", function (event) {
    event.preventDefault();
    openPopupAgreement();
  });
});
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
    } else if (uname.indexOf(" ") >= 0) {
      $("#msg").html(
        '<span class="text-danger">Nama tidak boleh mengandung spasi!</span>'
      );
      $("#register-button").attr("disabled", true);
    }
    else if (uname.match(/[^a-zA-Z0-9\-\/]/)) {
      $("#msg").html(
        '<span class="text-danger">Nama tidak boleh mengandung karakter spesial!</span>'
      );
      $("#register-button").attr("disabled", true);
    } else {
      $("#msg").html("mengecek...");
      $.post("./PHP/check_username.php", { username: uname }).done(function (
        data
      ) {
        if (data > "0") {
          $("#msg").html(
            '<span class="text-danger">Nama sudah diambil!</span>'
          );
          $("#register-button").attr("disabled", true);
        } else {
          $("#msg").html('<span class="text-success">Nama tersedia!</span>');
          $("#register-button").attr("disabled", false);
        }
      });
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
      $.post("./PHP/check_email.php", { email: email }).done(function (data) {
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
    $("#password-input-register").keyup(function () {
      checkPassword();
    });
  
    $("#confirm-password-input").keyup(function () {
      checkPassword();
    });
  });

  function isValidEmail(email) {
    var emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    return emailRegex.test(email);
  }

  
  function checkPassword() {
    var password = $("#password-input-register").val();
    var confirm_password = $("#confirm-password-input").val();
    var isValid = true;
  
    if (password.length < 8) {
      $("#msg-confirm-password").html(
        '<span class="text-danger">Password harus lebih dari 8 karakter!</span>'
      );
      $("#register-button").attr("disabled", true);
      isValid = false;
    } else if (password.indexOf(" ") >= 0) {
      $("#msg-confirm-password").html(
        '<span class="text-danger">Password tidak boleh mengandung spasi!</span>'
      );
      $("#register-button").attr("disabled", true);
      isValid = false;
    } else if (!password.match(/[^a-zA-Z0-9\-\/]/)) {
      $("#msg-confirm-password").html(
        '<span class="text-danger">Password harus mengandung 1 karakter spesial!</span>'
      );
      $("#register-button").attr("disabled", true);
      isValid = false;
    } else {
      $("#msg-confirm-password").html("");
      $("#register-button").attr("disabled", false);
    }
  
    if (password !== confirm_password) {
      $("#msg-confirm-password").html(
        '<span class="text-danger">Password tidak sama!</span>'
      );
      $("#register-button").attr("disabled", true);
      isValid = false;
    } else {
      $("#msg-confirm-password").html("");
      $("#register-button").attr("disabled", false);
    }
  
    return isValid;
  }
  // Registration form submission
  $("#register-button").click(function (event) {
    event.preventDefault();
    var name = $("#name-input").val();
    var email = $("#email-input-register").val();
    var password = $("#password-input-register").val();
    var confirm_password = $("#confirm-password-input").val();
    var isValid = true;
    if (name == "" || email == "" || password == "" || confirm_password == "") {
      $("#register-button").attr("disabled", true);
      isValid = false;
      $("#msg-confirm-password").html(
        '<span class="text-danger">Harap isi semua kolom!</span>'
      );
    } else if (password !== confirm_password) {
      $("#msg-confirm-password").html(
        '<span class="text-danger">Password tidak sama!</span>'
      );
      isValid = false;
    } else if (password.length < 8) {
      $("#msg-confirm-password").html(
        '<span class="text-danger">Password harus lebih dari 8 karakter!</span>'
      );
      $("#register-button").attr("disabled", true);
      isValid = false;
    } else if (password.indexOf(" ") >= 0) {
      $("#msg-confirm-password").html(
        '<span class="text-danger">Password tidak boleh mengandung spasi!</span>'
      );
      $("#register-button").attr("disabled", true);
      isValid = false;
    } else if (!password.match(/[^a-zA-Z0-9\-\/]/)) {
      $("#msg-confirm-password").html(
        '<span class="text-danger">Password harus mengandung 1 karakter spesial!</span>'
      );
      $("#register-button").attr("disabled", true);
      isValid = false;
    } else {
      $("#msg-confirm-password").html("");
    }

    if (!$("#agree-checkbox").is(":checked")) {
      $("#register-button").attr("disabled", true);
      isValid = false;
      $("#msg-confirm-password").html(
        '<span class="text-danger">Harap setujui syarat dan ketentuan!</span>'
      );
      }

    if (isValid) {
      $.post("./PHP/register-process.php", {
        name: name,
        email: email,
        password: password,
      }).done(function (data) {
        alert("Registrasi berhasil!");
        window.location.href = "./dashboard.html";
      });
    }
  });
});
