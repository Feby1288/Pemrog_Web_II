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

// Fungsi untuk menambahkan dosen
function tambahDosen($nama, $nidn, $jenjang)
{
    global $conn;
    $sql = "INSERT INTO dosen (Nama, NIDN, `Jenjang Pendidikan`) VALUES ('$nama', '$nidn', '$jenjang')";
    if ($conn->query($sql) === TRUE) {
        echo "Dosen berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk mengupdate dosen
function updateDosen($id, $nama, $nidn, $jenjang)
{
    global $conn;
    $sql = "UPDATE dosen SET Nama='$nama', NIDN='$nidn', `Jenjang Pendidikan`='$jenjang' WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Dosen berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk menghapus dosen
function hapusDosen($id)
{
    global $conn;
    $sql = "DELETE FROM dosen WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Dosen berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk menampilkan semua dosen
function tampilkanDosen()
{
    global $conn;
    $sql = "SELECT * FROM dosen";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nama</th><th>NIDN</th><th>Jenjang Pendidikan</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["Nama"] . "</td>";
            echo "<td>" . $row["NIDN"] . "</td>";
            echo "<td>" . $row["Jenjang Pendidikan"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data dosen.";
    }
}

// Menangani form submit untuk tambah dosen
if (isset($_POST["tambah_dosen"])) {
    $nama = $_POST["nama"];
    $nidn = $_POST["nidn"];
    $jenjang = $_POST["jenjang"];
    tambahDosen($nama, $nidn, $jenjang);
}

// Menangani form submit untuk update dosen
if (isset($_POST["update_dosen"])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $nidn = $_POST["nidn"];
    $jenjang = $_POST["jenjang"];
    updateDosen($id, $nama, $nidn, $jenjang);
}

// Menangani form submit untuk hapus dosen
if (isset($_POST["hapus_dosen"])) {
    $id = $_POST["id"];
    hapusDosen($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>SI Akademik - Dosen</title>
</head>
<body>
    <h1>Dosen</h1>

    <h2>Tambah Dosen</h2>
    <form method="POST" action="">
        <label>Nama:</label>
        <input type="text" name="nama" required><br><br>
        <label>NIDN:</label>
        <input type="text" name="nidn" required><br><br>
        <label>Jenjang Pendidikan:</label>
        <select name="jenjang" required>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
        </select><br><br>
        <input type="submit" name="tambah_dosen" value="Tambah">
    </form>

    <h2>Daftar Dosen</h2>
    <?php tampilkanDosen(); ?>

    <h2>Update Dosen</h2>
    <form method="POST" action="">
        <label>ID Dosen:</label>
        <input type="text" name="id" required><br><br>
        <label>Nama:</label>
        <input type="text" name="nama" required><br><br>
        <label>NIDN:</label>
        <input type="text" name="nidn" required><br><br>
        <label>Jenjang Pendidikan:</label>
        <select name="jenjang" required>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
        </select><br><br>
        <input type="submit" name="update_dosen" value="Update">
    </form>

    <h2>Hapus Dosen</h2>
    <form method="POST" action="">
        <label>ID Dosen:</label>
        <input type="text" name="id" required><br><br>
        <input type="submit" name="hapus_dosen" value="Hapus">
    </form>
</body>
</html>
