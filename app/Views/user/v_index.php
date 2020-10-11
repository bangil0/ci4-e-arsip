<?= $this->extend('layouts/app'); ?>

<?= $this->section('css'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('templates/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
<?= $this->endsection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible">
            <?= session()->getFlashdata('pesan') ?>
        </div>
    <?php endif ?>
    <div class="col">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data <?= $title; ?></h3>

                <div class="box-tools pull-right">
                    <a href="<?= base_url('user/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Departemen</th>
                            <th>Foto</th>
                            <th class="text-center" width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($user as $data) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $data['nama_user']; ?></td>
                                <td><?= $data['email']; ?></td>
                                <td><?= ($data['level'] == 1) ? 'Admin' : 'User' ?></td>
                                <td><?= $data['nama_dep']; ?></td>
                                <td class="text-center"><img src="<?= base_url('foto/' . $data['foto']) ?>" width="50px"></td>
                                <td class="text-center">
                                    <a href="<?= base_url('user/edit/' . $data['id_user']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete<?= $data['id_user'] ?>">Delete</button>
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

<!-- Modal Hapus Kategori -->
<?php foreach ($user as $data) : ?>
    <div class="modal fade" id="delete<?= $data['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Hapus <?= $title ?></h4>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin hapus <?= $data['nama_user']; ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('user/delete/' . $data['id_user']) ?>" class="btn btn-success">Ya</a>
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