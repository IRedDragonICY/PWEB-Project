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
    // input data to Azure SQL
    fetch('https://api-azure-sql.herokuapp.com/api/user', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },  
        body: JSON.stringify({
            name: name,
            email: email,
            password: password,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log('Success:', data);
            alert('Pendaftaran berhasil!');
            window.location.href = 'login.html';
        }
        )
        .catch((error) => {
            console.error('Error:', error);
            alert('Pendaftaran gagal!');
        }
        );

});
