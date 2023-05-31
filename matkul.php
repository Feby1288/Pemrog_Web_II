<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "siakad";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Fungsi untuk menambahkan matakuliah
function tambahMatakuliah($nama, $kode, $deskripsi)
{
    global $conn;
    $sql = "INSERT INTO matakuliah (Nama, `Kode Matakuliah`, Deskripsi) VALUES ('$nama', '$kode', '$deskripsi')";
    if ($conn->query($sql) === TRUE) {
        echo "Matakuliah berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk mengupdate matakuliah
function updateMatakuliah($id, $nama, $kode, $deskripsi)
{
    global $conn;
    $sql = "UPDATE matakuliah SET Nama='$nama', `Kode Matakuliah`='$kode', Deskripsi='$deskripsi' WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Matakuliah berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk menghapus matakuliah
function hapusMatakuliah($id)
{
    global $conn;
    $sql = "DELETE FROM matakuliah WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Matakuliah berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk menampilkan semua matakuliah
function tampilkanMatakuliah()
{
    global $conn;
    $sql = "SELECT * FROM matakuliah";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nama</th><th>Kode Matakuliah</th><th>Deskripsi</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["Nama"] . "</td>";
            echo "<td>" . $row["Kode Matakuliah"] . "</td>";
            echo "<td>" . $row["Deskripsi"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data matakuliah.";
    }
}

// Menangani form submit untuk tambah matakuliah
if (isset($_POST["tambah_matakuliah"])) {
    $nama = $_POST["nama"];
    $kode = $_POST["kode"];
    $deskripsi = $_POST["deskripsi"];
    tambahMatakuliah($nama, $kode, $deskripsi);
}

// Menangani form submit untuk update matakuliah
if (isset($_POST["update_matakuliah"])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $kode = $_POST["kode"];
    $deskripsi = $_POST["deskripsi"];
    updateMatakuliah($id, $nama, $kode, $deskripsi);
}

// Menangani form submit untuk hapus matakuliah
if (isset($_POST["hapus_matakuliah"])) {
    $id = $_POST["id"];
    hapusMatakuliah($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>SI Akademik - Matakuliah</title>
</head>
<body>
    <h1>Matakuliah</h1>

    <h2>Tambah Matakuliah</h2>
    <form method="POST" action="">
        <label>Nama:</label>
        <input type="text" name="nama" required><br><br>
        <label>Kode:</label>
        <input type="text" name="kode" required><br><br>
        <label>Deskripsi:</label>
        <textarea name="deskripsi" required></textarea><br><br>
        <input type="submit" name="tambah_matakuliah" value="Tambah">
    </form>

    <h2>Daftar Matakuliah</h2>
    <?php tampilkanMatakuliah(); ?>

    <h2>Update Matakuliah</h2>
    <form method="POST" action="">
        <label>ID Matakuliah:</label>
        <input type="text" name="id" required><br><br>
        <label>Nama:</label>
        <input type="text" name="nama" required><br><br>
        <label>Kode:</label>
        <input type="text" name="kode" required><br><br>
        <label>Deskripsi:</label>
        <textarea name="deskripsi" required></textarea><br><br>
        <input type="submit" name="update_matakuliah" value="Update">
    </form>

    <h2>Hapus Matakuliah</h2>
    <form method="POST" action="">
        <label>ID Matakuliah:</label>
        <input type="text" name="id" required><br><br>
        <input type="submit" name="hapus_matakuliah" value="Hapus">
    </form>
</body>
</html>
