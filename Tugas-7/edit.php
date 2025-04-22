<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2 class="mb-4">Edit Data KRS</h2>

    <?php
    if (!isset($_GET['id'])) {
        echo "<div class='alert alert-danger'>ID KRS tidak ditemukan.</div>";
        exit;
    }

    $id = $_GET['id'];

    $query = "SELECT krs.*, mahasiswa.nama, mahasiswa.npm 
              FROM krs 
              JOIN mahasiswa ON krs.mahasiswa_npm = mahasiswa.npm 
              WHERE krs.id = '$id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
        exit;
    }

    $data = mysqli_fetch_assoc($result);
    ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">NPM</label>
            <input type="text" class="form-control" value="<?= $data['npm']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" value="<?= $data['nama']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Mata Kuliah</label>
            <select name="matakuliah_kodemk" class="form-select" required>
                <option value=""></option>
                <?php
                $matkul = mysqli_query($conn, "SELECT * FROM matakuliah");
                while ($mk = mysqli_fetch_assoc($matkul)) {
                    $selected = ($mk['kodemk'] == $data['matakuliah_kodemk']) ? "selected" : "";
                    echo "<option value='{$mk['kodemk']}' $selected>{$mk['nama']} ({$mk['jumlah_sks']} SKS)</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $new_kodemk = $_POST['matakuliah_kodemk'];

        $update = mysqli_query($conn, "UPDATE krs SET matakuliah_kodemk='$new_kodemk' WHERE id='$id'");

        if ($update) {
            echo "<div class='alert alert-success mt-3'>Data KRS berhasil diupdate.</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal mengupdate data: " . mysqli_error($conn) . "</div>";
        }
    }
    ?>

</body>

</html>