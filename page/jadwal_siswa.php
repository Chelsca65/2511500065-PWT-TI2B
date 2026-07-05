<?php
require_once("config/koneksi.php");

$id_kelas = $_SESSION['id_kelas'];

$queryJadwal = mysqli_query($koneksi,"
SELECT jadwal_kelas.*, kelas.nm_kelas
FROM jadwal_kelas
JOIN kelas
ON jadwal_kelas.id_kelas = kelas.id_kelas
WHERE jadwal_kelas.id_kelas='$id_kelas'
");

$hasiljadwal = mysqli_fetch_array($queryJadwal);

?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Jadwal Kelas Siswa</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <table border="0">
                    <tr>
                        <td width="150">Kelas</td>
                        <td width="10">:</td>
                        <td style="padding-left:10px;">
                        <td><?= $hasiljadwal['nm_kelas'] ?></td>
                    </tr>
                    <tr>
                        <td>Tahun Ajaran</td>
                        <td>:</td>
                        <td style="padding-left:10px;">
                        <td><?= $hasiljadwal['thn_ajaran'] ?></td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td style="padding-left:10px;">
                        <td><?= $hasiljadwal['semester'] ?></td>
                    </tr>
                </table>
                <br><strong>DETAIL JADWAL KELAS</strong>
                <div style="margin-top:10px; margin-bottom:10px;">

                </div>
                <div style="margin-top:15px;">
                    <table class="table table-striped">
                        <tread>
                            <tr>
                                <th>No</th>
                                <th>Nama Mapel</th>
                                <th>Nama Guru</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Jam</th>
                            </tr>
                        </tread>
                      <?php
$no = 1;

$query = mysqli_query($koneksi,"
SELECT detail_jadwal.*, mapel.nm_mapel, guru.nm_guru,
       kelas.nm_kelas
FROM jadwal_kelas
JOIN detail_jadwal
ON jadwal_kelas.id_jadwal = detail_jadwal.id_jadwal
JOIN mapel
ON detail_jadwal.kd_mapel = mapel.kd_mapel
JOIN guru
ON detail_jadwal.kd_guru = guru.kd_guru
JOIN kelas
ON jadwal_kelas.id_kelas = kelas.id_kelas
WHERE jadwal_kelas.id_kelas='$id_kelas'
");

while($result = mysqli_fetch_array($query)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $result['nm_mapel'] ?></td>
    <td><?= $result['nm_guru'] ?></td>
    <td><?= $result['nm_kelas'] ?></td>
    <td><?= $result['hari'] ?></td>
    <td><?= $result['jam'] ?></td>
</tr>
<?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>