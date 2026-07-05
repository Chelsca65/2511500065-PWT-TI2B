<?php
require_once("config/koneksi.php");

$kd_guru = $_SESSION['kd_guru'];
?>

<style>
@media print {

    .btn{
        display: none;
    }

}
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Jadwal Guru</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php
            $hasiljadwal = mysqli_fetch_array(mysqli_query($koneksi, "
            SELECT * FROM jadwal_kelas
            JOIN detail_jadwal
            ON jadwal_kelas.id_jadwal = detail_jadwal.id_jadwal

            JOIN guru
            ON guru.kd_guru = detail_jadwal.kd_guru

            WHERE detail_jadwal.kd_guru='$kd_guru'
            "));
            ?>

                <table border="0">
                    <tr>
                        <td width="150">Nama Guru</td>
                        <td width="10">:</td>
                        <td style="padding-left:10px;">
                        <td><?= $hasiljadwal['nm_guru'] ?></td>
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
                <br><strong>DETAIL JADWAL MENGAJAR</strong>
                <div style="margin-top:10px; margin-bottom:10px;">

                </div>
                <div style="margin-top:15px;">
                    <table class="table table-striped">
                        <tread>
                            <tr>
                                <th>No</th>
                                <th>Kd Mapel</th>
                                <th>Nama Mapel</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Jam</th>
                            </tr>
                        </tread>
                        <?php
                        $no = 0;
                       
                        $query = mysqli_query($koneksi,"
                      
                        SELECT *
                        FROM detail_jadwal
                        JOIN guru ON guru.kd_guru=detail_jadwal.kd_guru
                        JOIN mapel ON mapel.kd_mapel=detail_jadwal.kd_mapel
                        JOIN jadwal_kelas ON jadwal_kelas.id_jadwal=detail_jadwal.id_jadwal
                        JOIN kelas ON kelas.id_kelas=jadwal_kelas.id_kelas
                        WHERE detail_jadwal.kd_guru='$kd_guru'
                        ");
                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                        ?>
                            <tbody>
                                <tr>
                                    <td><?= $no; ?></td> 
                                    <td><?= $result['kd_mapel']; ?></td>
                                    <td><?= $result['nm_mapel']; ?></td>
                                    <td><?= $result['nm_kelas']; ?></td>
                                    <td><?= $result['hari']; ?></td>
                                    <td><?= $result['jam']; ?></td>

                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>