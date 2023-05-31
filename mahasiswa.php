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

// Fungsi untuk menambahkan mahasiswa
function tambahMahasiswa($nama, $nim, $program_studi)
{
    global $conn;
    $sql = "INSERT INTO mahasiswa (Nama, NIM, `Program Studi`) VALUES ('$nama', '$nim', '$program_studi')";
    if ($conn->query($sql) === TRUE) {
        echo "Mahasiswa berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk mengupdate mahasiswa
function updateMahasiswa($id, $nama, $nim, $program_studi)
{
    global $conn;
    $sql = "UPDATE mahasiswa SET Nama='$nama', NIM='$nim', `Program Studi`='$program_studi' WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Mahasiswa berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk menghapus mahasiswa
function hapusMahasiswa($id)
{
    global $conn;
    $sql = "DELETE FROM mahasiswa WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Mahasiswa berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk menampilkan semua mahasiswa
function tampilkanMahasiswa()
{
    global $conn;
    $sql = "SELECT * FROM mahasiswa";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nama</th><th>NIM</th><th>Program Studi</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["Nama"] . "</td>";
            echo "<td>" . $row["NIM"] . "</td>";
            echo "<td>" . $row["Program Studi"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data mahasiswa.";
    }
}

// Menangani form submit untuk tambah mahasiswa
if (isset($_POST["tambah_mahasiswa"])) {
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $program_studi = $_POST["program_studi"];
    tambahMahasiswa($nama, $nim, $program_studi);
}

// Menangani form submit untuk update mahasiswa
if (isset($_POST["update_mahasiswa"])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $program_studi = $_POST["program_studi"];
    updateMahasiswa($id, $nama, $nim, $program_studi);
}

// Menangani form submit untuk hapus mahasiswa
if (isset($_POST["hapus_mahasiswa"])) {
    $id = $_POST["id"];
    hapusMahasiswa($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>SI Akademik - Mahasiswa</title>
</head>
<body>
    <h1>Mahasiswa</h1>

    <h2>Tambah Mahasiswa</h2>
    <form method="POST" action="">
        <label>Nama:</label>
        <input type="text" name="nama" required><br><br>
        <label>NIM:</label>
        <input type="text" name="nim" required><br><br>
        <label>Program Studi:</label>
        <input type="text" name="program_studi" required><br><br>
        <input type="submit" name="tambah_mahasiswa" value="Tambah">
    </form>

    <h2>Daftar Mahasiswa</h2>
    <?php tampilkanMahasiswa(); ?>

    <h2>Update Mahasiswa</h2>
    <form method="POST" action="">
        <label>ID Mahasiswa:</label>
        <input type="text" name="id" required><br><br>
        <label>Nama:</label>
        <input type="text" name="nama" required><br><br>
        <label>NIM:</label>
        <input type="text" name="nim" required><br><br>
        <label>Program Studi:</label>
        <input type="text" name="program_studi" required><br><br>
        <input type="submit" name="update_mahasiswa" value="Update">
    </form>

    <h2>Hapus Mahasiswa</h2>
    <form method="POST" action="">
        <label>ID Mahasiswa:</label>
        <input type="text" name="id" required><br><br>
        <input type="submit" name="hapus_mahasiswa" value="Hapus">
    </form>
</body>
</html>
