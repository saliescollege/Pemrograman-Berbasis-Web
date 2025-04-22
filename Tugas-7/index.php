<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Data KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .text-pink {
            color: #e83e8c;
            font-weight: 500;
        }
    </style>
</head>

<body class="container mt-5">
    <h2 class="mb-4">Data Kartu Rencana Studi (KRS)</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah KRS</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Nama Mata Kuliah</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT 
                        krs.id, 
                        mahasiswa.nama AS nama_mahasiswa, 
                        matakuliah.nama AS nama_mk, 
                        matakuliah.jumlah_sks 
                      FROM krs
                      JOIN mahasiswa ON krs.mahasiswa_npm = mahasiswa.npm
                      JOIN matakuliah ON krs.matakuliah_kodemk = matakuliah.kodemk";
            $result = mysqli_query($conn, $query) or die("Query gagal: " . mysqli_error($conn));;

            while ($row = mysqli_fetch_assoc($result)) {
                $nama = htmlspecialchars($row['nama_mahasiswa']);
                $mk = htmlspecialchars($row['nama_mk']);
                $sks = $row['jumlah_sks'];
                $keterangan = "<span class='text-pink'>$nama</span> Mengambil Mata Kuliah <span class='text-pink'>$mk</span> (<span class='text-pink'>$sks SKS</span>)";

                echo "<tr>
                        <td>$no</td>
                        <td>$nama</td>
                        <td>$mk</td>
                        <td>$keterangan</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus_krs.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                        </td>
                    </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>