<?php
$query = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id DESC");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM level WHERE id='$id'");
    header("location:?pg=level&hapus=berhasil");
}
?>
<div align="right" class="mb-3">
    <a href="?pg=tambah-level" class="btn btn-primary"> Tambah Level</a>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Level</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        while ($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['nama_level'] ?></td>
                <td><?php echo $row['keterangan'] ?></td>
                <td><a href="?pg=tambah-level&edit=<?php echo $row['id'] ?>" class="btn btn-xs btn-danger">Edit</a> |
                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="?pg=level&delete=<?php echo $row['id'] ?>" class=" btn btn-xs btn-success">Delete</a>
                </td>
                </td>
            </tr>
        <?php endwhile ?>
    </tbody>
</table>