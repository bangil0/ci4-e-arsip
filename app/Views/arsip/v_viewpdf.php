<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-striped">
            <tr>
                <th width="100px">No Arsip</th>
                <th width="30px">:</th>
                <td><?= $arsip['no_arsip']; ?></td>
                <th width="100px">Tgl Upload</th>
                <th width="30px">:</th>
                <td><?= $arsip['tgl_upload']; ?></td>
            </tr>
            <tr>
                <th>Nama Arsip</th>
                <th>:</th>
                <td><?= $arsip['nama_arsip']; ?></td>
                <th>Tgl Update</th>
                <th>:</th>
                <td><?= $arsip['tgl_update']; ?></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <th>:</th>
                <td><?= $arsip['deskripsi']; ?></td>
                <th>Kategori</th>
                <th>:</th>
                <td><?= $arsip['nama_kategori']; ?></td>
            </tr>
            <tr>
                <th>Departemen</th>
                <th>:</th>
                <td><?= $arsip['nama_dep']; ?></td>
                <th>User</th>
                <th>:</th>
                <td><?= $arsip['nama_user']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-sm-12">
        <iframe src="<?= base_url('file_arsip/' . $arsip['file_arsip']) ?>" height="1000px" width="100%"></iframe>
    </div>
</div>
<?= $this->endsection(); ?>