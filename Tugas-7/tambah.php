<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2 class="mb-4">Tambah Kartu Rencana Studi (KRS)</h2>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Pilih Mahasiswa</label>
            <select name="mahasiswa_npm" class="form-select" required>
                <option value=""></option>
                <?php
                $mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa");
                while ($mhs = mysqli_fetch_assoc($mahasiswa)) {
                    echo "<option value='{$mhs['npm']}'>{$mhs['nama']} ({$mhs['npm']})</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="matakuliah" class="form-label">Pilih Mata Kuliah</label>
            <select name="matakuliah_kodemk" class="form-select" required>
                <option value=""></option>
                <?php
                $matakuliah = mysqli_query($conn, "SELECT * FROM matakuliah");
                while ($mk = mysqli_fetch_assoc($matakuliah)) {
                    echo "<option value='{$mk['kodemk']}'>{$mk['nama']} ({$mk['jumlah_sks']} SKS)</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $npm = $_POST['mahasiswa_npm'];
        $kodemk = $_POST['matakuliah_kodemk'];

        $query = "INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('$npm', '$kodemk')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<div class='alert alert-success mt-3'>Data KRS berhasil ditambahkan.</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal menambahkan data. " . mysqli_error($conn) . "</div>";
        }
    }
    ?>
</body>

</html>