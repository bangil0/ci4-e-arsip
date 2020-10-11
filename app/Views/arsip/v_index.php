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
                    <a href="<?= base_url('arsip/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>No Arsip</th>
                            <th>Nama Arsip</th>
                            <th>Kategori</th>
                            <th>Upload</th>
                            <th>Update</th>
                            <th>Departemen</th>
                            <th>User</th>
                            <th>Detail</th>
                            <th class=" text-center" width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($arsip as $data) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $data['no_arsip']; ?></td>
                                <td><?= $data['nama_arsip']; ?></td>
                                <td><?= $data['nama_kategori']; ?></td>
                                <td><?= $data['tgl_upload']; ?></td>
                                <td><?= $data['tgl_update']; ?></td>
                                <td><?= $data['nama_dep']; ?></td>
                                <td><?= $data['nama_user']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('arsip/viewpdf/' . $data['id_arsip']) ?>" class="btn btn-sm btn-primary">Lihat</a><br>
                                    <?= number_format($data['ukuran_file'], 0); ?> Byte
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('arsip/edit/' . $data['id_arsip']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete<?= $data['id_arsip'] ?>">Delete</button>
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
<?php foreach ($arsip as $data) : ?>
    <div class="modal fade" id="delete<?= $data['id_arsip'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Hapus <?= $title ?></h4>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin hapus <?= $data['nama_arsip']; ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('arsip/delete/' . $data['id_arsip']) ?>" class="btn btn-success">Ya</a>
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