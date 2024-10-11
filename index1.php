<?php
$conn = new mysqli("localhost", "root", "", "pertemuan2");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$sql = "SELECT * FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Catatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="p-3 mb-3 bg-primary">
<div>
    <h2 class="mb-4 text-white" style="margin: 20px 0 0 30px;">Daftar Catatan orang kuat</h2>
    <a class="btn btn-warning text-white" style="margin-left: 30px;" href="pages/create.php">Tambah Catatan Baru</a>
    <br><br>
    <table class="table table-stripped table-bordered table-hover    git push --set-upstream origin master text-white">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi Catatan</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                // Looping data dari database
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['judul'] . "</td>";
                    echo "<td>" . $row['isi'] . "</td>";
                    echo "<td>" . date('d-m-Y H:i', strtotime($row['created_at'])) . "</td>";
                    echo "<td>";
                    echo "<a href='./pages/edit.php?id=" . $row['id'] . "'>Edit</a> | ";
                    echo "<a href='./actions/delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah anda yakin ingin menghapus catatan ini?\");'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Belum ada catatan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br><span style="margin-left: 30px;" class="badge text-bg-light">Primary</span>
<span class="badge text-bg-info">Info</span>
</div>
</body>
</html>
<?php
$conn->close();
?>