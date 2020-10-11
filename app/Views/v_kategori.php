<?= $this->extend('layouts/app'); ?>

<?= $this->section('css'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('templates/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
<?= $this->endsection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <?php
    if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">';
        echo session()->getFlashdata('pesan');
        echo '</div>';
    }
    ?>
    <div class="col">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data <?= $title; ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">No</th>
                            <th>Kategori</th>
                            <th class="text-center" width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kategori as $data) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $data['nama_kategori']; ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $data['id_kategori'] ?>">Edit</button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete<?= $data['id_kategori'] ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<!-- Modal add Kategori -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah <?= $title ?></h4>
            </div>
            <div class="modal-body">
                <?= form_open('kategori/tambah') ?>
                <div class="box-body">
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Masukan Kategori" required>
                    </div>
                </div>
                <!-- /.box-body -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal EDit Kategori -->
<?php foreach ($kategori as $data) : ?>
    <div class="modal fade" id="edit<?= $data['id_kategori'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit <?= $title ?></h4>
                </div>
                <div class="modal-body">
                    <?= form_open('kategori/edit/' . $data['id_kategori']) ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" placeholder="Masukan Kategori" required value="<?= $data['nama_kategori']; ?>">
                        </div>
                    </div>
                    <!-- /.box-body -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
                <?= form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach ?>
<!-- /.modal -->

<!-- Modal Hapus Kategori -->
<?php foreach ($kategori as $data) : ?>
    <div class="modal fade" id="delete<?= $data['id_kategori'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Hapus <?= $title ?></h4>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin hapus <?= $data['nama_kategori']; ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('kategori/delete/' . $data['id_kategori']) ?>" class="btn btn-success">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach ?>
<!-- /.modal -->
<?= $this->endsection(); ?>

<?= $this->section('js'); ?>
<!-- DataTables -->
<script src="<?= base_url('templates/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('templates/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>
<?= $this->endsection(); ?>