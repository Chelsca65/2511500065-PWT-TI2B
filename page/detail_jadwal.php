<?php
require_once("config/koneksi.php");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Jadwal Kelas</h1>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_GET['action'])) {
    if($_GET['action'] == "hapus") {
        $kd =$_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM jadwal_kelas where id_jadwal = '$kd' ");
        if ($query){
            echo '
            <div class="alert alert-warning alert-dismissible">
            Berhasil Di Hapus</div>';
            echo '<meta http-equiv="refersh" content=1;url=index.php?page=jadwal">';
        }
    }
}
?>
<div class="content">
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <?php
            $hasiljadwal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM jadwal_kelas")); 
            ?>
            <table border="0">
                <tr>
                    <td width="150">Tahun Ajaran</td>
                    <td width="10">:</td>
                    <td style="padding-left:10px;">
                    <td><?= $hasiljadwal['thn_ajaran'] ?></td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>:</td>
                    <td style="padding-left:10px;">
                    <td><?= $hasiljadwal['semester'] ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td style="padding-left:10px;">
                    <td><?= $hasiljadwal['kelas'] ?></td>
                </tr>
            </table>
            <br><strong>DETAIL JADWAL KELAS</strong>
            <div style="margin-top:15px;">
            <table class="table table-striped">
                <tread>
                    <tr>
                        <th>No</th>
                        <th>Kd Mapel</th>
                        <th>Nama Mapel</th>
                        <th>Nama Guru</th>
                        <th>Hari</th>
                        <th>Jam</th>
                    </tr>
                </tread>
                <?php
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT * FROM jadwal_kelas 
                JOIN detail_jadwal ON jadwal_kelas.id_jadwal=detail_jadwal.id_jadwal 
                JOIN mapel ON mapel.kd_mapel=detail_jadwal.kd_mapel 
                JOIN guru ON guru.kd_guru=detail_jadwal.kd_guru");
                while ($result = mysqli_fetch_array($query)) {
                    $no++;
                ?>
                <tbody>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $result['kd_mapel']; ?></td>
                        <td><?= $result['nm_mapel']; ?></td>
                        <td><?= $result['nm_guru']; ?></td>
                        <td><?= $result['hari']; ?></td>                        
                        <td><?= $result['jam_mulai']; ?> s.d <?= $result['jam_selesai']; ?></td>
    
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</div>