<?php
// Koneksi ke database (ganti sesuai dengan detail koneksi database Anda)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "tabunganku";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Fungsi untuk memperbarui pengaturan akun dalam database
function updateAccountSettings($field, $value, $user_id) {
    global $conn;
    $sql = "UPDATE accountdb SET $field = '$value' WHERE id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Pengaturan akun berhasil diperbarui.";
    } else {
        echo "Terjadi kesalahan saat memperbarui pengaturan akun: " . $conn->error;
    }
}

// Mendapatkan data pengguna dari database berdasarkan ID pengguna
function getUserData($user_id) {
    global $conn;
    $sql = "SELECT * FROM accountdb WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Proses pembaruan pengaturan akun
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];

    // Mengupdate foto profil jika ada perubahan
    if ($_FILES['foto_profil']['name'] != '') {
        $foto_profil = $_FILES['foto_profil']['name'];
        $target_dir = "/uploads/pict_profile/";
        $target_file = $target_dir . basename($_FILES["foto_profil"]["name"]);
        move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $target_file);
        updateAccountSettings('foto_profil', $foto_profil, $user_id);
    }

    // Memperbarui pengaturan akun lainnya jika ada perubahan
    if (isset($_POST['nis'])) {
        $nis = $_POST['nis'];
        updateAccountSettings('nis', $nis, $user_id);
    }
    if (isset($_POST['tanggal_lahir'])) {
        $tanggal_lahir = $_POST['tanggal_lahir'];
        updateAccountSettings('tanggal_lahir', $tanggal_lahir, $user_id);
    }
    if (isset($_POST['jenis_kelamin'])) {
        $jenis_kelamin = $_POST['jenis_kelamin'];
        updateAccountSettings('jenis_kelamin', $jenis_kelamin, $user_id);
    }
    if (isset($_POST['kelas_jenjang'])) {
        $kelas_jenjang = $_POST['kelas_jenjang'];
        updateAccountSettings('kelas_jenjang', $kelas_jenjang, $user_id);
    }
    if (isset($_POST['sekolah'])) {
        $sekolah = $_POST['sekolah'];
        updateAccountSettings('sekolah', $sekolah, $user_id);
    }
    if (isset($_POST['kontak_ortu'])) {
        $kontak_ortu = $_POST['kontak_ortu'];
        updateAccountSettings('kontak_ortu', $kontak_ortu, $user_id);
    }
    if (isset($_POST['alamat'])) {
        $alamat = $_POST['alamat'];
        updateAccountSettings('alamat', $alamat, $user_id);
    }
}

// Mendapatkan data pengguna berdasarkan ID (ganti dengan ID pengguna yang sesuai)
// dapatkan ID pengguna dari name atau username yang sedang login
$user_id = $_SESSION['user_id'];
$user_data = getUserData($user_id);

?>
<!-- Tampilan HTML untuk Pusat Akun -->
<html>
<head>
    <title>Pusat Akun</title>
    <!-- Tambahkan CSS dan JS sesuai kebutuhan -->
</head>
<body>
    <h1>Pusat Akun</h1>

    <!-- Form untuk mengubah profil akun -->
    <form method="post" enctype="multipart/form-data">
        <label for="foto_profil">Foto Profil</label>
        <input type="file" id="foto_profil" name="foto_profil"><br>

        <label for="nis">NIS (Nomor Induk Siswa)</label>
        <input type="text" id="nis" name="nis" value="<?php echo $user_data['nis']; ?>"><br>

        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $user_data['tanggal_lahir']; ?>"><br>

        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin">
            <option value="laki-laki" <?php if ($user_data['jenis_kelamin'] == 'laki-laki') echo 'selected'; ?>>Laki−Laki</option>
            <option value="perempuan" <?php if ($user_data['jenis_kelamin'] == 'perempuan') echo 'selected'; ?>>Perempuan</option>  
        </select><br>

        <label for="kelas_jenjang">Kelas/Jenjang</label>
        <input type="text" id="kelas_jenjang" name="kelas_jenjang" value="<?php echo $user_data['kelas_jenjang']; ?>"><br>

        <label for="sekolah">Sekolah</label>
        <input type="text" id="sekolah" name="sekolah" value="<?php echo $user_data['sekolah']; ?>"><br>

        <label for="kontak_ortu">Kontak Orang Tua/Wali</label>
        <input type="text" id="kontak_ortu" name="kontak_ortu" value="<?php echo $user_data['kontak_ortu']; ?>"><br>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat"><?php echo $user_data['alamat']; ?></textarea><br>

        <button type="submit">Update</button>
        <button type="button">Cancel</button>
    </form>

    <script src="js/settings.js"></script>
</body>
</html>

<?php
// Tutup koneksi database setelah selesai digunakan
$conn->close();
?>
