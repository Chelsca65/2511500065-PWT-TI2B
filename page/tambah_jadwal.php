<?php
require_once("config/koneksi.php");
?>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
//kode otomatis
$carikode = mysqli_query($koneksi, "select max(id_jadwal) from jadwal_kelas") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0] !== null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "J-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "J-001";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_jadwal = $_POST['id_jadwal'];
    $id_kelas = $_POST['id_kelas'];
    $semester = $_POST['semester'];
    $thn_ajaran = $_POST['thn_ajaran'];

    $kd_mapel = $_POST['kd_mapel'];
    $kd_guru = $_POST['kd_guru'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];

    // Insert ke tabel jadwal
    $insertjadwal = mysqli_query($koneksi, "INSERT INTO jadwal_kelas values ('$id_jadwal','$id_kelas', '$thn_ajaran', '$semester')");

    if (!$insertjadwal) {
        echo "Gagal insert ke tabel jadwal: " . mysqli_error($koneksi);
        die;
    }

    //insert ke detailjadwal
    $allSuccess = true;
    for ($i = 0; $i < count($kd_mapel); $i++) {
        $insert = mysqli_query($koneksi, "INSERT INTO detail_jadwal (id_jadwal, kd_mapel, kd_guru, hari, jam)
        VALUES ('$id_jadwal', '{$kd_mapel[$i]}' , '{$kd_guru[$i]}','{$hari[$i]}' , '{$jam[$i]}')");
        if (!$insert) {
            $allSuccess = false;
            echo "Gagal insert detail ke-{$i}: " . mysqli_error($koneksi);
        }
    }

    if ($allSuccess) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" contents="1;url=index.php?page=jadwal">';
    } else {
        echo 'div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal menyimpan sebagian atau seluruh data detail. </h4></div>';
    }
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Kode Jadwal</label>
                        <input type="text" name="id_jadwal" value="<?= $hasilkode; ?>" placeholder="Id jadwal" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control" required>
                            <option selected disabled>--Pilih Kelas--</option>
                            <?php
                            $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                            while ($k = mysqli_fetch_assoc($kelas)) {
                                echo "<option value='{$k['id_kelas']}'>{$k['nm_kelas']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option selected disabled>--Pilih Semester--</option>
                            <option>Ganjil</option>
                            <option>Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="thn_ajaran" class="form-control" required>
                            <option selected disabled>--Pilih Tahun Ajaran--</option>
                            <option>2024-2025</option>
                            <option>2025-2026</option>
                        </select>
                    </div>

                    <hr>
                    <h5>Detail Jadwal</h5>
                    <div id="detail-jadwal">
                        <div class="row mb-2">
                            <div class="col-mb-3">
                                <select name="kd_mapel[]" class="form-control">
                                    <option selected disabled>--Pilih Mapel--</option>
                                    <?php
                                    $mapel = mysqli_query($koneksi, "SELECT * FROM mapel");
                                    while ($k = mysqli_fetch_assoc($mapel)) {
                                        echo "<option value='{$k['kd_mapel']}'>{$k['nm_mapel']} </option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="kd_guru[]" class="form-control" required>
                                    <option selected disabled>--Pilih Guru--</option>
                                    <?php
                                    $guru = mysqli_query($koneksi, "SELECT * FROM guru");
                                    while ($g = mysqli_fetch_assoc($guru)) {
                                        echo "<option value='{$g['kd_guru']}'>{$g['nm_guru']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="hari[]" class="form-control" required>
                                    <option selected disabled>--Pilih Hari--</option>
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    <option>Sabtu</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="jam[]" class="form-control" required>
                                    <option selected disabled>--Pilih Jam--</option>
                                    <option>08.00-10.00</option>
                                    <option>08.00-09.30</option>
                                    <option>10.30-12.00</option>
                                    <option>12.30-14.00</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info" onclick="tambahBaris()"> + Tambah Mapel </button>
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                </form>




                <script>
                    function tambahBaris() {
                        let container = document.getElementById('detail-jadwal');
                        let row = container.firstElementChild.cloneNode(true);
                        row.querySelectorAll('input').forEach(input => input.value = '');
                        container.appendChild(row);
                    }
                </script>

            </div>
        </div>
    </div>
    </div>