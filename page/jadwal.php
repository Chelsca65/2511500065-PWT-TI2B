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
            <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm">
            Tambah jadwal </a>
            <table class="table table-striped">
                <tread>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Tahun ajaran</th>
                        <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </tread>
                <?php
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT * FROM jadwal_kelas");
                while ($result = mysqli_fetch_array($query)) {
                    $no++;
                ?>
                <tbody>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $result['kelas']; ?></td>
                        <td><?= $result['thn_ajaran']; ?></td>
                        <td><?= $result['semester']; ?></td>
                        <td>
                            <a href="index.php?page=jadwal&action=hapus&kd=<?= $result['id_jadwal']
                             ?>" title="">
                                <span class="badge badge-danger">Hapus</span></a>
                            <a href="index.php?page=detail_jadwal&kd=<?= $result['id_jadwal'] ?>" title
                            =""><span class
                                ="badge badge-warning">Lihat Detail</span></a>
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</div>