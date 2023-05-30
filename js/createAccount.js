document.getElementById('register-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const nama = document.getElementById('nama').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (password !== confirmPassword) {
        alert('Password dan konfirmasi password tidak cocok.');
        return;
    }
});
