<?php
require_once("config/koneksi.php");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ekstrakulikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_GET['action'])) {
    if($_GET['action'] == "hapus") {
        $kd =$_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM ekstra_2511500065 where id_ekstra065 = '$kd' ");
        if ($query){
            echo '
            <div class="alert alert-warning alert-dismissible">
            Berhasil Di Hapus</div>';
            echo '<meta http-equiv="refersh" content=1;url=index.php?page=ekstra2511500065">';
        }
    }
}
?>
<div class="content">
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <a href="index.php?page=tambah_ekstra2511500065" class="btn btn-primary btn-sm">
            Tambah Ekstrakulikuler </a>
            <table class="table table-striped">
                <tread>
                    <tr>
                        <th>No</th>
                        <th>Kd Ekstrakulikuler</th>
                        <th>Nama Ekstrakulikuler</th>
                        <th>Keterangan</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Aksi</th>
                    </tr>
                </tread>
                <?php
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500065");
                while ($result = mysqli_fetch_array($query)) {
                    $no++;
                ?>
                <tbody>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $result['id_ekstra065']; ?></td>
                        <td><?= $result['nama_ekstra065']; ?></td>
                        <td><?= $result['ket065']; ?></td>
                        <td><?= $result['semester065']; ?></td>
                        <td><?= $result['thn_ajaran065']; ?></td>
                        <td>
                            <a href="index.php?page=ekstra2511500065&action=hapus&kd=<?= $result['id_ekstra065']
                             ?>" title="">
                                <span class="badge badge-danger">Hapus</span></a>
                            <a href="index.php?page=edit_ekstra2511500065&kd=<?= $result['id_ekstra065'] ?>" title
                            =""><span class
                                ="badge badge-warning">Edit</span></a>
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</div>