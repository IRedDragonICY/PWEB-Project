document.getElementById('register-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (password !== confirmPassword) {
        alert('Password dan konfirmasi password tidak cocok.');
        return;
    }

    // create a new FormData object and append the form data
    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('password', password);

    // send the form data to insert.php using a POST request
    fetch('PHP/insert.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                alert(data.message);
                return;
            }
            window.location.href = 'login.html';
        })
        .catch(err => {
            alert('Terjadi kesalahan pada server.');
            console.error(err);
        });
});